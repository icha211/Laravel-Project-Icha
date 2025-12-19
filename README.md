<h1 align="center">Employee Management System (Laravel)</h1>

Modern role-based employee management app built with Laravel 12 (PHP 8.2), Blade components, Bootstrap 5, and Chart.js v4. It includes custom authentication with department and role selection, an employer analytics dashboard, and a unified layout across pages.

## Features

- Authentication: Email/password login and registration with department and role (Employer/Employee)
- Role-based UI: Redirects to Employer or Employee dashboard after login
- Employer Dashboard: Stats tiles, Attendance Overview, Payroll chart, Department distribution, Heatmap, Announcements
- Unified Layout: Shared sidebar, branding, and modern styling via a Blade component
- Database Migrations: `users` table extended with `department`, `role`, `phone`, `position`

## Tech Stack

- Framework: Laravel 12, PHP 8.2
- Frontend: Blade, Bootstrap 5, Font Awesome
- Charts: Chart.js v4 (responsive, fixed-height containers)
- Database: SQLite (local dev) or your preferred DB

## Getting Started

1) Install dependencies
- `composer install`
- `npm install`

2) Environment setup
- Copy `.env.example` to `.env`
- Set `APP_KEY` if not generated: `php artisan key:generate`
- Use SQLite for local dev:
	- Create the file `database/database.sqlite`
	- In `.env`: set `DB_CONNECTION=sqlite` and clear other DB_* values

3) Run migrations
- `php artisan migrate`

4) Start the app
- In one terminal: `npm run dev`
- In another: `php artisan serve`
- Visit http://127.0.0.1:8000

Tip: You can also run the convenience dev script: `composer run dev`

## Usage Notes

- Registration page includes Department (e.g., IT Division, Finance Division) and Role (Employer/Employee)
- After registration, a success message is shown; then log in
- Employers land on the analytics dashboard; Employees land on their role-appropriate views

## Project Structure

- App code: `app/` (controllers, models, providers)
- Views: `resources/views/` (Blade templates)
	- Layout: `resources/views/components/app-layout.blade.php`
	- Employer dashboard: `resources/views/dashboard/employer.blade.php`
	- Auth views: `resources/views/auth/login.blade.php`
- Assets: `resources/js`, `resources/css` (handled by Vite)
- Routes: `routes/web.php`
- Migrations/Seeds: `database/migrations`, `database/seeders`

## Common Commands

- Fresh database: `php artisan migrate:fresh`
- Run tests: `php artisan test`
- Production build: `npm run build`

## License

This project is provided under the MIT License. See `LICENSE` if present.
