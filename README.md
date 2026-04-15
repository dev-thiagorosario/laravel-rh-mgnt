<p align="center">
  <a href="https://laravel.com" target="_blank">
    <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
  </a>
</p>

<p align="center">
  <img src="https://img.shields.io/badge/PHP-8%2B-blue" alt="PHP Version">
  <img src="https://img.shields.io/badge/Laravel-Framework-red" alt="Laravel">
  <img src="https://img.shields.io/badge/Database-PostgreSQL%20%2F%20MySQL-blue" alt="Database">
  <img src="https://img.shields.io/badge/Status-In%20Development-yellow" alt="Project Status">
  <img src="https://img.shields.io/badge/License-MIT-green" alt="License">
</p>

---

# Human Resources Management System (HRMS) — Laravel

A complete **Human Resources Management System** built with **Laravel** as a **realistic corporate HR platform**.  
This is the **biggest project of the course**, designed to consolidate **Laravel fundamentals + advanced concepts**, with a focus on **clean structure, authentication, policies/authorization, and an admin-ready interface**.

> Goal: simulate a real company HR system with multiple user types, access control, and scalable modules.

---

## 📌 About the Project

The **HRMS** centralizes HR routines such as:
- **Authentication and access control** (login flow + authorization via Policies/Gates)
- **User management by roles** (Admin, Manager, Employee)
- **Department-based control** (Managers limited to their own department)
- Structure ready to grow into modules like **employees, job roles, payroll, vacations, attendance**, etc.

---

## 👥 User Types & Permissions

### ✅ Admin
- Has full access across the system
- Can **create users in any department**
- Can manage sensitive HR resources globally

### ✅ Manager
- Has elevated access inside their scope
- Can **create users ONLY inside their own department**
- Typical permissions: view/manage employees of their department, approve requests, etc.

### ✅ Employee
- Standard access user
- Can view/edit only their own profile (and other allowed resources)
- **Cannot create or delete users**

> This “department boundary” is enforced at the authorization level (Policies), not only in the UI.

---

## 🔐 Authentication Flow (Login)

The project implements a clean login flow using Laravel’s native Auth stack:

- Login screen (Blade)
- Validation of credentials
- Session-based authentication
- Logout
- Protected routes guarded by middleware
- Authorization enforced by Policies

### Typical flow
1. User accesses `/login`
2. Submits credentials
3. Laravel authenticates + regenerates session
4. Redirect to dashboard based on role (Admin/Manager/Employee)
5. Protected resources are controlled by Policies

---

## 🛡️ Authorization (Policies)

The project uses **Laravel Policies** to control actions in a reliable and scalable way.

### Example rules implemented / intended
- **User creation**
  - Admin can create users in any department
  - Manager can create users only in **their own department**
  - Employee cannot create users

This ensures:
- Security at code level (not only front-end)
- Clear separation of responsibilities
- Easy maintenance as the system grows

---

## 🚀 Main Features (Current + Core Foundation)

### ✅ Foundation
- Laravel project structured with MVC
- Migrations, seeders, factories
- Ready to scale with new modules

### ✅ Authentication
- Login
- Logout
- Protected routes

### ✅ User Management
- Users with role classification (Admin / Manager / Employee)
- Department linking for each user
- Controlled creation rules (Policies)

### ✅ HR Core Structure
- Departments module (base)
- Seeders to populate initial system data
- Factories for development/testing

> As the project evolves, new HR modules will be added and documented here (vacations, payroll, requests, attendance, etc.).

---

## 🧱 Project Structure

- `app/Models` → Models (User, Department, etc.)
- `app/Policies` → Authorization rules (Policies)
- `app/Http/Controllers` → Controllers (including invokable controllers where useful)
- `database/migrations` → Schema
- `database/seeders` → Initial data (admin, managers, employees, departments)
- `database/factories` → Test data
- `resources/views` → Blade UI (auth + admin layouts)
- `routes/web.php` → Web routes
- `routes/auth.php` → Auth routes (if used in your setup)

---

## 🛠️ Tech Stack

- **PHP 8+**
- **Laravel**
- **Blade**
- **HTML5 / CSS3**
- **Eloquent ORM**
- **Migrations, Seeders, Factories**
- **Policies (Authorization)**
- **PostgreSQL or MySQL** (depends on your environment)
- Optional local mail testing (MailHog)

---

## ⚙️ Installation & Setup

### Requirements
- PHP 8+
- Composer
- Database (PostgreSQL or MySQL)
- Node.js (optional, for front assets)

### Step by step

```bash
# Clone
git clone https://github.com/your-username/laravel-rh-mgnt.git
cd laravel-rh-mgnt

# Install dependencies
composer install

# Env
cp .env.example .env
php artisan key:generate

# If the app runs in Docker, the browser accesses the project through:
# APP_URL=http://localhost:8080
# BACKEND_URL=http://localhost:8080
#
# Inside the `app` container the backend is overridden to `http://nginx`
# by docker-compose, so the frontend controllers/components can consume
# the backend routes without pointing to localhost from inside the container.

# Configure database in .env
# If you run `php artisan` on your machine, use:
# DB_CONNECTION=pgsql
# DB_HOST=127.0.0.1
# DB_PORT=5432
# DB_DATABASE=laravel_rh_mgnt
# DB_USERNAME=laravel
# DB_PASSWORD=laravel
#
# If you run Artisan inside the `app` container, `DB_HOST=db` also works.

# Migrate + seed
php artisan migrate --seed

# Run
php artisan serve
