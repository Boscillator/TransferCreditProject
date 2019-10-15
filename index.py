"""
Indexes the database.
Currently works off of CSV, will be converted to use the database directly.

Requires nltk

```
pip install nltk
python
>>> import nltk
>>> nltk.download('punkt')
>>> nltk.download('stopwords')
```
"""

import csv
from nltk.tokenize import word_tokenize
from nltk.corpus import stopwords

stopwords = set(stopwords.words('english'))

def jaccard_distance(a,b):
    try:
        return len(a - b)/len(a | b)
    except ZeroDivisionError:
        return 0.0

def tokenize(s):
    return {word.lower() for word in word_tokenize(s) if word.isalpha() and word not in stopwords}

def index(courses):
    for a_id, _, a_description in courses:
        for b_id, _, b_description in courses:
            yield a_id, b_id, jaccard_distance( a_description, b_description )


if __name__ == '__main__':
    with open('data/umd_courses.csv') as csvfile:
        reader = csv.reader(csvfile)
        courses = [(id, name, tokenize(description)) for id, name, description in reader ]

    lc = len(courses)
    for i, (a_id, b_id, score) in enumerate(index(courses)):
        print(a_id, b_id, score, f'{i}/{lc**2}')
