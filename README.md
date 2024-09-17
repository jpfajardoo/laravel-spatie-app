Laravel Application with Spatie Roles and Permissions Welcome to the Laravel Application! This README will guide you through setting up and running the application.

Prerequisites Before you get started, make sure you have the following installed:

PHP (version 8.3 or higher) Composer Node.js and npm Laravel (installed globally or through Composer)

First, clone the repository to your local machine: bash git clone https://github.com/jpfajardoo/laravel-spatie.git cd your-repository

Install PHP dependencies using Composer: bash composer install

Install Node.js dependencies using npm: bash npm install Setup

Run Migrations and Seed the Database To set up the database schema and seed initial data, run: bash php artisan migrate:fresh --seed This command will drop all tables and re-run all migrations, then seed the database with the initial data.

Compile your application's assets with: bash npm run dev This will compile your assets for development. For production, you may want to run npm run prod to minify and optimize your assets.

Running the Application To start the Laravel development server, use: bash php artisan serve The application will be available at http://localhost:8000 by default.