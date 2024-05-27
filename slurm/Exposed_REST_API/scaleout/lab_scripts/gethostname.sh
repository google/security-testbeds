#!/bin/bash

#SBATCH -N10  # Run this across 10 nodes
#SBATCH -n20  # Run 20 tasks
#SBATCH --mail-user=fred@localhost # Send mail to fred
#SBATCH --mail-type=BEGIN,END,FAIL # Send mail on begin, end, fail
#SBATCH -t1  # Submit with 1 minute of walltime
#SBATCH -o gethostname_%j.out # output goes to gethostname_<JOBID>.out
#SBATCH -e gethostname_%j.err # error goes to gethostname_<JOBID>.err

srun -l hostname | sort -h

