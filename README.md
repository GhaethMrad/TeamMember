# 👥 TeamMember

**TeamMember** is a web-based application built with the **Laravel framework** that provides a simple and organized way to manage team members.  
The project is designed to be clean, scalable, and easy to extend, making it suitable for learning purposes or as a base for larger systems.

---

## 🚀 Project Overview

The **TeamMember** project helps you:
- Manage team members efficiently
- Perform CRUD operations (Create, Read, Update, Delete)
- Practice Laravel best practices and project structure
- Extend the system with roles, permissions, or authentication

This project can be used as a learning resource, a portfolio project, or a foundation for real-world applications.

---

## ✨ Features

- Add, edit, delete, and view team members
- Organized Laravel MVC architecture
- Database-driven system
- Easy to customize and extend
- Clean and maintainable codebase

---

## 🛠️ Technologies Used

- **Laravel (PHP Framework)**
- **PHP >= 8.1**
- **MySQL / SQLite / PostgreSQL**
- **Composer** for dependency management
- **Blade Templates** (if views are used)
- **Vite / Laravel Mix** (if frontend assets are included)

---

## 📋 Requirements

Before running the project, make sure you have the following installed:

- PHP **8.1 or higher**
- Composer
- A database system (MySQL recommended)
- Node.js & npm (optional, if frontend assets are used)

---

## ▶️ How to Run the Project

Follow the steps below to run the **TeamMember** project locally:

### Step 1: Clone the Repository
```bash
git clone https://github.com/GhaethMrad/TeamMember.git
cd TeamMember
```
### Step 2: Install PHP Dependencies:
```bash
composer install
```
### Step 3: Create Environment File:
```bash
cp .env.example .env
```
### Step 4: Configure the Environment:
```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_username
DB_PASSWORD=your_database_password
```
### Step 5: Generate Application Key
```bash
php artisan key:generate
```
### Step 6: Run Database Migrations
```bash
php artisan migrate
```
### Step 7: Run Database Seeder (Optional)
```bash
php artisan db:seed
```
### Step 8: Start the Development Server And Vite
```bash
composer run dev
```
### Step 9: Access the Application
```bash
http://127.0.0.1:8000

