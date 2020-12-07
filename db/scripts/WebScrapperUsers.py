from msedge.selenium_tools import Edge, EdgeOptions
from selenium.webdriver.support.ui import Select
from selenium.webdriver.common.keys import Keys
from selenium.webdriver import ActionChains
import json
import hashlib 
import time
import pymongo
import dns
import random
import numpy as np

url = "https://www.randomlists.com/email-addresses?qty=150"
users = []
emails = []
passwords = []

options = EdgeOptions()
options.use_chromium = True
options.add_argument('headless')

driver = Edge(executable_path = 'C:\Program Files\msedgedriver.exe', options = options)

driver.get(url)

time.sleep(5)

lis = driver.find_elements_by_xpath("/html/body/div/div[1]/main/article/div[2]/ol/li")

for li in lis:
    emails.append(li.text)

for email in emails:
    pwd = email.split('@')[0]
    pwd+='1234'
    pwd = hashlib.md5(pwd.encode())
    passwords.append(pwd.hexdigest())


#-------------------------------------------------------

client = pymongo.MongoClient("mongodb+srv://sgdb:Hhtsod9xdj2JH6dK@sgbdcluster.wq7u4.mongodb.net/Music?retryWrites=true&w=majority")
db = client.Music

musicians = db.Musician.find(projection = {"name": 0, "description": 0, "photo": 0, "contact": 0, "style_searched": 0, "instrument": 0})
bands = db.Band.find(projection = {"name": 0, "description": 0, "photo": 0, "contact": 0, "style": 0, "instrumentSearched": 0})

alldata = []

for m in musicians:
    alldata.append(['m', m["_id"]])

for b in bands:
    alldata.append(['b', b["_id"]])

random.shuffle(alldata)

sum = len(alldata)
n = len(emails)

rnd_array = np.random.multinomial(sum, np.ones(n)/n, size=1)[0]

k = 0
for i in range(0, len(emails)):
    user_musicians = []
    user_bands = []
    for j in range(0, rnd_array[i]):
        idx = alldata[k]
        k+=1
        if idx[0] == 'm':
            user_musicians.append(idx[1])
        else:
            user_bands.append(idx[1])
    print()
    data = {
        "_id": i+1,
        "email": emails[i],
        "password": passwords[i],
        "musicians": user_musicians,
        "bands": user_bands
    }

    users.append(data)

with open("users.json", "w") as file:
    json.dump(users, file, indent = 4)
    file.close()