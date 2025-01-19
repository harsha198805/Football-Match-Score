# Football-Match-Score
Simple Real-Time Football Score System with WebSockets

2025-01-19

git clone https://github.com/harsha198805/Football-Match-Score.git

cd Football-Match-Score

composer install

cp .env.example .env

php artisan key:generate

php artisan migrate

php artisan db:seed

php artisan serve

Run Websocket Server

php artisan websockets:serve

View Live Score

http://127.0.0.1:8000/football

Update Score

http://127.0.0.1:8000/score/update