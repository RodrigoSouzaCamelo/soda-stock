# Requirements
- MySql 8.0
- PHP 7.2.9
- Composer 1.8.6
- Laravel 5.8.29

# Step run application
- Create an .env file based on the .env.example file and add the database settings. This must be done at the root of the application.
## Run the commands
- composer install
- php artisan migrate
- php artisan db:seed
- php artisan key:generate
- php artisan serve
