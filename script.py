import requests, json, pymysql
api_url_book = "https://gnikdroy.pythonanywhere.com/api/book"
api_url_person = "https://gnikdroy.pythonanywhere.com/api/person"
host = "localhost"
user = "challenge34"
database = "challenge34"
password = "41n0mtwyz4"

conn = pymysql.connect(host=host, user=user, password=password, database=database, charset='utf8', use_unicode=True)
cur = conn.cursor()
insert_query_authors = "INSERT INTO authors (name, alias, birth_date, death_date, webpage) VALUES (%s, %s, %s, %s, %s)"
insert_query_books = "INSERT INTO books (id_author, name, description, languages, Bookshelves, Subjects) VALUES (%s, %s, %s, %s, %s, %s)"

for i in range(2791, 6333):
    url_persons = api_url_person + "?page=" + str(i)
    print(url_persons)
    response = requests.get(url_persons)
    for j in range(0, 10):
        name = response.json().get('results')[j].get('name')
        alias = response.json().get('results')[j].get('alias')
        birth_date = response.json().get('results')[j].get('birth_date')
        death_date = response.json().get('results')[j].get('death_date')
        webpage = response.json().get('results')[j].get('webpage')
        cur.execute(insert_query_authors, (name, alias, birth_date, death_date, webpage))
        print(f"{cur.rowcount} details inserted")
    if i%10 == 0:
        conn.commit()

url_persons = api_url_person + "?page=6333"
response = requests.get(url_persons)
print(url_persons)
for j in range(0, 3):
    name = response.json().get('results')[j].get('name')
    alias = response.json().get('results')[j].get('alias')
    birth_date = response.json().get('results')[j].get('birth_date')
    death_date = response.json().get('results')[j].get('death_date')
    webpage = response.json().get('results')[j].get('webpage')
    cur.execute(insert_query_authors, (name, alias, birth_date, death_date, webpage))
    print(f"{cur.rowcount} details inserted")

"""
url_book = api_url_book + "?page=1"
response = requests.get(url_book)
authors = response.json().get('results')[0].get('agents')[0].get('person')
select_query="SELECT id FROM authors WHERE name = %s"
cur.execute(select_query, (authors))
records = cur.fetchall()
print(*records[0])


#6848
for i in range(1, 10):
    url_book = api_url_book + "?page=" + str(i)
    print(url_book)
    response = requests.get(url_book)
    print("Page :", i)
    for j in range(0, 10):
        name = response.json().get('results')[j].get('title')
        description = response.json().get('results')[j].get('description')
        languages = response.json().get('results')[j].get('languages')
        bookshelves = json.dumps(response.json().get('results')[j].get('bookshelves'))
        subjects = json.dumps(response.json().get('results')[j].get('subjects'))
        try: 
            authors = response.json().get('results')[j].get('agents')[0].get('person')
        except:
            authors = None
        select_query="SELECT id FROM authors WHERE name = %s"
        cur.execute(select_query, (authors))
        records = cur.fetchall()
        
        try:
            id_author = int(*records[0])
        except IndexError:
            id_author = None

        cur.execute(insert_query_books, (id_author, name, description, languages, bookshelves, subjects))
        print(f"{cur.rowcount} details inserted")
    conn.commit()
"""

conn.commit()
conn.close()