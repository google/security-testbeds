# Triton inference server RCE

publicly exposed Triton inference servers before version 2.40  with `--model-control explicit` options are vulnerable to remote code execution by dynamic model loading through the model control APIs.

Detailed blog post: https://protectai.com/threat-research/triton-inference-server-arbitrary-file-overwrite
Metasploit module: https://github.com/protectai/ai-exploits/tree/main/triton

# safe version instance setup
A safe version is loaded with no initial models so we can't overwrite any model and we can't exploit the server.
```bash
docker run --rm -p8000:8000 -p8001:8001 -p8002:8002 -v APathWithNoModelInside/:/models nvcr.io/nvidia/tritonserver:23.10-py3 tritonserver --model-repository=/models --model-control explicit
```

# vulnerable version instance setup
```bash
docker run --rm -p8000:8000 -p8001:8001 -p8002:8002 -v ASimpleModel/:/models nvcr.io/nvidia/tritonserver:23.10-py3 tritonserver --model-repository=/models --model-control explicit
```
