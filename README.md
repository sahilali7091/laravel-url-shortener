# Laravel URL Shortener

## Features
- Role based system (Superadmin / Admin / Member)
- Company-based access
- Short URL generation
- Redirect system
- Allow users to log in and log out

## How it works
- Superadmin is created using a database seeder.
- Superadmin can create Admins for a company.
- When an Admin is created, they receive an email with login credentials.
- Admins can create both Admins and Members within their own company.
- Users can log in and log out of the system.
- Admins and Members can create short URLs for their company.
- All short URLs correctly redirect to the original URL.
- Duplicate short URLs are not allowed within the same company.

## Authentication
Used Laravel Breeze for authentication scaffolding.
Implemented Laravel's authentication for login/logout and role-based authorization.

## Database
Connected to remote MySQL database using environment configuration and secure credentials.

## AI Usage
Used ChatGPT to understand Laravel Breeze authentication flow.

## UI Note
Focused on backend functionality (login, roles, URL generation). Used Laravel default UI templates.

## Setup Instructions
```bash
git clone <repo-url>
cd project
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
npm install
npm run build
php artisan serve