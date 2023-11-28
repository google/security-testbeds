# Selenium Grid Chrome
# Setup

1. Create docker image with this command: 

`docker run -d --platform linux/amd64 --name selenium-chrome -p 4444:4444 --shm-size="2g" selenium/standalone-chrome:latest`

2. Connect to the Selenium dashboard: http://localhost:4444/

3. Verify Selenium Grid is working as intended by requesting a sample website (google.com) by running the python3 script below: 

```python
# selenium_test.py
# Run with:
# python3 selenium_test.py
from selenium import webdriver
from selenium.webdriver.chrome.options import Options as ChromeOptions

options = ChromeOptions()
options.platform_name = 'linux'
driver = webdriver.Remote("http://localhost:4444/wd/hub", options=options)

driver.get("https://google.com")
if not "Google" in driver.title:
    raise Exception("Unable to load google page!")
else:
    print("All good, google.com page loaded!")
driver.quit()
```
