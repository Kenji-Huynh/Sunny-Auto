# Sunny Auto - React Frontend Setup

## 🎯 Cấu trúc dự án

```
laravel/
├── resources/
│   ├── js/
│   │   ├── app.jsx                    # Entry point
│   │   ├── bootstrap.js               # Axios setup
│   │   └── components/
│   │       ├── App.jsx                # Root component với Router
│   │       └── pages/
│   │           └── Home.jsx           # Trang chủ
│   └── views/
│       └── frontend.blade.php         # Template cho React
├── routes/
│   └── web.php                        # Laravel routes
├── vite.config.js                     # Vite config với React
└── package.json                       # Dependencies
```

## ✅ Đã cài đặt

- ✅ React 19.2.3
- ✅ React DOM 19.2.3
- ✅ React Router DOM (mới cài)
- ✅ Vite với plugin React
- ✅ TailwindCSS v4

## 🚀 Các lệnh quan trọng

### Development (với hot reload)
```bash
npm run dev
```

### Build production
```bash
npm run build
```

### Chạy cả server Laravel và Vite dev
```bash
composer dev
```

## 📂 Tạo component mới

### 1. Tạo Page component
```jsx
// resources/js/components/pages/About.jsx
import React from 'react';

function About() {
    return (
        <div className="about-page">
            <h1>About Sunny Auto</h1>
        </div>
    );
}

export default About;
```

### 2. Thêm route trong App.jsx
```jsx
import About from './pages/About';

// Trong <Routes>
<Route path="/about" element={<About />} />
```

## 🎨 Styling

Dự án sử dụng **TailwindCSS v4** - đã tích hợp sẵn.

### Ví dụ:
```jsx
<div className="container mx-auto px-4">
    <h1 className="text-4xl font-bold text-orange-500">
        Sunny Auto
    </h1>
    <button className="bg-orange-500 hover:bg-orange-600 text-white px-6 py-3 rounded-lg">
        Click me
    </button>
</div>
```

## 🔗 URLs

- **Frontend (React)**: http://localhost:8000/ 
- **Admin Panel**: http://localhost:8000/admin
- **Dashboard**: http://localhost:8000/dashboard (cần auth)
- **Products**: http://localhost:8000/products (admin)
- **Users**: http://localhost:8000/users (admin)

## 📡 API Integration

### Sử dụng Axios (đã setup)
```jsx
import axios from 'axios';

// GET request
const fetchProducts = async () => {
    const response = await axios.get('/api/products');
    return response.data;
};

// POST request
const createProduct = async (data) => {
    const response = await axios.post('/api/products', data);
    return response.data;
};
```

### Tạo API routes trong Laravel
```php
// routes/web.php hoặc routes/api.php
Route::get('/api/products', [ProductController::class, 'apiIndex']);
Route::post('/api/products', [ProductController::class, 'apiStore']);
```

## 🏗️ Component Structure (Đề xuất)

```
components/
├── App.jsx                    # Root với Router
├── layout/
│   ├── Header.jsx            # Header component
│   ├── Footer.jsx            # Footer component
│   └── Navigation.jsx        # Navigation menu
├── pages/
│   ├── Home.jsx              # Trang chủ
│   ├── Products.jsx          # Danh sách sản phẩm
│   ├── ProductDetail.jsx     # Chi tiết sản phẩm
│   ├── About.jsx             # Giới thiệu
│   └── Contact.jsx           # Liên hệ
└── common/
    ├── Button.jsx            # Button component
    ├── Card.jsx              # Card component
    └── Loading.jsx           # Loading spinner
```

## 💡 Tips

### 1. Sử dụng React Hooks
```jsx
import { useState, useEffect } from 'react';

function MyComponent() {
    const [data, setData] = useState([]);
    
    useEffect(() => {
        fetchData();
    }, []);
    
    const fetchData = async () => {
        const result = await axios.get('/api/data');
        setData(result.data);
    };
    
    return <div>{/* render */}</div>;
}
```

### 2. Code Splitting
```jsx
import { lazy, Suspense } from 'react';

const Products = lazy(() => import('./pages/Products'));

<Suspense fallback={<Loading />}>
    <Products />
</Suspense>
```

### 3. Environment Variables
```jsx
// .env
VITE_API_URL=http://localhost:8000/api

// Sử dụng trong code
const apiUrl = import.meta.env.VITE_API_URL;
```

## 🐛 Troubleshooting

### Build failed?
```bash
rm -rf node_modules package-lock.json
npm install
npm run build
```

### Vite not detecting changes?
```bash
npm run dev -- --force
```

### Clear Laravel cache
```bash
php artisan cache:clear
php artisan view:clear
php artisan config:clear
```

## 📝 Next Steps

1. **Tạo layout components** (Header, Footer, Navigation)
2. **Tạo pages** cho Products, About, Contact
3. **Setup API endpoints** trong Laravel
4. **Kết nối frontend với backend** qua Axios
5. **Add authentication** cho user frontend
6. **Optimize performance** (lazy loading, code splitting)

## 🎯 Mục tiêu

- [ ] Trang chủ với slider hero
- [ ] Danh sách sản phẩm có filter
- [ ] Chi tiết sản phẩm
- [ ] Giỏ hàng (cart)
- [ ] Checkout
- [ ] Tài khoản khách hàng
- [ ] Search functionality
- [ ] Responsive design
