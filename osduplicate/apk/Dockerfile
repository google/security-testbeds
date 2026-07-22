FROM alpine:3.21

# Install a pkg from main repos
RUN apk add fzf

# Verify that the extra pkg is not available
RUN ! apk add --simulate orb

# Add external repository
RUN wget -O /etc/apk/keys/packages@orb.net.rsa.pub https://pkgs.orb.net/stable/alpine/orb.pub
RUN echo "https://pkgs.orb.net/stable/alpine" >> /etc/apk/repositories
RUN apk update

# Install extra pkg
RUN apk add orb

COPY verify.sh /usr/bin/verify.sh
RUN chmod +x /usr/bin/verify.sh

ENV DEFAULT_PKG="fzf"
ENV DEFAULT_PKG_FILE="usr/bin/fzf"
ENV EXTRA_PKG="orb"
ENV EXTRA_PKG_FILE="usr/bin/orb"
ENV LANGUAGE_EXTRACTORS="go/binary"
ENV OS_EXTRACTOR="os/apk"
ENV DUP_ANNOTATOR="vex/os-duplicate/apk"
