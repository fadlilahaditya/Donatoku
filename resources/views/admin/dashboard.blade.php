<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Donatoku De Patisserie</title>
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

        .sidebar {
            position: fixed; left: 0; top: 0; width: 250px; height: 100vh;
            background: linear-gradient(135deg, var(--primary-pink), var(--primary-orange));
            padding: 2rem 0; z-index: 1000;
        }

        .sidebar-header {
            text-align: center; margin-bottom: 2rem; color: var(--white);
        }

        .sidebar-header h2 { font-size: 1.5rem; margin-bottom: 0.5rem; }
        .sidebar-header p { opacity: 0.8; font-size: 0.9rem; }

        .sidebar-menu { list-style: none; }
        .sidebar-menu li { margin-bottom: 0.5rem; }
        .sidebar-menu a {
            display: block; padding: 1rem 2rem; color: var(--white);
            text-decoration: none; transition: all 0.3s ease;
        }
        .sidebar-menu a:hover, .sidebar-menu a.active {
            background: rgba(255,255,255,0.2); transform: translateX(5px);
        }

        .main-content {
            margin-left: 250px; padding: 2rem;
        }

        .header {
            background: var(--white); padding: 1.5rem 2rem; border-radius: 15px;
            box-shadow: 0 5px 15px var(--shadow); margin-bottom: 2rem;
            display: flex; justify-content: space-between; align-items: center;
        }

        .header h1 { color: var(--text-dark); font-size: 2rem; }

        .logout-btn {
            padding: 0.8rem 1.5rem; background: linear-gradient(135deg, var(--danger), #C0392B);
            color: var(--white); border: none; border-radius: 25px; cursor: pointer;
            text-decoration: none; transition: all 0.3s ease;
        }
        .logout-btn:hover { transform: translateY(-2px); box-shadow: 0 5px 15px var(--shadow); }

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
        }

        .stat-customers .stat-icon { background: linear-gradient(135deg, var(--primary-pink), var(--primary-orange)); }
        .stat-orders .stat-icon { background: linear-gradient(135deg, var(--success), #229954); }
        .stat-revenue .stat-icon { background: linear-gradient(135deg, var(--warning), #D68910); }

        .stat-number { font-size: 2rem; font-weight: 700; color: var(--text-dark); margin-bottom: 0.5rem; }
        .stat-label { color: var(--text-light); font-size: 1rem; }

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
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-header">
            <img src="{{ asset('images/logo-nav.png') }}" alt="Donatoku" style="height: 60px; margin-bottom: 0.5rem;">
            <p>Admin Panel</p>
        </div>
        <ul class="sidebar-menu">
            <li><a href="{{ route('admin.dashboard') }}" class="active">📊 Dashboard</a></li>
            <li><a href="{{ route('admin.orders') }}">📋 Pesanan</a></li>
            <li><a href="{{ route('admin.order.track') }}">🔎 Cek PO</a></li>
            <li><a href="{{ route('admin.menus') }}">🍰 Kelola Menu</a></li>
            <li><a href="{{ route('home') }}">🏠 Website</a></li>
        </ul>
    </div>

    <div class="main-content">
        <div class="header">
            <h1>Dashboard Admin</h1>
            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="logout-btn">Logout</button>
            </form>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="stats-grid">
            <div class="stat-card stat-customers">
                <div class="stat-icon">👥</div>
                <div class="stat-number">{{ $totalCustomers }}</div>
                <div class="stat-label">Total Pelanggan</div>
            </div>
            <div class="stat-card stat-orders">
                <div class="stat-icon">📋</div>
                <div class="stat-number">{{ $totalOrders }}</div>
                <div class="stat-label">Total Pesanan</div>
            </div>
            <div class="stat-card stat-revenue">
                <div class="stat-icon">💰</div>
                <div class="stat-number">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</div>
                <div class="stat-label">Total Pendapatan</div>
            </div>
        </div>

        <div class="recent-orders">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
                <h3>Pesanan Terbaru</h3>
                <a href="{{ route('admin.orders') }}" style="color: var(--primary-pink); text-decoration: none; font-weight: 600;">
                    Lihat Semua →
                </a>
            </div>
            @if($recentOrders->count() > 0)
                <table class="orders-table">
                    <thead>
                        <tr>
                            <th>Pelanggan</th>
                            <th>Produk</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recentOrders as $order)
                        <tr>
                            <td>{{ $order->user->name }}</td>
                            <td>{{ $order->product_name }}</td>
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
                    Belum ada pesanan
                </p>
            @endif
        </div>
    </div>
</body>
</html>
