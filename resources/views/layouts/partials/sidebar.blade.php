<aside class="sidebar">
    <div class="logo-container">
        <img src="{{ asset('imgs/logo/logo.png') }}" alt="Sunny Auto Logo">
    </div>
    
    <ul class="nav-menu">
        <a href="{{ route('dashboard') }}" style="text-decoration: none; color: inherit;">
            <li class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M3 13h8V3H3v10zm0 8h8v-6H3v6zm10 0h8V11h-8v10zm0-18v6h8V3h-8z"/></svg>
                <span>Dashboard</span>
            </li>
        </a>
        <a href="{{ route('products.index') }}" style="text-decoration: none; color: inherit;">
            <li class="nav-item {{ request()->routeIs('products.*') ? 'active' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-5 14H7v-2h7v2zm3-4H7v-2h10v2zm0-4H7V7h10v2z"/></svg>
                <span>Sản phẩm</span>
            </li>
        </a>
        <a href="{{ route('users.index') }}" style="text-decoration: none; color: inherit;">
            <li class="nav-item {{ request()->routeIs('users.*') ? 'active' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                <span>Tài khoản</span>
            </li>
        </a>
        <a href="{{ route('blogs.index') }}" style="text-decoration: none; color: inherit;">
            <li class="nav-item {{ request()->routeIs('blogs.*') ? 'active' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M19 5v14H5V5h14m0-2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-4.86 8.86l-3 3.87L9 13.14 6 17h12l-3.86-5.14z"/></svg>
                <span>Blog</span>
            </li>
        </a>
        <a href="{{ route('contacts.index') }}" style="text-decoration: none; color: inherit; position: relative; display: block;">
            <li class="nav-item {{ request()->routeIs('contacts.*') ? 'active' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/></svg>
                <span>Liên hệ</span>
                <span class="unread-badge" style="
                    display: none; 
                    position: absolute; 
                    top: 50%; 
                    right: 16px; 
                    transform: translateY(-50%);
                    background: linear-gradient(135deg, #ef4444, #dc2626); 
                    color: white; 
                    font-size: 10px; 
                    font-weight: 700; 
                    padding: 4px 8px; 
                    border-radius: 12px; 
                    min-width: 20px; 
                    height: 20px;
                    text-align: center;
                    line-height: 12px;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    box-shadow: 0 2px 8px rgba(239, 68, 68, 0.4);
                    border: 2px solid white;
                ">0</span>
            </li>
        </a>
    </ul>
</aside>

<script>
// Update unread contacts badge
async function updateUnreadBadge() {
    try {
        const response = await fetch('/api/contacts/unread-count');
        const data = await response.json();
        
        const badge = document.querySelector('.unread-badge');
        if (badge) {
            if (data.count > 0) {
                badge.textContent = data.count;
                badge.style.display = 'flex';
            } else {
                badge.style.display = 'none';
            }
        }
    } catch (error) {
        console.error('Error fetching unread count:', error);
    }
}

// Update on page load
document.addEventListener('DOMContentLoaded', updateUnreadBadge);

// Update every 30 seconds
setInterval(updateUnreadBadge, 30000);
</script>
