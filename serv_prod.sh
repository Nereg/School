php artisan down
composer install
composer update # may need more swap
rm -rf .env
cp prod.env .env
./clear.sh #clearing all stuff
./queue.sh
php artisan up 