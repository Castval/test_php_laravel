## Avvio

```
docker compose up -d --build
docker compose exec phpmyadmin chmod 777 /sessions
```

Entrare nel container docker (da effettuare solo la prima volta):

```
docker compose exec php bash
chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache
chmod -R 775 /var/www/storage /var/www/bootstrap/cache
php artisan migrate --seed
npm install
npm run dev -- --host
```

Dopo la prima:

```
docker compose up -d
```

utente:

```
root@example.com
password
```

lancio test:

```
php artisan test
```

APP_URL: http://localhost
