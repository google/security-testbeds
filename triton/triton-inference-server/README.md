# Triton inference server RCE

publicly exposed Triton inference servers with `--model-control explicit` options are vulnerable to remote code execution by dynamic model loading through the model control APIs.

Detailed blog post: https://protectai.com/threat-research/triton-inference-server-arbitrary-file-overwrite
metasploit module: https://github.com/protectai/ai-exploits/tree/main/triton

# Vulnerable instance setup
```bash
docker run --rm -p8000:8000 -p8001:8001 -p8002:8002 -v/APath/:/models nvcr.io/nvidia/tritonserver:24.02-py3 tritonserver --model-repository=/models --model-control explicit
```
