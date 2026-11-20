import uvicorn
from fastapi import FastAPI, HTTPException
from pydantic import BaseModel
from RestrictedPython import compile_restricted, safe_builtins

app = FastAPI(title="Patched Python Sandbox Server (CVE-2026-53710 Fixed)")

class CodeExecutionRequest(BaseModel):
    code: str

def validate_code(code: str):
    if "__" in code or "getattr" in code:
        raise HTTPException(
            status_code=400,
            detail="Security Violation: Forbidden patterns or dunder attributes detected."
        )

@app.post("/execute_code")
def execute_code(req: CodeExecutionRequest):
    validate_code(req.code)
    
    local_ns = {}
    globals_ns = {
        "__builtins__": safe_builtins,
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
