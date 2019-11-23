import mysql.connector
import os
import spacy
import multiprocessing
from annoy import AnnoyIndex
from progressbar import progressbar
print("Connecting")

K = 50
N = 25

db = mysql.connector.connect(
  host="localhost",
  user="root",
  passwd=os.environ.get('MYSQL_PASS','<mypassword>'),
  database='transfercredit'
)
cursor = db.cursor()

print("Loading NLP")
nlp = spacy.load('en_core_web_md')

print("Deleting previous work")
cursor.execute("DELETE FROM course_index WHERE TRUE")

print("Running Query")
cursor.execute("""
SELECT id, course_name, school FROM courses
""")


print("Indexing...")
courses = cursor.fetchall()

f = len(nlp(courses[0][1]).vector)
print(f)

t = AnnoyIndex(f, 'angular')
school_index = {}

for id, name, school in progressbar(courses):
  t.add_item(id, nlp(name).vector)
  school_index[id] = school

print("Building Index")
t.build(N)


print("Getting neighbors")
results = []
for id, name, school in progressbar(courses):
    neighbors = t.get_nns_by_item(id,K, include_distances=True)
    for n_id, distance in zip(*neighbors):
        if school_index[id] == school_index[n_id]:
            continue
        results.append((id, n_id, distance))

print("Inserting Values")
for result in progressbar(results):
    cursor.execute("INSERT INTO course_index VALUES (%s,%s,%s)", result)

db.commit()

