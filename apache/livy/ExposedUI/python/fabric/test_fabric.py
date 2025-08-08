
from msal import PublicClientApplication
from dotenv import load_dotenv
import os
import requests
import time

# Load environment variables from .env file
load_dotenv()
tenant_id = os.getenv('TENANT_ID')
client_id = os.getenv('CLIENT_ID')
workspace_id = os.getenv('WORKSPACE_ID')
lakehouse_id = os.getenv('LAKEHOUSE_ID')
redirect_url_port = os.getenv('REDIRECT_URL_PORT')
api_version = os.getenv('API_VERSION')

app = PublicClientApplication(
   client_id,
   authority= f"https://login.microsoftonline.com/{tenant_id}",   
)

result = None

 # If no cached tokens or user interaction needed, acquire tokens interactively
if not result:
    result = app.acquire_token_interactive(scopes=["https://api.fabric.microsoft.com/Lakehouse.Execute.All", "https://api.fabric.microsoft.com/Lakehouse.Read.All", "https://api.fabric.microsoft.com/Item.ReadWrite.All", 
                                                "https://api.fabric.microsoft.com/Workspace.ReadWrite.All", "https://api.fabric.microsoft.com/Code.AccessStorage.All", "https://api.fabric.microsoft.com/Code.AccessAzureKeyvault.All", 
                                                "https://api.fabric.microsoft.com/Code.AccessAzureDataExplorer.All", "https://api.fabric.microsoft.com/Code.AccessAzureDataLake.All", "https://api.fabric.microsoft.com/Code.AccessFabric.All"],
                                                port=f"{redirect_url_port}")

# Get the access token
if "access_token" in result:
    access_token = result["access_token"]
else:
    print(result.get("error"))

if access_token:
   api_base_url_mist='https://api.fabric.microsoft.com/v1'
   livy_base_url = api_base_url_mist + "/workspaces/"+workspace_id+"/lakehouses/"+lakehouse_id +"/livyApi/versions/"+api_version+"/sessions"
   headers = {"Authorization": "Bearer " + access_token}

# List Livy essions
livy_session_url = livy_base_url
get_sessions_response = requests.get(livy_session_url, headers=headers)
print(get_sessions_response.json())
