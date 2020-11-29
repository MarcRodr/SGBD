from msedge.selenium_tools import Edge, EdgeOptions
from selenium.webdriver.support.ui import Select
from selenium.webdriver.common.keys import Keys
from selenium.webdriver import ActionChains
import time
import requests
import base64
from io import BytesIO
import json
import random
from PIL import Image

url_photos = 'https://randomuser.me/photos'
url_names = 'https://www.name-generator.org.uk/quick/'

musicians = []
images_men = []
images_women = []
names_men = []
names_women = []

options = EdgeOptions()
options.use_chromium = True
#options.add_argument('headless')

driver = Edge(executable_path = 'C:\Program Files\msedgedriver.exe', options = options)

driver.get(url_photos)

time.sleep(5)

# men
images = driver.find_elements_by_css_selector("[data-gender=men]:not([data-int=undefined])")
for img_tag in images:
    src = img_tag.get_attribute('src')
    #img = Image.open(requests.get(src, stream = True).raw)
    #buffered = BytesIO()
    #img.save(buffered, format="JPEG")
    #img_str = base64.b64encode(buffered.getvalue())
    images_men.append(src)

# women
images = driver.find_elements_by_css_selector("[data-gender=women]:not([data-int=undefined])")
for img_tag in images:
    src = img_tag.get_attribute('src')
    #img = Image.open(requests.get(src, stream = True).raw)
    #buffered = BytesIO()
    #img.save(buffered, format="JPEG")
    #img_str = base64.b64encode(buffered.getvalue())
    images_women.append(src)

driver.get(url_names)

txt_box = driver.find_element_by_xpath('//*[@id="main"]/div/form/input[3]')
txt_box.clear()
txt_box.send_keys("95")

# men
select = Select(driver.find_element_by_xpath('//*[@id="gender"]'))
select.select_by_visible_text('male')
time.sleep(2)
driver.find_element_by_xpath('//*[@id="qc-cmp2-ui"]/div[2]/div/button[2]').click()
time.sleep(3)
driver.execute_script("window.scrollTo(0, 1080)") 
driver.find_element_by_xpath('//*[@id="main"]/div/form/input[4]').click()
time.sleep(5)
names = driver.find_elements_by_class_name('name_heading')
for name in names:
    names_men.append(name.text)

# women
select = Select(driver.find_element_by_xpath('//*[@id="gender"]'))
select.select_by_visible_text('female')
time.sleep(2)
actions = ActionChains(driver)
element = driver.find_element_by_xpath('//*[@id="main"]/div/form/input[4]')
actions.move_to_element(element).click().perform()
time.sleep(5)
names = driver.find_elements_by_class_name('name_heading')
for name in names:
    names_women.append(name.text)


description = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.'

for i in range(0, len(names_men)):
    style = random.randint(1, 18)
    instrument = random.randint(1, 12)
    data = {
            
            "_id": i+1,
            "name": names_men[i],
            "description": description,
            "photo": images_men[i],#.decode('utf8').replace("'", '"'),
            "contact": (names_men[i].replace(" ", "_") + "@gmail.com").lower(),
            "style_searched": style,
            "instrument": instrument
        }

    musicians.append(data)


for i in range(0, len(names_women)):
    style = random.randint(1, 18)
    instrument = random.randint(1, 12)
    data = {
            
            "_id": len(names_men)+i+1,
            "name": names_women[i],
            "description": description,
            "photo": images_women[i],#.decode('utf8').replace("'", '"'),
            "contact": (names_women[i].replace(" ", "_") + "@gmail.com").lower(),
            "style_searched": style,
            "instrument": instrument
        }

    musicians.append(data)

with open("musicians.json", "w") as file:
    json.dump(musicians, file, indent = 4)
    file.close()

driver.close()

