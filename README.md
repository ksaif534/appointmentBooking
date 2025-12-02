# Appointment Booking System

A comprehensive appointment booking system built with Laravel 12, featuring role-based access control, real-time availability management, and a professional public-facing interface.

## 🌟 Features

### Public Features

-   **Professional Landing Page**: Eye-catching hero section with service highlights
-   **Service Catalog**: Browse available services with detailed descriptions and pricing
-   **Online Booking**: Intuitive booking flow with staff and time slot selection
-   **Mobile Responsive**: Fully responsive design optimized for all devices

### Admin & Staff Features

-   **Role-Based Access Control**: Three user roles (Admin, Staff, Customer)
-   **Service Management**: Create, update, and manage services
-   **Staff Management**: Manage staff details and service assignments
-   **Availability Management**: Set and manage staff availability schedules
-   **Appointment Management**: View and manage all appointments
-   **Booking Notifications**: Email notifications for booking confirmations

### Technical Features

-   **Authentication**: Secure user authentication with Laravel Breeze
-   **Authorization**: Policy-based authorization for resources
-   **Database Queue**: Background job processing for notifications
-   **SQLite Database**: Lightweight database for easy setup
-   **Tailwind CSS**: Modern, utility-first CSS framework
-   **Alpine.js**: Lightweight JavaScript framework for interactivity

## 📋 Requirements

-   PHP 8.2 or higher
-   Composer
-   SQLite (or MySQL/PostgreSQL)
-   Node.js & NPM (optional, for local development)

## 🚀 Installation

### Quick Setup

```bash
# Clone the repository
git clone https://github.com/ksaif534/appointmentBooking.git
cd appointmentBooking

# Install dependencies and setup
composer run setup

# Start the development server
php artisan serve
```

### Manual Setup

```bash
# Clone the repository
git clone https://github.com/ksaif534/appointmentBooking.git
cd appointmentBooking

# Install PHP dependencies
composer install

# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate

# Create SQLite database
touch database/database.sqlite

# Run migrations
php artisan migrate

# (Optional) Seed the database
php artisan db:seed

# Start the development server
php artisan serve
```

The application will be available at `http://localhost:8000`

## 🔧 Configuration

### Environment Variables

Update your `.env` file with the following configurations:

```env
APP_NAME="Appointment Booking"
APP_URL=http://localhost:8000

# Database (SQLite by default)
DB_CONNECTION=sqlite

# Mail Configuration (for notifications)
MAIL_MAILER=smtp
MAIL_HOST=your-smtp-host
MAIL_PORT=587
MAIL_USERNAME=your-email
MAIL_PASSWORD=your-password
MAIL_FROM_ADDRESS=noreply@example.com
MAIL_FROM_NAME="${APP_NAME}"

# Queue (for background jobs)
QUEUE_CONNECTION=database
```

### Queue Worker

To process booking notifications and other background jobs:

```bash
php artisan queue:work
```

## 📊 Database Schema

### Core Tables

-   **users**: User accounts with role-based access (admin, staff, customer)
-   **services**: Available services with pricing and duration
-   **staff_details**: Extended staff information
-   **staff_services**: Staff-to-service assignments
-   **staff_availabilities**: Staff availability schedules
-   **appointments**: Booking records
-   **notifications**: System notifications
-   **calendar_syncs**: Calendar integration data

## 🎯 Usage

### User Roles

1. **Admin**

    - Full access to all features
    - Manage services, staff, and appointments
    - View all system data

2. **Staff**

    - Manage personal availability
    - View assigned appointments
    - Update service assignments

3. **Customer**
    - Browse services
    - Book appointments
    - View personal bookings

### Booking Flow

1. **Browse Services**: Visit `/our-services` to view available services
2. **Select Service**: Click "Book Now" on desired service
3. **Choose Staff**: Select from available staff members
4. **Pick Date & Time**: Choose from available time slots
5. **Confirm Booking**: Review and confirm appointment details
6. **Receive Confirmation**: Get email notification with booking details

## 🛠️ Development

### Running Tests

```bash
# Run all tests
composer test

# Run specific test suite
php artisan test --filter=BookingTest
```

### Code Quality

```bash
# Run Laravel Pint (code formatter)
./vendor/bin/pint

# Run static analysis
./vendor/bin/phpstan analyse
```

### Development Server with Hot Reload

```bash
# Run all services (server, queue, logs, vite)
composer run dev
```

## 📁 Project Structure

```
appointment-booking/
├── app/
│   ├── Http/
│   │   ├── Controllers/      # Application controllers
│   │   └── Middleware/       # Custom middleware
│   ├── Models/               # Eloquent models
│   ├── Notifications/        # Email notifications
│   └── Policies/             # Authorization policies
├── database/
│   ├── migrations/           # Database migrations
│   └── seeders/              # Database seeders
├── resources/
│   └── views/
│       ├── components/       # Blade components
│       ├── layouts/          # Layout templates
│       ├── home.blade.php    # Landing page
│       ├── about.blade.php   # About page
│       └── services.blade.php # Services page
├── routes/
│   └── web.php               # Web routes
└── tests/                    # Test files
```

## 🔐 Security

-   All routes are protected with appropriate middleware
-   Policy-based authorization for resource access
-   CSRF protection on all forms
-   SQL injection prevention via Eloquent ORM
-   XSS protection via Blade templating

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## 📝 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## 👥 Authors

-   **Saif Kamal** - [GitHub](https://github.com/ksaif534)

## 🙏 Acknowledgments

-   Built with [Laravel](https://laravel.com/)
-   UI components from [Tailwind CSS](https://tailwindcss.com/)
-   Authentication scaffolding by [Laravel Breeze](https://laravel.com/docs/breeze)
-   Icons from [Heroicons](https://heroicons.com/)

## 📞 Support

For support, email support@example.com or open an issue in the GitHub repository.

---

**Made with ❤️ using Laravel**
