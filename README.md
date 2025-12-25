# PGIFM - Postgraduate Family Institute of Medicine Exam Prep

A comprehensive Laravel-based web application for medical education and exam preparation, developed for Dr. Sahar Aslam.

## About

PGIFM (Postgraduate Family Institute of Medicine) is an online medical education platform that provides:
- **MCPS Family Medicine** exam preparation courses
- **MRCGP INT South Asia** certification courses
- **MCPS Family Medicine TOACS** preparation
- **MRCGP [INT] South Asia OSCE** training
- Short courses and workshops
- Mentorship programs
- Library resources
- Student enrollment and course management

## Features

- **Public Website**: Course information, testimonials, news updates, and contact forms
- **Student Portal**: Course enrollment, class materials, library access, and profile management
- **Doctor/Admin Portal**: Course management, class scheduling, news management, slider images, gallery, and enrollment management
- **News Ticker**: Real-time news updates displayed in a scrolling ticker
- **Library System**: Access to educational materials and resources
- **Enrollment System**: Students can enroll in courses and access class materials
- **Chatbot Integration**: AI-powered assistant for student support

## Technology Stack

- **Framework**: Laravel 12.x
- **PHP**: 8.2+
- **Frontend**: Bootstrap 5, Vite, SCSS
- **Database**: SQLite (default) / MySQL / PostgreSQL
- **Authentication**: Laravel UI

## Requirements

- PHP >= 8.2
- Composer
- Node.js & NPM
- SQLite (or MySQL/PostgreSQL)

## Installation & Setup

### Quick Setup

Run the automated setup script:

```bash
composer run setup
```

This will:
1. Install PHP dependencies
2. Create `.env` file if it doesn't exist
3. Generate application key
4. Run database migrations
5. Install NPM dependencies
6. Build frontend assets

### Manual Setup

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd PGFM_Project-main
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Configure environment**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Configure database**
   - Update `.env` with your database credentials
   - Or use SQLite (default): `touch database/database.sqlite`

5. **Run migrations**
   ```bash
   php artisan migrate
   ```

6. **Install frontend dependencies**
   ```bash
   npm install
   ```

7. **Build assets**
   ```bash
   npm run build
   ```

## Development

### Start Development Server

Run both Laravel and Vite in development mode:

```bash
composer run dev
```

This will start:
- Laravel development server on `http://127.0.0.1:8000`
- Vite dev server for hot module replacement

### Run Tests

```bash
composer run test
```

## Project Structure

```
├── app/
│   ├── Http/Controllers/     # Application controllers
│   ├── Models/               # Eloquent models
│   └── Providers/            # Service providers
├── database/
│   ├── migrations/           # Database migrations
│   └── seeders/              # Database seeders
├── resources/
│   ├── views/                # Blade templates
│   ├── js/                   # JavaScript files
│   └── sass/                 # SCSS stylesheets
├── routes/
│   └── web.php               # Web routes
└── public/                   # Public assets
```

## User Types

- **Students (type = 1)**: Can enroll in courses, access class materials, and use library
- **Doctors/Admins (type = 2)**: Can manage courses, classes, news, and enrollments

## Key Features

### News Management
- News ticker on public pages
- Separate news types (Classes, References)
- Published/unpublished status

### Course Management
- Multiple course types
- Course enrollment system
- Class scheduling and materials
- Course descriptions and details

### Library System
- Educational materials
- File uploads and management
- Access control for authenticated users

## Contact

- **Email**: saharaslam@gmail.com
- **WhatsApp**: 0333-3451936
- **Instagram**: [@its.saharaslam](https://instagram.com/its.saharaslam)

## License

This project is proprietary software. All rights reserved.

## Credits

Developed for **Dr. Sahar Aslam** - Consultant Family Medicine Specialist
MCPS F.M (CPSP), MRCGP [INT] RCGP-UK
Online Medical Educator & Exam Mentor
