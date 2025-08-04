FROM ubuntu:24.04
RUN apt update
RUN DEBIAN_FRONTEND=noninteractive apt install -y python3 python3-pip curl
WORKDIR /app

COPY requirements.txt .
COPY PoC.py .

RUN pip install --no-cache-dir -r requirements.txt --break-system-packages

RUN apt update && apt install -y git
RUN git clone https://github.com/infiniflow/ragflow --branch v0.12.0

WORKDIR /app/ragflow

EXPOSE 7860

CMD ["python3", "rag/llm/rpc_server.py", "--model_name", "jonastokoliu/causal_lm_distilgpt2_eli5_finetune"]