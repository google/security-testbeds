# Unsecure RAGFlow RPC Server setup

The RPC server employs a fixed authentication token(infiniflow-token4kevinhu) and uses unsafe pickle serialization for processing incoming TCP requests. These vulnerabilities allow for potential exploitation of the server by dispatching a maliciously crafted request.

## Steps to Set Up the RPC Server:

```bash
sudo apt update && sudo apt install -y git python3 python3-pip python3-venv
git clone https://github.com/infiniflow/ragflow --branch v0.12.0
cd ragflow
python3 -m venv venv
source venv/bin/activate
pip3 install torch torchvision torchaudio --index-url https://download.pytorch.org/whl/cpu
pip3 install 'accelerate>=0.26.0' transformers

python3 rag/llm/rpc_server.py --model_name jonastokoliu/causal_lm_distilgpt2_eli5_finetune
```

## Exploiting the RPC Server

Perform these steps to test or exploit the server (for demonstration purposes only):

1. Execute the Proof-of-Concept (PoC) script:
    ```bash
    python3 PoC.py
    ```
2. Verify the executed payload:
    ```bash
       ll /tmp/hacked
    ```
