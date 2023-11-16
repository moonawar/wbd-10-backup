import requests

print ("""
Seeding Genres
====================================
    
...
""")

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
# api_url = 'http://web/genre/add'

for genre in BOOK_GENRES:
    data = {
        'genre': genre
    }

    response = requests.post(api_url, data=data)

    if response.status_code == 200:
        print(f"Genre '{data['genre']}' inserted successfully.")
    else:
        print(f"Failed to insert genre '{data['genre']}'.")