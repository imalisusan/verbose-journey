# Task Management Application

## Overview
This is a simple task management web application built using Laravel. The application allows users to create, edit, delete, reorder tasks, and manage them under different projects. It is designed with best practices in mind, leveraging Laravel's features for routing, controllers, validation, and authentication.

## Features
- **Task Management**: Users can create, update, delete, and reorder tasks. Tasks are associated with projects, and the priority of tasks can be managed through drag-and-drop functionality.
- **Project Management**: Users can manage tasks under different projects, selecting a project from a dropdown to filter tasks accordingly.
- **Authentication**: All task and project management routes are protected, requiring users to be logged in to access them.
- **Slugs for Routing**: Instead of using IDs, the application uses slugs in the routes for better readability and SEO.

## Installation & Setup

### Prerequisites
- **PHP >= 8.0**
- **Composer**
- **MySQL**
- **Node.js & NPM/Yarn**

### Step-by-Step Installation

1. **Clone the Repository**
   ```bash
   git clone <repository_url>
   cd <repository_directory>
2. **Install Dependencies**
Install PHP dependencies
   ```bash
   composer install
   ```
    Install Javascript dependencies
   ```bash
   npm install
   ```
    or
     ```bash
   yarn install
   ```
3. **Environment Setup**

Open the .env file and configure your database settings
    ```env
    DB_DATABASE=your_database_name
    DB_USERNAME=your_database_username
    DB_PASSWORD=your_database_password
    ```
4. **Generate application key**

Open the .env file and configure your database settings
    ```bash
    php artisan key:generate
    ```
5. **Database Migration and Seeding**

Run the migrations to create the database tables:
   ```bash
   php artisan migrate
   ```
    Seed the database with sample data:
   ```bash
   php artisan db:seed
   ```
6. **Compile the assets**
Open the .env file and configure your database settings
   ```bash
   npm run dev
   ```
    or
     ```bash
   yarn run dev
   ```
4. **Serve the application**

Open the .env file and configure your database settings
    ```bash
    php artisan serve
    ```

The application will be available at http://localhost:8000 where you can create an account, and view the seeded tasks and continue to test the application 

## License
Alternatively, you can watch a video demo I have prepared to make your work easier:
**[Click here!](https://drive.google.com/file/d/1oZPYTUphqiokfbHQGYEDwdYC9BXleK5W/view?usp=sharing)**



## License

MIT

**Free Software!**



