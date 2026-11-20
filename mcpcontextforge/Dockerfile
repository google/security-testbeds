FROM python:3.11-slim

WORKDIR /app

RUN pip install --no-cache-dir RestrictedPython fastapi uvicorn pydantic

COPY server_vulnerable.py server_patched.py ./

EXPOSE 8080

CMD ["python", "server_vulnerable.py"]
