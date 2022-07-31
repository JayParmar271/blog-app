## About Blog App
1. Clone the project

2. Set up database and APP_URL (For image path) in .env file

3. Migrate the database
    ```sh
    php artisan migrate --seed
    ```

4. Create passport client
    ```sh
    php artisan passport:install --uuids
    ```

5. Run the project
    ```sh
    php artisan serve
    ```
