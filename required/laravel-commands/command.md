
//Make Migrations
php artisan make:migration add_individual_id_to_clients_table --table=clients --path=/database/migrations/2020_migrations
php artisan migrate --path=/database/migrations/2020_migrations

//Linux Permissions
sudo chown -Rf www-data:www-data /var/www/campsn.jerotoma.com/*
