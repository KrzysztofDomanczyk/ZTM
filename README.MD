```markdown
## Start

docker compose up --build -d
```
http://localhost:8888/

## Commands

```sh
vendor/bin/phpstan analyse
vendor/bin/rector process
vendor/bin/php-cs-fixer fix
npx tsc --watch
```

* wykorzystanie API z danymi realtime
* automatyczne wyświetlanie bieżącej lub ostatniej znanej pozycji pojazdów (nie starszych niż 10 minut)
* zapis / cache danych do DB (Postgres), aby nie pobierać ich przy każdym otwarciu mapy
* w języku PHP 8+ (obowiązkowe użycie composera wyłącznie dla celów autoloadera i PSR-4, ale bez dodatkowych pluginów i bibliotek)
* w języku Javascript (obsługa mapy)
* nie używanie frameworków JS lub PHP.
* wizualizacja na mapie Targeo 3.0 
* umieszczenie rozwiązania na GitHub



## Notes

- **PHP 8.3**: Use PHP 8.3 because 8.4 is not stable yet.
- **PHPStan**: Usage of PHPStan.
- **Simple Router**: Implementation of a simple router.
- **WebSocket**: WebSocket usage.
- **DI**: nie dodano.
- **postgis**: nie dodano.
- **garbage collector dla danych vehicle**: nie dodano.
- - **Autoryzacja**: nie dodano.
- zapis / cache danych do DB (Postgres), aby nie pobierać ich przy każdym otwarciu mapy - 
- 
```