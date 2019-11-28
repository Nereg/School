rm -rf /etc/supervisor/conf.d/supervisor.conf
cp supervisor.conf /etc/supervisor/conf.d/
sudo supervisorctl reread
sudo supervisorctl update
sudo supervisorctl start laravel-worker:*
php artisan queue:restart