<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin Panel | Premium Accounting</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="icon" href="" sizes="any" />
    <link rel="icon" href="https://trademos.net/assets/images/faviconnew.png" type="image/svg+xml" />
    <link rel="apple-touch-icon" href="https://trademos.net/assets/images/faviconnew.png" />
    

<link rel="stylesheet" href="{{ asset('assets/css/jquery.dataTables.min.css') }}">




<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@600&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
<!-- Remix Icons -->
<link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">

<style>
    :root {
        --primary-gold: #D4AF37;
        --gold-light: #F3E5AB;
        --gold-dim: #AA8C2C;
        --bg-dark: #09090b;
        --sidebar-bg: #121214;
        --header-bg: rgba(18, 18, 20, 0.95);
        --text-main: #FFFFFF;
        --text-muted: #A1A1AA;
        --border-color: #27272A;
        --hover-bg: rgba(212, 175, 55, 0.1);
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Inter', sans-serif;
    }

    body {
        background: var(--bg-dark);
        color: var(--text-main);
        display: flex;
        min-height: 100vh;
        overflow-x: hidden;
    }

    /* SCROLLBAR */
    ::-webkit-scrollbar {
        width: 6px;
    }
    ::-webkit-scrollbar-track {
        background: var(--bg-dark); 
    }
    ::-webkit-scrollbar-thumb {
        background: #333; 
        border-radius: 3px;
    }
    ::-webkit-scrollbar-thumb:hover {
        background: var(--primary-gold); 
    }

    /* SIDEBAR */
    .sidebar {
        width: 260px;
        height: 100vh;
        background: var(--sidebar-bg);
        border-right: 1px solid var(--border-color);
        position: fixed;
        left: 0;
        top: 0;
        z-index: 1000;
        transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        display: flex;
        flex-direction: column;
    }

    .brand-box {
        height: 70px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-bottom: 1px solid var(--border-color);
        background: linear-gradient(to right, rgba(212, 175, 55, 0.05), transparent);
    }

    .brand-box h2 {
        font-family: 'Cinzel', serif;
        font-size: 20px;
        color: var(--primary-gold);
        letter-spacing: 2px;
        text-transform: uppercase;
    }

    .sidebar-menu {
        flex: 1;
        overflow-y: auto;
        padding: 20px 0;
        list-style: none;
    }

    .menu-item {
        margin-bottom: 4px;
        position: relative;
    }

    .menu-link {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 12px 25px;
        color: var(--text-muted);
        text-decoration: none;
        font-size: 14px;
        transition: all 0.3s;
        border-left: 3px solid transparent;
        cursor: pointer;
    }

    .menu-link:hover, .menu-link.active {
        background: var(--hover-bg);
        color: var(--primary-gold);
        border-left-color: var(--primary-gold);
    }

    .link-content {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .menu-icon {
        font-size: 18px;
    }

    .arrow-icon {
        font-size: 14px;
        transition: transform 0.3s;
    }

    /* SUBMENU */
    .submenu {
        list-style: none;
        background: rgba(0, 0, 0, 0.3);
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.3s ease-out;
    }

    .menu-item.open .submenu {
        max-height: 300px; /* Arbitrary large height for animation */
        transition: max-height 0.5s ease-in;
    }

    .menu-item.open .arrow-icon {
        transform: rotate(180deg);
        color: var(--primary-gold);
    }

    .submenu li a {
        padding: 10px 25px 10px 60px;
        display: block;
        font-size: 13px;
        color: var(--text-muted);
        text-decoration: none;
        transition: 0.2s;
        position: relative;
    }

    .submenu li a:hover {
        color: var(--gold-light);
        background: rgba(255, 255, 255, 0.02);
    }

    .submenu li a::before {
        content: "";
        position: absolute;
        left: 45px;
        top: 50%;
        width: 4px;
        height: 4px;
        border-radius: 50%;
        background: var(--border-color);
        transform: translateY(-50%);
    }

    .submenu li a:hover::before {
        background: var(--primary-gold);
    }

    /* HEADER */
    .header {
        position: fixed;
        left: 260px;
        top: 0;
        width: calc(100% - 260px);
        height: 70px;
        background: var(--header-bg);
        border-bottom: 1px solid var(--border-color);
        backdrop-filter: blur(10px);
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0 30px;
        z-index: 999;
        transition: all 0.3s;
    }

    .toggle-btn {
        display: none;
        font-size: 24px;
        color: var(--text-main);
        cursor: pointer;
        padding: 5px;
    }

    .header-title h3 {
        color: var(--text-main);
        font-size: 18px;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .admin-info {
        font-size: 14px;
        color: var(--text-muted);
        display: flex;
        align-items: center;
        gap: 10px;
        background: rgba(255, 255, 255, 0.05);
        padding: 8px 16px;
        border-radius: 20px;
        border: 1px solid var(--border-color);
    }

    .admin-info i {
        color: var(--primary-gold);
    }

    /* MAIN CONTENT WRAPPER */
    .main-wrapper {
        margin-left: 260px;
        margin-top: 70px;
        width: 100%;
        transition: margin-left 0.3s;
    }

    /* RESPONSIVE */
    @media (max-width: 1024px) {
        .sidebar {
            transform: translateX(-100%);
            box-shadow: 5px 0 15px rgba(0, 0, 0, 0.5);
        }

        .sidebar.active {
            transform: translateX(0);
        }

        .header {
            left: 0;
            width: 100%;
            padding: 0 20px;
        }

        .main-wrapper {
            margin-left: 0;
        }

        .toggle-btn {
            display: block;
        }

        /* Overlay when sidebar is open */
        .sidebar-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(2px);
            z-index: 999;
            display: none;
            opacity: 0;
            transition: opacity 0.3s;
        }

        .sidebar-overlay.active {
            display: block;
            opacity: 1;
        }
    }

</style>
</head>

<body>

<!-- Mobile Overlay -->
<div class="sidebar-overlay" onclick="toggleSidebar()"></div>

<!-- SIDEBAR -->
<aside class="sidebar" id="sidebar">
    <div class="brand-box">
        <h2>TradeMos</h2>
    </div>
    
    <ul class="sidebar-menu">

        <li class="menu-item">
            <a href="{{ route('staff.dashboard') }}" class="menu-link">
                <div class="link-content">
                    <i class="ri-dashboard-3-line menu-icon"></i>
                    <span>Dashboard</span>
                </div>
            </a>
        </li>

        <li class="menu-item has-submenu">
            <a href="javascript:void(0)" class="menu-link" onclick="toggleSubmenu(this)">
                <div class="link-content">
                    <i class="ri-user-star-line menu-icon"></i>
                    <span>Employee Mgmt</span>
                </div>
                <i class="ri-arrow-down-s-line arrow-icon"></i>
            </a>
            <ul class="submenu">
                <li><a href="{{route('staff.add_employee')}}">Add Employee</a></li>
                <li><a href="{{ route('staff.employee_list') }}">Employee List</a></li>
            </ul>
        </li>

        <li class="menu-item has-submenu">
            <a href="javascript:void(0)" class="menu-link" onclick="toggleSubmenu(this)">
                <div class="link-content">
                    <i class="ri-briefcase-4-line menu-icon"></i>
                    <span>Accounts Mgmt</span>
                </div>
                <i class="ri-arrow-down-s-line arrow-icon"></i>
            </a>
            <ul class="submenu">
                <li><a href="{{route('accounts.request_form')}}">Request Form</a></li>
                <li><a href="{{route('accounts.request_list')}}">Request List</a></li>
            </ul>
        </li>

        <li class="menu-item has-submenu">
            <a href="javascript:void(0)" class="menu-link" onclick="toggleSubmenu(this)">
                <div class="link-content">
                    <i class="ri-money-dollar-circle-line menu-icon"></i>
                    <span>Expense Mgmt</span>
                </div>
                <i class="ri-arrow-down-s-line arrow-icon"></i>
            </a>
            <ul class="submenu">
                <li><a href="{{route('accounts.expence_form')}}">Expense Form</a></li>
                <li><a href="{{route('accounts.expence_list')}}">Expense List</a></li>
            </ul>
        </li>

        <li class="menu-item has-submenu">
            <a href="javascript:void(0)" class="menu-link" onclick="toggleSubmenu(this)">
                <div class="link-content">
                    <i class="ri-wallet-3-line menu-icon"></i>
                    <span>Wallet Requests</span>
                </div>
                <i class="ri-arrow-down-s-line arrow-icon"></i>
            </a>
            <ul class="submenu">
                <li><a href="{{route('accounts.wallet_request_form')}}">Wallet Request Form</a></li>
                <li><a href="{{route('accounts.wallet_request_list')}}">Wallet Request List</a></li>
            </ul>
        </li>

        <!-- Divider line for visual separation -->
        <li style="border-top: 1px solid var(--border-color); margin: 15px 0;"></li>

        <li class="menu-item">
            <a href="{{ route('admin.logout') }}" class="menu-link" style="color: #ff5b5b;">
                <div class="link-content">
                    <i class="ri-logout-box-r-line menu-icon"></i>
                    <span>Logout</span>
                </div>
            </a>
        </li>

    </ul>
</aside>

<!-- HEADER -->
<div class="header">
    <div style="display: flex; align-items: center; gap: 20px;">
        <i class="ri-menu-2-line toggle-btn" onclick="toggleSidebar()"></i>
        <div class="header-title">
            <h3>Admin Overview</h3>
        </div>
    </div>
    
    <div class="admin-info">
        <i class="ri-shield-user-line"></i>
        <span>Welcome, Admin</span>
    </div>
</div>

<script>
    // Submenu Toggle
    function toggleSubmenu(element) {
        const parent = element.parentElement;
        const wasOpen = parent.classList.contains('open');

        // Close all other open submenus (optional, keep if you want accordion style)
        document.querySelectorAll('.menu-item.has-submenu').forEach(item => {
            item.classList.remove('open');
        });

        // Toggle current
        if (!wasOpen) {
            parent.classList.add('open');
        }
    }

    // Sidebar Mobile Toggle
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        const overlay = document.querySelector('.sidebar-overlay');
        
        sidebar.classList.toggle('active');
        overlay.classList.toggle('active');
    }
</script>

</body>
</html>
