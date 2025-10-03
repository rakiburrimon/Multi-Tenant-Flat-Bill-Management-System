# Multi-Tenant Flat Bill Management System

A comprehensive Laravel-based system for managing flat bills across multiple tenants and property owners. This system provides role-based access control with separate interfaces for administrators, property owners, and tenants.

## 🌐 Live Demo

- Demo: [multi-tenant-rimon.infinityfreeapp.com](https://multi-tenant-rimon.infinityfreeapp.com/)

Use the credentials below to explore the demo:

- Admin
  - Email: `admin@example.com`
  - Password: `password`
- Owner
  - Email: `alice.owner@example.com`
  - Password: `password`
- Owner
  - Email: `bob.owner@example.com`
  - Password: `password`

## 🚀 Features

- **Multi-tenant Architecture**: Support for multiple property owners and their tenants
- **Role-based Access Control**: Admin, Owner, and Tenant roles with different permissions
- **Bill Management**: Create, track, and manage bills for different categories
- **Flat Management**: Organize properties into buildings and flats
- **Tenant Management**: Register and manage tenant information
- **Password Reset**: Secure password reset functionality with custom email templates
- **Responsive Design**: Modern, mobile-friendly interface with Bootstrap 5
- **Email Notifications**: Custom email templates for password reset

## 📋 Requirements

- PHP 8.2 or higher
- Composer
- SQLite (default) or MySQL/PostgreSQL
- Node.js and NPM (for frontend assets)

## 🛠️ Installation & Setup

### 1. Clone the Repository

```bash
git clone <repository-url>
cd Multi-Tenant-Flat-Bill-Management-System
```

### 2. Install Dependencies

```bash
composer install
npm install
```

### 3. Environment Configuration

Copy the example environment file and configure your settings:

```bash
cp .env.example .env
```

Edit the `.env` file with your configuration:

```env
APP_NAME="Multi-Tenant Flat Bill Management"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

# Database Configuration (SQLite - Default)
DB_CONNECTION=sqlite
DB_DATABASE=database/database.sqlite

# Mail Configuration (for password reset)
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-app-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your-email@gmail.com
MAIL_FROM_NAME="${APP_NAME}"
```

### 4. Generate Application Key

```bash
php artisan key:generate
```

### 5. Database Setup

Create the SQLite database file:

```bash
touch database/database.sqlite
```

Run migrations to create database tables:

```bash
php artisan migrate
```

### 6. Seed Sample Data

Populate the database with sample data:

```bash
php artisan db:seed
```

### 7. Build Frontend Assets

```bash
npm run build
```

### 8. Start the Development Server

```bash
php artisan serve
```

The application will be available at `http://localhost:8000`

## 👥 Default User Credentials

After running the database seeder, you can use these credentials to log in:

### Admin User
- **Email**: `admin@example.com`
- **Password**: `password`
- **Role**: Admin (full system access)

### Property Owners
- **Email**: `alice.owner@example.com`
- **Password**: `password`
- **Role**: Owner

- **Email**: `bob.owner@example.com`
- **Password**: `password`
- **Role**: Owner

## 🗄️ Database Structure

### Core Tables

#### Users Table
- `id` - Primary key
- `name` - User's full name
- `email` - Unique email address
- `password` - Hashed password
- `role` - User role (admin, owner)
- `email_verified_at` - Email verification timestamp
- `remember_token` - Remember me token
- `created_at`, `updated_at` - Timestamps

#### Buildings Table
- `id` - Primary key
- `house_owner_id` - Foreign key to users (property owner)
- `name` - Building name
- `address` - Building address
- `city` - City
- `postcode` - Postal code
- `created_at`, `updated_at` - Timestamps

#### Flats Table
- `id` - Primary key
- `building_id` - Foreign key to buildings
- `house_owner_id` - Foreign key to users (property owner)
- `number` - Flat number/identifier
- `floor` - Floor number
- `description` - Flat description
- `created_at`, `updated_at` - Timestamps

#### Tenants Table
- `id` - Primary key
- `house_owner_id` - Foreign key to users (property owner)
- `flat_id` - Foreign key to flats
- `name` - Tenant name
- `email` - Tenant email
- `phone` - Tenant phone number
- `lease_start` - Lease start date
- `lease_end` - Lease end date
- `created_at`, `updated_at` - Timestamps

#### Bill Categories Table
- `id` - Primary key
- `name` - Category name (unique)
- `description` - Category description
- `created_at`, `updated_at` - Timestamps

#### Bills Table
- `id` - Primary key
- `house_owner_id` - Foreign key to users (property owner)
- `flat_id` - Foreign key to flats
- `tenant_id` - Foreign key to tenants (nullable)
- `category_id` - Foreign key to bill categories
- `amount` - Bill amount (decimal)
- `due_date` - Due date
- `status` - Bill status (unpaid, paid, overdue)
- `paid_at` - Payment timestamp
- `remarks` - Additional remarks
- `created_at`, `updated_at` - Timestamps

### Relationships

- **Users** → **Buildings** (One-to-Many)
- **Buildings** → **Flats** (One-to-Many)
- **Users** → **Flats** (One-to-Many, through buildings)
- **Flats** → **Tenants** (One-to-Many)
- **Users** → **Tenants** (One-to-Many, through flats)
- **Bill Categories** → **Bills** (One-to-Many)
- **Flats** → **Bills** (One-to-Many)
- **Tenants** → **Bills** (One-to-Many)

## 🎯 User Roles & Permissions

### Admin Role
- Full system access
- Manage all property owners
- Manage all tenants
- View all buildings, flats, and bills
- System administration functions

### Owner Role
- Manage their own buildings and flats
- Manage tenants in their properties
- Create and manage bills for their properties
- View their own data only

### Tenant Role (Future Enhancement)
- View their own bills
- Update personal information
- Payment tracking

## 🔧 Configuration

### Mail Configuration

For password reset functionality, configure your mail settings in `.env`:

#### Gmail Configuration
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-app-password
MAIL_ENCRYPTION=tls
```

**Note**: For Gmail, you need to:
1. Enable 2-factor authentication
2. Generate an "App Password"
3. Use the app password (not your regular password)

#### Alternative Mail Services
- **Mailtrap** (for testing)
- **SendGrid**
- **Mailgun**
- **Amazon SES**

### Database Configuration

#### SQLite (Default)
```env
DB_CONNECTION=sqlite
DB_DATABASE=database/database.sqlite
```

#### MySQL
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=flat_bill_management
DB_USERNAME=root
DB_PASSWORD=
```

#### PostgreSQL
```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=flat_bill_management
DB_USERNAME=postgres
DB_PASSWORD=
```

## 🚀 Usage Guide

### 1. Admin Access
- Login with admin credentials
- Navigate to "Owners" to manage property owners
- Navigate to "Tenants" to manage all tenants
- View system-wide statistics and reports

### 2. Owner Registration
- Visit `/register/tenant` (despite the URL, this registers owners)
- Fill in the registration form
- Login with new credentials

### 3. Owner Dashboard
- Login as an owner
- Navigate to "Flats" to manage your properties
- Navigate to "Bills" to create and manage bills
- Navigate to "Categories" to manage bill categories

### 4. Password Reset
- Visit `/forgot-password`
- Enter your email address
- Check your email for the reset link
- Follow the link to reset your password

## 📁 Project Structure

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── Admin/          # Admin-specific controllers
│   │   ├── Owner/          # Owner-specific controllers
│   │   ├── AuthController.php
│   │   └── TenantRegistrationController.php
│   └── Middleware/
│       └── CheckRole.php   # Role-based access control
├── Models/                 # Eloquent models
├── Notifications/          # Email notifications
└── Providers/

database/
├── migrations/             # Database schema migrations
├── seeders/               # Sample data seeders
└── factories/             # Model factories

resources/
├── views/
│   ├── admin/             # Admin interface views
│   ├── auth/              # Authentication views
│   ├── owner/             # Owner interface views
│   └── layouts/           # Layout templates
└── css/                   # Stylesheets

routes/
├── web.php                # Main web routes
├── web_admin.php          # Admin routes
└── web_owner.php          # Owner routes
```

## 🔒 Security Features

- **Password Hashing**: Bcrypt encryption for all passwords
- **CSRF Protection**: Laravel's built-in CSRF protection
- **Role-based Access**: Middleware-based role checking
- **Input Validation**: Server-side validation for all forms
- **SQL Injection Protection**: Eloquent ORM prevents SQL injection
- **XSS Protection**: Blade templating engine escapes output

## 🧪 Testing

Run the test suite:

```bash
php artisan test
```

## 📝 API Documentation

The system currently uses traditional web routes. Future versions may include API endpoints for mobile applications.

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Add tests if applicable
5. Submit a pull request

## 📄 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## 🆘 Support

For support and questions:
- Check the Laravel documentation: https://laravel.com/docs
- Review the code comments and inline documentation
- Create an issue in the repository

## 🔄 Version History

- **v1.0.0** - Initial release with basic functionality
  - Multi-tenant architecture
  - Role-based access control
  - Bill management system
  - Password reset functionality
  - Responsive design

---

**Built with ❤️ using Laravel Framework**
