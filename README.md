## ezk-fake-news

### Запуск с локалки

#### Зависимости
- `Make`
- `Docker`

#### Запуск
- `
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/var/www/html \
    -w /var/www/html \
    laravelsail/php81-composer:latest \
    composer install --ignore-platform-reqs
` Это чтобы пыху самому не ставить
- `make up`
- `make front-install`
- `make front-build`
