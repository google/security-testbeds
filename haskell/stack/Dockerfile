FROM ubuntu:22.04

RUN apt-get update

RUN mkdir -p /testdata/.stack/snapshots/x86_64-linux-tinfo6/5d9c516138681e7612b8da0993c6b1cd6a130524681cc01c446e6d513c0eb003/9.10.3/pkgdb
RUN mkdir -p /testdata/.stack/snapshots/x86_64-linux-tinfo6/5d9c516138681e7612b8da0993c6b1cd6a130524681cc01c446e6d513c0eb003/9.10.3/package.conf.d

# Set working directory
WORKDIR /testdata

# Copy valid files into the container
COPY ansi-terminal-1.1.5-9l6OdZnXoWK9mitTSq4yaK.conf /testdata/.stack/snapshots/x86_64-linux-tinfo6/5d9c516138681e7612b8da0993c6b1cd6a130524681cc01c446e6d513c0eb003/9.10.3/pkgdb
COPY abx2xml-go-1.0-6a24666dc582c5d8e5cc9a1949ec4a9b927455ffb058881d1398f193add47c00.conf /testdata/.stack/snapshots/x86_64-linux-tinfo6/5d9c516138681e7612b8da0993c6b1cd6a130524681cc01c446e6d513c0eb003/9.10.3/pkgdb
COPY colour-2.3.7-6jrGRZcUxApK69XoLH4IlN.conf /testdata/.stack/snapshots/x86_64-linux-tinfo6/5d9c516138681e7612b8da0993c6b1cd6a130524681cc01c446e6d513c0eb003/9.10.3/package.conf.d

CMD ["/bin/bash"]
