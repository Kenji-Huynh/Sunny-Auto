<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Sunny Control</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f0f2f5;
            min-height: 100vh;
        }
        
        /* Sidebar */
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            width: 280px;
            height: 100vh;
            background: white;
            color: orangered;
            padding: 30px 0;
            box-shadow: 4px 0 10px rgba(0, 0, 0, 0.1);
            z-index: 1000;
        }
        
        .logo-container {
            padding: 0 30px 30px;
            border-bottom: 1px solid rgba(255, 69, 0, 0.1);
            margin-bottom: 30px;
        }
        
        .logo-container img {
            width: 100%;
            height: auto;
        }
        
        .nav-menu {
            list-style: none;
        }
        
        .nav-item {
            padding: 15px 30px;
            display: flex;
            align-items: center;
            gap: 15px;
            cursor: pointer;
            transition: all 0.3s ease;
            border-left: 4px solid transparent;
        }
        
        .nav-item:hover, .nav-item.active {
            background: rgba(255, 69, 0, 0.08);
            border-left-color: orangered;
        }
        
        .nav-item svg {
            width: 20px;
            height: 20px;
            fill: orangered;
        }
        
        /* Main Content */
        .main-content {
            margin-left: 280px;
            min-height: 100vh;
        }
        
        /* Top Bar */
        .top-bar {
            background: white;
            padding: 20px 40px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.08);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .page-title {
            font-size: 28px;
            font-weight: 600;
            color: orangered;
        }
        
        .user-section {
            position: relative;
            display: flex;
            align-items: center;
            gap: 15px;
            cursor: pointer;
        }
        
        .user-avatar {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background: orangered;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 18px;
        }
        
        .user-info {
            text-align: right;
        }
        
        .user-name {
            font-weight: 600;
            color: #333;
            font-size: 14px;
        }
        
        .user-role {
            font-size: 12px;
            color: #666;
        }
        
        /* Dropdown Menu */
        .dropdown-menu {
            position: absolute;
            top: 100%;
            right: 0;
            margin-top: 10px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
            min-width: 220px;
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.3s ease;
            z-index: 1000;
        }
        
        .dropdown-menu.active {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }
        
        .dropdown-item {
            padding: 15px 20px;
            display: flex;
            align-items: center;
            gap: 12px;
            border-bottom: 1px solid #f0f0f0;
            cursor: pointer;
            transition: background 0.3s ease;
            color: #333;
        }
        
        .dropdown-item:last-child {
            border-bottom: none;
            border-radius: 0 0 8px 8px;
        }
        
        .dropdown-item:first-child {
            border-radius: 8px 8px 0 0;
        }
        
        .dropdown-item:hover {
            background: rgba(255, 69, 0, 0.05);
        }
        
        .dropdown-item svg {
            width: 18px;
            height: 18px;
            fill: orangered;
        }
        
        .dropdown-item.logout:hover {
            background: rgba(255, 69, 0, 0.1);
            color: orangered;
        }
        
        /* Dashboard Content */
        .dashboard-content {
            padding: 40px;
        }
        
        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 25px;
            margin-bottom: 40px;
        }
        
        .stat-card {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            display: flex;
            align-items: center;
            gap: 20px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(255, 69, 0, 0.2);
        }
        
        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .stat-icon svg {
            width: 30px;
            height: 30px;
            fill: white;
        }
        
        .stat-icon.blue { background: orangered; }
        .stat-icon.green { background: #4CAF50; }
        .stat-icon.orange { background: #FF9800; }
        .stat-icon.purple { background: #9C27B0; }
        
        .stat-info h3 {
            font-size: 32px;
            font-weight: 700;
            color: #333;
            margin-bottom: 5px;
        }
        
        .stat-info p {
            font-size: 14px;
            color: #666;
        }
        
        /* Welcome Card */
        .welcome-card {
            background: orangered;
            padding: 40px;
            border-radius: 16px;
            color: white;
            margin-bottom: 40px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }
        
        .welcome-card h2 {
            font-size: 32px;
            margin-bottom: 10px;
        }
        
        .welcome-card p {
            font-size: 16px;
            opacity: 0.9;
        }
        
        /* Quick Actions */
        .quick-actions {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            margin-bottom: 40px;
        }
        
        .quick-actions h3 {
            font-size: 20px;
            color: #333;
            margin-bottom: 20px;
            font-weight: 600;
        }
        
        .actions-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
        }
        
        .action-btn {
            padding: 15px 20px;
            background: #f8f9fa;
            border: 2px solid transparent;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 12px;
            color: #333;
            text-decoration: none;
        }
        
        .action-btn:hover {
            background: white;
            border-color: orangered;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(255, 69, 0, 0.2);
        }
        
        .action-btn svg {
            width: 20px;
            height: 20px;
            fill: orangered;
        }
        
        /* User Profile Modal */
        .profile-modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            z-index: 2000;
        }
        
        .profile-modal.active {
            opacity: 1;
            visibility: visible;
        }
        
        .profile-modal-content {
            background: white;
            border-radius: 16px;
            padding: 40px;
            max-width: 500px;
            width: 90%;
            transform: scale(0.9);
            transition: transform 0.3s ease;
        }
        
        .profile-modal.active .profile-modal-content {
            transform: scale(1);
        }
        
        .profile-modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }
        
        .profile-modal-header h3 {
            font-size: 24px;
            color: orangered;
            font-weight: 600;
        }
        
        .close-modal {
            width: 35px;
            height: 35px;
            border: none;
            background: #f0f0f0;
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }
        
        .close-modal:hover {
            background: orangered;
        }
        
        .close-modal svg {
            width: 18px;
            height: 18px;
            fill: #666;
        }
        
        .close-modal:hover svg {
            fill: white;
        }
        
        .profile-avatar-large {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background: orangered;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 40px;
            font-weight: 700;
            margin: 0 auto 30px;
        }
        
        .profile-details {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }
        
        .detail-row {
            display: flex;
            justify-content: space-between;
            padding: 12px 0;
            border-bottom: 1px solid #f0f0f0;
        }
        
        .detail-label {
            color: #666;
            font-size: 14px;
        }
        
        .detail-value {
            color: orangered;
            font-weight: 600;
            font-size: 14px;
        }
        
        .logout-btn {
            width: 100%;
            padding: 15px;
            background: orangered;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            margin-top: 20px;
            transition: all 0.3s ease;
        }
        
        .logout-btn:hover {
            background: white;
            color: orangered;
            border: 2px solid orangered;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(255, 69, 0, 0.3);
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                width: 70px;
            }
            
            .logo-container img,
            .nav-item span {
                display: none;
            }
            
            .nav-item {
                justify-content: center;
                padding: 15px;
            }
            
            .main-content {
                margin-left: 70px;
            }
            
            .top-bar {
                padding: 15px 20px;
            }
            
            .dashboard-content {
                padding: 20px;
            }
            
            .stats-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    @include('layouts.partials.sidebar')
    
    <!-- Main Content -->
    <main class="main-content">
        <!-- Top Bar -->
        <div class="top-bar">
            <h1 class="page-title">Dashboard</h1>
            <div class="user-section" onclick="toggleDropdown()">
                <div class="user-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
                <div class="user-info">
                    <div class="user-name">{{ auth()->user()->name }}</div>
                    <div class="user-role">Administrator</div>
                </div>
                
                <!-- Dropdown Menu -->
                <div class="dropdown-menu" id="userDropdown">
                    <div class="dropdown-item" onclick="event.stopPropagation(); showProfileModal()">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                        <span>Thông tin tài khoản</span>
                    </div>
                    <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                        @csrf
                        <button type="submit" class="dropdown-item logout" style="width: 100%; text-align: left; background: none; border: none; font-family: inherit; font-size: inherit;">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M17 7l-1.41 1.41L18.17 11H8v2h10.17l-2.58 2.58L17 17l5-5zM4 5h8V3H4c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h8v-2H4V5z"/></svg>
                            <span>Đăng xuất</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        
        <!-- Dashboard Content -->
        <div class="dashboard-content">
            <!-- Stats Grid -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon blue">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-5 14H7v-2h7v2zm3-4H7v-2h10v2zm0-4H7V7h10v2z"/></svg>
                    </div>
                    <div class="stat-info">
                        <h3>{{ $totalProducts }}</h3>
                        <p>Tổng sản phẩm</p>
                    </div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-icon green">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M19 3h-4.18C14.4 1.84 13.3 1 12 1c-1.3 0-2.4.84-2.82 2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-7 0c.55 0 1 .45 1 1s-.45 1-1 1-1-.45-1-1 .45-1 1-1zm2 14H7v-2h7v2zm3-4H7v-2h10v2zm0-4H7V7h10v2z"/></svg>
                    </div>
                    <div class="stat-info">
                        <h3>{{ $totalBlogs }}</h3>
                        <p>Tổng blog</p>
                    </div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-icon orange">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/></svg>
                    </div>
                    <div class="stat-info">
                        <h3>{{ $totalContacts }}</h3>
                        <p>Tổng liên hệ</p>
                    </div>
                </div>
            </div>
            
            <!-- Quick Actions -->
            <div class="quick-actions">
                <h3>Thao tác nhanh</h3>
                <div class="actions-grid">
                    <a href="{{ route('products.create') }}" class="action-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/></svg>
                        <span>Thêm sản phẩm</span>
                    </a>
                    <a href="{{ route('blogs.index') }}" class="action-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M19 5v14H5V5h14m0-2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-4.86 8.86l-3 3.87L9 13.14 6 17h12l-3.86-5.14z"/></svg>
                        <span>Quản lí Blog</span>
                    </a>
                    <a href="{{ route('contacts.index') }}" class="action-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/></svg>
                        <span>Quản lí Liên hệ</span>
                    </a>
                </div>
            </div>
            
        </div>
    </main>
    
    <!-- Profile Modal -->
    <div class="profile-modal" id="profileModal" onclick="closeProfileModal()">
        <div class="profile-modal-content" onclick="event.stopPropagation()">
            <div class="profile-modal-header">
                <h3>Thông tin tài khoản</h3>
                <button class="close-modal" onclick="closeProfileModal()">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/></svg>
                </button>
            </div>
            
            <div class="profile-avatar-large">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
            
            <div class="profile-details">
                <div class="detail-row">
                    <span class="detail-label">Họ và tên:</span>
                    <span class="detail-value">{{ auth()->user()->name }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Email:</span>
                    <span class="detail-value">{{ auth()->user()->email }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Vai trò:</span>
                    <span class="detail-value">Administrator</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Ngày đăng ký:</span>
                    <span class="detail-value">{{ auth()->user()->created_at->format('d/m/Y H:i') }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Trạng thái:</span>
                    <span class="detail-value" style="color: #43A047;">● Đang hoạt động</span>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        function toggleDropdown() {
            const dropdown = document.getElementById('userDropdown');
            dropdown.classList.toggle('active');
        }
        
        function showProfileModal() {
            document.getElementById('profileModal').classList.add('active');
            document.getElementById('userDropdown').classList.remove('active');
        }
        
        function closeProfileModal() {
            document.getElementById('profileModal').classList.remove('active');
        }
        
        // Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            const userSection = document.querySelector('.user-section');
            const dropdown = document.getElementById('userDropdown');
            
            if (!userSection.contains(event.target)) {
                dropdown.classList.remove('active');
            }
        });
        
        // Close modal with Escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeProfileModal();
            }
        });
    </script>
</body>
</html>
