#!/bin/sh
#
# Sample TaskProlog script that will print a batch job's
# job ID and node list to the job's stdout
#

if [ X"$SLURM_STEP_ID" = "X" -a X"$SLURM_PROCID" = "X"0 ]
then
  echo -e "print ==========================================\n"
  echo -e "print SLURM_JOB_ID = $SLURM_JOB_ID\n"
  echo -e "print SLURM_JOB_NODELIST = $SLURM_JOB_NODELIST\n"
  echo -e "print ==========================================\n"
fi

