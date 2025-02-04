```markdown
## Start

1. docker compose up --build -d
2. docker exec -it ztm_targeo_backend composer install
```
http://localhost:8888/

## Commands

```sh
vendor/bin/rector process
vendor/bin/php-cs-fixer fix
npx tsc --watch
```

## Conditions
* wykorzystanie API z danymi realtime
* automatyczne wyświetlanie bieżącej lub ostatniej znanej pozycji pojazdów (nie starszych niż 10 minut)
* zapis / cache danych do DB (Postgres), aby nie pobierać ich przy każdym otwarciu mapy
* w języku PHP 8+ (obowiązkowe użycie composera wyłącznie dla celów autoloadera i PSR-4, ale bez dodatkowych pluginów i bibliotek)
* w języku Javascript (obsługa mapy)
* nie używanie frameworków JS lub PHP.
* wizualizacja na mapie Targeo 3.0 
* umieszczenie rozwiązania na GitHub



## Notes
- Api ZTM Gdańsk (https://ckan2.multimediagdansk.pl/gpsPositions?v=2), zwraca pozycje pojazdów co około 1-2 minut.
- Ze względu na uproszczenie zadania, nie napisano mechanizmu dependency injection. Zamiast tego użyto zwykłego tworzenia klasy w domenie.
- Ze względu na uproszczenie zadania nie użyto postGis, w produkcyjnej wersji można byłoby użyć tego rozszerzenia. Architektura pozwala na dodanie rozszerzenia w przyszlości.
- Ze względu na uproszczenie zadania, nie dodano żadnej autoryzacji między FE i BE.
```

