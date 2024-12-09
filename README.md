# niche_laravel
if you cant run this laravel project, read this:

make sure you run:
php artisan serve

if that doesnt work or error, maybe you dont have composer installed.
try command:
composer install

YOU MIGHT NEED THESE:
   composer install
   cp .env.example .env
   php artisan key:generate
   php artisan migrate
   php artisan storage:link
   php artisan serve

   Open the .env file and update the following settings as needed:
   APP_NAME=YourAppName
   APP_URL=http://127.0.0.1:8000
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=your_database_name
   DB_USERNAME=your_database_user
   DB_PASSWORD=your_database_password

by shion :)

use this for testing db connection and logging in(because password needs to be hashed to work):
INSERT INTO `users` (`id`, `username`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES (NULL, 'test', 'test@test.com', NULL, '$2y$12$Ti99f.3.eitg6TOX9riof.9TXwlaK6skwbm7LRBtQjHkpEbo7xfly', NULL, NULL, NULL)

email: test@test.com
password: Testing123!
