Start

docker exec -it ztm_targeo_app php -S 0.0.0.0:8000 -t public


vendor/bin/phpstan analyse
vendor/bin/rector process
vendor/bin/php-cs-fixer fix

AD
PHP 8.3 poniewaz 8.4 not stable yet
uzycie php stan