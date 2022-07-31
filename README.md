## About Blog App
1. Clone the project

2. Set up database and migrate the database
    ```sh
    php artisan migrate --seed
    ```

3. Create passport client
    ```sh
    php artisan passport:install --uuids
    ```

4. Run the project
    ```sh
    php artisan serve
    ```
