bash:
	docker-compose exec lhg-smap-app bash

log:
	docker-compose exec lhg-smap-app bash -c "tail -f storage/logs/laravel.log"

migrate:
	docker-compose exec lhg-smap-app bash -c "php artisan migrate"

migrate-fresh:
	docker-compose exec lhg-smap-app bash -c "php artisan migrate:fresh"

migrate-rollback:
	docker-compose exec lhg-smap-app bash -c "php artisan migrate:rollback"

rabbitmq:
	docker-compose exec lhg-smap-app bash -c "php artisan rabbitmq:consume rabbitmq"

seed:
	docker-compose exec lhg-smap-app bash -c "php artisan db:seed"

seed-test:
	docker-compose exec lhg-smap-app bash -c "php artisan db:seed --class=TestSeeder"

start:
	docker-compose up

stop:
	docker-compose stop

build:
	docker-compose build --no-cache

websocket:
	docker-compose exec lhg-smap-app bash -c "php artisan websocket:serve"
