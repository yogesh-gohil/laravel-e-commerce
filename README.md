# Laravel Vue.js E-commerce Dashboard

## Overview

This open-source e-commerce dashboard is built using Laravel and Vue.js, providing a robust and user-friendly interface for managing various e-commerce tasks. It allows users to efficiently handle categories, products, and other essential aspects of an e-commerce platform.

## Features

- **Category Management**: Easily create, update, and delete product categories.
- **Product Management**: Add, edit, and remove products with detailed information and images.
- **Order Management**: View and manage customer orders.
- **User Management**: Handle user roles and permissions to secure different parts of the dashboard.
- **Analytics & Reports**: Generate and view sales reports and analytics to track the performance of your store.
- **Responsive Design**: Optimized for both desktop and mobile devices for seamless management on the go.

## Installation

### Prerequisites

- PHP >= 8.1
- Composer
- Node.js & npm
- MySQL or any other supported database

### Steps

1. **Clone the repository:**
   ```bash
   git clone https://github.com/yogesh-gohil/laravel-e-commerce.git
   cd laravel-e-commerce
   
2. **Install backend dependencies:**
    ```bash
    composer install
    ```
3. **Install frontend dependencies:**
    ```bash
    npm install
    ```
4. **Set up environment variables:**
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```
5. **Configure your database in the .env file:**
    ```bash
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=your_database_name
    DB_USERNAME=your_database_user
    DB_PASSWORD=your_database_password
    ```
6. **Run migrations and seed the database:**
    ```bash
    php artisan migrate --seed
    ```
7. **Build the frontend assets:**
    ```bash
    npm run dev
    ```
8. **Serve the application:**
    ```bash
    php artisan serve
    ```

## License

Laravel e commerce app is released under the GNU GENERAL PUBLIC LICENSE Version 3.
See [LICENSE](LICENSE) for details.

## Acknowledgements

- Laravel
- Vue.js
- All contributors and supporters of the project
