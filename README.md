<p align="center"><img src="https://theme.zdassets.com/theme_assets/624144/6a8455c16fd14684884098941e1317cc5173b353.png" width="400"></p>

# BitPanda PHP Technical Test #1

Test to demonstrate skills and mastery in PHP. 

[API Documentation](https://jvarona05.github.io/bitpanda-php-technical-test-1/public/docs/).

## Requirements

1. Create a call which will return all the users which are `active` (users table) and have an Austrian citizenship.
2. Create a call which will allow you to edit user details just if the user details are there already.
3. Create a call which will allow you to delete a user just if no user details exist yet.
4. Write a feature test for 3. with valid and invalid data

## Main Technologies

- Laravel
- Mysql
- RESTful API
- Docker - Laradock
- Migrations
- Seeders
- FeatureTest - PHPUnit
- Eloquent - Resource
- Eloquent - Eager Loading
- Laravel Apidoc Generator

## Installation

### Clone the project

```
git clone https://github.com/jvarona05/bitpanda-php-technical-test-1.git

cd bitpanda-sample
```

### Create .env file

```
cp .env.example .env
```

### Run Docker

```
git clone https://github.com/Laradock/laradock.git

cd laradock

cp env-example .env

docker-compose up -d nginx mysql workspace 
```

### Configure the project

```
docker exec -ti laradock_workspace_1 composer install

docker exec -ti laradock_workspace_1 php artisan migrate --seed

docker exec -ti laradock_workspace_1 php artisan test
```

### Open the proyect

```
http://localhost/
```
 
 Note: the app will ask you to generate the Laravel APP_KEY
