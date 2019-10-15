"""
Indexes the database.
Currently works off of CSV, will be converted to use the database directly.

Requires spacy.
This may not install correctly on windows, use WSL instead.
```
pip install -u spacy
python -m spacy download en_core_web_md
```
"""

import csv
import spacy


def index(names, descriptions):
    for i, a in enumerate(names):
        for j, b in enumerate(names):
            yield a, b, descriptions[i].similarity(descriptions[j])


if __name__ == '__main__':

    print("Reading CSV")
    with open('data/umd_courses.csv') as csvfile:
        reader = csv.reader(csvfile)
        courses = [(id, name, description) for id, name, description in reader]

    courses = courses[:1000]

    print("Loading model")
    nlp = spacy.load('en_core_web_md')

    print("Generating descriptions")
    names = [course[0] for course in courses]
    descriptions = [course[1] + course[2] for course in courses]
    descriptions = [nlp(description) for description in descriptions]

    print("Indexing")
    for i, (a, b, score) in enumerate(index(names, descriptions)):
        print(a, b, score, f'{i}/{len(names) ** 2}')
