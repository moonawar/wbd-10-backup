import requests
from faker import Faker
import random
import os

fake = Faker()

api_url = 'http://localhost:8000/user/register'
# api_url = 'http://web/user/register'

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

    role = random.randint(0,1)

    user_data = {
        'username': username,
        'role': ['customer', 'admin'][role],
        'email': email,
        'password': password
    }

    users.append((user_data, image_path))


users.append(({
    'username': 'admin',
    'role': 'admin',
    'email': 'admin@gmail.com',
    'password': 'admin'
}, 'user.jpg'))

users.append(({
    'username': 'addinmnwr',
    'role': 'admin',
    'email': 'addinmnwr@gmail.com',
    'password': 'addinmnwr'
}, 'user.jpg'))

users.append(({
    'username': 'cust',
    'role': 'cust',
    'email': 'cust@gmail.com',
    'password': 'cust'
}, 'user.jpg'))

# Send POST requests to create users with file uploads
for user_data, image_path in users:
    files = {'profile-pic': open(image_path, 'rb')}
    response = requests.post(api_url, data=user_data, files=files)

    if response.status_code == 200:
        print(f"User '{user_data['username']}' inserted successfully.")
    else:
        print(f"Failed to insert user '{user_data['username']}'.")
    
    # Clean up: remove temporary image file
    if (image_path != 'user.jpg'):
        files['profile-pic'].close()
        os.remove(image_path)