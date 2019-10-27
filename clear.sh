php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan clear-compiled
sudo rm -rf storage/framework/sessions/*
# Paste restart comands for all services. For my developing machine :
sudo supervisorctl restart nginx
sudo supervisorctl restart all