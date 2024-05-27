#!/bin/bash

for x in {1..1000} ; do
sudo su - fred -c "sbatch --qos=normal -Amanagers -N1 --mem=100 -t10 -o /dev/null --wrap='srun hostname'"
sudo su - fred -c "sbatch --qos=normal -Abedrock -N1 --mem=200 -t10 -o /dev/null --wrap='srun hostname'"
sudo su - chip -c "sbatch --qos=normal -Amicro -N2 --mem=300 -t20 -o /dev/null --wrap='srun hostname'"
sudo su - dino -c "sbatch --qos=normal -Amicro -N3 --mem=400 -t30 -o /dev/null --wrap='srun hostname'"
sudo su - edna -c "sbatch --qos=normal -Amolecular -N4 --mem=500 -t40 -o /dev/null --wrap='srun hostname'"
sudo su - gazoo -c "sbatch --qos=normal -Amolecular -N5 --mem=600 -t50 -o /dev/null --wrap='srun hostname'"
sudo su - barney -c "sbatch --qos=normal -Amanagers -N2 --mem=700 -t50 -o /dev/null --wrap='srun hostname'"
sudo su - wilma -c "sbatch --qos=normal -Abedrock -N5 --mem=800 -t50 -o /dev/null --wrap='srun hostname'"
sudo su - pebbles -c "sbatch --qos=normal -Agpuusers -N1 --mem=800 -t50 --gres=gpu:gtx:2 -o /dev/null --wrap='srun hostname'"
sudo su - bambam -c "sbatch --qos=normal -Agpuusers -N1 --mem=800 -t50 --gres=gpu:gtx:2 -o /dev/null --wrap='srun hostname'"
done

# for x in pebbles bambam fred chip dino edna gazoo barney wilma ; do scancel -u $x ; done
