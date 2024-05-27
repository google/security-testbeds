#!/bin/bash
SLURM_SPOOLDIR=/var/spool/slurm/statesave
JOB_SCRIPT=$SLURM_SPOOLDIR/hash.${SLURM_JOB_ID: -1:1}/job.$SLURM_JOB_ID/script
if [ -f $JOB_SCRIPT ]; then
    cp $JOB_SCRIPT /tmp/${SLURM_JOB_ID}_script
fi

