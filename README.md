<p align="center">
  <a href="https://laravel.com" target="_blank">
    <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
  </a>
</p>

<p align="center">
  <img src="https://img.shields.io/badge/PHP-8%2B-blue" alt="PHP Version">
  <img src="https://img.shields.io/badge/Laravel-Framework-red" alt="Laravel">
  <img src="https://img.shields.io/badge/Database-MySQL-blue" alt="MySQL">
  <img src="https://img.shields.io/badge/Status-In%20Development-yellow" alt="Project Status">
  <img src="https://img.shields.io/badge/License-MIT-green" alt="License">
</p>

---

# Human Resources Management System (HRMS)

A complete **Human Resources Management System** built with **Laravel**, developed as the largest hands-on project of the course, simulating a real-world corporate HR application.

This project was designed to consolidate fundamental and advanced Laravel concepts while following best practices in architecture, code organization, and professional development workflows.

---

## 📌 About the Project

The **HRMS** is a web application focused on managing internal Human Resources processes, covering everything from the system foundation to essential flows such as authentication, user management, and administrative data handling.

The application is built in a scalable way, allowing continuous evolution as new features are added throughout the development process.

---

## 🚀 Features

- User registration and management (Administrators and Employees)
- Complete authentication system
  - Login
  - Logout
  - Password recovery
  - Password reset
- Initial structure for roles, departments, and permissions
- Administrative HR data management
- Organized and responsive admin layout
- Seeders and factories for development and testing
- MySQL database integration
- Local email testing with MailHog

---

## 🛠️ Tech Stack

- **PHP 8+**
- **Laravel**
- **MySQL**
- **Blade**
- **HTML5 / CSS3**
- **Eloquent ORM**
- **Migrations, Seeders, and Factories**
- **MailHog (local environment)**

---

## 🧱 Project Structure

The project follows Laravel’s standard structure, with a strong focus on organization, readability, and maintainability:

- `app/Models` → Application models
- `database/migrations` → Database schema
- `database/seeders` → Initial system data
- `database/factories` → Fake data for testing
- `resources/views` → Application views and layouts
- `routes/web.php` → Web routes
- `routes/auth.php` → Authentication routes

---

## ⚙️ Installation and Setup

### Requirements

- PHP 8+
- Composer
- MySQL
- Node.js (optional, for assets)
- MailHog (optional, for email testing)

### Step by step

```bash
# Clone the repository
git clone https://github.com/your-username/your-repository.git

# Access the project directory
cd your-repository

# Install dependencies
composer install

# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate

# Configure database in .env
DB_DATABASE=hrms
DB_USERNAME=root
DB_PASSWORD=

# Run migrations and seeders
php artisan migrate --seed

# Start the application
php artisan serve
