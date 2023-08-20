# Project Documentation: Timehut - Employee Management System

### Table of contents

1. [Introduction](#1-introduction)
2. [Project Overview](#2-project-overview)
3. [Technology Stack](#3-technology-stack)
4. [Installation Guide](#4-installation-guide)
5. [Usage Guide](#5-usage-guide)
8. [References](#6-references)

### 1. Introduction
<p>
    Welcome to the documentation for Timehut, an Employee Management System designed to assist companies in efficiently managing their employees, tracking working hours, and calculating salaries. This documentation provides a comprehensive guide on how to set up and use the Timehut system.
</p>

### 2. Project Overview
#### 2.1 Purpose
<p>
    Timehut aims to streamline employee management processes for businesses of all sizes. It provides an intuitive web-based interface for administrators to create and manage employee profiles, assign shifts, track attendance, and calculate salaries.
</p>

#### 2.2. Features
Key features of Timehut include:

- Employee Management: Create and manage employee profiles, including personal information and job details.
- Shift Scheduling: Assign shifts to employees and track their working hours.
- Salary Calculation: Automatically calculate employee salaries based on hours worked.
- User-Friendly Interface: A user-friendly web interface powered by Laravel, Filament, Livewire, and Heroicons.

### 3. Technology Stack
Timehut is built using a modern technology stack to ensure stability, security, and scalability. The core technologies used in this project are:

- **PHP - Laravel 10**: Laravel is a popular PHP framework known for its elegant syntax and robust features. Version 10 offers improved performance and security.

- **PHP - Filament v3**: Filament is a Laravel-based admin panel generator that simplifies the creation of tables, forms, and other admin-related tasks. Version 3 provides enhanced functionality.

- **Livewire v3**: Livewire is a Laravel package for building interactive user interfaces. It enables real-time interactions without the need for complex JavaScript.

- **Heroicons**: Heroicons is a set of free, MIT-licensed high-quality SVG icons for you to use in your web projects.

- **PHP - PEST:** Pest is a testing framework with a focus on simplicity, meticulously designed to bring back the joy of testing in PHP.

### 4. Installation Guide
To set up Timehut on your local machine, follow these steps:
#### 4.1 Prerequisites
Before you begin, make sure you have the following installed:
- **PHP**: Ensure that you have PHP installed, preferably version 8 or higher.

- **Composer**: Composer is a dependency manager for PHP. Install it by following the instructions on the official website.

- **Node.js and NPM**: Node.js is required for managing JavaScript dependencies. Install both Node.js and NPM from the official website.

- **Database**: Set up a local database system (e.g., MySQL, PostgreSQL) and have the necessary credentials ready.

  #### 4.2 Installation Steps
  1. Clone the project repository from GitHub:
```bash
git clone https://github.com/TimehutMk/timehut-backend.git
```
  2. Open the project using your preferred IDE (e.g., PHPStorm, Visual Studio Code).
  3. Navigate to the project directory in your terminal and run the following commands:
```bash
npm install
composer install
```
  4. Create a .env file by copying the provided example:
```bash
cp .env.example .env
```
  5. Generate the application key:
```bash
php artisan key:generate
```
  6. Configure your .env file with the appropriate database connection details:
```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_username
DB_PASSWORD=your_database_password
```
  7. Migrate and seed the database:
```bash
php artisan migrate --seed
```
  8. Start the Laravel development server:
```bash
php artisan serve
```
  9. Compile the frontend assets:
```bash
npm run dev
```
  10. Access the Timehut application in your web browser at `http://localhost:8000` or `http://127.0.0.1:8000`.
  11. Log in to the admin panel with the provided credentials.
```bash
admin@gmail.com
```
```bash
admin
```

### 5. Usage Guide
#### 5.1 Admin Panel
<p>
    The admin panel provides access to all the features of Timehut. Here are some common tasks:
</p>

- **Employee Management**: Create, edit, or delete employee profiles.
- **Shift Scheduling**: Track their working hours.
- **Salary Calculation**: The system will automatically calculate salaries based on hours worked.
- **User Management**: Manage admin users and their permissions.

  #### 5.2 Employee Portal
<p>
    In addition to the admin panel, Timehut provides an employee portal where employees can:
</p>

- View their assigned shifts.
- Check their working hours.
- Access salary information.

### 6. References

- [Laravel Documentation](https://laravel.com/docs/10)
- [Filament Documentation](https://docs.filamentadmin.com/v3/)
- [Livewire Documentation](https://laravel-livewire.com/docs/2.x/)
- [Heroicons](https://heroicons.com/)
- [Node.js](https://nodejs.org/)
- [Composer](https://getcomposer.org/)
- [Pest](https://pestphp.com/)
