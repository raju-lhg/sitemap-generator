# _LHG DEV Docker Installation Instructions_

## Installation 

- Install and configure [Docker](https://docs.docker.com/) and Docker Compose 
- Open your terminal on project directory 
- Run `` docker-compose build --no-cache `` to build the containers.  
- Update your `.env` file with following - 
# Update ``.env`` file:
	DB_CONNECTION=mysql
    DB_HOST=lhg-smap-db
    DB_PORT=3306
    DB_DATABASE=lhg-smap-db
    DB_USERNAME=root
    DB_PASSWORD=12345678

# Useful Commands

### Start Application:
``docker-compose up``

This will start application on http://localhost:8001/ and PHP MyAdmin is available on - http://localhost:8003/

### Stream Log:
``docker-compose exec lhg-smap-app bash -c "tail -f storage/logs/laravel.log"``

### Migrate:
``docker-compose exec lhg-smap-app bash -c "php artisan migrate"``

### Migrate-fresh:
``docker-compose exec lhg-smap-app bash -c "php artisan migrate:fresh"``

### Migrate-rollback:
``docker-compose exec lhg-smap-app bash -c "php artisan migrate:rollback``

### Seed:
``docker-compose exec lhg-smap-app bash -c "php artisan db:seed"``

### Seed-test:
``docker-compose exec lhg-smap-app bash -c "php artisan db:seed --class=TestSeeder"``

## Stop Application:
``docker-compose stop``  

If you are from Linux, make use of the Makefile located in root directory. 
