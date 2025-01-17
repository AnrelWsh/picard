# Picard API

## Clone the repo

```bash
git clone git@github.com:AnrelWsh/picard
cd picard
```

## Composer

```bash
composer install
```


## Environment

Create a .env.local and add :

```bash
APP_SECRET=<app_secret>
DATABASE_URL="mysql://ID:PASSWORD@127.0.0.1:3306/<DB_name>&charset=utf8mb4"

```

## Database

```bash
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
```

## Add fake products with Faker

```bash
php bin/console doctrine:fixtures:load  
```

## Start server

```bash
symfony serve
```

Don't forget to launch your local server environement (Laragon, MAMP, ...) !

## Loom video link : 
https://www.loom.com/share/56cd90d9ba874e0b924a91434f0b3b6c?sid=d3844300-603d-40ee-97dc-6b54a7f20d1a

## Sources de travail

Replays du cours de création d'API de Yoann Coualan