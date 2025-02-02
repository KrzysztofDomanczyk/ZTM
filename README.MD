Here is the formatted `README.MD`:

```markdown
## Start

```sh
docker exec -it ztm_targeo_app php -S 0.0.0.0:8000 -t public
```

## Commands

```sh
vendor/bin/phpstan analyse
vendor/bin/rector process
vendor/bin/php-cs-fixer fix
npx tsc --watch

```

## Notes

- **PHP 8.3**: Use PHP 8.3 because 8.4 is not stable yet.
- **PHPStan**: Usage of PHPStan.
- **Simple Router**: Implementation of a simple router.
- **WebSocket**: WebSocket usage.
```