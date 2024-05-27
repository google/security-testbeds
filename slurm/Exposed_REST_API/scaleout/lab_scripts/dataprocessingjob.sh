#!/bin/bash

sbcast -f ~/dataset /tmp/dataset
sbcast -f ~/dataprocessingprogram.sh /tmp/dataprocessingprogram.sh
srun /tmp/dataprocessingprogram.sh 
sgather -f /tmp/dataset.out ~/dataset.out

