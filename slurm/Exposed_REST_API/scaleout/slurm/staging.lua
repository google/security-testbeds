local json = require 'json'
local open = io.open

local function read_file(path)
	local file = open(path, "rb")
	if not file then return nil end
	local content = file:read "*all"
	file:close()
	return content
end

local function write_file(path, contents)
	local file = open(path, "wb")
	if not file then return nil end
	file:write(contents)
	file:close()
	return
end

-- deepcopy() is from http://lua-users.org/wiki/CopyTable
function deepcopy(orig)
	local orig_type = type(orig)
	local copy
	if orig_type == 'table' then
		copy = {}
		for orig_key, orig_value in next, orig, nil do
			copy[deepcopy(orig_key)] = deepcopy(orig_value)
		end
		setmetatable(copy, deepcopy(getmetatable(orig)))
	else -- number, string, boolean, etc
		copy = orig
	end
	return copy
end

function sync(src, dst)
	local a = string.format(
		"/usr/bin/env rsync --numeric-ids --delete-after --ignore-errors --stats -a -- %s %s",
		src, dst)
	slurm.log_info("calling: %s", a)
	os.execute(string.format("echo -- calling %s", a))

	if (not os.execute(a))
	then
		-- FIXME: need to get rc from rsync
		slurm.log_info("rsync had errors")
	end
end

function slurm_stage_in_remote(id, bundle, spool_path, config_path)
	return slurm.SUCCESS
end

function slurm_stage_in_allocator(id, bundle, spool_path, config_path)
	slurm.log_info("called slurm_stage_in_allocator() bundle:%s spool_path:%s config_path:%s",
		bundle, spool_path, config_path)

	local user = os.getenv("SCRUN_USER")
	local uid = tonumber(os.getenv("SCRUN_USER_ID"))
	local gid = tonumber(os.getenv("SCRUN_GROUP_ID"))
	local config_contents = read_file(config_path)
	local p = "/srv/containers/"..user.."/"..id.."/"
	local c = json.decode(config_contents)
	local jc = p.."/config.json"
	local rootfs = c["root"]["path"]
	local dstfs = p.."/rootfs/"

	if (string.sub(rootfs, 0, 1) ~= "/")
	then
		rootfs = bundle .. "/" .. rootfs
	end

	-- override root path to new location
	c["root"]["path"] = p.."/rootfs"

	-- any rlimit requests will be rejected causing container to fail
	c["process"]["rlimits"] = nil

	-- remove any request to mount /dev/pts as it will be rejected --
	for i,m in ipairs(c["mounts"]) do
		if m["type"] == "devpts" then
			for v,o in ipairs(m["options"]) do
				if string.find(o, "gid=") then
					-- must use the gid from inside of the container
					c["mounts"][i]["options"][v] = "gid=" .. tonumber(c["process"]["user"]["gid"])
				end
			end
		end
	end

	-- crun requires user namespace but centos crun doesnt include this patch set
	-- https://github.com/containers/crun/pull/181/files
	table.insert(c["linux"]["namespaces"], {type="user"})
	-- user namespace requires mappings
	c["linux"]["uidMappings"] = {};
	table.insert(c["linux"]["uidMappings"], { containerID=c["process"]["user"]["uid"], hostID=uid, size=1 })
	c["linux"]["gidMappings"] = {};
	table.insert(c["linux"]["gidMappings"], { containerID=c["process"]["user"]["gid"], hostID=gid, size=1 })

	if (not os.execute("mkdir -p "..dstfs))
	then
		slurm.log_info("mkdir failed")
	end

	-- send over rootfs
	sync(rootfs .. "/", dstfs .. "/")

	-- handle special bind mounts that are local only
	-- make a new mounts array to avoid using table.remove()
	-- https://stackoverflow.com/questions/12394841/safely-remove-items-from-an-array-table-while-iterating
	local mounts = {}
	for i,m in ipairs(c["mounts"]) do
		slurm.log_info("mount source: %s", m["source"])
		if string.find(m["source"], "overlay%-container", 0, plain) then
			sync(m["source"], dstfs .. m["destination"])
		else
			table.insert(mounts, deepcopy(m))
		end
	end
	c["mounts"] = mounts

	slurm.set_bundle_path(p)
	slurm.set_root_path(p.."rootfs")

	write_file(jc, json.encode(c))
	slurm.log_info("created: "..jc)

	return slurm.SUCCESS
end

function slurm_stage_out_allocator(id, bundle, spool_path, config_path)
	slurm.log_info("called slurm_stage_out_allocator() bundle:%s spool_path:%s config_path:%s", bundle, spool_path, config_path)

	if (not os.execute("rm --one-file-system --preserve-root=all -rf "..bundle))
	then
		slurm.log_info("rsync failed")
		return slurm.FAILURE;
	end

	return slurm.SUCCESS
end

function slurm_stage_out_remote(id, bundle, spool_path, config_path)
	return slurm.SUCCESS
end

slurm.log_info("initialized container_bb.lua")

return slurm.SUCCESS
