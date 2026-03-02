@include('staff::layouts.header')
<!-- MAIN CONTENT -->
<div class="main-content">

   <div class="content-wrapper">

    <!-- Welcome Section (Glassmorphism Effect) -->
    <div class="welcome-banner h-fade-in">
        <div class="welcome-content">
            <h3><span id="greetingText">Good Morning</span>, <?php echo session('admin_username'); ?>!</h3>
            <p>Here's your daily overview. You have pending tasks to review.</p>
        </div>
        <div class="current-time">
            <i class="ri-time-line"></i> <span id="clock">00:00:00</span>
            <span class="date">{{ \Carbon\Carbon::now()->format('d M, Y') }}</span>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="stats-grid">
        
        <!-- Total Employees Card -->
        <a href="{{ route('staff.employee_list') }}" class="stat-card h-slide-up" style="animation-delay: 0.1s;">
            <div class="stat-icon-wrapper blue-glow">
                <i class="ri-team-fill"></i>
            </div>
            <div class="stat-info">
                <h4>Total Staff</h4>
                <h2>{{ $employeeCount }}</h2>
                <div class="stat-trend trend-up">
                    <i class="ri-arrow-right-up-line"></i> Active Members
                </div>
            </div>
            <div class="hover-circle"></div>
        </a>

        <!-- Wallet Balance Card (New Widget) -->
        <div class="stat-card h-slide-up" style="animation-delay: 0.2s;">
            <div class="stat-icon-wrapper green-glow">
                <i class="ri-wallet-3-line"></i>
            </div>
            <div class="stat-info">
                <h4>Wallet Balance</h4>
                <h2>${{ number_format($walletBalance) }}</h2>
                <div class="stat-trend trend-up">
                    <i class="ri-checkbox-circle-line"></i> Available Funds
                </div>
            </div>
            <div class="hover-circle"></div>
        </div>

        <!-- Add Employee Card -->
        <a href="{{ route('staff.add_employee') }}" class="stat-card h-slide-up" style="animation-delay: 0.3s;">
            <div class="stat-icon-wrapper gold-glow">
                <i class="ri-user-add-line"></i>
            </div>
            <div class="stat-info">
                <h4>Quick Action</h4>
                <h2>New User</h2>
                <div class="stat-trend trend-neutral">
                    <i class="ri-add-circle-line"></i> Add Employee
                </div>
            </div>
             <div class="hover-circle"></div>
        </a>

         <!-- Change Password Card (Clickable Widget) -->
         <a href="{{ route('admin.change.password') }}" class="stat-card h-slide-up security-card" style="animation-delay: 0.4s;">
            <div class="stat-icon-wrapper red-glow">
                <i class="ri-shield-keyhole-line"></i>
            </div>
            <div class="stat-info">
                <h4>Security</h4>
                <h2>Password</h2>
                <div class="stat-trend trend-secure">
                    <i class="ri-lock-password-line"></i> Update Now
                </div>
            </div>
             <div class="hover-circle"></div>
        </a>

    </div>

    <!-- Quick Links / Recent Activity Grid -->
    <div class="dashboard-grid">
        
        <!-- Recent Shortcuts -->
        <div class="grid-card h-slide-up" style="animation-delay: 0.5s;">
            <div class="card-header">
                <h3><i class="ri-flashlight-line"></i> Quick Access</h3>
            </div>
            <div class="shortcut-list">
                {{-- <a href="{{ route('staff.test') }}" class="shortcut-item">
                    <i class="ri-file-list-3-line"></i>
                    <span>Account Requests</span>
                </a> --}}
                {{-- <a href="{{ route('accounts.wallet_request_list') }}" class="shortcut-item">
                    <i class="ri-wallet-3-line"></i>
                    <span>Wallet Requests</span>
                </a>
                <a href="{{ route('accounts.expence_list') }}" class="shortcut-item">
                     <i class="ri-money-dollar-circle-line"></i>
                    <span>Expense List</span>
                </a> --}}
            </div>
        </div>

        <!-- System Status -->


    </div>

</div>
</div>

<script>
    // Live Clock Script
    function updateClock() {
        const now = new Date();
        const timeString = now.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit', second: '2-digit' });
        document.getElementById('clock').innerText = timeString;

        const hour = now.getHours();
        let greeting = "Good Evening";
        if (hour < 12) greeting = "Good Morning";
        else if (hour < 18) greeting = "Good Afternoon";
        
        document.getElementById('greetingText').innerText = greeting;
    }
    setInterval(updateClock, 1000);
    updateClock(); // Run immediately
</script>

<style>
/* Animation Utilities */
@keyframes fadeInUp { 
    from { opacity: 0; transform: translateY(20px); } 
    to { opacity: 1; transform: translateY(0); } 
}
.h-fade-in { animation: fadeInUp 0.8s cubic-bezier(0.2, 0.8, 0.2, 1) forwards; }
.h-slide-up { opacity: 0; animation: fadeInUp 0.6s cubic-bezier(0.2, 0.8, 0.2, 1) forwards; }

/* MAIN CONTENT */
.main-content {
    margin-left: 240px;
    margin-top: 60px;
    padding: 30px;
    width: calc(100% - 240px);
    background: #f4f6f9;
}

@media screen and (max-width:767px) {
    .main-content {
        margin-left: 0px;
        margin-top: 80px;
        padding: 30px 15px;
        width: 100%;
    }
}

/* Content Wrapper */
.content-wrapper {
  max-width: 1200px;
  margin: 40px auto;
}

/* Welcome Banner */
.welcome-banner {
    background: #ffffff;
    border: 1px solid #e5e7eb;
    border-radius: 24px;
    padding: 30px 40px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 40px;
    position: relative;
    overflow: hidden;
    box-shadow: 0 10px 40px rgba(0,0,0,0.05);
}

.welcome-content h3 {
    font-family: 'Cinzel', serif;
    font-size: 26px;
    color: #222;
    margin-bottom: 8px;
}
.welcome-content h3 span { color: #D4AF37; }
.welcome-content p { color: #6b7280; font-size: 14px; }

.current-time {
    text-align: right;
    color: #222;
}
.current-time i { color: #D4AF37; font-size: 18px; margin-right: 5px; }
.current-time span#clock { font-size: 28px; font-weight: 700; font-family: monospace; display: block; }
.current-time .date { font-size: 13px; color: #888; font-weight: 500; }

/* Stats Grid */
.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 25px;
    margin-bottom: 40px;
}

.stat-card {
    background: #ffffff;
    border-radius: 20px;
    padding: 25px;
    position: relative;
    display: flex;
    align-items: center;
    gap: 20px;
    text-decoration: none;
    border: 1px solid #e5e7eb;
    transition: all 0.3s ease;
}

.stat-card:hover {
    transform: translateY(-5px);
    border-color: #D4AF37;
    box-shadow: 0 8px 25px rgba(0,0,0,0.08);
}

.stat-icon-wrapper {
    width: 60px;
    height: 60px;
    border-radius: 18px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 26px;
    flex-shrink: 0;
}

/* Soft Glow Colors */
.blue-glow { background: rgba(59, 130, 246, 0.1); color: #3b82f6; border: 1px solid rgba(59, 130, 246, 0.2); }
.gold-glow { background: rgba(212, 175, 55, 0.1); color: #D4AF37; border: 1px solid rgba(212, 175, 55, 0.2); }
.red-glow { background: rgba(239, 68, 68, 0.1); color: #ef4444; border: 1px solid rgba(239, 68, 68, 0.2); }
.green-glow { background: rgba(16, 185, 129, 0.1); color: #10b981; border: 1px solid rgba(16, 185, 129, 0.2); }

.stat-info h4 { color: #6b7280; font-size: 12px; text-transform: uppercase; margin-bottom: 4px; }
.stat-info h2 { color: #222; font-size: 28px; font-weight: 700; margin-bottom: 4px; }

.stat-trend { font-size: 12px; font-weight: 500; display: flex; align-items: center; gap: 4px; }
.trend-up { color: #10b981; }
.trend-neutral { color: #D4AF37; }
.trend-secure { color: #ef4444; }

/* Dashboard Grid */
.dashboard-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 30px;
}

.grid-card {
    background: #ffffff;
    border-radius: 20px;
    padding: 30px;
    border: 1px solid #e5e7eb;
    box-shadow: 0 5px 20px rgba(0,0,0,0.04);
}

.card-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 25px;
    padding-bottom: 15px;
    border-bottom: 1px solid #e5e7eb;
}
.card-header h3 { color: #222; font-size: 16px; font-weight: 600; display: flex; gap: 10px; }
.card-header h3 i { color: #D4AF37; }

/* Shortcut List */
.shortcut-list {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
    gap: 15px;
}

.shortcut-item {
    background: #f9fafb;
    padding: 20px;
    border-radius: 14px;
    text-align: center;
    text-decoration: none;
    color: #6b7280;
    border: 1px solid #e5e7eb;
    transition: 0.3s;
}

.shortcut-item i { display: block; font-size: 24px; margin-bottom: 10px; color: #222; transition: 0.3s; }
.shortcut-item span { font-size: 13px; font-weight: 500; }

.shortcut-item:hover { 
    background: rgba(212, 175, 55, 0.08); 
    border-color: #D4AF37; 
    color: #D4AF37; 
}
.shortcut-item:hover i { transform: translateY(-3px); color: #D4AF37; }

/* Server Stats */
.status-indicator { 
    font-size: 11px; 
    padding: 4px 8px; 
    border-radius: 12px; 
    text-transform: uppercase; 
    font-weight: 700; 
}
.status-indicator.online { 
    background: rgba(16, 185, 129, 0.15); 
    color: #10b981; 
}

.stat-row { margin-bottom: 20px; }
.stat-row span { display: block; margin-bottom: 8px; font-size: 13px; color: #555; }

.progress-bar { 
    height: 6px; 
    background: #e5e7eb; 
    border-radius: 10px; 
    overflow: hidden; 
}
.fill { height: 100%; background: #D4AF37; border-radius: 10px; }
.fill.green { background: #10b981; }

.val { font-size: 11px; color: #888; float: right; margin-top: -20px; }

/* Responsive */
@media (max-width: 900px) {
    .dashboard-grid { grid-template-columns: 1fr; }
    .welcome-banner { flex-direction: column; align-items: flex-start; gap: 20px; }
    .current-time { text-align: left; }
<<<<<<< HEAD
}
=======
}
</style>
>>>>>>> ce45a22b41c79b2a3862cac8f66c21cf47a716f4
