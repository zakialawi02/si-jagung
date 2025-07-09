# SI Jagung - Corn Plantation Information System

SI Jagung is a web-based geographic information system (GIS) designed to manage and monitor corn plantation lands. It provides tools for administrators to manage land data, visualize it on an interactive map, and for users to view and gain insights from this data. The system also includes informational pages about corn cultivation and health.

## Features

* **Admin & User Dashboards**: Separate dashboard interfaces for administrators and regular users.
* **User Management**: Administrators can manage system users.
* **Land Data Management (CRUD)**: Full capabilities to Create, Read, Update, and Delete corn plantation land data. Includes a review process for new land entries.
* **Interactive Map Visualization**: Displays the location of corn plantation lands on an interactive map.
* **Geospatial Index Layers**: Visualize important agricultural indices on the map, including:
    * NDVI (Normalized Difference Vegetation Index) for vegetation health.
    * NDMI (Normalized Difference Moisture Index) for crop water stress.
    * Methane data layers.
* **Authentication**: Secure user registration and login functionality.
* **Informational Pages**: Provides valuable content on corn cultivation techniques, corn health, and its benefits.

## Technologies Used

This project is built with the following technologies:

* **Backend**:
    * PHP 8.1+
    * [Laravel](https://laravel.com/) Framework 10.x
    * MySQL

* **Frontend**:
    * [Bootstrap 5](https://getbootstrap.com/)
    * [Vite](https://vitejs.dev/)
    * jQuery
    * [DataTables](https://datatables.net/) for interactive tables.
    * JavaScript for map interactivity (likely using a library like Leaflet.js).

## Installation

To get a local copy up and running, follow these steps.

**Prerequisites:**
* PHP >= 8.1
* Composer
* Node.js & NPM
* A web server (like Apache or Nginx)
* MySQL Database

**Steps:**

1.  **Clone the repository:**
    ```sh
    git clone [https://github.com/zakialawi02/si-jagung.git](https://github.com/zakialawi02/si-jagung.git)
    cd si-jagung
    ```

2.  **Install PHP dependencies:**
    ```sh
    composer install
    ```

3.  **Install JavaScript dependencies:**
    ```sh
    npm install
    ```

4.  **Set up the environment file:**
    * Copy the example environment file.
        ```sh
        cp .env.example .env
        ```
    * Generate a new application key.
        ```sh
        php artisan key:generate
        ```

5.  **Configure your `.env` file:**
    * Open the `.env` file and set up your database connection details (`DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`).

6.  **Set up the database:**
    * Create a new database with the name you specified in the `.env` file.
    * Import the provided SQL file to set up the initial tables and data.
        ```sh
        mysql -u YOUR_USERNAME -p YOUR_DATABASE_NAME < sijagung.sql
        ```
    * Run the database migrations to ensure the schema is up-to-date.
        ```sh
        php artisan migrate
        ```

7.  **Create a symbolic link for storage:**
    ```sh
    php artisan storage:link
    ```

8.  **Compile frontend assets:**
    ```sh
    npm run dev
    ```

9.  **Run the development server:**
    ```sh
    php artisan serve
    ```
    The application will be available at `http://127.0.0.1:8000`.

## Author

* **Zaki Alawi** - [zakialawi02](https://github.com/zakialawi02)

## Support and Donations

If you find this project useful and would like to support its further development, you can make a donation via the following platforms:

https://ko-fi.com/zakialawi

Every contribution you make is greatly appreciated. Thank you!

## License

This project is licensed under the **Creative Commons Attribution-NonCommercial-ShareAlike 4.0 International (CC BY-NC-SA 4.0)**.

[![CC BY-NC-SA 4.0](https://i.creativecommons.org/l/by-nc-sa/4.0/88x31.png)](http://creativecommons.org/licenses/by-nc-sa/4.0/)

Under the following terms:

- **Attribution** — You must give appropriate credit, provide a link to the license, and indicate if changes were made.
- **NonCommercial** — You may not use the material for commercial purposes.
- **ShareAlike** — If you remix, transform, or build upon the material, you must distribute your contributions under the same license as the original.

For complete details, please see the [LICENSE](LICENSE) file.