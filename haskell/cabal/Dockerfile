FROM ubuntu:22.04

RUN apt-get update

RUN mkdir -p /testdata/.cabal/store/ghc-9.6.6/package.db

# Set working directory
WORKDIR /testdata

# Copy valid files into the container
COPY safe-0.3.21-bf7883b24e2927b8c2c172a7483f6c3e88459b69f9bf915968d889e82f47f177.conf  /testdata/.cabal/store/ghc-9.6.6/package.db/
COPY abx2xml-go-1.0-6a24666dc582c5d8e5cc9a1949ec4a9b927455ffb058881d1398f193add47c00.conf  /testdata/.cabal/store/ghc-9.6.6/package.db/

CMD ["/bin/bash"]
