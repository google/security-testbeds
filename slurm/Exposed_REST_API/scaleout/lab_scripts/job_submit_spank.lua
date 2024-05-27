function slurm_job_submit(job_desc, part_list, submit_uid)
	if job_desc.account and job_desc.account == "projecta" then
		job_desc.script = string.gsub(job_desc.script, "srun", "srun --renice=-10")
	elseif job_desc.account and job_desc.account == "projectb" then
		job_desc.script = string.gsub(job_desc.script, "srun", "srun --renice=15")
	end
	return slurm.SUCCESS
end
function slurm_job_modify(job_desc, job_rec, part_list, modify_uid)
	return slurm.SUCCESS
end
slurm.log_user("initialized")
return slurm.SUCCESS
