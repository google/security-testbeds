# PaperCut NF/MF Docker images
---

### Building
- Use the `local_builder.sh` script (slow, but reliable)
- Use `docker buildx bake` to build the images (recommended, faster)

### The resulting images
These images simulate a near realistic production environment and are prebuilt/preconfigured to let you get started ASAP.

They currently consist of two version types:
- Vulnerable (Intended to be used only for testing and in-conjuction with the Tsunami Vulnerability Scanner)
  - `ghcr.io/isaac-gc/papercut_ng_mf:19.2.7.62195`
  - `ghcr.io/isaac-gc/papercut_ng_mf:20.1.4.57927`
  - `ghcr.io/isaac-gc/papercut_ng_mf:21.2.10.62186`
  - `ghcr.io/isaac-gc/papercut_ng_mf:22.0.1.62695`

Non-vulnerable (patched)
  - `ghcr.io/isaac-gc/papercut_ng_mf:20.1.8.66704`
  - `ghcr.io/isaac-gc/papercut_ng_mf:21.2.12.66701`
  - `ghcr.io/isaac-gc/papercut_ng_mf:22.0.12.66453`


#### Using the images
1. Pull down an OCI image for the version you want to use/test.
- i.e. `docker pull ghcr.io/isaac-gc/papercut_ng_mf:22.0.1.62695`
2. Run the container using docker, kubernetes, or another OCI compatible engine
 - I.e. using docker: `docker run -it --rm -p 9191:9191 ghcr.io/isaac-gc/papercut_ng_mf:22.0.1.62695`
3. Thats it!