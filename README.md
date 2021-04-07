# Laravel project

## Laravel Feature testing (CRUD operations)


## Instructions to run this project:

### Clone GitHub repo for this project locally
1-  git clone "link"
### Install Composer Dependencies
2-  composer install
### Create a copy of your .env file
3-  cp .env.example .env
### Generate an app encryption key
4-  php artisan key:generate
### Create an empty database for our application
### In the .env file, add database information to allow Laravel to connect to the database
### Migrate the database
5-  php artisan migrate
### RUN TESTS
6-  php artisan test