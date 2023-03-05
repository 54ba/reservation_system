stop:
    docker-compose stop
shell:
    docker-compose run artisan sh
start:
    docker-compose up --detach
destroy:
    docker-compose down --volumes
build:
    docker-compose up --detach --build
seed:
    docker-compose run artisan db:seed
migrate:
    docker-compose run artisan migrate:fresh