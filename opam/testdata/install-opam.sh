#!/usr/bin/env bash
set -euo pipefail

export OPAMYES=1

opam init --disable-sandboxing --yes --bare
opam switch create default ocaml-base-compiler.5.1.1

eval "$(opam env --switch=default)"

opam install \
  dune \
  ocamlfind \
  core_kernel \
  cohttp-lwt \
  ppx_deriving
