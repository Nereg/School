php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan clear-compiled
sudo rm -rf storage/framework/sessions/*
php artisan optimize
# Paste restart comands for all services. For my developing machine :
sudo supervisorctl restart all