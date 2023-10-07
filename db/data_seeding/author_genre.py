import requests
import random

api_url = 'http://localhost:8000/author/add'

# Authors Generator
AUTHORS = [
    "Andrea Hirata",
    "Dee Lestari",
    "Pramoedya Ananta Toer",
    "Tere Liye",
    "Ika Natassa",
    "Ahmad Fuadi",
    "Tere Liye",
    "Dewi Lestari",
    "Habiburrahman El Shirazy",
    "Ayah Edy",
    "Fira Basuki",
    "Seno Gumira Ajidarma",
    "Djenar Maesa Ayu",
    "Mira W",
    "Leila S. Chudori"
]

for author in AUTHORS:
    author_data = {
        'author-name': author,
        'author-age': random.randint(20, 50)
    }

    response = requests.post(api_url, data=author_data)

    print("Response: ", response.status_code)
    if response.status_code == 200:
        print(f"Author '{author_data['author-name']}' inserted successfully.")
    else:
        print(f"Failed to insert author '{author_data['author-name']}'.")


BOOK_GENRES = [
    "Mystery",
    "Science Fiction",
    "Fantasy",
    "Romance",
    "Thriller",
    "Non-Fiction",
    "Historical Fiction",
    "Biography",
    "Horror",
    "Adventure",
    "Young Adult",
    "Dystopian",
    "Self-Help",
    "Crime",
    "Classics"
]

api_url = 'http://localhost:8000/genre/add'

for genre in BOOK_GENRES:
    data = {
        'genre': genre
    }

    response = requests.post(api_url, data=data)

    print("Response: ", response.status_code)
    if response.status_code == 200:
        print(f"Genre '{data['genre']}' inserted successfully.")
    else:
        print(f"Failed to insert genre '{data['genre']}'.")