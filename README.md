# Notes App

Notes App is a web application for writing notes and scheduling them to be delivered to someone by email. Users can manage their notes, see scheduled dates on a calendar, and share published notes through a link. The application also includes account security and team features.

## Features

- Create, edit, and delete notes with a title, message, recipient email, and scheduled send date.
- Automatically email the recipient when a published note reaches its scheduled time.
- Open a published note using the link sent by email.
- View scheduled note dates in a calendar and see note status on the dashboard.
- Register and sign in, verify email addresses, manage profiles, and enable two-factor authentication.
- Create teams, invite members, and manage team roles.
- Manage personal API tokens through Laravel Jetstream and Sanctum.

## Technology

### Backend

- PHP 8.2+
- Laravel 12
- Livewire 3 and Livewire Volt for interactive pages
- Laravel Jetstream for account, team, and API-token features
- Laravel Fortify for authentication features
- Laravel Sanctum for API tokens
- Laravel Tinker for interactive application debugging
- MySQL by default (configure another Laravel-supported database if desired)
- Laravel queues and scheduler for sending notes at their scheduled time

### Frontend

- JavaScript (ES modules)
- Vite 7, Laravel Vite plugin, and Tailwind Vite plugin
- Tailwind CSS 3, with Tailwind Forms and Typography plugins
- Alpine.js and Preline
- FullCalendar 6 (calendar grid and interactions packages are installed)
- SweetAlert2 for alert dialogs
- Axios, PostCSS, and Autoprefixer

### Other packages

- `doctrine/dbal` for database schema operations
- `jantinnerezo/livewire-alert` for Livewire notifications
- `symfony/postmark-mailer` for Postmark email transport
- `fakerphp/faker` for generated test data
- Pest and `pestphp/pest-plugin-laravel` for tests
- Mockery for test doubles
- Laravel Sail, Pail, Pint, Boost, and Collision for development and debugging
- Concurrently to run the local app, queue worker, and Vite together

## Requirements

- PHP 8.2 or newer with the extensions required by Laravel
- Composer
- Node.js and npm
- MySQL or another database supported by Laravel
- A configured email transport for real email delivery

## Installation

1. Clone this repository and enter its directory.
2. Install PHP dependencies and create the environment file:

   ```bash
   composer install
   cp .env.example .env
   php artisan key:generate
   ```

   On Windows PowerShell, use `Copy-Item .env.example .env` in place of `cp`.

3. Set the database connection and credentials in `.env`. The example configuration uses MySQL and the database name `notesapp`. Create that database before migrating.
4. Run database migrations and install/build the frontend:

   ```bash
   php artisan migrate
   npm install
   npm run build
   ```

5. Configure the `MAIL_*` values in `.env`. The example uses `MAIL_MAILER=log`, which writes email content to the application log instead of delivering it. For production, configure a working mail service and queue connection.

## Running locally

Start the application, queue worker, and frontend development server:

```bash
composer run dev
```

In a second terminal, run Laravel's scheduler so due notes are queued each minute:

```bash
php artisan schedule:work
```

The app is served at `http://localhost:8000` by default. For scheduled emails to be delivered, keep both the scheduler and a queue worker running. `composer run dev` starts a queue listener for local development.

## Docker

The repository includes a `dockerfile` for building an Apache-based image. Build and run it with your chosen Docker setup, and provide the application's environment variables and database/mail services. The image runs migrations on startup and runs the scheduler alongside Apache.

## Tests

Run the automated test suite with:

```bash
php artisan test
```

## License

This repository currently uses the MIT license declared in `composer.json`.
