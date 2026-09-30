# Ad Management Platform

A Laravel-based marketplace for browsing and managing classified ads, with separate customer and administrator areas.

**Project administrator:** [Filip Vicentijevic (@filipvicentijevic99)](https://github.com/filipvicentijevic99)

## Features

- Browse ads publicly and filter them by category.
- Customers can manage ads, view their profile, and review activity.
- Administrators can manage customers, categories, and ads.
- Admin dashboard with counts and recently added users and ads.

## Languages and Technologies

- **Languages:** PHP, JavaScript, CSS, SQL
- **Templates:** Laravel Blade
- **Frameworks and libraries:** Laravel 10, Alpine.js, Tailwind CSS
- **Database:** MySQL
- **Frontend tooling:** Vite and npm

## Requirements

- PHP 8.1-8.4
- Composer
- Node.js and npm
- MySQL

The committed Composer lock file currently includes a dependency that does not declare PHP 8.5 support. Use PHP 8.4 or earlier for the standard setup.

## Local Setup

1. Install PHP and Composer dependencies:

   ```sh
   composer install
   ```

2. Create the local environment file:

   ```sh
   cp .env.example .env
   ```

   In Windows PowerShell, use `Copy-Item .env.example .env` instead.

3. Create a MySQL database named `laravel` and set the `DB_*` values in `.env` to match your local MySQL configuration.

4. Generate the application key and create the tables and demo data:

   ```sh
   php artisan key:generate
   php artisan migrate --seed
   ```

5. Install and build the frontend assets:

   ```sh
   npm install
   npm run build
   ```

   In Windows PowerShell, use `npm.cmd install` and `npm.cmd run build` if script execution blocks `npm`.

6. Start the local server:

   ```sh
   php artisan serve
   ```

   Open the URL printed by Artisan, usually `http://127.0.0.1:8000`.

## Demo Accounts

The seeder creates these local development accounts:

| Role | Email | Password |
| --- | --- | --- |
| Admin | `admin@raf.rs` | `admin.123` |
| Customer | `pera@raf.rs` | `customer.123` |

These are public demo credentials. Do not use them in a production deployment; change or remove them before exposing the application publicly.
