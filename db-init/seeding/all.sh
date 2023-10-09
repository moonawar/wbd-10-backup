apt-get update
apt-get install -y python3 python3-pip

pip3 install requests Faker

# check if seeding has already been done
if [ ! -f init.flag ]; then
    echo "Seeding database... ###########################################"
    python3 user.py
    python3 genre.py
    python3 author.py
    python3 book.py
    touch init.flag
else
    echo "Action already initiated. Skipping..."

echo "Seeding complete."
fi