# Tablero
App for organizing boardgame matches.  
This is a small example meant as an exercise for IT-Academy Fullstack PHP course.   

## 🧑‍🧑‍🧒‍🧒 Dependencies
- PHP 8.3
- Composer 2.0+
- Laravel 11.31
- Docker
- Sail 
- Livewire 3.5

## ⚙️ Development Setup With Docker/Sail
Follow these steps to test password recovery email locally, or if you don't want to install composer and want to test app. 

1. Clone this repo and `cd` to root directory.
2. Copy example environment file: `cp .env.example .env`.
3. Docker install composer dependencies and set up Sail:
```sh
docker run --rm \
  -u "$(id -u):$(id -g)" \
  -v "$(pwd):/var/www/html" \
  -w /var/www/html \
  laravelsail/php83-composer:latest \
  composer install --ignore-platform-reqs
```
4. Start development environment:
```sh
./vendor/bin/sail up -d
```
5. Generate app key:
```sh
./vendor/bin/sail artisan key:generate
```
6. Run database migrations (optionally with seeds):
```sh
./vendor/bin/sail artisan migrate
#Or with seeds:
./vendor/bin/sail artisan migrate --seed
```
>[!WARNING]
> **Troubleshoot MYSQL errors**  
> If there's errors on migration, make sure MYSQL container is running: `./vendor/bin/sail ps`.  
> If it isn't, restart the containers: 
>```sh
>./vendor/bin/sail down
>./vendor/bin/sail up -d
>```
> Then try to migrate tables again.

7. Install and start frontend assets:
```sh
./vendor/bin/sail npm install
./vendor/bin/sail npm run dev
```
Access the application:
- Web server: `http://localhost`
- Mailpit(Email Testing): `http://localhost:8025`
- Database: `localhost:3306`

### Useful Sail Commands
- Stop containers: `./vendor/bin/sail down`
- Restart containers: `./vendor/bin/sail restart`
- Run artisan commands: `./vendor/bin/sail artisan [command]`
- Run npm commands: `./vendor/bin/sail npm [command]`

## ⚙️ Development Setup Without Docker/Sail
Follow these steps to set up the application locally for development.  
1. Clone this repo and `cd` to root directory.
2. Copy example .env: `cp .env.example .env` and set your own SQL database conection. Make sure to uncomment lines removing `#`. 
```sql
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=dbName
DB_USERNAME=dbUser
DB_PASSWORD=dbPassword
```
3. Install php dependencies with `composer install`.
4. Generate key with `php artisan key:generate`.
5. Migrate database: `php artisan migrate`. Optionally, you can use `php artisan migrate --seed` to populate database with fake data. 
6. Install and start frontend assets:
```sh
npm install
npm run dev
```
7. Start development server with `php artisan serve`. 

Then open your browser and navigate to `http://localhost:8000`.
