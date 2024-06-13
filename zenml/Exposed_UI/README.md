
# common steps for both safe and unsafe zenml instances
install the docker on your host machine
```bash
# run an instance
docker run -it -p 8080:8080 --name zenml ubuntu:22.04
# inside the instance
mkdir zenml
cd zenml
add-apt-repository ppa:deadsnakes/ppa
apt update
apt install python3.11 python3-pip python3.11-venv -y
python3.11 -m venv .venv
source .venv/bin/activate
# Install ZenML
pip install "zenml[server]"
# Start the ZenML dashboard locally.
zenml up --ip-address 0.0.0.0 --port 8080

cat << EOF >> run.py
from zenml import pipeline, step
@step
def load_data() -> dict:
    training_data = [[1, 2], [3, 4], [5, 6]]
    labels = [0, 1, 0]
    return {'features': training_data, 'labels': labels}
@step
def train_model(data: dict) -> None:
    total_features = sum(map(sum, data['features']))
    total_labels = sum(data['labels'])
    print(f"Trained model using {len(data['features'])} data points. "
          f"Feature sum is {total_features}, label sum is {total_labels}")
@pipeline
def simple_ml_pipeline():
    """Define a pipeline that connects the steps."""
    dataset = load_data()
    train_model(dataset)
if __name__ == "__main__":
    run = simple_ml_pipeline()
EOF

# run the sample pipeline
python3.11 run.py
```
on the host machine run `docker inspect zenml | jq -r '.[].NetworkSettings.IPAddress'` and get the zenml IP address. navigate to http://IP:8080. on the login page enter `default` as the username, and leave the password empty.

## important
please remember if you see an error like ` Cannot connect to the ZenML database because the ZenML server at http://127.0.0.1:8237 is not running.` you should try `zenml down` and then `zenml up` in the python environment to fix this issue.

# setup a safe instance
```bash
docker run -it -d -p 8080:8080 zenmldocker/zenml-server
```
after setup a zenml dashboard with docker it will ask you to set a password, so no weak credentials exist with this setup.
