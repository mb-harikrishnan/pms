<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', sans-serif;
        }

        body {
            height: 100vh;
            background: #000;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
            color: #fff;
        }

        /* Waves */
        .wave {
            position: absolute;
            width: 200%;
            height: 200px;
            bottom: 0;
            left: 0;
            background: url("data:image/svg+xml,%3Csvg viewBox='0 0 1440 320' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath fill='%23ffffff' fill-opacity='0.15' d='M0,96L48,117.3C96,139,192,181,288,192C384,203,480,181,576,176C672,171,768,181,864,181.3C960,181,1056,171,1152,144C1248,117,1344,75,1392,53.3L1440,32L1440,320L0,320Z'%3E%3C/path%3E%3C/svg%3E");
            animation: waveMove 10s linear infinite;
        }

        .wave.wave2 {
            opacity: 0.5;
            animation-duration: 15s;
        }

        @keyframes waveMove {
            from { transform: translateX(0); }
            to { transform: translateX(-50%); }
        }

        /* Login Card */
        .login-box {
            background: #fff;
            color: #000;
            width: 360px;
            padding: 40px;
            border-radius: 12px;
            z-index: 1;
            box-shadow: 0 20px 40px rgba(255,255,255,0.15);
            text-align: center;
        }

        .login-box h2 {
            margin-bottom: 25px;
            font-weight: 700;
            letter-spacing: 1px;
        }

        .input-group {
            margin-bottom: 20px;
            text-align: left;
        }

        .input-group label {
            font-size: 14px;
            font-weight: 600;
        }

        .input-group input {
            width: 100%;
            padding: 12px;
            margin-top: 6px;
            border-radius: 6px;
            border: 1px solid #000;
            outline: none;
        }

        .input-group input:focus {
            border-color: #555;
        }

        .login-btn {
            width: 100%;
            padding: 12px;
            background: #000;
            color: #fff;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
            transition: 0.3s;
        }

        .login-btn:hover {
            background: #333;
        }

        .admin-text {
            margin-top: 15px;
            font-size: 13px;
            opacity: 0.7;
        }
    </style>
</head>
<body>
<div class="login-box">
    <h2>ADMIN LOGIN</h2>

    <form method="POST" action="{{ route('admin.login_check') }}">
        @csrf

        <div class="input-group">
            <label>Username</label>
            <input 
                type="text" 
                name="username" 
                placeholder="Enter admin username"
                value="{{ old('username') }}"
            >

            @error('username')
                <small style="color: red;">{{ $message }}</small>
            @enderror
        </div>

        <div class="input-group">
            <label>Password</label>
            <input 
                type="password" 
                name="password" 
                placeholder="Enter password"
            >

            @error('password')
                <small style="color: red;">{{ $message }}</small>
            @enderror
        </div>

        @if(session('error'))
            <small style="color: red;">{{ session('error') }}</small>
        @endif

        <button type="submit" class="login-btn">Login</button>
    </form>

    <div class="admin-text">Authorized access only</div>
</div>


    <div class="wave"></div>
    <div class="wave wave2"></div>

</body>
</html>
