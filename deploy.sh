#!/usr/bin/env bash
docker-compose up --build -d
docker exec currency_yii2 sh -c "composer.phar install"
