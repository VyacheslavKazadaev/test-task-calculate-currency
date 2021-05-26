#!/usr/bin/env bash
docker exec currency_yii2 sh -c "php vendor/bin/codecept -c codeception.yml ${*}"
chmod -R o+rw tests
