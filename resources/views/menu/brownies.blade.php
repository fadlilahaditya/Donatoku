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
        /* Same CSS as homepage */
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
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Poppins', sans-serif; line-height: 1.6; color: var(--text-dark); background-color: var(--cream); overflow-x: hidden; }
        .container { max-width: 1200px; margin: 0 auto; padding: 0 20px; }
        .navbar { background: linear-gradient(135deg, var(--primary-pink), var(--primary-orange)); padding: 1rem 0; box-shadow: 0 2px 10px var(--shadow); position: sticky; top: 0; z-index: 1000; }
        .nav-container { display: flex; justify-content: space-between; align-items: center; max-width: 1200px; margin: 0 auto; padding: 0 20px; }
        .nav-brand { display: flex; align-items: center; gap: 1rem; }
        .logo-circle { width: 65px; height: 65px; border-radius: 50%; display: flex; align-items: center; justify-content: center; position: relative; box-shadow: 0 4px 12px rgba(184, 51, 106, 0.3); border: 2px solid var(--primary-pink); overflow: hidden; }
        .nav-logo-img { width: 100%; height: 100%; object-fit: cover; border-radius: 50%; }
        .nav-brand-text h1 { color: var(--white); font-size: 1.8rem; font-weight: 700; margin-bottom: -5px; }
        .nav-brand-text p { color: var(--cream); font-size: 0.8rem; font-weight: 300; font-style: italic; }
        .nav-menu { display: flex; gap: 2rem; }
        .nav-link { color: var(--white); text-decoration: none; font-weight: 500; padding: 0.5rem 1rem; border-radius: 25px; transition: all 0.3s ease; }
        .nav-link:hover, .nav-link.active { background: rgba(255, 255, 255, 0.2); transform: translateY(-2px); }
        .menu-header { background: linear-gradient(135deg, var(--primary-pink), var(--primary-orange)); padding: 3rem 0; text-align: center; color: var(--white); }
        .menu-header h1 { font-size: 3rem; font-weight: 700; margin-bottom: 1rem; }
        .menu-header p { font-size: 1.2rem; opacity: 0.9; }
        .products { padding: 4rem 0; background: var(--cream); }
        .products-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 2rem; }
        .product-card { background: var(--white); border-radius: 20px; padding: 2rem; box-shadow: 0 10px 30px var(--shadow); transition: all 0.3s ease; }
        .product-card:hover { transform: translateY(-5px); box-shadow: 0 20px 40px var(--shadow); }
        .product-image { width: 100px; height: 100px; background: linear-gradient(135deg, var(--primary-orange), var(--primary-pink)); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem; font-size: 3rem; overflow: hidden; }
        .product-icon-img { width: 80px; height: 80px; object-fit: contain; border-radius: 50%; padding: 10px; background: var(--white); }
        .product-content h3 { font-size: 1.5rem; font-weight: 600; color: var(--text-dark); margin-bottom: 1rem; text-align: center; }
        .product-sizes { margin-bottom: 1.5rem; }
        .size-option { display: flex; justify-content: space-between; align-items: center; padding: 0.8rem; margin-bottom: 0.5rem; background: var(--cream); border-radius: 10px; cursor: pointer; }
        .size-option.selected { border: 2px solid var(--primary-pink); background: #fff; }
        .size { font-weight: 500; color: var(--text-dark); }
        .product-price { text-align: center; margin-bottom: 1.5rem; }
        .price { font-size: 1.3rem; font-weight: 600; color: var(--primary-pink); }
        .product-description { text-align: center; color: var(--text-light); margin-bottom: 1.5rem; font-style: italic; }
        .product-card .btn { width: 100%; margin-top: 1rem; }
        .btn { padding: 1rem 2rem; border: none; border-radius: 50px; font-weight: 600; text-decoration: none; cursor: pointer; transition: all 0.3s ease; display: inline-block; text-align: center; }
        .btn-primary { background: linear-gradient(135deg, var(--primary-pink), var(--primary-orange)); color: var(--white); }
        .btn-primary:hover { transform: translateY(-3px); box-shadow: 0 10px 25px var(--shadow); }
        .footer { background: linear-gradient(135deg, var(--primary-pink), var(--primary-orange)); color: var(--white); padding: 3rem 0 1rem; }
        .footer-content { display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; margin-bottom: 2rem; }
        .footer-brand h3 { font-size: 1.8rem; font-weight: 700; margin-bottom: -5px; }
        .footer-brand p { font-size: 0.9rem; font-weight: 300; font-style: italic; opacity: 0.8; }
        .footer-info p { margin-bottom: 0.5rem; opacity: 0.9; }
        .footer-bottom { text-align: center; padding-top: 2rem; border-top: 1px solid rgba(255, 255, 255, 0.2); opacity: 0.7; }
        @media (max-width: 768px) {
            .nav-container { flex-direction: column; gap: 0.75rem; padding: 0 14px; }
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
            .nav-link { padding: 0.45rem 0.85rem; font-size: 0.92rem; flex: 0 0 auto; }
            .products-grid { grid-template-columns: 1fr; }
            .footer-content { grid-template-columns: 1fr; text-align: center; }
            .menu-header h1 { font-size: 2rem; }
            .menu-header { padding: 2rem 0; }
            .products { padding: 2.5rem 0; }
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
            </div>
        </div>
    </nav>

    <!-- Menu Header -->
    <section class="menu-header">
        <div class="container">
            <h1>Brownies</h1>
            <p>Brownies lezat dengan berbagai variasi dan ukuran</p>
        </div>
    </section>

    <!-- Products Grid -->
    <section class="products">
        <div class="container">
            <div class="products-grid">
                @foreach($products as $product)
                <div class="product-card">
                    <div class="product-image">
                        @if($product['name'] == 'Fudgie Brownies Standard')
                            <img src="/images/FudgieBrowniesStandard.jpeg" alt="Fudgie Brownies Standard" class="product-icon-img">
                        @elseif($product['name'] == 'Basecake Brownies')
                            <img src="/images/BasecakeBrownies.jpeg" alt="Basecake Brownies" class="product-icon-img">
                        @elseif($product['name'] == 'Cup Brownies')
                            <img src="/images/CupBrownies.jpeg" alt="Cup Brownies" class="product-icon-img">
                        @elseif($product['name'] == 'Brownies Cup Hias')
                            <img src="/images/BrowniesCupHias.jpeg" alt="Brownies Cup Hias" class="product-icon-img">
                        @elseif($product['name'] == 'Fudgy Hias')
                            <img src="/images/FudgyHias.jpeg" alt="Fudgy Hias" class="product-icon-img">
                        @elseif($product['name'] == 'Fudgy Brownies Hias')
                            <img src="/images/FudgyBrowniesHias.jpeg" alt="Fudgy Brownies Hias" class="product-icon-img">
                        @elseif($product['name'] == 'Brownies Cup')
                            <img src="/images/BrowniesCup.jpeg" alt="Brownies Cup" class="product-icon-img">
                        @elseif($product['name'] == 'Pop Slice')
                            <img src="/images/PopSlice.jpeg" alt="Pop Slice" class="product-icon-img">
                        @else
                            <img src="/images/icon-brownies.png" alt="Brownies" class="product-icon-img">
                        @endif
                    </div>
                    <div class="product-content">
                        <h3>{{ $product['name'] }}</h3>

                        @if(isset($product['sizes']))
                            <div class="product-sizes">
                                @foreach($product['sizes'] as $size)
                                <div class="size-option" data-size="{{ $size['size'] }}" data-price="{{ $size['price'] }}">
                                    <span class="size">{{ $size['size'] }}</span>
                                    <span class="price">Rp {{ number_format($size['price'], 0, ',', '.') }}</span>
                                </div>
                                @endforeach
                            </div>
                        @else
                            <div class="product-price">
                                <span class="price">Rp {{ number_format($product['price'], 0, ',', '.') }}</span>
                            </div>
                        @endif

                        @if(isset($product['description']))
                            <p class="product-description">{{ $product['description'] }}</p>
                        @endif

                        <button class="btn btn-primary" data-product="{{ $product['name'] }}">Pesan Sekarang</button>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <script>
        (function(){
            const ORDER_URL = "{{ route('customer.create-order') }}";
            document.querySelectorAll('.product-card').forEach(card => {
                const sizes = card.querySelectorAll('.size-option');
                sizes.forEach(s => {
                    s.tabIndex = 0;
                    s.addEventListener('click', () => {
                        sizes.forEach(x => x.classList.remove('selected'));
                        s.classList.add('selected');
                    });
                    s.addEventListener('keydown', (e) => { if (e.key === 'Enter') s.click(); });
                });

                const btn = card.querySelector('.btn-primary');
                if (btn) {
                    btn.addEventListener('click', () => {
                        const product = btn.dataset.product || '';
                        const selected = card.querySelector('.size-option.selected');
                        const size = selected ? selected.dataset.size : '';
                        let url = ORDER_URL + '?product_name=' + encodeURIComponent(product);
                        if (size) url += '&product_size=' + encodeURIComponent(size);
                        window.location.href = url;
                    });
                }
            });
        })();
    </script>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-brand">
                    <h3>DONATOKU</h3>
                    <p>Your Daily Dose of Sweetness</p>
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
</body>
</html>
