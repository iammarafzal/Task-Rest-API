# Task Management REST API

This is a Laravel REST API assignment for managing daily tasks. It includes features like validation, soft deletes, and partial updates.

## Features

- **Create, Read, Update, Delete (CRUD)** for tasks.
- **Validation**: Prevents creating tasks with past dates.
- **Soft Delete**: Tasks are moved to a "trash" can instead of being permanently deleted.
- **Restore**: Ability to restore deleted tasks.
- **Partial Update**: Special endpoint to update just the "reminder" status.

---

## Setup Instructions

1. **Clone the repository**
   ```bash
   git clone [https://github.com/iammarafzal/Task-Rest-API.git](https://github.com/iammarafzal/Task-Rest-API.git)
   cd Task-Rest-API
2. **Install Dependencies**
      ```bash
      composer install
3. **Setup Environment**
      ```bash
      cp .env.example .env
    php artisan key:generate
4. **Run Migrations**
      ```bash
      php artisan migrate
5. **Start Server**
      ```bash
      php artisan migratephp artisan serve
