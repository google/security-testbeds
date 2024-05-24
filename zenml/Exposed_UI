
# common steps for both safe and unsafe zenml instances
on an ubuntu 22.04 instance:
```bash
mkdir zenml
cd zenml
sudo add-apt-repository ppa:deadsnakes/ppa
sudo apt update
sudo apt install python3.11 python3.11-pip python3.11-venv
python3.11 -m venv .venv
source .venv/bin/activate
# Install ZenML
pip install "zenml[server]"
# Start the ZenML dashboard locally.
zenml up
```
create a simple ML pipeline
`nano run.py`
paste following:
```bash
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
```
and run the sample pipeline:
`pytho3 run.py`
you will see a link generated in the output. open it and enter `default` as username and leave password empty.

# setup a safe instance
```bash
docker run -it -d -p 8080:8080 zenmldocker/zenml-server
```
after setup a zenml dashboard with docker it will ask you to set a password, so no weak credentials exist with this setup.
