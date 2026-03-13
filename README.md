# Laravel Blog App

This project is a simple blog application built with Laravel 12, Breeze authentication, Tailwind CSS 4, and Flowbite.

It includes:

- a landing page with featured posts and category highlights
- a public blog index with search, category filtering, and author filtering
- single post pages
- authentication with login via email or username
- a protected dashboard for managing posts
- profile management with avatar upload

## Tech Stack

- PHP 8.2+
- Laravel 12
- SQLite for local development
- Pest for testing
- Vite + Tailwind CSS 4 + Flowbite for frontend assets

## Main Features

- Public pages:
  - `/`
  - `/posts`
  - `/posts/{slug}`
  - `/about`
  - `/contact`
- Auth flow:
  - register
  - login with `user_cred` and `password`
  - email verification
  - password reset
- Dashboard:
  - create, edit, view, and delete your own posts
- Profile:
  - update name, username, email
  - upload avatar

## Local Setup

1. Install PHP and Composer dependencies:

```bash
composer install
```

2. Install frontend dependencies:

```bash
npm install
```

3. Prepare the app key:

```bash
php artisan key:generate
```

4. Prepare the database and seed demo data:

```bash
php artisan migrate:fresh --seed
```

5. Create the storage symlink for uploaded avatars:

```bash
php artisan storage:link
```

## Run the App

For a full local dev session:

```bash
composer run dev
```

That command starts:

- the Laravel development server
- the queue listener
- the Vite dev server

If you only want the backend quickly:

```bash
php artisan serve
```

## Demo Account

The seeders create a demo user:

- Username: `sandhikagalih`
- Email: `sandhikagalih@gmail.com`
- Password: `password123`

You can log in using either the username or the email in the login form.

## Testing

Run the full test suite with:

```bash
php artisan test
```

The test configuration uses SQLite in memory, so tests do not depend on your local database file.

## Database Notes

For local development this project uses SQLite.

- App database: `database/local.sqlite`
- Test database: in-memory SQLite via `phpunit.xml`

If you want a clean local reset:

```bash
php artisan migrate:fresh --seed
```

## Seeded Content

The seeders create:

- blog categories
- demo users
- sample English blog posts

Seeder entry point:

```bash
php artisan db:seed
```

## Useful Commands

```bash
php artisan serve
php artisan migrate:fresh --seed
php artisan storage:link
php artisan test
npm run dev
npm run build
```

## Project Status

The project is currently in a working state for local development:

- homepage renders properly
- blog pages render properly
- auth flow works
- dashboard CRUD flow works
- tests are passing

## License

This project is open-sourced under the MIT license.
