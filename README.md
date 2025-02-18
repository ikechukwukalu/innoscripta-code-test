# Innoscripta Code Test

This is a sample REST API that returns JSON as a response.

## Requirements

- PHP 8.2
- [Laravel 11](https://laravel.com/docs/10.x)
- [MailHog](https://github.com/mailhog/MailHog)
- Redis
- MySQL

## Project setup

```shell
npm install
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
```

### Run development server

```shell
php artisan serve
npm run build
```

### Run websocket server

```shell
php artisan reverb:start --debug
```

### Run queue worker

```shell
php artisan optimize:clear
php artisan queue:work
```

### Run tests

```shell
php artisan test --parallel --recreate-databases
```

### Generate documentation

```shell
php artisan scribe:generate
```

## Note

- Login credentials for customer

``` json
{
    "email": "testuser@example.com",
    "password": "$2C00l#@theM0m3nt!"
}
```

- Login credentials for Admin

``` json
{
    "email": "testadmin@innoscripta.com",
    "password": "$2C00l#@theM0m3nt!"
}
```

- After generating the documentation, navigate to `/docs` to view and test the APIs within the generated documentation by clicking on the `TRY IT OUT` button. A POSTMAN collection can also be exported from the documentation.

