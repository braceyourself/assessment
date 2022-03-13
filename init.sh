#!/usr/bin/env bash

test -d vendor/ || {
    echo "vendor/ dir not found. Installing dependencies."
    docker-compose run --rm composer install
}

test -f .env || {
    echo ".env file not found"
    cp .env.example .env
    docker-compose run artisan key:generate
}

eval "docker-compose up -d --force-recreate -V"
eval "docker-compose ps"
res=$(docker-compose ps | grep "(starting)")

while [[ "$res" == *"(starting)"* ]]; do
    echo "something is starting...";
    echo "$res";

    sleep 1
    res=$(docker-compose ps | grep "(starting)")
done

sleep 3

echo "running migrations"
eval "docker-compose run --rm artisan migrate:fresh --seed"