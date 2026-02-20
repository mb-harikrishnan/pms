<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login | Trademos</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    
    <!-- Icons -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">

    <style>
        :root {
            --gold-primary: #D4AF37;
            --gold-light: #F3E5AB;
            --gold-dark: #AA8C2C;
            --gold-gradient: linear-gradient(135deg, #D4AF37 0%, #F3E5AB 50%, #AA8C2C 100%);
            --bg-dark: #050505;
            --card-bg: rgba(20, 20, 20, 0.95);
            --border-color: rgba(212, 175, 55, 0.3);
            --text-main: #FFFFFF;
            --text-muted: #888888;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            height: 100vh;
            background-color: var(--bg-dark);
            color: var(--text-main);
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
            position: relative;
        }

        /* Abstract Golden Background */
        .gold-orb {
            position: absolute;
            width: 800px;
            height: 800px;
            background: radial-gradient(circle, rgba(212, 175, 55, 0.08) 0%, transparent 70%);
            border-radius: 50%;
            top: -200px;
            right: -200px;
            z-index: 0;
            animation: pulseSlow 10s ease-in-out infinite;
        }

        .gold-orb-2 {
            position: absolute;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(170, 140, 44, 0.05) 0%, transparent 70%);
            border-radius: 50%;
            bottom: -150px;
            left: -150px;
            z-index: 0;
            animation: pulseSlow 12s ease-in-out infinite reverse;
        }

        @keyframes pulseSlow {
            0%, 100% { transform: scale(1); opacity: 0.5; }
            50% { transform: scale(1.1); opacity: 0.8; }
        }

        /* Geometric Overlay */
        .overlay {
            position: absolute;
            inset: 0;
            background-image: 
                linear-gradient(rgba(212, 175, 55, 0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(212, 175, 55, 0.03) 1px, transparent 1px);
            background-size: 60px 60px;
            z-index: 0;
            mask-image: radial-gradient(circle at center, black 40%, transparent 100%);
        }

        /* Login Container */
        .login-box {
            background: var(--card-bg);
            width: 400px;
            padding: 50px 40px;
            border-radius: 20px;
            z-index: 10;
            border: 1px solid var(--border-color);
            box-shadow: 0 0 40px rgba(0, 0, 0, 0.8), 0 0 15px rgba(212, 175, 55, 0.1);
            text-align: center;
            position: relative;
            backdrop-filter: blur(10px);
        }

        /* Golden Logo Effect */
        .logo-container {
            margin-bottom: 25px;
            position: relative;
            display: inline-block;
        }

        .logo-container img {
            width: 80px;
            height: auto;
            filter: drop-shadow(0 0 10px rgba(212, 175, 55, 0.4));
        }

        /* Typography */
        .login-box h2 {
            font-family: 'Cinzel', serif;
            font-weight: 700;
            font-size: 26px;
            margin-bottom: 10px;
            background: var(--gold-gradient);
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
            color: var(--gold-primary);
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
            background: rgba(0, 0, 0, 0.4);
            border: 1px solid #333;
            border-radius: 8px;
            color: #fff;
            font-size: 15px;
            outline: none;
            transition: 0.4s;
        }

        .input-wrapper i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #555;
            transition: 0.4s;
            font-size: 18px;
        }

        .input-wrapper input:focus {
            border-color: var(--gold-primary);
            box-shadow: 0 0 15px rgba(212, 175, 55, 0.15);
        }

        .input-wrapper input:focus + i {
            color: var(--gold-primary);
        }

        /* Button */
        .login-btn {
            width: 100%;
            padding: 15px;
            background: var(--gold-gradient);
            color: #1a1a1a;
            border: none;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            cursor: pointer;
            transition: 0.3s;
            margin-top: 10px;
            box-shadow: 0 5px 15px rgba(212, 175, 55, 0.2);
            position: relative;
            overflow: hidden;
        }

        .login-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(212, 175, 55, 0.3);
            filter: brightness(1.1);
        }

        .login-btn::after {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
            transition: 0.5s;
        }

        .login-btn:hover::after {
            left: 100%;
        }

        /* Footer */
        .admin-text {
            margin-top: 25px;
            font-size: 12px;
            color: rgba(255, 255, 255, 0.3);
            letter-spacing: 1px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding-top: 20px;
        }

        /* Error Styling */
        small[style*="color: red;"] {
            color: #ff6b6b !important;
            font-size: 12px;
            margin-top: 5px;
            display: flex;
            align-items: center;
            gap: 5px;
        }
        small[style*="color: red;"]::before {
            content: '\ea0f'; /* mixicon alert */
            font-family: 'remixicon';
        }

    </style>
</head>
<body>
    
    <div class="gold-orb"></div>
    <div class="gold-orb-2"></div>
    <div class="overlay"></div>

    <div class="login-box">
        <div class="logo-container">
            <img src="https://trademos.net/dist_assets/img/favicon/favlogoNew.png" alt="TradeMos Logo">
        </div>
        
        <h2>Admin Portal</h2>
        <p class="subtitle">Secure Financial Access System</p>

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

        <div class="admin-text">© 2026. copyrights Trademos</div>
    </div>

</body>
</html>
