# Simple PHP Framework With Blade Template Engine
A simple PHP (boiler plate) framework for easily scaffolding web applications

# Application Requirements
To run the application on a local server ensure you have the following installed
- PHP 7.4 or higher (also add to Environment PATH for windows)
- Composer
- xampp or wampp
- A code editor of your choice (e.g. Visual Studio Code)
- A terminal or command prompt of your choice (e.g. Git Bash, PowerShell, Terminal)

# Run application on a local server
1. Clone the repository to your local machine using the following command in your terminal or command prompt
- [https://github.com/Master-Daniel/simple-php-framework-with-blade-template-engine.git](https://github.com/Master-Daniel/simple-php-framework-with-blade-template-engine.git)
- cd /simple-php-framework-with-blade-template-engine
- composer update

# Application Setup
To run this application you must first create and environment file (.env) with the following variables
``` env
APP_NAME=
APP_URL=http://localhost:8000
APP_DEBUG=true
APP_TIMEZONE=UTC
APP_LOCALE=en

DB_HOST=localhost
DB_NAME=database
DB_USER=root
DB_PASS=

MAIL_DRIVER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=
MAIL_PASSWORD=
MAIL_ENCRYPTION=tls

SESSION_SECURE=false
CACHE_ENABLED=true
```

# Setting up Database tables/migrations

2. Create a new database in your local server (e.g. xampp, wampp)
- Create a new database with the name of your choice (e.g. simple_php_framework)
- Create a new user with the name of your choice (e.g. simple_php_framework_user)
- Create a new password for the user (e.g. simple_php_framework_password)
- Update the database connection settings in the .env file to match your database settings
- Update the database connection settings in the database.php file to match your database settings

3. Run the following command in your terminal or command prompt to create the database tables
- php vendor/bin/phinx init
- php vendor/bin/phinx create CreateUsersTable (to create tables) # where *CreateUsersTable* is the table name
- php vendor/bin/phinx migrate
- php vendor/bin/phinx rollback

4. Run the following command in your terminal or command prompt to seed the database with some data
- php vendor/bin/phinx seed:create UserSeeder # Where *UserSeeder* is the seed file name
- php vendor/bin/phinx seed:run
To run a specific seeder, use:
- php vendor/bin/phinx seed:run -s UserSeeder

5. Run the following command in your terminal or command prompt to start the application
- php -S localhost:8000 -t public

6. Open your web browser and navigate to http://localhost:8000 to view the application