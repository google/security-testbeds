from flask import Flask, request, render_template_string
import reverb

app = Flask(__name__)

html = """
    <!doctype html>
    <title>Execute Python Expression</title>
    <h1>Enter a Python expression:</h1>
    <form method=post>
      <textarea name=expression rows=3 cols=40></textarea><br><br>
      <input type=submit value="Evaluate">
    </form>
    <h2>Output:</h2>
    <pre>{{ result }}</pre>
"""

@app.route('/', methods=['GET', 'POST'])
def index():
    result = ""
    if request.method == 'POST':
        expression = request.form['expression']
        try:
            # define the variables and functions allowed, including the reverb lib
            allowed_globals = {"__builtins__": None, "reverb": reverb}
            result = eval(expression, allowed_globals, {})
        except Exception as e:
            result = f"Error: {str(e)}"

    return render_template_string(html, result=result)

if __name__ == '__main__':
    app.run(debug=True)