function slurm_job_submit(job_desc, part_list, submit_uid)
        if job_desc.account == nil then
                slurm.log_user("--account option required")
                return slurm.ESLURM_INVALID_ACCOUNT
        end
        if job_desc.time_limit == slurm.NO_VAL then
                slurm.log_user("--time limit option required")
                return slurm.ESLURM_INVALID_TIME_LIMIT
        end

        return slurm.SUCCESS
end
function slurm_job_modify(job_desc, job_rec, part_list, modify_uid)
        return slurm.SUCCESS
end
return slurm.SUCCESS

