<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | SMA Cakrawala</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        /* Reset & Base */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            background: url("{{ asset('image/halaman.jpg') }}") no-repeat center center fixed;
            background-size: cover;
            font-family: 'Poppins', sans-serif;
            position: relative;
        }

        /* Overlay Background */
        .overlay {
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(3px);
            z-index: 0;
        }

        /* Logo Section */
        .logo {
            text-align: center;
            z-index: 1;
            position: relative;
            margin-bottom: 25px;
            animation: fadeDown 1s ease-out;
        }

        .logo img {
            width: 110px;
            height: 110px;
            object-fit: contain;
            border-radius: 50%;
            border: 3px solid rgba(255, 255, 255, 0.8);
            background: rgba(255, 255, 255, 0.25);
            padding: 10px;
            box-shadow: 0 4px 20px rgba(255, 255, 255, 0.3);
            transition: transform 0.3s ease;
        }

        .logo img:hover {
            transform: scale(1.05);
        }

        /* Login Card */
        .login-card {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(15px);
            border-radius: 20px;
            box-shadow: 0 8px 32px rgba(31, 38, 135, 0.37);
            border: 1px solid rgba(255, 255, 255, 0.25);
            width: 370px;
            padding: 50px 45px 55px;
            text-align: center;
            z-index: 1;
            position: relative;
            animation: fadeInUp 0.9s ease-out;
            overflow: hidden;
        }

        .login-title {
            font-size: 24px;
            font-weight: 600;
            color: white;
            letter-spacing: 0.5px;
            margin-bottom: 30px;
            text-shadow: 0 1px 3px rgba(0, 0, 0, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        /* Error Message */
        .error-message {
            background: rgba(253, 221, 221, 0.95);
            color: #991b1b;
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
            font-weight: 500;
            border: 1px solid rgba(220, 38, 38, 0.3);
            box-shadow: 0 2px 8px rgba(220, 38, 38, 0.2);
            display: flex;
            align-items: center;
            gap: 10px;
            animation: shake 0.5s ease-in-out;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
            20%, 40%, 60%, 80% { transform: translateX(5px); }
        }

        /* Form Inputs */
        .input-group {
            position: relative;
            margin-bottom: 18px;
        }

        .input-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #6b7280;
            font-size: 18px;
            transition: color 0.3s ease;
        }

        .form-input {
            width: 100%;
            padding: 12px 45px 12px 45px;
            background: rgba(255, 255, 255, 0.85);
            border: none;
            border-radius: 8px;
            font-size: 15px;
            outline: none;
            transition: all 0.3s ease;
            font-family: 'Poppins', sans-serif;
        }

        .form-input::placeholder {
            color: #9ca3af;
        }

        .form-input:focus {
            background: white;
            box-shadow: 0 0 0 3px rgba(255, 77, 77, 0.3);
            transform: translateY(-1px);
        }

        .form-input:focus ~ .input-icon {
            color: #ff4d4d;
        }

        /* Password Toggle */
        .password-toggle {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #6b7280;
            font-size: 18px;
            cursor: pointer;
            transition: color 0.3s ease;
        }

        .password-toggle:hover {
            color: #ff4d4d;
        }

        /* Form Options */
        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .remember-me {
            display: flex;
            align-items: center;
            gap: 8px;
            color: white;
        }

        .remember-me input {
            width: 16px;
            height: 16px;
            accent-color: #ff4d4d;
        }

        .forgot-password {
            color: white;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .forgot-password:hover {
            color: #ffcccc;
            text-decoration: underline;
        }

        /* Submit Button */
        .btn-login {
            background: linear-gradient(135deg, #ff4d4d, #cc0000);
            color: white;
            border: none;
            border-radius: 8px;
            padding: 12px 0;
            font-weight: 600;
            font-size: 15px;
            width: 100%;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(255, 77, 77, 0.3);
            font-family: 'Poppins', sans-serif;
            position: relative;
            overflow: hidden;
        }

        .btn-login::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s ease;
        }

        .btn-login:hover::before {
            left: 100%;
        }

        .btn-login:hover {
            background: linear-gradient(135deg, #cc0000, #990000);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(255, 77, 77, 0.4);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        /* Back Link */
        .back-link {
            color: white;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
            margin-top: 25px;
            font-size: 14px;
            opacity: 0.8;
            transition: all 0.3s ease;
        }

        .back-link:hover {
            opacity: 1;
            transform: translateX(-5px);
        }

        /* Animations */
        @keyframes fadeDown {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive */
        @media (max-width: 480px) {
            .login-card {
                width: 90%;
                padding: 40px 30px 45px;
            }

            .logo img {
                width: 90px;
                height: 90px;
            }

            .login-title {
                font-size: 22px;
            }

            .form-options {
                flex-direction: column;
                gap: 10px;
                align-items: flex-start;
            }
        }
    </style>
</head>
<body>

    {{-- Background Overlay --}}
    <div class="overlay"></div>

    {{-- Logo Section --}}
    <div class="logo">
        <img src="{{ asset('image/logo-sekolah.png') }}" alt="Logo SMA Cakrawala">
    </div>

    {{-- Login Card --}}
    <div class="login-card">
        <h2 class="login-title">
            Login Akun
        </h2>

        {{-- Error Message --}}
        @if ($errors->any())
            <div class="error-message">
                <i class="fas fa-exclamation-circle"></i>
                {{ $errors->first() }}
            </div>
        @endif

        {{-- Login Form --}}
        <form method="POST" action="{{ route('login') }}">
            @csrf

            {{-- Username/Email Input --}}
            <div class="input-group">
                <i class="fas fa-user input-icon"></i>
                <input 
                    type="text" 
                    name="input_type" 
                    class="form-input" 
                    placeholder="Akun Pengguna" 
                    value="{{ old('input_type') }}"
                    required 
                    autofocus
                >
            </div>

            {{-- Password Input --}}
            <div class="input-group">
                <i class="fas fa-lock input-icon"></i>
                <input 
                    type="password" 
                    name="password" 
                    class="form-input" 
                    placeholder="Password" 
                    id="password-input"
                    required
                >
                <i class="fas fa-eye password-toggle" id="password-toggle"></i>
            </div>

            {{-- Remember Me & Forgot Password --}}
            <div class="form-options">
                <label class="remember-me">
                    <input type="checkbox" name="remember">
                    <span>Ingat saya</span>
                </label>
            </div>

            {{-- Submit Button --}}
            <button type="submit" class="btn-login">
                Login
            </button>
        </form>

    </div>

    <script>
        // Password Toggle Functionality
        const passwordInput = document.getElementById('password-input');
        const passwordToggle = document.getElementById('password-toggle');
        
        passwordToggle.addEventListener('click', function() {
            // Toggle password visibility
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                passwordToggle.classList.remove('fa-eye');
                passwordToggle.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                passwordToggle.classList.remove('fa-eye-slash');
                passwordToggle.classList.add('fa-eye');
            }
        });
    </script>

</body>
</html>