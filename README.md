git clone https://github.com/Tobak/xm.git

cd xm

composer install

npm install

npm run build

cp .env.example .env

php artisan key:generate


Set up

MAIL_MAILER=
MAIL_HOST=
MAIL_PORT=
MAIL_USERNAME=
MAIL_PASSWORD=
MAIL_ENCRYPTION=


in newly created .env


php artisan serve
