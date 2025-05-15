from __future__ import annotations
import bentoml

@bentoml.service(
    resources={"cpu": "2"},
    traffic={"timeout": 10},
)
class Summarization:
    def __init__(self) -> None:
        pass

    @bentoml.api
    def summarize(self, text: str) -> str:
        return "Hello World"
