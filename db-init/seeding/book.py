import requests
import random
import os

print ("""
Seeding Books
====================================
    
...
""")


NUM_OF_AUTHORS = 15
NUM_OF_GENRES = 15

post_api = 'http://web/book/add'


books = []
cat = ['hardcover-fiction', 'hardcover-nonfiction', 'young-adult']

# use nytimes api to get top 50 books
api_key = 'NjAsG7nGHyOJCVXiQRf3OIDPcnA8F0qu'
book_data_api = f'https://api.nytimes.com/svc/books/v3/lists/current/'


for c in cat:
    params = {
        "api-key": api_key
    }

    # Get books data 
    response = requests.get(book_data_api + c, params=params)

    if response.status_code != 200:
        print("Failed to get books data.", response.status_code, response.text)
        exit(1)

    data = response.json()
    books.extend(data['results']['books'])


for b in books:
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
    book_cover_temp_path = f'tmp/{title}.jpg'

    with open(book_cover_temp_path, 'wb') as image_file:
        image_content = requests.get(book_cover_url).content
        image_file.write(image_content)

    audio_path = f'tmp/tmp.mp3'

    files = {
        'cover': open(book_cover_temp_path, 'rb'),
        'audio': open(audio_path, 'rb')
    }

    data = {
        'title': title,
        'year': year,
        'summary': b['description'],
        'authors[]': authors,
        'genres[]': genres,
        'price': price,
        'lang': 'English',
    }

    response = requests.post(post_api, data=data, files=files)

    if response.status_code == 200:
        print(f"Book '{data['title']}' inserted successfully.")
    else:
        print(f"Failed to insert book '{data['title']}'.")

    print("----------------------------------------------")

    os.remove(book_cover_temp_path)