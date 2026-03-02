<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login | Planora</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="" sizes="any" />
    
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    
    <!-- Icons -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">

    <style>
        :root {
    --red-primary: #E10600;
    --red-light: #ff3b3b;
    --red-dark: #990000;
    --red-gradient: linear-gradient(135deg, #E10600 0%, #ff3b3b 50%, #990000 100%);
    --bg-light: #f4f6f9;
    --card-bg: #ffffff;
    --border-color: rgba(225, 6, 0, 0.2);
    --text-main: #222222;
    --text-muted: #777777;
}

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Inter', sans-serif;
}

body {
    height: 100vh;
    background-color: var(--bg-light);
    color: var(--text-main);
    display: flex;
    justify-content: center;
    align-items: center;
    overflow: hidden;
    position: relative;
}

/* Login Container */
.login-box {
    background: var(--card-bg);
    width: 400px;
    padding: 50px 40px;
    border-radius: 20px;
    z-index: 10;
    border: 1px solid #e5e5e5;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
    text-align: center;
    position: relative;
}

/* Logo */
.logo-container {
    margin-bottom: 15px;
    position: relative;
    display: inline-block;
}

.logo-container img {
    width: 150px;
    height: auto;
}

/* Typography */
.login-box h2 {
    font-family: 'Cinzel', serif;
    font-weight: 700;
    font-size: 26px;
    margin-bottom: 10px;
    background: var(--red-gradient);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    letter-spacing: 1px;
    text-transform: uppercase;
}

.subtitle {
    font-size: 13px;
    color: var(--text-muted);
    margin-bottom: 35px;
    letter-spacing: 0.5px;
}

/* Inputs */
.input-group {
    margin-bottom: 25px;
    text-align: left;
    position: relative;
}

.input-group label {
    font-size: 12px;
    color: var(--red-primary);
    text-transform: uppercase;
    letter-spacing: 1px;
    font-weight: 600;
    margin-bottom: 8px;
    display: block;
}

.input-wrapper {
    position: relative;
}

.input-wrapper input {
    width: 100%;
    padding: 14px 14px 14px 45px;
    background: #f9f9f9;
    border: 1px solid #ddd;
    border-radius: 8px;
    color: #333;
    font-size: 15px;
    outline: none;
    transition: 0.3s;
}

.input-wrapper i {
    position: absolute;
    left: 15px;
    top: 50%;
    transform: translateY(-50%);
    color: #aaa;
    transition: 0.3s;
    font-size: 18px;
}

.input-wrapper input:focus {
    border-color: var(--red-primary);
    box-shadow: 0 0 10px rgba(225, 6, 0, 0.2);
    background: #ffffff;
}

.input-wrapper input:focus + i {
    color: var(--red-primary);
}

/* Button */
.login-btn {
    width: 100%;
    padding: 15px;
    background: var(--red-primary);
    color: #ffffff;
    border: none;
    border-radius: 8px;
    font-size: 15px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1px;
    cursor: pointer;
    transition: 0.3s;
}

.login-btn:hover {
    background: var(--red-dark);
    box-shadow: 0 5px 20px rgba(225, 6, 0, 0.3);
}

/* Footer */
.admin-text {
    margin-top: 25px;
    font-size: 12px;
    color: #999999;
    letter-spacing: 1px;
    border-top: 1px solid #eeeeee;
    padding-top: 20px;
}

/* Error Styling */
small[style*="color: red;"] {
    color: #ff4c61 !important;
    font-size: 12px;
    margin-top: 5px;
    display: flex;
    align-items: center;
    gap: 5px;
}

small[style*="color: red;"]::before {
    content: '\ea0f';
    font-family: 'remixicon';
}

/* Responsive */
@media screen and (max-width:767px) {
    .login-box {
        width: 90%;
        padding: 50px 20px;
    }
}
    </style>
</head>
<body>
    
    <div class="gold-orb"></div>
    <div class="gold-orb-2"></div>
    <div class="overlay"></div>

    <div class="login-box">
        <div class="logo-container">
            <img src="{{ asset('assets/image/logo.png') }}" alt="Planora Logo">
        </div>
        
        <h2>Admin Portal</h2>
        <p class="subtitle">Secure Employee Access System</p>

        <form method="POST" action="{{ route('admin.login_check') }}">
            @csrf

            <div class="input-group">
                <label>Username</label>
                <div class="input-wrapper">
                    <input 
                        type="text" 
                        name="username" 
                        placeholder="Enter your ID"
                        value="{{ old('username') }}"
                        autocomplete="off"
                    >
                    <i class="ri-shield-user-line"></i>
                </div>

                @error('username')
                    <small style="color: red;">{{ $message }}</small>
                @enderror
            </div>

            <div class="input-group">
                <label>Password</label>
                <div class="input-wrapper">
                    <input 
                        type="password" 
                        name="password" 
                        placeholder="••••••••••••"
                    >
                    <i class="ri-lock-password-line"></i>
                </div>

                @error('password')
                    <small style="color: red;">{{ $message }}</small>
                @enderror
            </div>

            @if(session('error'))
                <div style="background: rgba(255, 76, 97, 0.1); border: 1px solid rgba(255, 76, 97, 0.3); padding: 10px; border-radius: 6px; margin-bottom: 20px;">
                    <small style="color: red; margin: 0; justify-content: center;">{{ session('error') }}</small>
                </div>
            @endif

            <button type="submit" class="login-btn">Authenticate</button>
        </form>

        <div class="admin-text">© 2026. copyrights Planora</div>
    </div>

</body>
</html>
