#!/bin/bash
#SBATCH -J myprogram
#SBATCH -c 1
#SBATCH -N 1
#SBATCH -t 0-2:00
#SBATCH --array=1-30
#SBATCH -o myprogram%A_%a.out
# %A" is replaced by the job ID and "%a" with the array index
#SBATCH -e myprogram%A_%a.err

./myprogram input$SLURM_ARRAY_TASK_ID.dat

sleep 10
