# Unsecure RAGFlow RPC Server setup

The RPC server employs a fixed authentication token(infiniflow-token4kevinhu) and uses unsafe pickle serialization for processing incoming TCP requests. These vulnerabilities allow for potential exploitation of the server by dispatching a maliciously crafted request.

## Steps to Set Up the RPC Server:

```bash
docker build -t ragflow-rpc-server .
docker run --rm -p 7860:7860 --name ragflow-rpc-server-container ragflow-rpc-server
```

## Exploiting the RPC Server

Perform these steps to test or exploit the server (for demonstration purposes only):

1. Execute the Proof-of-Concept (PoC) script:
    ```bash
    docker exec -it ragflow-rpc-server-container bash -c "cd /app && python3 PoC.py"
    ```
2. Verify the executed payload:
    ```bash
      docker exec -it ragflow-rpc-server-container ls /tmp/hacked
    ```
