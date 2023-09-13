# Archery Range: XSS Testbed

The application hosts XSS tests for web-security vulnerability scanners.

The core idea is to not statically provide tests but generate them through
 templating and string manipulation by picking the tests' components -
 namely source, sink, context and processing.

There is a division between server-side and client-side tests.
 Some components such as DOM sources are only available on client-side
 and can thus not be processed and sinked on the server-side.

The testbed is combinatorial in nature, thus, testing only specific cases is
more reasonable than exhaustively testing all the XSS testcases.

Install the requirements:
```sh
pip3 install -r requirements.txt
```

Run the XSS testbed:
```sh
python3 app.py
```
