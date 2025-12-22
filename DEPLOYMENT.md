# 🚀 Hướng dẫn Deploy lên Sevalla

## ⚠️ Quan trọng: Các bước sau khi deploy

### 1. Tạo Symbolic Link cho Storage

Sau khi deploy code lên Sevalla, bạn **BẮT BUỘC** phải chạy lệnh này:

```bash
php artisan storage:link
```

**Lệnh này làm gì?**
- Tạo symbolic link từ `public/storage` → `storage/app/public`
- Cho phép truy cập file upload từ web browser
- **Không có lệnh này thì KHÔNG upload được file!**

### 2. Clear Cache

```bash
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear
```

### 3. Optimize cho Production

```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

---

## 📝 Checklist Deploy

- [ ] Pull code mới từ GitHub
- [ ] `composer install --no-dev --optimize-autoloader`
- [ ] `npm install && npm run build`
- [ ] Cập nhật file `.env` với cấu hình Sevalla:
  ```env
  APP_ENV=production
  APP_DEBUG=false
  APP_URL=https://sunny-auto-test.sevalla.app
  ASSET_URL=https://sunny-auto-test.sevalla.app
  ```
- [ ] `php artisan migrate --force`
- [ ] **`php artisan storage:link`** ← **QUAN TRỌNG!**
- [ ] Clear & Cache:
  ```bash
  php artisan config:clear
  php artisan cache:clear
  php artisan config:cache
  php artisan route:cache
  ```

---

## 🔧 Cấu trúc Storage

Sau khi chạy `php artisan storage:link`, file upload sẽ được lưu tại:

```
storage/app/public/products/    # File thật nằm đây
    └── 1234567890_0_product-name.jpg

public/storage/                  # Symbolic link trỏ đến storage/app/public
    └── products/
        └── 1234567890_0_product-name.jpg
```

URL truy cập: `https://sunny-auto-test.sevalla.app/storage/products/1234567890_0_product-name.jpg`

---

## ❓ Troubleshooting

### Vẫn không upload được file?

1. **Kiểm tra symbolic link đã tạo chưa:**
   ```bash
   ls -la public/storage
   ```
   Phải thấy: `storage -> ../storage/app/public`

2. **Kiểm tra quyền thư mục:**
   ```bash
   chmod -R 775 storage
   chmod -R 775 bootstrap/cache
   ```

3. **Kiểm tra ENV:**
   ```bash
   php artisan config:show filesystem
   ```
   Phải thấy: `default: public`

4. **Xóa symbolic link cũ và tạo lại:**
   ```bash
   rm public/storage
   php artisan storage:link
   ```

### Hình cũ không hiển thị?

Hình upload trước đây lưu ở `/imgs/products/` sẽ không hiển thị vì giờ dùng `/storage/products/`.

**Giải pháp:**
- Upload lại hình cho sản phẩm cũ, hoặc
- Di chuyển file cũ sang storage:
  ```bash
  mv public/imgs/products/* storage/app/public/products/
  ```

---

## 📞 Liên hệ

Nếu gặp vấn đề, check logs tại: `storage/logs/laravel.log`
