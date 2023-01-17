requirements:
php: 8.*

run:
1- copy .env.example to .env and change db name to yours
2- run composer i
3- run php artisan key:generate
4- run php artisan passport:install
5- run php artisan passport:keys
6- run php artisan serve or the server you are working on
