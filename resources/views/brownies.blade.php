<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Brownies - Donatoku De Patisserie</title>

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

        /* Menu Section */
        .menu-section {
            padding: 4rem 0;
            min-height: 80vh;
        }

        .menu-header {
            text-align: center;
            margin-bottom: 3rem;
        }

        .menu-header h1 {
            font-size: 3rem;
            color: var(--primary-pink);
            margin-bottom: 1rem;
        }

        .menu-header p {
            font-size: 1.2rem;
            color: var(--text-light);
        }

        .menu-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-top: 3rem;
        }

        .menu-item {
            background: var(--white);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 8px 25px var(--shadow);
            transition: all 0.3s ease;
        }

        .menu-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px var(--shadow);
        }

        .menu-item-image {
            width: 100%;
            height: 250px;
            object-fit: cover;
        }

        .menu-item-content {
            padding: 1.5rem;
        }

        .menu-item h3 {
            color: var(--primary-pink);
            font-size: 1.4rem;
            margin-bottom: 0.5rem;
        }

        .menu-item p {
            color: var(--text-light);
            margin-bottom: 1rem;
        }

        .menu-item-price {
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--primary-orange);
        }

        /* Footer */
        .footer {
            background: var(--primary-pink);
            color: var(--white);
            text-align: center;
            padding: 2rem 0;
            margin-top: 4rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .nav-container {
                flex-direction: column;
                gap: 1rem;
            }

            .nav-menu {
                flex-wrap: wrap;
                justify-content: center;
                gap: 1rem;
            }

            .menu-header h1 {
                font-size: 2rem;
            }

            .menu-grid {
                grid-template-columns: 1fr;
            }
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
                <a href="{{ route('home') }}" class="nav-link">Beranda</a>
                <a href="{{ route('menu.kue-tart') }}" class="nav-link">Kue Tart</a>
                <a href="{{ route('menu.brownies') }}" class="nav-link active">Brownies</a>
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

    <!-- Menu Section -->
    <section class="menu-section">
        <div class="container">
            <div class="menu-header">
                <h1>Brownies</h1>
                <p>Brownies lembut dan fudgy dengan berbagai topping menarik untuk memanjakan lidah Anda</p>
            </div>

            <div class="menu-grid">
                <div class="menu-item">
                    <img src="/images/brownies-1.jpg" alt="Brownies Coklat Original" class="menu-item-image">
                    <div class="menu-item-content">
                        <h3>Brownies Coklat Original</h3>
                        <p>Brownies klasik dengan rasa coklat yang kaya dan tekstur yang fudgy</p>
                        <div class="menu-item-price">Rp 45.000</div>
                    </div>
                </div>

                <div class="menu-item">
                    <img src="/images/brownies-2.jpg" alt="Brownies Kacang" class="menu-item-image">
                    <div class="menu-item-content">
                        <h3>Brownies Kacang</h3>
                        <p>Brownies dengan topping kacang yang renyah dan gurih</p>
                        <div class="menu-item-price">Rp 50.000</div>
                    </div>
                </div>

                <div class="menu-item">
                    <img src="/images/brownies-3.jpg" alt="Brownies Keju" class="menu-item-image">
                    <div class="menu-item-content">
                        <h3>Brownies Keju</h3>
                        <p>Perpaduan sempurna antara coklat manis dan keju yang asin</p>
                        <div class="menu-item-price">Rp 55.000</div>
                    </div>
                </div>

                <div class="menu-item">
                    <img src="/images/brownies-4.jpg" alt="Brownies Cream Cheese" class="menu-item-image">
                    <div class="menu-item-content">
                        <h3>Brownies Cream Cheese</h3>
                        <p>Brownies dengan lapisan cream cheese yang lembut dan creamy</p>
                        <div class="menu-item-price">Rp 60.000</div>
                    </div>
                </div>

                <div class="menu-item">
                    <img src="/images/brownies-5.jpg" alt="Brownies Oreo" class="menu-item-image">
                    <div class="menu-item-content">
                        <h3>Brownies Oreo</h3>
                        <p>Brownies dengan topping remahan oreo yang renyah</p>
                        <div class="menu-item-price">Rp 58.000</div>
                    </div>
                </div>

                <div class="menu-item">
                    <img src="/images/brownies-6.jpg" alt="Brownies Salted Caramel" class="menu-item-image">
                    <div class="menu-item-content">
                        <h3>Brownies Salted Caramel</h3>
                        <p>Brownies dengan saus salted caramel yang manis dan sedikit asin</p>
                        <div class="menu-item-price">Rp 65.000</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <p>&copy; 2024 Donatoku De Patisserie. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
