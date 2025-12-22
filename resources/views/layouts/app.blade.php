<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') - Sunny Control</title>
    <link rel="icon" type="image/png" href="{{ asset('imgs/logo/icon.png') }}">
    @vite(['resources/css/app.css', 'resources/js/app.jsx'])
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
        
        /* Page Content */
        .page-content {
            padding: 40px;
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
            
            .page-content {
                padding: 20px;
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
        @include('layouts.partials.header')
        
        <!-- Page Content -->
        <div class="page-content">
            @yield('content')
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
