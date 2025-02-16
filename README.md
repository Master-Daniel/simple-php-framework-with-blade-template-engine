# simple-php-framework-with-blade-template-engine
A simple PHP (boiler plate) framework for easily scaffolding web applications

# Application Setup
To run this application you must first create and environment file (.env) with the following variables

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

# Run application on a local server
To run the application on a local server ensure you have the following installed
- PHP 7.4 or higher (also add to Environment PATH for windows)
- Composer
- xampp or wampp
- A code editor of your choice (e.g. Visual Studio Code)
- A terminal or command prompt of your choice (e.g. Git Bash, PowerShell, Terminal)

- Start the application by running the command on your terminal
- php -S localhost:8000 -t public