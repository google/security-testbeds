from flask import Flask, request, jsonify
import sys

app = Flask(__name__)

@app.route('/execute', methods=['POST'])
def execute_python_code():
    code = request.get_json()['code']
    try:
        # Execute the Python code
        exec(code, globals())
        return jsonify({'output': 'Code executed successfully!'})
    except Exception as e:
        return jsonify({'output': f'Error: {str(e)}'}), 400

if __name__ == '__main__':
    app.run(debug=True)