<div align="center">

# 🐘 PHP Projects

### Backend applications built with PHP & Laravel

[![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://php.net)
[![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)

</div>

---

## 📂 Projects

| Project | Description | Stack |
|---------|-------------|-------|
| **mansoura-zone** | Real estate & service marketplace | Laravel, MySQL, Blade |

---

## 🏪 Mansoura Zone

Local marketplace platform for services and products in Mansoura, Egypt.

### Features
- 🏠 Property listings & real estate
- 🛒 Product marketplace
- 👥 User registration & profiles
- 🔍 Advanced search & filtering
- 📱 Mobile-responsive design

---

## 🚀 Quick Start

```bash
# Clone the repository
git clone https://github.com/ahmedashraf344/php.git

# Navigate to project
cd php/mansoura-zone

# Install dependencies
composer install

# Setup environment
cp .env.example .env
php artisan key:generate

# Run migrations
php artisan migrate

# Seed database
php artisan db:seed

# Start server
php artisan serve
```

## 🏗️ Project Structure

```
php/
├── mansoura-zone/
│   ├── app/
│   │   ├── Http/Controllers/   # Controllers
│   │   ├── Models/             # Eloquent models
│   │   └── Services/           # Business logic
│   ├── database/
│   │   ├── migrations/         # Database migrations
│   │   └── seeders/            # Seed data
│   ├── resources/
│   │   └── views/              # Blade templates
│   ├── routes/
│   │   └── web.php             # Web routes
│   └── public/
└── README.md
```

## 🛠️ Tech Stack

| Category | Technologies |
|----------|-------------|
| **Framework** | Laravel 10 |
| **Language** | PHP 8.2 |
| **Database** | MySQL 8 |
| **Frontend** | Blade, Bootstrap 5 |
| **Auth** | Laravel Sanctum |
| **API** | RESTful JSON API |

## 📦 Dependencies

| Package | Purpose |
|---------|---------|
| Laravel Framework | Core framework |
| Laravel Sanctum | API authentication |
| Spatie Permission | Role management |
| Intervention Image | Image processing |

## 📫 Contact

- **Email:** ahmedashrafdev34@gmail.com
- **LinkedIn:** [linkedin.com/in/ashhraf](https://www.linkedin.com/in/ashhraf)

---

<div align="center">

Made with 🐘 by Ahmed Ashraf

</div>
