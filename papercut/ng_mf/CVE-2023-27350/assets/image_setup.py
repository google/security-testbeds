import requests

### Default vars/config used to setup image

# Setup Page 1 (user = admin, and password = password)
# service=direct/1/SetupAdmin/$Form &\
# sp=S0 &\
# Form0=password,passwordVerify,$PropertySelection,$Submit &\
# password=password &\
# passwordVerify=password &\
# $PropertySelectio= &\
# $Submit=Next
payload_page1 = {
    'service': 'direct/1/SetupAdmin/$Form',
    'sp': 'S0',
    'Form0': 'password,passwordVerify,$PropertySelection,$Submit',
    'password': 'password',
    'passwordVerify': 'password',
    '$PropertySelectio': '',
    '$Submit': 'Next'
}

# Setup Page 2 - Print cost
# service=direct/1/SetupOrgType/$Form &\
# sp=S0 &\
# Form0=$RadioGroup,$Submit,$Submit$0 &\
# $RadioGroup=0 &\
# $Submit=Next
payload_page2 = {
    'service': 'direct/1/SetupOrgType/$Form',
    'sp': 'S0',
    'Form0': '$RadioGroup,$Submit,$Submit$0',
    '$RadioGroup': '0',
    '$Submit': 'Next'
}

# Setup Page 3 - SetupUserCredit
# service=direct/1/SetupPrintCost/$Form &\
# sp=S0 &\
# Form0=defaultColorPageCost,defaultGrayscalePageCost,$Submit,$Submit$0 &\
# defaultColorPageCost=$0.00 &\
# defaultGrayscalePageCost=$0.00 &\
# $Submit=Next
payload_page3 = {
    'service': 'direct/1/SetupPrintCost/$Form',
    'sp': 'S0',
    'Form0': 'defaultColorPageCost,defaultGrayScalePageCost,$Submit,$Submit$0',
    'defaultColorPageCost': '$0.00',
    'defaultGrayScalePageCost': '$0.00',
    '$Submit': 'Next'
}

# Setup Page 4 - SetupUserSource
# service=direct/1/SetupUserCredit/$Form &\
# sp=S0 &\
# Form0=initialCredit,restricted,$Submit,$Submit$0 &\
# initialCredit=$0.00 &\
# $Submit=Next
payload_page4 = {
    'service': 'direct/1/SetupUserCredit/$Form',
    'sp': 'S0',
    'Form0': 'initialCredit,restricted,$Submit,$Submit$0',
    'initialCredit': '$0.00',
    '$Submit': 'Next'
}

# Setup Page 5 - SetupVerify
# service=direct/1/SetupUserSource/$Form &\
# sp=S0 &\
# Form0=$RadioGroup,$Select,$LinkSubmit,$Submit,$Submit$0 &\
# $Select=0 &\
# $RadioGroup=0 &\
# _linkSubmit= &\
# $Submit=Next
payload_page5 = {
    'service': 'direct/1/SetupUserSource/$Form',
    'sp': 'S0',
    'Form0': '$RadioGroup,$Select,$LinkSubmit,$Submit,$Submit$0',
    '$Select': '0',
    '$RadioGroup': '0',
    '$_linkSubmit': '',
    '$Submit': 'Next'
}

# Setup Page 6 - SetupCompleted
# service=direct/1/SetupVerify/$Form &\
# sp=S0 &\
# Form0=$Submit,$Submit$0 &\
# $Submit=Confirm
payload_page6 = {
    'service': 'direct/1/SetupVerify/$Form',
    'sp': 'S0',
    'Form0': '$Submit,$Submit$0',
    '$Submit': 'Confirm' 
}

### End default vars/config

# Local website setup
host = "http://localhost:9191/app"

headers = {
    'Origin': 'http://localhost:9191'
}

server_ready = False

while ( not server_ready ):
    try:
        resp = requests.get(host)
        if (resp.status_code == 200):
            server_ready = True
    except requests.exceptions.Timeout:
        continue
    except requests.exceptions.RequestException:
        continue




session = requests.Session()

session.get(host)

setup_steps = [
    payload_page1,
    payload_page2,
    payload_page3,
    payload_page4,
    payload_page5,
    payload_page6
]




for step in setup_steps:
    resp = session.post(host, data=step, headers=headers)
    if resp.status_code != 200:
        print(resp.status_code, resp.reason)