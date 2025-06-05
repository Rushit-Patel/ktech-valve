# KTech Valve - Manufacturing Website

A comprehensive web platform for KTech Valve, a valve manufacturing company. This Laravel-based website provides a complete digital presence with an intuitive frontend for customers and a powerful backend content management system for administrators.

## 🏭 About KTech Valve

KTech Valve is a manufacturing company specializing in high-quality valves for various industries. This website serves as the primary digital platform to showcase products, services, and company capabilities to potential customers worldwide.

## 🚀 Features

### Frontend (Customer-Facing)
- **Product Catalog**: Comprehensive product listings with categories and detailed specifications
- **Industry Solutions**: Showcasing valve applications across different industries
- **Company Information**: About us, certifications, and quality policy pages
- **Gallery**: Visual showcase of products and manufacturing facilities
- **Blog/News**: Latest company news and industry updates
- **Contact System**: Contact forms and inquiry submission
- **Download Center**: Technical documents, catalogs, and specifications
- **Search Functionality**: Site-wide search for products and content
- **SEO Optimized**: XML sitemap and robots.txt for search engines

### Backend (Content Management)
- **Admin Dashboard**: Complete control panel for website management
- **Product Management**: Add, edit, and organize products and categories
- **Content Management**: Manage pages, blog posts, and company information
- **Gallery Management**: Upload and organize images
- **Download Management**: Manage downloadable files and documents
- **Inquiry Management**: View and respond to customer inquiries
- **User Management**: Admin user accounts and permissions

## 🛠️ Technology Stack

- **Framework**: Laravel 12
- **PHP Version**: 8.2+
- **Frontend**: Blade Templates with Alpine.js
- **Styling**: TailwindCSS 4.x
- **Build Tool**: Vite 6.x
- **Database**: MySQL/SQLite (configurable)
- **Icons**: Font Awesome via Blade Icons
- **Development Tools**: Laravel Sail, Pint, PHPStan

## 📋 Requirements

- PHP 8.2 or higher
- Composer
- Node.js 18+ and npm
- MySQL 8.0+ or SQLite
- Web server (Apache/Nginx)

## 🔧 Installation

### 1. Clone the Repository
```bash
git clone https://github.com/Rushit-Patel/ktech-valve.git
cd ktech-valve
```

### 2. Install PHP Dependencies
```bash
composer install
```

### 3. Install Node.js Dependencies
```bash
npm install
```

### 4. Environment Setup
```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 5. Database Setup
```bash
# Create database (if using SQLite, this is automatic)
php artisan migrate

# Seed database with sample data (optional)
php artisan db:seed
```

### 6. Build Assets
```bash
# For development
npm run dev

# For production
npm run build
```

### 7. Storage Link
```bash
php artisan storage:link
```

## 🚀 Running the Application

### Development Mode
```bash
# Start all services (recommended)
composer run dev

# Or start individually:
# Laravel server
php artisan serve

# Asset compilation
npm run dev

# Queue worker (if using queues)
php artisan queue:work
```

### Production Deployment
```bash
# Optimize for production
composer install --optimize-autoloader --no-dev
php artisan config:cache
php artisan route:cache
php artisan view:cache
npm run build
```

## 📁 Project Structure

```
ktech-valve/
├── app/
│   ├── Http/Controllers/
│   │   ├── Frontend/          # Frontend controllers
│   │   └── Admin/             # Admin panel controllers
│   └── Models/                # Eloquent models
├── resources/
│   ├── views/
│   │   ├── frontend/          # Customer-facing views
│   │   └── admin/             # Admin panel views
│   └── js/                    # JavaScript files
├── routes/
│   ├── web.php               # Frontend routes
│   ├── admin.php             # Admin routes
│   └── auth.php              # Authentication routes
├── database/
│   ├── migrations/           # Database migrations
│   └── seeders/              # Database seeders
└── public/                   # Web accessible files
```

## 🔐 Admin Access

After installation, create an admin user:

```bash
php artisan make:user
```

Access the admin panel at: `https://yoursite.com/admin`

## 🧪 Testing

```bash
# Run all tests
composer run test

# Run specific test suite
php artisan test

# Run with coverage
php artisan test --coverage
```

## 🔧 Development Tools

### Code Quality
```bash
# Format code with Laravel Pint
./vendor/bin/pint

# Analyze code with PHPStan
./vendor/bin/phpstan analyse
```

### Asset Development
```bash
# Watch for file changes
npm run dev

# Build for production
npm run build
```

## 📝 Configuration

### Key Configuration Files
- `.env` - Environment variables
- `config/app.php` - Application settings
- `config/database.php` - Database configuration
- `vite.config.js` - Asset build configuration

### Important Environment Variables
```env
APP_NAME="KTech Valve"
APP_URL=https://your-domain.com
DB_CONNECTION=mysql
DB_DATABASE=ktech_valve
MAIL_MAILER=smtp
```

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch: `git checkout -b feature-name`
3. Make your changes and commit: `git commit -m 'Add feature'`
4. Push to the branch: `git push origin feature-name`
5. Submit a pull request

## 📞 Support

For technical support or questions about this project:

- **Developer**: Rushit Patel
- **Repository**: [https://github.com/Rushit-Patel/ktech-valve](https://github.com/Rushit-Patel/ktech-valve)
- **Issues**: [Report bugs or request features](https://github.com/Rushit-Patel/ktech-valve/issues)

## 📄 License

This project is proprietary software developed for KTech Valve. All rights reserved.

---

**Built with ❤️ using Laravel and modern web technologies**