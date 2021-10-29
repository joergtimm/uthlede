#!/bin/bash

docomposer() {
composer install
composer update --optimize-autoloader --no-scripts --no-interaction
php bin/console cache:clear --no-warmup --env=prod
php bin/console cache:warmup --env=prod
}
