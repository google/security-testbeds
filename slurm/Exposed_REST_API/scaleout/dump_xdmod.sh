#!/bin/bash
export TZ=UTC

#formatted for xdmod 9.5 per
# https://open.xdmod.org/9.5/resource-manager-slurm.html
sacct --allusers --parsable2 --noheader --allocations --duplicates \
	--format jobid,jobidraw,cluster,partition,account,group,gid,user,uid,submit,eligible,start,end,elapsed,exitcode,state,nnodes,ncpus,reqcpus,reqmem,reqtres,alloctres,timelimit,nodelist,jobname \
	--state CANCELLED,COMPLETED,FAILED,NODE_FAIL,PREEMPTED,TIMEOUT \
	--starttime now-1hour --endtime now >> /xdmod/data.csv
