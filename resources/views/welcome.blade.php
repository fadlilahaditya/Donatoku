<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Donatoku De Patisserie</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        /* Color Palette inspired by the image */
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

        /* Reset and Base Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            line-height: 1.6;
            color: var(--text-dark);
            background-color: var(--cream);
            overflow-x: hidden;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Navigation */
        .navbar {
            background: linear-gradient(135deg, var(--primary-pink), var(--primary-orange));
            padding: 1rem 0;
            box-shadow: 0 2px 10px var(--shadow);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .nav-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .nav-brand {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .logo-circle {
            width: 65px;
            height: 65px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            box-shadow: 0 4px 12px rgba(184, 51, 106, 0.3);
            border: 2px solid var(--primary-pink);
            overflow: hidden;
        }

        .nav-logo-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
        }

        .nav-brand-text h1 {
            color: var(--white);
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: -5px;
        }

        .nav-brand-text p {
            color: var(--cream);
            font-size: 0.8rem;
            font-weight: 300;
            font-style: italic;
        }

        .nav-menu {
            display: flex;
            gap: 2rem;
            flex-wrap: wrap;
            justify-content: flex-end;
            align-items: center;
        }

        .nav-link {
            color: var(--white);
            text-decoration: none;
            font-weight: 500;
            padding: 0.5rem 1rem;
            border-radius: 25px;
            transition: all 0.3s ease;
        }

        .nav-link:hover,
        .nav-link.active {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-2px);
        }

        .login-button {
            background: var(--white);
            color: var(--primary-pink);
            padding: 0.6rem 1.5rem;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 600;
            margin-left: 1rem;
            transition: all 0.3s ease;
            border: 2px solid var(--white);
        }

        .login-button:hover {
            background: transparent;
            color: var(--white);
            transform: translateY(-2px);
        }

        .user-menu {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .user-name {
            color: var(--white);
            font-weight: 500;
        }

        .logout-button {
            background: transparent;
            color: var(--white);
            border: 1px solid var(--white);
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.9rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .logout-button:hover {
            background: var(--white);
            color: var(--primary-pink);
        }

        /* Hero Section */
        .hero {
            background: linear-gradient(135deg, var(--cream), var(--light-pink));
            padding: 4rem 0;
            min-height: 80vh;
            display: flex;
            align-items: center;
        }

        .hero-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 3rem;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .hero-content h2 {
            font-size: 3rem;
            font-weight: 700;
            color: var(--primary-pink);
            margin-bottom: 1rem;
            line-height: 1.2;
        }

        .hero-content p {
            font-size: 1.1rem;
            color: var(--text-light);
            margin-bottom: 2rem;
            line-height: 1.8;
        }

        .home-alert {
            margin-bottom: 1.25rem;
            padding: 1rem 1.15rem;
            border-radius: 14px;
            text-align: left;
            box-shadow: 0 8px 22px rgba(0,0,0,0.08);
        }

        .home-alert p {
            margin: 0.35rem 0 0;
            color: inherit;
            line-height: 1.5;
            font-size: 0.98rem;
        }

        .home-alert-success {
            background: #ecfdf3;
            color: #166534;
            border: 1px solid #b7ebc6;
        }

        .hero-buttons {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .btn {
            padding: 1rem 2rem;
            border: none;
            border-radius: 50px;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-block;
            text-align: center;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary-pink), var(--primary-orange));
            color: var(--white);
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px var(--shadow);
        }

        .btn-secondary {
            background: transparent;
            color: var(--primary-pink);
            border: 2px solid var(--primary-pink);
        }

        .btn-secondary:hover {
            background: var(--primary-pink);
            color: var(--white);
            transform: translateY(-3px);
        }

        .hero-image {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .hero-logo {
            width: 350px;
            height: 350px;
            border: 3px solid var(--primary-pink);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            box-shadow: 0 25px 50px var(--shadow);
            animation: float 3s ease-in-out infinite;
            overflow: hidden;
        }

        .hero-logo-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
            animation: float 3s ease-in-out infinite;
        }

        .hero-logo-text {
            position: absolute;
            top: 20px;
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--primary-pink);
            text-align: center;
            line-height: 1.2;
            transform: rotate(-10deg);
        }

        .cupcake-illustration {
            width: 120px;
            height: 120px;
            margin: 1rem 0;
        }

        .hero-logo-brand {
            font-size: 2.5rem;
            font-weight: 900;
            color: var(--primary-pink);
            letter-spacing: 2px;
            margin-bottom: 0.5rem;
        }

        .hero-logo-contact {
            font-size: 0.9rem;
            color: var(--primary-pink);
            text-align: center;
            line-height: 1.4;
        }

        .hero-logo-contact span {
            display: block;
            margin: 0.2rem 0;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }

        /* Featured Products */
        .featured {
            padding: 4rem 0;
            background: var(--white);
        }

        .section-title {
            text-align: center;
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--primary-pink);
            margin-bottom: 3rem;
        }

        .featured-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
        }

        .featured-card {
            background: var(--white);
            border-radius: 20px;
            padding: 2rem;
            text-align: center;
            box-shadow: 0 10px 30px var(--shadow);
            transition: all 0.3s ease;
        }

        .featured-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px var(--shadow);
        }

        .card-image {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, var(--primary-orange), var(--primary-pink));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            font-size: 2rem;
            overflow: hidden;
        }

        .product-icon-img {
            width: 60px;
            height: 60px;
            object-fit: contain;
            border-radius: 50%;
            padding: 8px;
            background: var(--white);
        }

        .card-content h3 {
            font-size: 1.3rem;
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 0.5rem;
        }

        .category {
            color: var(--text-light);
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
        }

        .price {
            color: var(--primary-pink);
            font-weight: 600;
            font-size: 1.1rem;
            margin-bottom: 1rem;
        }

        .card-btn {
            background: var(--primary-pink);
            color: var(--white);
            padding: 0.8rem 1.5rem;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .card-btn:hover {
            background: var(--dark-pink);
            transform: translateY(-2px);
        }

        /* Categories */
        .categories {
            padding: 4rem 0;
            background: linear-gradient(135deg, var(--cream), var(--light-pink));
        }

        .categories-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
        }

        .category-card {
            background: var(--white);
            padding: 2rem;
            border-radius: 20px;
            text-align: center;
            text-decoration: none;
            color: var(--text-dark);
            box-shadow: 0 10px 30px var(--shadow);
            transition: all 0.3s ease;
        }

        .category-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px var(--shadow);
        }

        .category-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
        }

        .category-card h3 {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--primary-pink);
            margin-bottom: 1rem;
        }

        .category-card p {
            color: var(--text-light);
            line-height: 1.6;
        }

        /* About Section */
        .about {
            padding: 4rem 0;
            background: var(--white);
        }

        .about-content h2 {
            text-align: center;
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--primary-pink);
            margin-bottom: 2rem;
        }

        .about-content > p {
            text-align: center;
            font-size: 1.1rem;
            color: var(--text-light);
            max-width: 800px;
            margin: 0 auto 3rem;
            line-height: 1.8;
        }

        .about-features {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
        }

        .feature {
            text-align: center;
            padding: 2rem;
        }

        .feature-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
            display: block;
        }

        .feature h4 {
            font-size: 1.3rem;
            font-weight: 600;
            color: var(--primary-pink);
            margin-bottom: 1rem;
        }

        .feature p {
            color: var(--text-light);
            line-height: 1.6;
        }

        /* Footer */
        .footer {
            background: linear-gradient(135deg, var(--primary-pink), var(--primary-orange));
            color: var(--white);
            padding: 3rem 0 1rem;
        }

        .footer-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .footer-logo {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .footer-brand h3 {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: -5px;
        }

        .footer-brand p {
            font-size: 0.9rem;
            font-weight: 300;
            font-style: italic;
            opacity: 0.8;
        }

        .footer-info p {
            margin-bottom: 0.5rem;
            opacity: 0.9;
        }

        .footer-bottom {
            text-align: center;
            padding-top: 2rem;
            border-top: 1px solid rgba(255, 255, 255, 0.2);
            opacity: 0.7;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .navbar {
                padding: 0.75rem 0;
            }

            .nav-menu {
                flex-direction: row;
                flex-wrap: nowrap;
                gap: 0.5rem;
                width: 100%;
                align-items: center;
                justify-content: flex-start;
                overflow-x: auto;
                padding-bottom: 0.25rem;
                white-space: nowrap;
                -webkit-overflow-scrolling: touch;
            }

            .nav-container {
                flex-direction: column;
                gap: 0.75rem;
                padding: 0 14px;
            }

            .nav-brand {
                justify-content: center;
                text-align: center;
            }

            .user-menu {
                flex-direction: row;
                width: auto;
                flex: 0 0 auto;
            }

            .login-button,
            .logout-button,
            .nav-link {
                width: auto;
                text-align: center;
                margin-left: 0;
                flex: 0 0 auto;
                padding: 0.45rem 0.85rem;
                font-size: 0.92rem;
            }

            .hero {
                padding: 2.25rem 0 3rem;
                min-height: auto;
            }

            .hero-container {
                grid-template-columns: 1fr;
                text-align: center;
                gap: 2rem;
            }

            .hero-content h2 {
                font-size: 2rem;
            }

            .hero-logo {
                width: 280px;
                height: 280px;
                padding: 1.5rem;
            }

            .hero-image {
                order: -1;
            }

            .hero-logo-text {
                font-size: 1rem;
            }

            .cupcake-illustration {
                width: 80px;
                height: 80px;
            }

            .hero-logo-brand {
                font-size: 2rem;
            }

            .featured-grid,
            .categories-grid,
            .about-features {
                grid-template-columns: 1fr;
            }

            .footer-content {
                grid-template-columns: 1fr;
                text-align: center;
            }

            .section-title {
                font-size: 2rem;
            }

            .hero-buttons {
                justify-content: center;
            }
        }

        @media (max-width: 480px) {
            .container {
                padding: 0 14px;
            }

            .nav-container {
                align-items: stretch;
            }

            .nav-brand {
                justify-content: center;
            }

            .nav-menu {
                gap: 0.45rem;
            }

            .nav-brand-text h1 {
                font-size: 1.4rem;
            }

            .hero-content h2 {
                font-size: 1.75rem;
            }

            .home-alert {
                padding: 0.9rem 1rem;
            }

            .btn {
                width: 100%;
            }

            .hero-buttons {
                gap: 0.75rem;
            }

            .floating-order-btn {
                left: 14px;
                right: 14px;
                bottom: 14px;
                justify-content: center;
                font-size: 1rem;
                padding: 0.9rem 1rem;
            }
        }

        .floating-order-btn {
            position: fixed;
            bottom: 30px;
            right: 30px;
            background: linear-gradient(135deg, #B8336A, #F4A261);
            color: white;
            padding: 1rem 1.5rem;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 700;
            font-size: 1.1rem;
            box-shadow: 0 4px 20px rgba(184, 51, 106, 0.4);
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
            z-index: 1000;
        }

        .floating-order-btn:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 25px rgba(184, 51, 106, 0.6);
        }

        .floating-order-btn .icon {
            font-size: 1.5rem;
            animation: bounce 2s infinite;
        }

        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-5px); }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar">
        <div class="nav-container">
            <div class="nav-brand">
                <div class="logo-circle">
                    <img src="/images/logo-nav.png" alt="Donatoku Logo" class="nav-logo-img">
                </div>
                <div class="nav-brand-text">
                    <h1>DONATOKU</h1>
                    <p>Your Daily Dose of Sweetness</p>
                </div>
            </div>
            <div class="nav-menu">
                <a href="{{ route('home') }}" class="nav-link active">Beranda</a>
                <a href="{{ route('menu.kue-tart') }}" class="nav-link">Kue Tart</a>
                <a href="{{ route('menu.brownies') }}" class="nav-link">Brownies</a>
                <a href="{{ route('menu.bento-cake') }}" class="nav-link">Bento Cake</a>
                <a href="{{ route('menu.lekker-holland') }}" class="nav-link">Lekker Holland</a>

                @if(Auth::check())
                    <div class="user-menu">
                        <span class="user-name">Hi, {{ Auth::user()->name }}!</span>
                        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" class="logout-button">Logout</button>
                        </form>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="login-button">Login</a>
                @endif
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-container">
            <div class="hero-content">
                @if(session('success'))
                    <div class="home-alert home-alert-success">{{ session('success') }}</div>
                @endif

                @if(session('whatsapp_url'))
                    <div class="home-alert home-alert-success">
                        <strong>Konfirmasi Pesanan:</strong>
                        <p>Pesanan Anda sudah tersimpan. Klik tombol di bawah untuk konfirmasi via WhatsApp.</p>
                        <a href="{{ session('whatsapp_url') }}" target="_blank" class="btn btn-primary" style="display:inline-block; margin-top:0.75rem;">Konfirmasi ke WhatsApp</a>
                    </div>
                @endif

                <h2>Selamat Datang di DONATOKU</h2>
                <p>Nikmati kelezatan kue tart, brownies, dan berbagai kue spesial lainnya yang dibuat dengan cinta dan bahan-bahan berkualitas terbaik.</p>
                <div class="hero-buttons">
                    <a href="{{ route('menu.kue-tart') }}" class="btn btn-primary">Lihat Menu</a>
                    <a href="#featured" class="btn btn-secondary">Produk Unggulan</a>
                </div>
            </div>
            <div class="hero-image">
                <img src="/images/logo-hero.png" alt="DONATOKU Logo" class="hero-logo-img">
            </div>
        </div>
    </section>

    <!-- Featured Products -->
    <section id="featured" class="featured">
        <div class="container">
            <h2 class="section-title">Produk Unggulan</h2>
            <div class="featured-grid">
                @foreach($featuredProducts as $product)
                <div class="featured-card">
                    <div class="card-image">
                        @if($product['category'] == 'Kue Tart')
                            <img src="/images/icon-kue-tart.png" alt="Kue Tart Icon" class="product-icon-img">
                        @elseif($product['category'] == 'Brownies')
                            <img src="/images/icon-brownies.png" alt="Brownies Icon" class="product-icon-img">
                        @elseif($product['category'] == 'Bento Cake')
                            <img src="/images/icon-bento-cake.png" alt="Bento Cake Icon" class="product-icon-img">
                        @elseif($product['category'] == 'Lekker Holland')
                            <img src="/images/icon-lekker-holland.png" alt="Lekker Holland Icon" class="product-icon-img">
                        @else
                            <img src="/images/icon-featured-product.png" alt="Featured Product" class="product-icon-img">
                        @endif
                    </div>
                    <div class="card-content">
                        <h3>{{ $product['name'] }}</h3>
                        <p class="category">{{ $product['category'] }}</p>
                        <p class="price">{{ $product['price'] }}</p>
                        <a href="{{ route('customer.create-order', ['product_name' => $product['name']]) }}" class="card-btn">Lihat Detail</a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Menu Categories -->
    <section class="categories">
        <div class="container">
            <h2 class="section-title">Kategori Menu</h2>
            <div class="categories-grid">
                <a href="{{ route('menu.kue-tart') }}" class="category-card">
                    <div class="category-icon">
                        <img src="/images/icon-kue-tart.png" alt="Kue Tart" style="width: 80px; height: 80px; object-fit: contain;">
                    </div>
                    <h3>Kue Tart</h3>
                    <p>Berbagai macam kue tart dengan dekorasi menarik</p>
                </a>
                <a href="{{ route('menu.brownies') }}" class="category-card">
                    <div class="category-icon">
                        <img src="/images/icon-brownies.png" alt="Brownies" style="width: 80px; height: 80px; object-fit: contain;">
                    </div>
                    <h3>Brownies</h3>
                    <p>Brownies lezat dalam berbagai ukuran dan variasi</p>
                </a>
                <a href="{{ route('menu.bento-cake') }}" class="category-card">
                    <div class="category-icon">
                        <img src="/images/icon-bento-cake.png" alt="Bento Cake" style="width: 80px; height: 80px; object-fit: contain;">
                    </div>
                    <h3>Bento Cake</h3>
                    <p>Kue mini lucu dalam kotak bento</p>
                </a>
                <a href="{{ route('menu.lekker-holland') }}" class="category-card">
                    <div class="category-icon">
                        <img src="/images/icon-lekker-holland.png" alt="Lekker Holland" style="width: 80px; height: 80px; object-fit: contain;">
                    </div>
                    <h3>Lekker Holland</h3>
                    <p>Kue khas Belanda dengan cita rasa autentik</p>
                </a>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="about">
        <div class="container">
            <div class="about-content">
                <h2>Tentang Donatoku De Patisserie</h2>
                <p>Kami adalah toko kue yang berkomitmen untuk menyajikan produk berkualitas tinggi dengan cita rasa yang tak terlupakan. Setiap kue dibuat dengan penuh perhatian dan menggunakan bahan-bahan terbaik.</p>
                <div class="about-features">
                    <div class="feature">
                        <span class="feature-icon">✨</span>
                        <h4>Kualitas Terbaik</h4>
                        <p>Menggunakan bahan-bahan premium</p>
                    </div>
                    <div class="feature">
                        <span class="feature-icon">🎨</span>
                        <h4>Desain Custom</h4>
                        <p>Bisa request desain sesuai keinginan</p>
                    </div>
                    <div class="feature">
                        <span class="feature-icon">🚚</span>
                        <h4>Delivery</h4>
                        <p>Pengiriman cepat dan aman</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-brand">
                    <div class="footer-logo">
                        <div class="logo-circle">
                            <img src="/images/logo-nav.png" alt="Donatoku Logo" class="nav-logo-img">
                        </div>
                        <div>
                            <h3>DONATOKU</h3>
                            <p>Your Daily Dose of Sweetness</p>
                        </div>
                    </div>
                </div>
                <div class="footer-info">
                    <p>Hubungi kami untuk pemesanan:</p>
                    <p>📞 085708123616</p>
                    <p>📱 @donatoku_</p>
                    <p>📍 Jl. Sakura No.26b, Tulungrejo, Kec. Pare, Kabupaten Kediri, Jawa Timur 64212, Indonesia</p>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2025 Donatoku De Patisserie. All rights reserved.</p>
            </div>
        </div>
    </footer>

    @auth
        @if(auth()->user()->user_type === 'customer')
            <a href="{{ route('customer.create-order') }}" class="floating-order-btn">
                <span class="icon">🛒</span>
                <span>Pesan Sekarang</span>
            </a>
        @endif
    @else
        <a href="{{ route('login') }}" class="floating-order-btn">
            <span class="icon">🛒</span>
            <span>Pesan Sekarang</span>
        </a>
    @endauth
</body>
</html>

