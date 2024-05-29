# QED Soccer Teams Management

## Introduction

[Filament](https://filamentphp.com/) is a powerful tool for rapidly developing panels, forms, and pages with CRUD functionality in Laravel. This project serves as an introduction to Filament, Laravel's Eloquent ORM, and Git workflow through the creation of a simple soccer teams management system.

## Setup Project Locally

### Requirements

- PHP version: >= 8.3
- Laravel version: >= 11
- Filament version: >= 3.2
- Composer version: >= 2.7
- PostgreSQL (or any other SQL database) database version: >= 16.0

### Step-by-Step Setup

1. **Clone the Repository:**

   ```bash
   git clone https://github.com/markogajic13/qed-soccer-teams.git
   
2. **Create empty PostgreSQL database**
3. **Copy Environment Variables:**
   ```bash
   cp .env.example .env
5. **Project .env file:**
   Set your database name and password (they need to be same as in your pgAdmin 4).
   (If you get an error: FATAL: password authentication failed for user "postgres" then in your PC go to C:\Program Files\PostgreSQL\16\data\pg_hba.conf path and open pg_hba.conf conf file and edit all METHODS to trust and save file.)
   Then run next commands in VSC terminal:
   ```bash
   composer install
   ```bash
   php artisan key:generate
   ```bash
   php artisan storage:link
6. **Run Database Migrations:**
   ```bash
   php artisan migrate
7. **Create new admin:**
   First run the following command, then create name, email and password and then go to http://qed-soccer-teams.test/admin/login and login in dashboard with those email and password.
   ```bash
   php artisan make:filament-user
8. **Run custom command to create teams and players:**
    ```bash
    php artisan db:seed --class=LTPSeeder
   
9. **Run queue command to create leagues, teams and players avatars in background**
    Open the new terminal, navigate to laradock folder, execute workspace bash, navigate to project and run the command:
    ```bash
    php artisan queue:work
