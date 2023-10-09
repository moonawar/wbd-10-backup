sudo chown 1000 ./mysql/*
rm -rf ./mysql/*
touch ./mysql/.gitkeep

sudo chown 1000 ./db-init/seeding/init.flag
rm -rf ./db-init/seeding/init.flag

rm -rf ./app/storage/image/book_cover/*
touch ./app/storage/image/book_cover/.gitkeep

rm -rf ./app/storage/image/profile_pic/*
touch ./app/storage/image/profile_pic/.gitkeep

rm -rf ./app/storage/audio/*
touch ./app/storage/audio/.gitkeep