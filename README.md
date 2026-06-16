<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. This project uses **Laravel 10** with **PHP 8.2**.

## Requirements

- PHP >= 8.2
- Composer
- MySQL / MariaDB or SQLite
- Node.js & NPM

## Installation & Setup

1. **Clone the repository**

```bash
git clone <repository-url>
cd blog
```

2. **Install PHP dependencies**

```bash
composer install
```

3. **Create environment file**

```bash
cp .env.example .env
```

4. **Generate application key**

```bash
php artisan key:generate
```

5. **Configure database**

Edit `.env` and set your database credentials:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=blog
DB_USERNAME=root
DB_PASSWORD=
```

6. **Run migrations**

```bash
php artisan migrate
```

7. **Install frontend dependencies**

```bash
npm install
```

8. **Build assets**

```bash
npm run build
```

9. **Start the development server**

```bash
php artisan serve
```

The application will be available at `http://localhost:8000`.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
