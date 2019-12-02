import json
import csv

if __name__ == "__main__":
    with open('rpi_courses.csv', 'w', newline='') as csvfile:
        fieldnames = ['code','title','description'] # the field names that are going to be outputted to the csv file
        writer = csv.DictWriter(csvfile, fieldnames)

        for i in range(41):
            with open("{}.json".format(i), 'r') as f:
                courses = json.load(f)
            for j in courses['data']:
                writer.writerow({"code":(j['attributes']['subject_shortname']+j['attributes']['course_shortname']),
                                "title":j['attributes']['longname'],
                                "description":j['attributes']['description']})