import uvicorn
from fastapi import FastAPI, HTTPException
from pydantic import BaseModel
from RestrictedPython import compile_restricted, safe_builtins, Guards

app = FastAPI(title="Vulnerable Python Sandbox Server (CVE-2026-53710)")

class CodeExecutionRequest(BaseModel):
    code: str

@app.get("/")
def read_root():
    return {"message": "Welcome to FastAPI Sandbox Server"}

@app.get("/openapi.json", include_in_schema=True)
def openapi_spec():
    return {
        "openapi": "3.0.0",
        "info": {"title": "Vulnerable Python Sandbox Server", "version": "1.0.0"},
        "paths": {
            "/execute_code": {
                "post": {
                    "summary": "Execute Code",
                    "responses": {"200": {"description": "Successful Response"}}
                }
            }
        }
    }

def validate_code(code: str):
    blocked_patterns = ["__class__", "__bases__", "__subclasses__", "__globals__"]
    for pattern in blocked_patterns:
        if pattern in code:
            raise HTTPException(
                status_code=400,
                detail=f"Security Violation: Restricted pattern '{pattern}' detected."
            )

@app.post("/execute_code")
def execute_code(req: CodeExecutionRequest):
    validate_code(req.code)
    
    local_ns = {}
    safe_builtins["__import__"] = __import__
    globals_ns = {
        "__builtins__": safe_builtins,
        "getattr": getattr,
        "__import__": __import__,
        "_getitem_": lambda obj, ix: obj[ix],
        "_getiter_": iter,
        "_iter_unpack_sequence_": Guards.guarded_iter_unpack_sequence,
    }
    try:
        byte_code = compile_restricted(req.code, filename="<sandbox>", mode="exec")
        exec(byte_code, globals_ns, local_ns)
        return {
            "status": "success",
            "output": local_ns.get("result", "Code executed successfully.")
        }
    except Exception as e:
        return {"status": "error", "detail": str(e)}

if __name__ == "__main__":
    uvicorn.run(app, host="0.0.0.0", port=8080)
