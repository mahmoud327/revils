# Awarebox

### awarebox is an app for  is an online social shopping platform for handcrafts.

- Go to the project path and configure your environment:
- Copy the `.env.example` file to `.env`:
    ```bash
    cd ./appName

    cp .env.example .env
    ```
- Configure database in your `.env` file:
    ```dotenv
    DB_DATABASE=project
    DB_USERNAME=root
    DB_PASSWORD=
    ```
- Install composer packages using the following command:
    ```bash
    composer install
    ```
- Generate the project key using the following artisan command:
    ```bash
    php artisan key:generate
    ```

- Migrate the database tables and dummy data:
  ```bash
  php artisan migrate --seed
  ```

- Run the project in your browser using `artisan serve` command:
    ```bash
    php artisan serve
    ```
- Go to your browser and visit: [http://localhost:8000](http://localhost:8000)
    - Default Admin Credentials:
        - **Email:** admin@awarebox.com
        - **Password:** Password123

### Docker

- - to list all containers :
```
docker kill ps
```
- - to kill all containers :
```
docker kill $(docker ps -q)
```

- run following commands in terminal at the root of project dir to build docker and run app
- - check database/mysql folder to be empty before first time to build
- for first time run to build and up:
```
docker-compose up --build
```
- after first time just run the following command if container is already exists (or with --build if it's killed)
```
docker-compose up
```
- then run the following command to run migrations with seeder :
```
docker-compose exec php php artisan migrate:fresh --seed
```
- last run the following command to tests if needed :
```
docker-compose exec php php artisan test
```

- visit : http://localhost:8000


- for phpmyadmin credentials :
- visit : http://localhost:8001
-  - note: no need to enter server when you login to phpmyadmin keep it empty
- - username : your DB_USERNAME in .env file
- - password : your DB_PASSWORD in .env file
- - database name after login : your DB_DATABASE in .env file

``note: all data in db will be keept after down container``

```
docker-compose down
```
