import mysql.connector
import os
import spacy
print("Connecting")
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
SELECT a.id, a.description, b.id, b.description FROM courses AS a
CROSS JOIN courses AS b
WHERE a.school != b.school
""")

print("Indexing...")
for (a_id, a_desc, b_id, b_desc) in cursor.fetchall():
    print('\t',a_id,' ' ,b_id)
    a_desc = nlp(a_desc)
    b_desc = nlp(b_desc)
    score = a_desc.similarity(b_desc)
    cursor.execute("INSERT INTO course_index VALUES (%s, %s, %s)", (a_id, b_id, score))

db.commit()

