#Notes API
This is a Laravel application that serves as the backend REST API for managing Notes

###Initial Setup
* Edit the .env file to connect to the database (You can find the info in `../../database/README.md`)
* Run docker compose `docker-compose up -d`
* Exec into the `web` docker container `docker exec -it web bash`, then:
    * Install dependencies via `composer install`
    * Run migrations and seed the database `php artisan migrate --seed`


###Authenticating 
Api requests must be authenticated with a Bearer token.
* To get the authentication bearer token, a user must first call the `/api/login` endpoint with credentials `email` and `password` in the body as `form-data`
