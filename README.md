# Task Management

### Coalition Technologies Task Management System

---

## Building

### Pre-requisites:

1. Install Laravel 11 using Composer:
   - Refer to the [Laravel installation guide](https://laravel.com/docs/11.x/installation).

2. Install MySQL v8 server using WSL2 or Docker Desktop.

3. Ensure MySQL is reachable on `localhost`.

4. Install HeidiSQL or any database management tool:
   - Download [HeidiSQL](https://www.heidisql.com/download.php).
---

### Create a local MySQL database for development:

```sql
CREATE DATABASE tasks;
CREATE USER 'tasks'@'%' IDENTIFIED BY 'tasks';
GRANT ALL ON tasks.* TO 'tasks'@'%';
FLUSH PRIVILEGES;
```

---

### Install application dependencies and perform database migration:

```sh
git clone https://github.com/Madhan-Prasath/task-management.git
cd task-management

# Update the database credentials in the `.env` file
cp .env.example .env

# Set the following in the .env file:
# DB_CONNECTION=mysql
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=tasks
# DB_USERNAME=tasks
# DB_PASSWORD=tasks

composer install
php artisan migrate --seed
php artisan key:generate

php artisan serve

# Access Task Management System at http://localhost:8000
```

---

## Running in Production

### Server Prerequisites:

- Deploy the application using Docker with the [docker-compose.yml](docker-compose.yml) file.
- Set Apache `DocumentRoot` to the Laravel application's `public` folder, e.g., `/var/www/public`.
- Create a MySQL database and user as required. Refer to development DB creation steps.

---

### Install application dependencies and perform database migration:

```sh
cd /var
git clone https://github.com/Madhan-Prasath/task-management.git www
cd www

# Update the database credentials in the `.env` file:
# DB_CONNECTION=mysql
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=tasks
# DB_USERNAME=tasks
# DB_PASSWORD=tasks

chown -Rh www-data storage/framework
cp .env.prod .env
```

---

### Steps to run inside the Docker container:

```sh
composer install
php artisan migrate --seed
php artisan key:generate

# Access Task Management System at https://tasks.example.com/
```
---

### Features:
- Task creation, editing, and deletion.
- Priority management and task reordering.
- Project filtering and global task views.

---
