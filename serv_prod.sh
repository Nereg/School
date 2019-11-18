php artisan down
rm -rf .env
cp prod.env .env
./clear.sh #clearing all stuff
./queue.sh
php artisan up 