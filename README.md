Task Management REST API

This is a Laravel REST API assignment for managing daily tasks. It includes features like validation, soft deletes, and partial updates.

Features

Create, Read, Update, Delete (CRUD) for tasks.

Validation: Prevents creating tasks with past dates.

Soft Delete: Tasks are moved to a "trash" can instead of being permanently deleted.

Restore: Ability to restore deleted tasks.

Partial Update: Special endpoint to update just the "reminder" status.

Setup Instructions

Clone the repository

git clone [https://github.com/iammarafzal/Task-Rest-API.git](https://github.com/iammarafzal/Task-Rest-API.git)
cd Task-Rest-API


Install Dependencies

composer install


Setup Environment

cp .env.example .env
php artisan key:generate


Note: Open .env and set your database name.

Run Migrations

php artisan migrate


Start Server

php artisan serve


The API will run at: http://localhost:8000

API Endpoints

1. General Tasks

Method

URL

Description

GET

/api/tasks

Get all tasks

POST

/api/tasks

Create a new task

GET

/api/tasks/{id}

View single task

PUT

/api/tasks/{id}

Update task details

DELETE

/api/tasks/{id}

Soft delete a task

2. Deleted Tasks & Restore

Method

URL

Description

GET

/api/tasks/deleted

View trash (deleted tasks)

POST

/api/tasks/{id}/restore

Restore a deleted task

3. Extra

Method

URL

Description

PATCH

/api/tasks/{id}/reminder

Update only the reminder

JSON Examples for Testing

1. Create a Task (POST)
URL: http://localhost:8000/api/tasks

{
  "text": "Submit Assignment",
  "day": "2025-12-30",
  "reminder": true
}


2. Update Reminder Only (PATCH)
URL: http://localhost:8000/api/tasks/1/reminder

{
  "reminder": false
}


3. Validation Error (Past Date)
If you try to use a past date, you will get this error:

{
  "message": "The day must be a date after or equal to today."
}


Testing Tool

Use Thunder Client or Postman.

Header Required: Accept: application/json
