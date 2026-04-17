<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Dashboard - Donatoku De Patisserie</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        :root {
            --primary-pink: #FF6B9D;
            --primary-orange: #FF8E53;
            --cream: #FFF8E1;
            --white: #FFFFFF;
            --text-dark: #2C3E50;
            --text-light: #7F8C8D;
            --shadow: rgba(0,0,0,0.1);
            --success: #27AE60;
            --warning: #F39C12;
            --danger: #E74C3C;
        }

        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
        background: var(--cream); }

        .navbar {
            background: linear-gradient(135deg, var(--primary-pink), var(--primary-orange));
            padding: 1rem 2rem; color: var(--white);
            display: flex; justify-content: space-between; align-items: center;
            box-shadow: 0 2px 10px var(--shadow);
        }

        .navbar-brand { display: flex; align-items: center; }
        .navbar-brand img { height: 50px; }

        .navbar-menu {
            display: flex; gap: 2rem; list-style: none;
        }

        .navbar-menu a {
            color: var(--white); text-decoration: none; padding: 0.5rem 1rem;
            border-radius: 20px; transition: all 0.3s ease;
        }
        .navbar-menu a:hover, .navbar-menu a.active { background: rgba(255,255,255,0.2); }

        .logout-btn {
            padding: 0.8rem 1.5rem; background: rgba(255,255,255,0.2);
            color: var(--white); border: none; border-radius: 25px; cursor: pointer;
            text-decoration: none; transition: all 0.3s ease;
        }
        .logout-btn:hover { background: rgba(255,255,255,0.3); }

        .container { max-width: 1200px; margin: 0 auto; padding: 2rem; }

        .welcome-section {
            background: var(--white); padding: 2rem; border-radius: 15px;
            box-shadow: 0 5px 15px var(--shadow); margin-bottom: 2rem;
            text-align: center;
        }

        .welcome-section h1 { color: var(--text-dark); margin-bottom: 1rem; }
        .welcome-section p { color: var(--text-light); font-size: 1.1rem; }

        .stats-grid {
            display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem; margin-bottom: 2rem;
        }

        .stat-card {
            background: var(--white); padding: 2rem; border-radius: 15px;
            box-shadow: 0 5px 15px var(--shadow); text-align: center;
            transition: all 0.3s ease;
        }
        .stat-card:hover { transform: translateY(-5px); }

        .stat-icon {
            width: 60px; height: 60px; border-radius: 50%; margin: 0 auto 1rem;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.5rem; color: var(--white);
            background: linear-gradient(135deg, var(--primary-pink), var(--primary-orange));
        }

        .stat-number { font-size: 2rem; font-weight: 700; color: var(--text-dark); margin-bottom: 0.5rem; }
        .stat-label { color: var(--text-light); font-size: 1rem; }

        .action-buttons {
            display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem; margin-bottom: 2rem;
        }

        .action-btn {
            background: linear-gradient(135deg, var(--primary-pink), var(--primary-orange));
            color: var(--white); padding: 1.5rem; border-radius: 15px;
            text-decoration: none; text-align: center; font-weight: 600;
            transition: all 0.3s ease; box-shadow: 0 5px 15px var(--shadow);
        }
        .action-btn:hover { transform: translateY(-3px); box-shadow: 0 10px 25px var(--shadow); }

        .recent-orders {
            background: var(--white); padding: 2rem; border-radius: 15px;
            box-shadow: 0 5px 15px var(--shadow);
        }

        .recent-orders h3 { color: var(--text-dark); margin-bottom: 1.5rem; font-size: 1.3rem; }

        .orders-table {
            width: 100%; border-collapse: collapse;
        }

        .orders-table th {
            background: var(--cream); padding: 1rem; text-align: left;
            color: var(--text-dark); font-weight: 600; border-radius: 5px;
        }

        .orders-table td {
            padding: 1rem; border-bottom: 1px solid #ECF0F1;
        }

        .status-badge {
            padding: 0.4rem 0.8rem; border-radius: 20px; font-size: 0.8rem;
            font-weight: 600; text-transform: uppercase;
        }

        .status-pending { background: #FEF3CD; color: #B7950B; }
        .status-preparing { background: #D5E8FF; color: #1F4E79; }
        .status-ready { background: #D1F2EB; color: #0E6B47; }
        .status-delivered { background: #D5EDDA; color: #155724; }
        .status-cancelled { background: #F8D7DA; color: #721C24; }

        .alert {
            padding: 1rem 1.5rem; border-radius: 10px; margin-bottom: 1rem;
        }
        .alert-success { background: #D1F2EB; color: #0E6B47; border-left: 4px solid var(--success); }

        .floating-order-btn {
            position: fixed;
            bottom: 30px;
            right: 30px;
            background: linear-gradient(135deg, var(--primary-pink), var(--primary-orange));
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
    <nav class="navbar">
        <div class="navbar-brand">
            <img src="{{ asset('images/logo-nav.png') }}" alt="Donatoku De Patisserie">
        </div>
        <ul class="navbar-menu">
            <li><a href="{{ route('customer.dashboard') }}" class="active">Dashboard</a></li>
            <li><a href="{{ route('customer.orders') }}">Riwayat Pesanan</a></li>
            <li><a href="{{ route('home') }}">Menu</a></li>
        </ul>
        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
            @csrf
            <button type="submit" class="logout-btn">Logout</button>
        </form>
    </nav>

    <div class="container">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(session('whatsapp_url'))
            <div class="alert alert-success">
                <strong>Konfirmasi Pesanan:</strong>
                <p>Pesanan Anda sudah tersimpan. Jika ingin mengirimkan pesanan ini ke WhatsApp Donatoku, klik tombol di bawah.</p>
                <a href="{{ session('whatsapp_url') }}" target="_blank" class="btn btn-success">Konfirmasi ke WhatsApp</a>
            </div>
        @endif

        <div class="welcome-section">
            <h1>Selamat Datang, {{ Auth::user()->name }}! 👋</h1>
            <p>Nikmati pengalaman berbelanja kue dan donat terbaik dari Donatoku De Patisserie</p>
        </div>

        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon">📋</div>
                <div class="stat-number">{{ $totalOrders }}</div>
                <div class="stat-label">Total Pesanan</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">⏳</div>
                <div class="stat-number">{{ $pendingOrders }}</div>
                <div class="stat-label">Pesanan Pending</div>
            </div>
        </div>

        <div class="action-buttons">
            <a href="{{ route('customer.create-order') }}" class="action-btn" style="grid-column: 1 / -1; background: linear-gradient(135deg, var(--primary-pink), var(--primary-orange)); color: white; font-size: 1.1rem;">
                🛒 Buat Pesanan Baru
            </a>
            <a href="{{ route('menu.kue-tart') }}" class="action-btn">
                🎂 Kue Tart
            </a>
            <a href="{{ route('menu.brownies') }}" class="action-btn">
                🍫 Brownies
            </a>
            <a href="{{ route('menu.bento-cake') }}" class="action-btn">
                🍱 Bento Cake
            </a>
            <a href="{{ route('menu.lekker-holland') }}" class="action-btn">
                🥐 Lekker Holland
            </a>
        </div>

        <div class="recent-orders">
            <h3>Pesanan Terbaru</h3>
            @if($orders->count() > 0)
                <table class="orders-table">
                    <thead>
                        <tr>
                            <th>PO Number</th>
                            <th>Produk</th>
                            <th>Ukuran & Qty</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                        <tr>
                            <td>{{ $order->po_number ?? 'N/A' }}</td>
                            <td>{{ $order->product_name }}</td>
                            <td>{{ $order->product_size }} ({{ $order->quantity }}x)</td>
                            <td>Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                            <td>
                                <span class="status-badge status-{{ $order->status }}">
                                    @if($order->status == 'pending') Pending
                                    @elseif($order->status == 'delivered') Selesai
                                    @elseif($order->status == 'cancelled') Dibatalkan
                                    @else {{ ucfirst($order->status) }}
                                    @endif
                                </span>
                            </td>
                            <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p style="text-align: center; color: var(--text-light); padding: 2rem;">
                    Anda belum memiliki pesanan.
                    <a href="{{ route('menu.kue-tart') }}" style="color: var(--primary-pink);">Lihat menu kami!</a>
                </p>
            @endif
        </div>
    </div>

    <a href="{{ route('customer.create-order') }}" class="floating-order-btn">
        <span class="icon">🛒</span>
        <span>Pesan Sekarang</span>
    </a>
</body>
</html>
