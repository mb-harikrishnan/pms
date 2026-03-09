<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Panel | Planora</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <link rel="stylesheet" href="{{ asset('assets/css/jquery.dataTables.min.css') }}">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@600&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <!-- Remix Icons -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">

    <style>
        :root {
            --primary-red: #E10600;
            --red-light: #FF4D4D;
            --red-dim: #B30000;
            --bg-light: #f4f6f9;
            --sidebar-bg: #ffffff;
            --header-bg: #ffffff;
            --text-main: #222222;
            --text-muted: #6b7280;
            --border-color: #e5e7eb;
            --hover-bg: rgba(225, 6, 0, 0.08);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            background: var(--bg-light);
            color: var(--text-main);
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* SCROLLBAR */
        ::-webkit-scrollbar {
            width: 6px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: #ccc;
            border-radius: 3px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--primary-red);
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
            transition: 0.3s;
            display: flex;
            flex-direction: column;
            box-shadow: 5px 0 20px rgba(0, 0, 0, 0.05);
        }

        .brand-box {
            height: 80px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-bottom: 1px solid var(--border-color);
            background: linear-gradient(to right, rgba(225, 6, 0, 0.05), transparent);
        }

        .sidebar-menu {
            flex: 1;
            overflow-y: auto;
            padding: 20px 0;
            list-style: none;
        }

        .menu-item {
            margin-bottom: 4px;
        }

        /* MENU LINK */
        .menu-link {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 12px 25px;
            color: var(--text-muted);
            text-decoration: none;
            font-size: 14px;
            transition: 0.3s;
            border-left: 3px solid transparent;
        }

        /* Hover */
        .menu-link:hover {
            background: var(--hover-bg);
            color: var(--primary-red);
        }

        /* Active */
        .menu-link.active {
            background: rgba(225, 6, 0, 0.1);
            color: var(--primary-red);
            border-left: 3px solid var(--primary-red);
            font-weight: 600;
        }

        /* Icons */
        .menu-icon {
            font-size: 18px;
            color: var(--primary-red);
        }

        .arrow-icon {
            font-size: 14px;
            color: var(--primary-red);
            transition: 0.3s;
        }

        .menu-item.open .arrow-icon {
            transform: rotate(180deg);
        }

        /* SUBMENU */
        .submenu {
            list-style: none;
            background: #fafafa;
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease-out;
        }

        .menu-item.open .submenu {
            max-height: 300px;
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
            color: var(--primary-red);
            background: rgba(225, 6, 0, 0.05);
        }

        .submenu li a::before {
            content: "";
            position: absolute;
            left: 45px;
            top: 50%;
            width: 4px;
            height: 4px;
            border-radius: 50%;
            background: #ccc;
            transform: translateY(-50%);
        }

        .submenu li a:hover::before {
            background: var(--primary-red);
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
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 30px;
            z-index: 999;
        }

        .toggle-btn {
            display: none;
            font-size: 24px;
            color: var(--primary-red);
            cursor: pointer;
        }

        .header-title h3 {
            color: var(--text-main);
            font-size: 18px;
            font-weight: 600;
        }

        .admin-info {
            font-size: 14px;
            color: var(--text-muted);
            display: flex;
            align-items: center;
            gap: 10px;
            background: #f9fafb;
            padding: 8px 16px;
            border-radius: 20px;
            border: 1px solid var(--border-color);
        }

        .admin-info i {
            color: var(--primary-red);
        }

        /* MAIN WRAPPER */
        .main-wrapper {
            margin-left: 260px;
            margin-top: 70px;
            width: 100%;
        }

        /* RESPONSIVE */
        @media (max-width: 1024px) {
            .sidebar {
                transform: translateX(-100%);
                box-shadow: 5px 0 20px rgba(0, 0, 0, 0.1);
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

            .sidebar-overlay {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.3);
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

        /* Date Input */
        input[type="date"]::-webkit-calendar-picker-indicator {
            filter: none !important;
        }
    </style>
</head>

<body>

  
        <!-- Mobile Overlay -->
        <div class="sidebar-overlay" onclick="toggleSidebar()"></div>

        <!-- SIDEBAR -->
        <aside class="sidebar" id="sidebar">
            <div class="brand-box">
                <img style="width: 150px;" src="{{ asset('assets/image/logo.png') }}" alt="Planora">
            </div>

            <ul class="sidebar-menu">

               

                        <li class="menu-item">
                            <a href="javascript:void(0)" class="menu-link" onclick="toggleSubmenu(this)">
                                <div class="link-content">
                                    <i class="ri-user-star-line menu-icon"></i>
                                    <span>Role Mgmt</span>
                                </div>
                                <i class="ri-arrow-down-s-line arrow-icon"></i>
                            </a>
                            <ul class="submenu">

                                <li><a href="{{route('staff.add_department')}}">Add Role</a></li>
                                <li><a href="{{ route('staff.department_list') }}">Role List</a></li>


                            </ul>
                        </li>

                     

            <!-- Mobile Overlay -->
            <div class="sidebar-overlay" onclick="toggleSidebar()"></div>

            <!-- SIDEBAR -->
            <aside class="sidebar" id="sidebar">
                <div class="brand-box">
                    <img style="width: 150px;" src="{{ asset('assets/image/logo.png') }}" alt="Planora">
                </div>

                <ul class="sidebar-menu">

                    <!-- DASHBOARD START -->

                    <li class="menu-item">
                        <a href="{{ route('staff.dashboard') }}" class="menu-link {{ request()->routeIs('staff.dashboard') ? 'active' : '' }}">
                            <div class="link-content">
                                <i class="ri-dashboard-3-line menu-icon"></i>
                                <span>Dashboard</span>
                            </div>
                        </a>
                    </li>


                    <!-- DASHBOARD END -->


                    <!-- DEPARTMENT MANAGEMENT START -->


                    <li class="menu-item">
                        <a href="javascript:void(0)" class="menu-link" onclick="toggleSubmenu(this)">
                            <div class="link-content">
                                <i class="ri-user-star-line menu-icon"></i>
                                <span>Role Mgmt</span>
                            </div>
                            <i class="ri-arrow-down-s-line arrow-icon"></i>
                        </a>
                        <ul class="submenu">

                            <li><a href="{{route('staff.add_department')}}">Add Role</a></li>
                            <li><a href="{{ route('staff.department_list') }}">Role List</a></li>


                        </ul>
                    </li>

                    <!-- DEPARTMENT MANAGEMENT END -->


                    <!-- EMPLOYEE MANAGEMENT START -->

                    <li class="menu-item has-submenu {{ request()->routeIs('staff.add_employee') || request()->routeIs('staff.employee_list') ? 'open' : '' }}">
                        <a href="javascript:void(0)" class="menu-link" onclick="toggleSubmenu(this)">
                            <div class="link-content">
                                <i class="ri-user-star-line menu-icon"></i>
                                <span>Employee Mgmt</span>
                            </div>
                            <i class="ri-arrow-down-s-line arrow-icon"></i>
                        </a>
                        <ul class="submenu">

                            <li><a href="{{route('staff.add_employee')}}" class="{{ request()->routeIs('staff.add_employee') ? 'active' : '' }}">Add Employee</a></li>
                            <li><a href="{{ route('staff.employee_list') }}" class="{{ request()->routeIs('staff.employee_list') ? 'active' : '' }}">Employee List</a></li>


                        </ul>
                    </li>


                    <!-- EMPLOYEE MANAGEMENT END -->


                    <!-- PROJECT MANAGEMENT START -->

                    <li class="menu-item has-submenu {{ request()->routeIs('staff.add_projects') || request()->routeIs('staff.add_projects') ? 'open' : '' }}">
                        <a href="javascript:void(0)" class="menu-link" onclick="toggleSubmenu(this)">
                            <div class="link-content">
                                <i class="ri-user-star-line menu-icon"></i>
                                <span>Project Mgmt</span>
                            </div>
                            <i class="ri-arrow-down-s-line arrow-icon"></i>
                        </a>
                        <ul class="submenu">

                            <li><a href="{{route('staff.add_projects')}}" class="{{ request()->routeIs('staff.add_projects') ? 'active' : '' }}">Add Project</a></li>
                            {{-- <li><a href="{{ route('staff.employee_list') }}" class="{{ request()->routeIs('staff.employee_list') ? 'active' : '' }}">Employee List</a>
                    </li> --}}


                </ul>
                </li>


                <!-- PROJECT MANAGEMENT END -->


                    <!-- LOGOUT START -->
                    <li style="border-top: 1px solid var(--border-color); margin: 15px 0;"></li>

                    <li class="menu-item">
                        <a href="{{ route('admin.logout') }}" class="menu-link" style="color: #ff5b5b;">
                            <div class="link-content">
                                <i class="ri-logout-box-r-line menu-icon"></i>
                                <span>Logout</span>
                            </div>
                        </a>
                    </li>


                    <!-- LOGOUT END -->

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

                    // Close all other open submenus
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


            <style>
                .content-wrapper {
                    max-width: 100% !important;
                }

                a.btn-reject.reject-btn,
                a.btn-approve.reject-btn {
                    background: rgba(231, 76, 60, 0.2) !important;
                    color: #e74c3c !important;
                    border: 1px solid rgba(231, 76, 60, 0.3) !important;
                    height: 36px;
                    padding: 10px;
                    border-radius: 10px;
                    margin: 0px 10px !important;
                }

                table.dataTable tbody th,
                table.dataTable tbody td {
                    padding: 18px 10px !important;
                    white-space: nowrap;
                }
            </style>

</body>

</html>

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

        // Close all other open submenus
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


<style>
    .content-wrapper {
        max-width: 100% !important;
    }

    a.btn-reject.reject-btn,
    a.btn-approve.reject-btn {
        background: rgba(231, 76, 60, 0.2) !important;
        color: #e74c3c !important;
        border: 1px solid rgba(231, 76, 60, 0.3) !important;
        height: 36px;
        padding: 10px;
        border-radius: 10px;
        margin: 0px 10px !important;
    }

    table.dataTable tbody th,
    table.dataTable tbody td {
        padding: 18px 10px !important;
        white-space: nowrap;
    }
</style>

</body>

</html>
