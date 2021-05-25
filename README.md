# PopcornMan

## How to run

1. Open a terminal inside project folder.
2. Run `cp .env.example .env`. This will copy environment variables files.
3. Run `docker-compose up --build --remove-orphans -d`. This will start all the containers.
4. Run `docker exec -i -t popcornman_app_1 composer install`. This will install dependencies.
5. Run `docker exec -i -t popcornman_app_1 php artisan key:generate`. This will generate new key for your application.
6. Run `docker exec -i -t popcornman_app_1 php artisan migrate:fresh --seed`. This will create database and tables, and fills them with data.
7. Run `docker exec -i -t popcornman_app_1 php artisan serve --host 0.0.0.0 --port 8080`. This will run your application on port 8080.
8. Open http://localhost:8080.
9. Login using below credentials:<br>
    Username: `**popcorn@example.com**`<br>
    Password: `**secret**`
10. Enjoy :)
