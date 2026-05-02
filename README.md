## Database Configuration

The project is currently configured with a live server database connection.

You can either:

### Option 1: Use Existing Server Database (Recommended)
No additional setup required. The project is already connected to the server database. Just update the `.env` file if needed.

### Option 2: Use Local Database
If you want to run the project locally:
1. Create a new MySQL database on your local system
2. Update `.env` file with your local database credentials
3. Run migrations to create tables:

   php artisan migrate

(Optional) Seed initial data:
   php aritsan db:seed --class=SuperAdminSeeder

---

Note:
- All database structure is managed via Laravel migrations.
- No manual SQL import is required.


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
npm install
npm run build
php artisan serve



## Project Setup

1. Clone the repository
   git clone <repo-url>

2. Install PHP dependencies
   composer install

3. Install Node dependencies
   npm install

4. Setup environment file
   cp .env.example .env

5. Generate application key
   php artisan key:generate

6. Run migrations
   php artisan migrate

7. (Optional) Seed database
   php aritsan db:seed --class=SuperAdminSeeder

8. Start development server
   php artisan serve

9. Run frontend build
   npm run dev