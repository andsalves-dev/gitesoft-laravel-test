
## About Application Execution

All terminal commands are executed in root dir of project.

### Dependencies/Composer

PHP 7.1.x and Laravel 5.5.x were used.
To install composer dependencies, run:

-- $ composer install

### Database Config

Migrations and seeders were created to seed the database with initial data.<br>

The following steps are recommended:

- Configure .env file. Local file were created with this content:

APP_NAME=Laravel
APP_ENV=local
APP_KEY=base64:bxma4xIc8IZEAEgA620VjfxOx4hSSb1hEGkzr0bxdNs=
APP_DEBUG=true
APP_LOG_LEVEL=debug
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel_films
DB_USERNAME=root
DB_PASSWORD=root

- Create the named database (Mysql, same name as in .env file): 

  -- CREATE DATABASE IF NOT EXISTS laravel_films;
  
- After database created, run migrations and seeders:
-- $ php artisan migrate --seed

### Running Application

To run the application, Configure a local server like apache, 
or use builtin server from PHP (recommended). <br>
To do it the right way, run: 

-- $ php -S 0.0.0.0:8000 -t public/

### Remarks

- The project were made in Linux, Manjaro Dist, Arch based. 
- The APIs were made in same project. An API for films and other for comments were set in api routes.
- The seeders include a default admin user, for first login. Username and password are "admin".
- VueJs was used as Frontend js Library. Bootstrap were used too.
- Home page is always /films
- For sign up, will have a link "sign up" in Login page
- Any user can post comments and/or new films after register.
- The created or most edited directories/files were:
  - /resources/views
  - /app/Http/Controllers,Helper
  - /app/Model
  - /database
  - /routes/{api,web}.php
  - /public