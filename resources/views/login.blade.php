<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - Donatoku De Patisserie</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary-pink: #B8336A;
            --primary-orange: #F4A261;
            --cream: #FAF0E6;
            --light-pink: #F8C8DC;
            --dark-pink: #8B2A52;
            --text-dark: #2C2C2C;
            --text-light: #666;
            --white: #FFFFFF;
            --shadow: rgba(184, 51, 106, 0.1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, var(--primary-pink), var(--primary-orange));
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .login-container {
            background: var(--white);
            border-radius: 20px;
            box-shadow: 0 25px 50px rgba(0,0,0,0.1);
            overflow: hidden;
            width: 100%;
            max-width: 400px;
        }

        .login-header {
            background: linear-gradient(135deg, var(--primary-pink), var(--primary-orange));
            padding: 2rem;
            text-align: center;
            color: var(--white);
        }

        .logo-circle {
            width: 80px;
            height: 80px;
            background: var(--white);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        .logo-circle img {
            width: 70px;
            height: 70px;
            object-fit: cover;
            border-radius: 50%;
        }

        .login-header h1 {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .login-header p {
            font-size: 0.9rem;
            opacity: 0.9;
        }

        .login-form {
            padding: 2rem;
        }

        .user-type-selector {
            display: flex;
            margin-bottom: 2rem;
            background: var(--cream);
            border-radius: 15px;
            padding: 5px;
        }

        .user-type-btn {
            flex: 1;
            padding: 12px;
            border: none;
            background: transparent;
            border-radius: 10px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            color: var(--text-light);
        }

        .user-type-btn.active {
            background: var(--primary-pink);
            color: var(--white);
            box-shadow: 0 2px 10px rgba(184, 51, 106, 0.3);
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: var(--text-dark);
        }

        .form-control {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid var(--cream);
            border-radius: 10px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: var(--white);
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary-pink);
            box-shadow: 0 0 0 3px rgba(184, 51, 106, 0.1);
        }

        .btn-login {
            width: 100%;
            padding: 15px;
            background: linear-gradient(135deg, var(--primary-pink), var(--primary-orange));
            color: var(--white);
            border: none;
            border-radius: 10px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-bottom: 1rem;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(184, 51, 106, 0.3);
        }

        .register-link {
            text-align: center;
            color: var(--text-light);
            font-size: 0.9rem;
        }

        .register-link a {
            color: var(--primary-pink);
            text-decoration: none;
            font-weight: 500;
        }

        .register-link a:hover {
            text-decoration: underline;
        }

        .alert {
            padding: 12px 15px;
            border-radius: 8px;
            margin-bottom: 1rem;
            font-size: 0.9rem;
        }

        .alert-error {
            background: #fee;
            color: #c33;
            border: 1px solid #fcc;
        }

        .alert-success {
            background: #efe;
            color: #363;
            border: 1px solid #cfc;
        }

        @media (max-width: 480px) {
            .login-container {
                margin: 10px;
            }

            .login-header, .login-form {
                padding: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <div class="logo-circle">
                <img src="/images/logo-nav.png" alt="Donatoku Logo">
            </div>
            <h1>DONATOKU</h1>
            <p>Login to Your Account</p>
        </div>

        <div class="login-form">
            @if(session('error'))
                <div class="alert alert-error">
                    {{ session('error') }}
                </div>
            @endif

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('login.submit') }}" method="POST">
                @csrf

                <div class="user-type-selector">
                    <button type="button" class="user-type-btn active" data-type="customer">
                        👤 Pelanggan
                    </button>
                    <button type="button" class="user-type-btn" data-type="admin">
                        👨‍💼 Admin
                    </button>
                </div>

                <input type="hidden" name="user_type" id="user_type" value="customer">

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required value="{{ old('email') }}">
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>

                <button type="submit" class="btn-login">
                    🚀 Masuk
                </button>
            </form>

            <div class="register-link">
                Belum punya akun? <a href="{{ route('register') }}">Daftar sekarang</a>
            </div>
        </div>
    </div>

    <script>
        // Handle user type selection
        document.querySelectorAll('.user-type-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                // Remove active class from all buttons
                document.querySelectorAll('.user-type-btn').forEach(b => b.classList.remove('active'));

                // Add active class to clicked button
                this.classList.add('active');

                // Update hidden input value
                document.getElementById('user_type').value = this.dataset.type;

                // Update header text based on user type
                const headerText = document.querySelector('.login-header p');
                if (this.dataset.type === 'admin') {
                    headerText.textContent = 'Admin Panel Access';
                } else {
                    headerText.textContent = 'Login to Your Account';
                }
            });
        });

        // Auto-refresh CSRF token if needed
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form');
            form.addEventListener('submit', function() {
                // Set meta CSRF token for any AJAX requests
                const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                if (window.axios) {
                    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token;
                }
            });
        });
    </script>
</body>
</html>
