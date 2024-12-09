# niche_laravel
if you cant run this laravel project, read this:

make sure you run:
php artisan serve

if that doesnt work or error, maybe you dont have composer installed.
try command:
composer install

if thats successful, run 'php artisan serve'php 
if that still fails, check to see if you have .env in your files.(not .env.example).
if not, check if .env is included in the file '.gitignore'
if it is, and you have .env.example in your file, run:
cp .env.example .env
and
php artisan key:generate

now try php artisan serve

by shion :)

use this for testing db connection and logging in(because password needs to be hashed to work):
INSERT INTO `users` (`id`, `username`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES (NULL, 'test', 'test@test.com', NULL, '$2y$12$Ti99f.3.eitg6TOX9riof.9TXwlaK6skwbm7LRBtQjHkpEbo7xfly', NULL, NULL, NULL)

email: test@test.com
password: Testing123!