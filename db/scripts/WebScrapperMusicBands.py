from bs4 import BeautifulSoup as bs
from PIL import Image
import requests
import base64
from io import BytesIO
import json
import random

url = 'https://www.radiox.co.uk/features/x-lists/best-bands-of-all-time/'
bands = []
images = []
names = []
descriptions = []

response = requests.get(url)

soup = bs(response.text, 'html.parser')

lis = soup('li')
for i in range(2, 87):
    li = lis[i]
    if li['class'][0] == 'collection__item':
        image_url = li.find('img')['src']
        #img = Image.open(requests.get(image_url, stream = True).raw)
        #buffered = BytesIO()
        #img.save(buffered, format="JPEG")
        #img_str = base64.b64encode(buffered.getvalue())
        images.append(image_url)
        
        names.append(li.find('h2').text)

        descriptions.append(li.find('p').text)

for i in range(0, len(names)):
    style = random.randint(1, 18)
    instrument = random.randint(1, 12)
    data = {
            
            "_id": i+1,
            "name": names[i],
            "description": descriptions[i],
            "photo": images[i],#.decode('utf8').replace("'", '"'),
            "contact": ("contact@" + names[i].replace(" ", "") + ".com").lower(),
            "style": style,
            "instrumentSearched": instrument
        }

    bands.append(data)


with open("bands.json", "w") as file:
    json.dump(bands, file, indent = 4)
    file.close()