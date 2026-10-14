# Testbed for the OSV-SCALIBR MinimOS ecosystem mapping.
#
# MinimOS uses the same APK database format as Alpine, so os/apk reads it
# unchanged. The only thing deciding which OSV ecosystem the packages route to is
# the ID field in /etc/os-release. This image pins an alpine:3.10 base, which ships
# an APK database with genuinely outdated packages, and writes the real MinimOS
# os-release over it, copied verbatim out of reg.mini.dev/curl:latest.
#
# A real MinimOS image is deliberately not used as the base:
#
#   1. Minimus is ceasing operations and turning reg.mini.dev off on 2026-10-22,
#      so anything pinned to that registry stops being buildable afterwards.
#   2. The published MinimOS images are hardened to zero known advisories, which is
#      the entire point of the product, so scanning one confirms the routing but
#      leaves no advisory matches to look at.
#
# The same technique is already used by osv-scanner in
# cmd/osv-scanner/scan/image/testdata/test-alpine.Dockerfile.

FROM alpine:3.10@sha256:451eee8bedcb2f029756dc3e9d73bab0e7943c1ac55cff3a4861c52a0fdd3e98

RUN printf '%s\n' \
      'ID=minimos' \
      'NAME="MinimOS"' \
      'PRETTY_NAME="MinimOS"' \
      'VERSION_ID="20241031"' \
      'HOME_URL="https://minimus.io"' \
      'BUG_REPORT_URL="https://support.minimus.io"' \
      > /etc/os-release \
 && rm -f /etc/alpine-release

# App for putting the scalibr binary inside the container
RUN mkdir -p /app
WORKDIR /app

ENV OS_EXTRACTOR="os/apk"

CMD ["/bin/sh"]
