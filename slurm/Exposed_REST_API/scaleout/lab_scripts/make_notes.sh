#!/bin/bash
# make_notes.sh
# -------------
# Creates static man page notes from key Slurm commands.
# For use in the Vim editor with the 'M' command, for opening all the pages in
# the 'for' loop, below, in Vim tabs.
#
mkdir -p $HOME/notes
for x in sbatch srun salloc sattach squeue sinfo slurm.conf ; do
	man $x > $HOME/notes/$x
done
echo -n 'com! M tabe $HOME/notes/sbatch     |' >> ~/.vimrc
echo -n '       tabe $HOME/notes/srun       |' >> ~/.vimrc
echo -n '       tabe $HOME/notes/salloc     |' >> ~/.vimrc
echo -n '       tabe $HOME/notes/sattach    |' >> ~/.vimrc
echo -n '       tabe $HOME/notes/squeue     |' >> ~/.vimrc
echo -n '       tabe $HOME/notes/sinfo      |' >> ~/.vimrc
echo -n '       tabe $HOME/notes/slurm.conf |' >> ~/.vimrc
echo -n '       tabnext'                       >> ~/.vimrc
