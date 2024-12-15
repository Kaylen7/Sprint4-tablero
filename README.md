# Tablero
App for organizing boardgame matches.  
This is a small example meant as an exercise for IT-Academy Fullstack PHP course. 

## 🧑‍🧑‍🧒‍🧒 Dependencies
- Php 8.2
- Laravel 11.31
- Tinker 2.9
- Livewire 3.5

## ⚙️ How to install
1. Clone this repo and `cd` to root directory.
2. `cp .env.example .env` and set your own SQL database conection.
3. `composer install`
4. `php artisan key:generate`
5. `php artisan migrate` (Use `--seed` if you want to populate database with some fake data.)
6. `npm run build`
7. Run `php artisan serve` and navigate to `localhost` to play around. 