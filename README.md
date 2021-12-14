1. Start application

```sh
docker-compose -f docker-compose.yml -f docker-compose.override.yml -f docker-compose.debug.yml up -d
```

2. Load fixtures

```sh
docker-compose exec php sh -c "bin/console d:f:l --purge-with-truncate --no-interaction"
```

3. Run `phpstan` and `php-cs-fixer`

```sh
docker-compose exec php sh -c "composer php-cs-fixer ; composer phpstan"
```


5. Run tests

```sh
docker-compose exec php sh -c "composer setup-tests; ./vendor/bin/phpunit"
```

5. Check endpoints:

List shifts:

```sh
curl --insecure https://localhost/shifts
```

List workers:

```sh
curl --insecure https://localhost/workers
```

List worker shifts (`worker` and `date` are optional):

```sh
curl --insecure https://localhost/worker-shifts?worker\=1\&date\=2021-01-01
```

Add worker shifts:

```sh
curl --insecure -X POST https://localhost/worker-shifts -d '{"worker":1,"shift":1,"date":"2022-01-01"}'
```

Delete worker shifts:

```sh
curl --insecure -X DELETE https://localhost/worker-shifts/5
```
