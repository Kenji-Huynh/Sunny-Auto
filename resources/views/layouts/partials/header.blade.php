<div class="top-bar">
    <h1 class="page-title">@yield('title', 'Dashboard')</h1>
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
