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
used Laravel Breeze for authentication scaffolding.
I implemented Laravel's authentication for login/logout and used role-based authorization for access control.

## sql
I connected the application to a remote MySQL database using environment configuration and ensured secure access via proper credentials and IP whitelisting

## AI
Used ChatGPT to understand Laravel Breeze authentication flow (login, logout, session handling).

## User Interface
have focused more on the core functionality like login system, short URL generation, and role management (super admin, admin, and members), rather than UI, so I have used Laravel’s default login and dashboard templates.


## Setup Instructions

```bash
git clone <repo-url>
cd project
composer install
cp .env.example .env
env = i'll share the env file on email just copy and paste here
php artisan key:generate
php artisan migrate
npm install
npm run build
php artisan serve