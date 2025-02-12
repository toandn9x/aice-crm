**Clone your project** <br>
**Go to the folder application using cd command on your cmd or terminal** <br>
Run **composer install** on your cmd or terminal <br>
Run **npm install && npm run build** <br>
Run **docker compose up -d** to create mariadb <br>
Copy .env.example file to .env on the root folder. You can type copy .env.example .env if using command prompt Windows or cp .env.example .env if using terminal, Ubuntu
Open your .env file and change the database name (DB_DATABASE) to whatever you have, username (DB_USERNAME) and password (DB_PASSWORD) field correspond to your configuration.
Run **php artisan key:generate** <br>
Run **php artisan migrate** <br>
Run **php artisan serve** <br>