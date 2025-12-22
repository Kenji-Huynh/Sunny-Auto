# 🚀 Sunny Auto - Hướng dẫn cài đặt

## 📋 Yêu cầu hệ thống

- PHP >= 8.2
- Composer
- Node.js >= 18.x
- MySQL 8.0+ hoặc MariaDB 10.x
- Git

## 🔧 Các bước cài đặt

### 1. Clone Repository

```bash
git clone https://github.com/YOUR_USERNAME/sunny-auto.git
cd sunny-auto/laravel
```

### 2. Cài đặt PHP Dependencies

```bash
composer install
```

### 3. Cài đặt Node Dependencies

```bash
npm install
```

### 4. Cấu hình Environment

```bash
# Copy file .env.example thành .env
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 5. Cấu hình Database

Mở file `.env` và cập nhật thông tin database:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sunny_auto
DB_USERNAME=root
DB_PASSWORD=your_password
```

### 6. Tạo Database

```bash
# Tạo database trong MySQL
mysql -u root -p
CREATE DATABASE sunny_auto CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
exit;
```

### 7. Chạy Migration

```bash
php artisan migrate
```

### 8. Seed Database (Optional)

```bash
# Tạo dữ liệu mẫu
php artisan db:seed
```

### 9. Tạo Storage Link

```bash
php artisan storage:link
```

### 10. Build Frontend Assets

```bash
# Development
npm run dev

# Production
npm run build
```

## 🔑 Cấu hình Lark Bot (Tùy chọn)

Nếu muốn sử dụng tính năng gửi thông báo qua Lark:

1. Tạo Lark Bot tại [Lark Open Platform](https://open.larksuite.com/)
2. Lấy `APP_ID`, `APP_SECRET`, và `GROUP_ID`
3. Cập nhật trong file `.env`:

```env
LARK_APP_ID=your_app_id
LARK_APP_SECRET=your_app_secret
LARK_CONTACT_GROUP_ID=your_group_id
LARK_API_BASE_URL=https://open.larksuite.com/open-apis
```

## 🚀 Chạy Project

### Development Mode

```bash
# Chạy server + queue + logs + vite dev cùng lúc
composer dev

# Hoặc chạy riêng lẻ:
php artisan serve              # Server: http://localhost:8000
php artisan queue:listen       # Queue worker
npm run dev                    # Vite dev server
```

### Production Mode

```bash
# Build assets
npm run build

# Chạy server
php artisan serve

# Chạy queue worker (trong terminal riêng)
php artisan queue:work --tries=3
```

## 👤 Tài khoản Admin mặc định

Sau khi seed database, sử dụng:

```
Email: admin@gmail.com
Password: 12345678
```

⚠️ **LƯU Ý:** Đổi mật khẩu ngay sau khi đăng nhập!

## 📁 Cấu trúc Project

```
laravel/
├── app/                    # Logic ứng dụng
│   ├── Http/Controllers/   # Controllers
│   ├── Models/            # Eloquent models
│   └── Services/          # Business logic (LarkService)
├── database/
│   └── migrations/        # Database migrations
├── resources/
│   ├── js/               # React components
│   └── views/            # Blade templates (Admin panel)
├── routes/
│   └── web.php           # Routes định nghĩa
└── public/
    └── build/            # Compiled frontend assets
```

## 🔍 URLs quan trọng

- **Frontend (React):** http://localhost:8000/
- **Admin Panel:** http://localhost:8000/admin
- **Login:** http://localhost:8000/login

## 🐛 Troubleshooting

### Lỗi "No application encryption key"
```bash
php artisan key:generate
```

### Lỗi "SQLSTATE[HY000] [1045] Access denied"
- Kiểm tra lại thông tin database trong `.env`

### Lỗi "Class not found"
```bash
composer dump-autoload
```

### Lỗi "Mix manifest not found"
```bash
npm run build
```

### Lỗi permission (Linux/Mac)
```bash
chmod -R 775 storage bootstrap/cache
```

## 📝 Scripts hữu ích

```bash
# Xóa cache
php artisan cache:clear
php artisan config:clear
php artisan view:clear
php artisan route:clear

# Fresh migration (XÓA toàn bộ data!)
php artisan migrate:fresh --seed

# Tạo migration mới
php artisan make:migration create_table_name

# Tạo model + migration
php artisan make:model ModelName -m

# Tạo controller
php artisan make:controller ControllerName

# Check routes
php artisan route:list
```

## 📞 Hỗ trợ

Nếu gặp vấn đề, hãy tạo issue trên GitHub hoặc liên hệ team.

---

**Made with ❤️ by Sunny Auto Team**
