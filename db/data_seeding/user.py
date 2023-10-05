import requests
from faker import Faker
import random
import os

fake = Faker()

api_url = 'http://localhost:8000/user/register'  # Replace with your API endpoint URL

# Generate fake user data using Faker
users = []
for _ in range(1):  # Adjust the number of users as needed
    username = fake.user_name()
    password = username  # Password is the same as the username
    email = fake.email()
    
    # Generate a random image URL from picsum.photos
    image_id = random.randint(1, 100)
    image_url = f'https://picsum.photos/id/{image_id}/200/200' 
    
    # Create a temporary image file
    # image_path = f'tmp/{username}.jpg'
    image_path = f'tmp/example.jpg'
    os.makedirs(os.path.dirname(image_path), exist_ok=True)

    with open(image_path, 'wb') as image_file:
        image_content = requests.get(image_url).content
        image_file.write(image_content)

    user_data = {
        'username': username,
        'role': 'customer',  # Assuming the role is 'customer'
        'email': email,
        'password': password
    }

    users.append((user_data, image_path))

# Send POST requests to create users with file uploads
for user_data, image_path in users:
    files = {'profile-pic': open(image_path, 'rb')}
    response = requests.post(api_url, data=user_data, files=files)

    if response.status_code == 301:
        print(f"User '{user_data['username']}' inserted successfully.")
    else:
        print(f"Failed to insert user '{user_data['username']}'.")
    
    # Clean up: remove temporary image file
    os.remove(image_path)