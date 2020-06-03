#!/bin/bash

function up()
{
  cd general && docker-compose up -d
  cd ../auth && docker-compose up -d
  cd ../notifier && docker-compose up -d
  cd ../mailer && docker-compose up -d
}

function down() {
  cd auth && docker-compose down
  cd ../notifier && docker-compose down
  cd ../mailer && docker-compose down
  cd ../general && docker-compose down
}

function userCreated() {
    cd notifier && docker-compose run artisan user:created
}

case "$1" in
  (up)
    up
    exit 1
    ;;
  (down)
    down
    exit 1
    ;;
  (user:created)
    userCreated
    exit 1
    ;;
  (*)
    echo "Usage: $0 {up|down}"
    exit 2
    ;;
esac