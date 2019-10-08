"""
This script requires beautiful soup 4. You must run:
`pip install beautifulsoup4`
"""
import urllib.request
import time
import csv
from bs4 import BeautifulSoup

# it's good practice to factor the urls into constants
BASE_URL = "https://app.testudo.umd.edu/soc/search?courseId=&sectionId=&termId=202001&_openSectionsOnly=on&creditCompare=&credits=&courseLevelFilter=ALL&instructor=&_facetoface=on&_blended=on&_online=on&courseStartCompare=&courseStartHour=&courseStartMin=&courseStartAM=&courseEndHour=&courseEndMin=&courseEndAM=&teachingCenter=ALL&_classDay1=on&_classDay2=on&_classDay3=on&_classDay4=on&_classDay5=on"
PAGE_URL = "https://app.testudo.umd.edu/soc/202001/{code}"  #`{code}`` will be replaced with an actual prefix code later

def fetch_all_codes():
    # make an http request to BASE URL and store the parsed results in doc
    with urllib.request.urlopen(BASE_URL) as response:
        doc = BeautifulSoup(response.read(), 'html.parser')

    # find all elements with class `prefix-abbrev` and get their text.
    # we know it's the prefix-abbrev elements by inspecting the page in chrome dev tools.
    abbrevs = doc.findAll("span", {"class":"prefix-abbrev"})
    abbrevs = [abbr.get_text() for abbr in abbrevs]
    return abbrevs


def fetch_courses(prefix_code):
    # fetch the page with the urls
    with urllib.request.urlopen(PAGE_URL.format(code=prefix_code)) as response:
        doc = BeautifulSoup(response.read(), 'html.parser')
    
    rows = doc.findAll("div", {"class":"row"})

    # for each class on the page store the results 
    results = []
    for row in rows:
        try:
            results.append({
                'code':row.find(class_='course-id').get_text(),
                'title':row.find(class_='course-title').get_text(),
                'description': row.find(class_='approved-course-text').get_text()
            })
        except AttributeError:
            pass

    return results




if __name__ == '__main__':
    # get a lits of prefix codes from the website
    all_prefix_codes = fetch_all_codes()
    
    # we need to store the data in a csv file, so open that
    with open('data/umd_courses.csv', 'w', newline='') as csvfile:
        fieldnames = ['code','title','description'] # the field names that are going to be outputted to the csv file
        writer = csv.DictWriter(csvfile, fieldnames)

        # for each prefix code, get all of it's courses and save the result
        for prefix_code in all_prefix_codes:
            print("[" + prefix_code + "]")
            courses = fetch_courses(prefix_code)
            for course in courses:
                writer.writerow(course)

            # it's rude to just send a ton of requests at once, wait abit
            time.sleep(.1)
