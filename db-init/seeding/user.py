import requests
from faker import Faker
import random
import os

fake = Faker()

api_url = 'http://web/user/register'

print ("""
Seeding Users
====================================
    
...
""")

users = []
for _ in range(20):
    username = fake.user_name()
    password = username
    email = fake.email()
    
    # Generate a random image URL from picsum.photos
    image_url = f'https://picsum.photos/500' 
    
    # Create a temporary image file
    image_path = f'tmp/{username}.jpg'

    with open(image_path, 'wb') as image_file:
        image_content = requests.get(image_url).content
        image_file.write(image_content)

    role = random.choice(['customer', 'admin'])

    user_data = {
        'username': username,
        'role': role,
        'email': email,
        'password': password
    }

    users.append((user_data, image_path))

# Send POST requests to create users with file uploads
for user_data, image_path in users:
    files = {'profile-pic': open(image_path, 'rb')}
    response = requests.post(api_url, data=user_data, files=files)

    if response.status_code == 200:
        print(f"User '{user_data['username']}' inserted successfully.")
    else:
        print(f"Failed to insert user '{user_data['username']}'.")
    
    # Clean up: remove temporary image file
    os.remove(image_path)