# 🎓 Student Management API

This project is a RESTful API built with Laravel for managing students. It allows you to register students, list them, and retrieve them by their registration number. A welcome email is also sent upon registration.

## 📦 Requirements

- PHP >= 8.1
- Composer
- Laravel >= 10
- MySQL or PostgreSQL
- Mailtrap or any configured SMTP service
- Node.js and npm (only needed if compiling frontend assets)

---

## 🚀 Installation

```bash
# 1. Clone the repository
git clone https://github.com/MiguelAngelMP10/student-management.git

# 2. Navigate to the project directory
cd student-management

# 3. Install PHP dependencies
composer install

# 4. Copy the environment file and configure it
cp .env.example .env

# 5. Generate application key
php artisan key:generate

# 6. Set up your database credentials in the .env file

# 7. Run database migrations
php artisan migrate

# 8. (Optional) Seed the database
php artisan db:seed
```

## 🧪 Running Tests
```bash
  php artisan test
```
This runs the feature and unit tests included in the project.


## 📬 Email Configuration
To send welcome emails, configure your .env file with valid SMTP settings, e.g. for Mailtrap:

```env
MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_username
MAIL_PASSWORD=your_password
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=admissions@unisant.edu
MAIL_FROM_NAME="UNISANT"
```
