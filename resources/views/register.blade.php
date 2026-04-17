<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Register - Donatoku De Patisserie</title>

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

        .register-container {
            background: var(--white);
            border-radius: 20px;
            box-shadow: 0 25px 50px rgba(0,0,0,0.1);
            overflow: hidden;
            width: 100%;
            max-width: 450px;
            max-height: 90vh;
            overflow-y: auto;
        }

        .register-header {
            background: linear-gradient(135deg, var(--primary-pink), var(--primary-orange));
            padding: 1.5rem;
            text-align: center;
            color: var(--white);
        }

        .logo-circle {
            width: 60px;
            height: 60px;
            background: var(--white);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        .logo-circle img {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 50%;
        }

        .register-header h1 {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .register-header p {
            font-size: 0.8rem;
            opacity: 0.9;
        }

        .register-form {
            padding: 2rem;
        }

        .form-group {
            margin-bottom: 1.2rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: var(--text-dark);
            font-size: 0.9rem;
        }

        .form-control {
            width: 100%;
            padding: 10px 12px;
            border: 2px solid var(--cream);
            border-radius: 8px;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            background: var(--white);
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary-pink);
            box-shadow: 0 0 0 3px rgba(184, 51, 106, 0.1);
        }

        .btn-register {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, var(--primary-pink), var(--primary-orange));
            color: var(--white);
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-bottom: 1rem;
        }

        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(184, 51, 106, 0.3);
        }

        .login-link {
            text-align: center;
            color: var(--text-light);
            font-size: 0.9rem;
        }

        .login-link a {
            color: var(--primary-pink);
            text-decoration: none;
            font-weight: 500;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        .alert {
            padding: 10px 12px;
            border-radius: 6px;
            margin-bottom: 1rem;
            font-size: 0.85rem;
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

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        @media (max-width: 480px) {
            .register-container {
                margin: 10px;
                max-height: 95vh;
            }

            .register-header, .register-form {
                padding: 1.2rem;
            }

            .form-row {
                grid-template-columns: 1fr;
                gap: 0;
            }
        }
    </style>
</head>
<body>
    <div class="register-container">
        <div class="register-header">
            <div class="logo-circle">
                <img src="/images/logo-nav.png" alt="Donatoku Logo">
            </div>
            <h1>DONATOKU</h1>
            <p>Daftar Akun Pelanggan</p>
        </div>

        <div class="register-form">
            @if($errors->any())
                <div class="alert alert-error">
                    <ul style="margin: 0; padding-left: 20px;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('register.submit') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="name">Nama Lengkap</label>
                    <input type="text" class="form-control" id="name" name="name" required value="{{ old('name') }}" placeholder="Masukkan nama lengkap Anda">
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required value="{{ old('email') }}">
                </div>

                <div class="form-group">
                    <label for="phone">Nomor HP</label>
                    <input type="tel" class="form-control" id="phone" name="phone" required value="{{ old('phone') }}" placeholder="08xxxxxxxxxx">
                </div>

                <div class="form-group">
                    <label for="address">Alamat Lengkap</label>
                    <textarea class="form-control" id="address" name="address" rows="3" required placeholder="Jl. Contoh No. 123, Kelurahan, Kecamatan, Kota">{{ old('address') }}</textarea>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required minlength="6">
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">Konfirmasi Password</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required minlength="6">
                    </div>
                </div>

                <button type="submit" class="btn-register">
                    🎂 Daftar Sekarang
                </button>
            </form>

            <div class="login-link">
                Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a>
            </div>
        </div>
    </div>
</body>
</html>
