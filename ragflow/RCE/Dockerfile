FROM python:3.9-slim

WORKDIR /app

COPY requirements.txt .
COPY PoC.py .

RUN pip install --no-cache-dir -r requirements.txt

RUN apt update && apt install -y git
RUN git clone https://github.com/infiniflow/ragflow --branch v0.12.0

WORKDIR /app/ragflow

EXPOSE 7860

CMD ["python", "rag/llm/rpc_server.py", "--model_name", "jonastokoliu/causal_lm_distilgpt2_eli5_finetune"]