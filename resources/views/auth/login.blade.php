<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Workforce Insights - Sign In</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            background: #0a0a0a;
            color: #ffffff;
            min-height: 100vh;
            display: flex;
        }

        .container {
            display: flex;
            width: 100%;
            min-height: 100vh;
        }

        .left-panel {
            flex: 1;
            padding: 60px 80px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            max-width: 600px;
        }

        .right-panel {
            flex: 1;
            background-image: url('https://img.freepik.com/free-photo/office-workers-using-finance-graphs_23-2150408645.jpg?semt=ais_hybrid&w=740&q=80');
            background-size: cover;
            background-position: center;
            position: relative;
        }

        .right-panel::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(124, 58, 237, 0.2) 0%, rgba(10, 10, 10, 0.7) 100%);
        }

        .logo {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #7c3aed 0%, #a855f7 100%);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 30px;
            font-size: 32px;
        }

        .title {
            font-size: 36px;
            font-weight: 600;
            margin-bottom: 10px;
            letter-spacing: -0.5px;
        }

        .subtitle {
            color: #9ca3af;
            font-size: 16px;
            margin-bottom: 50px;
        }

        .tabs {
            display: flex;
            gap: 20px;
            margin-bottom: 40px;
        }

        .tab {
            flex: 1;
            padding: 14px;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            background: transparent;
            color: #9ca3af;
        }

        .tab.active {
            background: linear-gradient(135deg, #7c3aed 0%, #a855f7 100%);
            color: white;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-label {
            display: block;
            margin-bottom: 10px;
            font-size: 14px;
            font-weight: 500;
            color: #e5e7eb;
        }

        .input-wrapper {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #6b7280;
        }

        .form-control {
            width: 100%;
            padding: 14px 14px 14px 45px;
            background: transparent;
            border: 1px solid #374151;
            border-radius: 10px;
            color: #ffffff;
            font-size: 15px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            outline: none;
            border-color: #7c3aed;
            box-shadow: 0 0 0 3px rgba(124, 58, 237, 0.1);
        }

        .form-control::placeholder {
            color: #6b7280;
        }

        select.form-control {
            cursor: pointer;
            background-color: #1a1a1a;
        }

        select.form-control option {
            background-color: #1a1a1a;
            color: #ffffff;
            padding: 10px;
        }

        .password-toggle {
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #6b7280;
            cursor: pointer;
            transition: color 0.3s ease;
        }

        .password-toggle:hover {
            color: #9ca3af;
        }

        .form-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .remember-me {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
            color: #9ca3af;
        }

        .remember-me input[type="checkbox"] {
            width: 16px;
            height: 16px;
            cursor: pointer;
        }

        .forgot-link {
            color: #a855f7;
            text-decoration: none;
            font-size: 14px;
            transition: color 0.3s ease;
        }

        .forgot-link:hover {
            color: #c084fc;
        }

        .btn-primary {
            width: 100%;
            padding: 16px;
            background: linear-gradient(135deg, #7c3aed 0%, #a855f7 100%);
            border: none;
            border-radius: 10px;
            color: white;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-bottom: 30px;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(124, 58, 237, 0.3);
        }

        .divider {
            text-align: center;
            margin-bottom: 30px;
            position: relative;
        }

        .divider::before,
        .divider::after {
            content: '';
            position: absolute;
            top: 50%;
            width: 45%;
            height: 1px;
            background: #374151;
        }

        .divider::before {
            left: 0;
        }

        .divider::after {
            right: 0;
        }

        .divider-text {
            color: #6b7280;
            font-size: 14px;
            padding: 0 15px;
            background: #0a0a0a;
            position: relative;
        }

        .social-buttons {
            display: flex;
            gap: 15px;
        }

        .btn-social {
            flex: 1;
            padding: 14px;
            background: transparent;
            border: 1px solid #374151;
            border-radius: 10px;
            color: #e5e7eb;
            font-size: 15px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .btn-social:hover {
            border-color: #7c3aed;
            background: rgba(124, 58, 237, 0.05);
        }

        .error-message {
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.3);
            color: #fca5a5;
            padding: 12px 16px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .success-message {
            background: rgba(34, 197, 94, 0.1);
            border: 1px solid rgba(34, 197, 94, 0.3);
            color: #86efac;
            padding: 12px 16px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        @media (max-width: 968px) {
            .right-panel {
                display: none;
            }

            .left-panel {
                max-width: 100%;
                padding: 40px;
            }
        }

        @media (max-width: 640px) {
            .left-panel {
                padding: 30px 20px;
            }

            .title {
                font-size: 28px;
            }

            .social-buttons {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="left-panel">
            <div class="logo">
                ✦
            </div>

            <h1 class="title">Workforce Insights, Simplified.</h1>
            <p class="subtitle">Welcome Back. Powering Your People Strategy.</p>

            <div class="tabs">
                <button class="tab active" id="signin-tab">Sign In</button>
                <button class="tab" id="signup-tab">Sign Up</button>
            </div>

            @if ($errors->any())
                <div class="error-message">
                    @foreach ($errors->all() as $error)
                        {{ $error }}<br>
                    @endforeach
                </div>
            @endif

            @if (session('status'))
                <div class="success-message">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" id="signin-form">
                @csrf
                <div class="form-group">
                    <label class="form-label">Email</label>
                    <div class="input-wrapper">
                        <span class="input-icon">✉</span>
                        <input type="email" name="email" class="form-control" placeholder="Enter your email" value="{{ old('email') }}" required autofocus>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Password</label>
                    <div class="input-wrapper">
                        <span class="input-icon">🔒</span>
                        <input type="password" name="password" class="form-control" id="password" placeholder="Enter your password" required>
                        <span class="password-toggle" onclick="togglePassword()">👁</span>
                    </div>
                </div>

                <div class="form-footer">
                    <label class="remember-me">
                        <input type="checkbox" name="remember">
                        <span>Remember me</span>
                    </label>
                    <a href="#" class="forgot-link">Forgot password?</a>
                </div>

                <button type="submit" class="btn-primary">Sign In</button>
            </form>

            <form method="POST" action="{{ route('register') }}" id="signup-form" style="display: none;">
                @csrf
                <div class="form-group">
                    <label class="form-label">Name</label>
                    <div class="input-wrapper">
                        <span class="input-icon">👤</span>
                        <input type="text" name="name" class="form-control" placeholder="Enter your name" value="{{ old('name') }}" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Email</label>
                    <div class="input-wrapper">
                        <span class="input-icon">✉</span>
                        <input type="email" name="email" class="form-control" placeholder="Enter your email" value="{{ old('email') }}" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Department</label>
                    <div class="input-wrapper">
                        <span class="input-icon">🏢</span>
                        <select name="department" class="form-control" required style="padding-left: 45px;">
                            <option value="" disabled selected>Select department</option>
                            <option value="IT Division" {{ old('department') == 'IT Division' ? 'selected' : '' }}>IT Division</option>
                            <option value="Finance Division" {{ old('department') == 'Finance Division' ? 'selected' : '' }}>Finance Division</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Role</label>
                    <div class="input-wrapper">
                        <span class="input-icon">⚡</span>
                        <select name="role" class="form-control" required style="padding-left: 45px;">
                            <option value="" disabled selected>Select role</option>
                            <option value="employer" {{ old('role') == 'employer' ? 'selected' : '' }}>Employer</option>
                            <option value="employee" {{ old('role') == 'employee' ? 'selected' : '' }}>Employee</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Password</label>
                    <div class="input-wrapper">
                        <span class="input-icon">🔒</span>
                        <input type="password" name="password" class="form-control" id="password-signup" placeholder="Enter your password" required>
                        <span class="password-toggle" onclick="togglePasswordSignup()">👁</span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Confirm Password</label>
                    <div class="input-wrapper">
                        <span class="input-icon">🔒</span>
                        <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm your password" required>
                    </div>
                </div>

                <button type="submit" class="btn-primary">Sign Up</button>
            </form>
        </div>

        <div class="right-panel"></div>
    </div>

    <script>
        const signinTab = document.getElementById('signin-tab');
        const signupTab = document.getElementById('signup-tab');
        const signinForm = document.getElementById('signin-form');
        const signupForm = document.getElementById('signup-form');

        signinTab.addEventListener('click', () => {
            signinTab.classList.add('active');
            signupTab.classList.remove('active');
            signinForm.style.display = 'block';
            signupForm.style.display = 'none';
        });

        signupTab.addEventListener('click', () => {
            signupTab.classList.add('active');
            signinTab.classList.remove('active');
            signupForm.style.display = 'block';
            signinForm.style.display = 'none';
        });

        function togglePassword() {
            const password = document.getElementById('password');
            password.type = password.type === 'password' ? 'text' : 'password';
        }

        function togglePasswordSignup() {
            const password = document.getElementById('password-signup');
            password.type = password.type === 'password' ? 'text' : 'password';
        }
    </script>
</body>
</html>
