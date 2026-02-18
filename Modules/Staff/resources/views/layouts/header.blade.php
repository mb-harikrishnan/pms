<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin Panel</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">


<link rel="stylesheet" href="{{ asset('assets/css/jquery.dataTables.min.css') }}">




<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Segoe UI', sans-serif;
}

/* BODY */
body {
    background: #f4f4f4;
    display: flex;
}

/* SIDEBAR */
.sidebar {
    width: 240px;
    height: 100vh;
    background: #000;
    color: #fff;
    position: fixed;
    left: 0;
    top: 0;
}

.sidebar h2 {
    text-align: center;
    padding: 20px;
    border-bottom: 1px solid #333;
    letter-spacing: 1px;
}

.sidebar ul {
    list-style: none;
    padding: 20px 0;
}

.sidebar ul li {
    padding: 15px 25px;
    cursor: pointer;
    transition: 0.3s;
}

.sidebar ul li:hover {
    background: #222;
}

.sidebar ul li a {
    text-decoration: none;
    color: #fff;
    display: block;
    font-size: 15px;
}

/* HEADER */
.header {
    position: fixed;
    left: 240px;
    top: 0;
    width: calc(100% - 240px);
    height: 60px;
    background: #fff;
    border-bottom: 1px solid #ddd;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0 25px;
}

.header h3 {
    color: #000;
}

.header .admin-info {
    font-size: 14px;
    color: #555;
}




/* SUBMENU */
.has-submenu > a {
    position: relative;
}

.has-submenu > a::after {
    content: "▾";
    position: absolute;
    right: 20px;
    font-size: 12px;
}

.submenu {
    list-style: none;
    display: none;
    background: #111;
}

.submenu li {
    padding: 12px 40px;
}

.submenu li a {
    font-size: 14px;
    color: #ddd;
}

.submenu li:hover {
    background: #222;
}

/* SHOW SUBMENU ON HOVER */
.has-submenu:hover .submenu {
    display: block;
}


</style>
</head>

<body>

<!-- SIDEBAR -->
<div class="sidebar">
    <h2>ADMIN</h2>
    <ul>

        <li>
            <a href="{{ route('staff.dashboard') }}">Dashboard</a>
        </li>

        <li class="has-submenu">
            <a href="javascript:void(0)">Employee Management</a>
            <ul class="submenu">
                <li><a href="{{route('staff.add_employee')}}">Add Employee</a></li>
                <li><a href="{{ route('staff.employee_list') }}">Employee List</a></li>
            </ul>
        </li>
        <li class="has-submenu">
            <a href="javascript:void(0)">Accounts Management</a>
            <ul class="submenu">
                <li><a href="{{route('accounts.request_form')}}">Request Form</a></li>
                <li><a href="{{route('accounts.request_list')}}">Request List</a></li>
             
            </ul>
        </li>
        <li class="has-submenu">
            <a href="javascript:void(0)">Expence Management</a>
            <ul class="submenu">
                <li><a href="{{route('accounts.expence_form')}}">Expence Form</a></li>
                <li><a href="{{route('accounts.expence_list')}}">Expence List</a></li>
             
            </ul>
        </li>
        <li class="has-submenu">
            <a href="javascript:void(0)">Wallet Request Management</a>
            <ul class="submenu">
                <li><a href="{{route('accounts.wallet_request_form')}}">Wallet Request Form</a></li>
                <li><a href="{{route('accounts.wallet_request_list')}}">Wallet Request List</a></li>
             
            </ul>
        </li>

        {{-- <li>
            <a href="#">Password Management</a>
        </li> --}}

        <li>
            <a href="{{ route('admin.logout') }}">Logout</a>
        </li>

    </ul>
</div>
<!-- SIDEBAR -->



<!-- HEADER -->
<div class="header">
    <h3></h3>
    <div class="admin-info">
        Welcome, Admin
    </div>
</div>

</body>
</html>
