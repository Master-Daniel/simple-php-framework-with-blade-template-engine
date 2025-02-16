# Simple PHP Framework With Blade Template Engine
A simple PHP (boiler plate) framework for easily scaffolding web applications

# Application Setup
To run this application you must first create and environment file (.env) with the following variables

APP_NAME=\n
APP_URL=http://localhost:8000\n
APP_DEBUG=true\n
APP_TIMEZONE=UTC\n
APP_LOCALE=en\n\n

DB_HOST=localhost\n
DB_NAME=database\n
DB_USER=root\n
DB_PASS=\n\n

MAIL_DRIVER=smtp\n
MAIL_HOST=smtp.mailtrap.io\n
MAIL_PORT=2525\n
MAIL_USERNAME=\n
MAIL_PASSWORD=\n
MAIL_ENCRYPTION=tls\n\n

SESSION_SECURE=false\n
CACHE_ENABLED=true\n

# Run application on a local server
To run the application on a local server ensure you have the following installed
- PHP 7.4 or higher (also add to Environment PATH for windows)
- Composer
- xampp or wampp
- A code editor of your choice (e.g. Visual Studio Code)
- A terminal or command prompt of your choice (e.g. Git Bash, PowerShell, Terminal)

Start the application by running the command on your terminal
- php -S localhost:8000 -t public