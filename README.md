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

run seeders to populate and the acting main branch is the random_backup_before_merging...
