# Tablero
App for organizing boardgame matches.  
This is a small example meant as an exercise for IT-Academy Fullstack PHP course.   

## 🧑‍🧑‍🧒‍🧒 Dependencies
- PHP 8.3
- Composer 2.0+
- Laravel 11.31
- Livewire 3.5

## ⚙️ Development Setup
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
6. Start asset pipeline: `npm run dev`.
7. Start development server with `php artisan serve`.  

Then open your browser and navigate to `http://localhost:8000`.