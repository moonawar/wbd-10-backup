import requests
import random
import os
import csv

print ("""
Seeding Books
====================================
    
...
""")


NUM_OF_AUTHORS = 15
NUM_OF_GENRES = 15

post_api = 'http://localhost:8000/book/add'
# post_api = 'http://web/book/add'
books = []

with open('books.csv', newline='', encoding='utf-8') as csvfile:
    reader = csv.DictReader(csvfile)
    for row in reader:
        books.append({
            'title': row['original_title'],
            'description': f"Buku {row['original_title']} karya {row['authors']} ini menceritakan tentang {row['original_title']}.",
            'book_image': row['small_image_url']
        })

for b in books:
    try:
        title = (b['title']).title()

        print(f"Trying to add book - {title} to database.")

        num_of_authors = random.randint(1, 4)
        authors = []
        for _ in range(num_of_authors):
            authors.append(random.randint(1, NUM_OF_AUTHORS))

        num_of_genres = random.randint(1, 3)
        genres = []
        for _ in range(num_of_genres):
            genres.append(random.randint(1, NUM_OF_GENRES))

        year = random.randint(2000, 2020)
        price = random.randint(1,100) * 10000

        book_cover_url = b['book_image']

        audio_path = f'book.mp3'

        data = {
            'title': title,
            'year': year,
            'summary': b['description'],
            'authors[]': authors,
            'genres[]': genres,
            'price': price,
            'lang': 'English',
            'imagePath': book_cover_url,
            'audioPath': 'var/www/html/storage/audio/book.mp3'
        }

        # response = requests.post(post_api, data=data, files=files)
        response = requests.post(post_api, data=data)

        if response.status_code == 200:
            print(f"Book '{data['title']}' inserted successfully.")
        else:
            print(f"Failed to insert book '{data['title']}'.")

        print("----------------------------------------------")
    except Exception as e:
        print(e)
        print(f"Failed to add book - {title} to database.")
        print("----------------------------------------------")