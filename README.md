## About Blog App (https://blogger-app-laravel.herokuapp.com/)
1. Clone the project

2. Composer install

3. Set up database and APP_URL (For image path) in .env file

4. Migrate the database
    ```sh
    php artisan migrate --seed
    ```

5. Create passport client
    ```sh
    php artisan passport:install --uuids
    ```

6. Run the project
    ```sh
    php artisan serve
    ```
