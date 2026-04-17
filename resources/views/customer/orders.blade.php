<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pesanan - Donatoku De Patisserie</title>
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

        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: var(--cream); }

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

        .page-header {
            background: var(--white); padding: 2rem; border-radius: 15px;
            box-shadow: 0 5px 15px var(--shadow); margin-bottom: 2rem; text-align: center;
        }

        .page-header h1 { color: var(--text-dark); margin-bottom: 0.5rem; }

        .orders-section {
            background: var(--white); padding: 2rem; border-radius: 15px;
            box-shadow: 0 5px 15px var(--shadow);
        }

        .orders-section h3 { color: var(--text-dark); margin-bottom: 1.5rem; font-size: 1.3rem; }

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

        .btn-back {
            display: inline-block; padding: 0.8rem 1.5rem; background: var(--text-light);
            color: var(--white); text-decoration: none; border-radius: 8px; margin-bottom: 1rem;
        }

        .pagination {
            display: flex; justify-content: center; margin-top: 2rem; gap: 0.5rem;
        }

        .pagination a, .pagination span {
            padding: 0.5rem 1rem; background: var(--white); color: var(--text-dark);
            text-decoration: none; border-radius: 5px; border: 1px solid #ECF0F1;
        }

        .pagination .active { background: var(--primary-pink); color: var(--white); }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="navbar-brand">
            <img src="{{ asset('images/logo-nav.png') }}" alt="Donatoku De Patisserie">
        </div>
        <ul class="navbar-menu">
            <li><a href="{{ route('customer.dashboard') }}">Dashboard</a></li>
            <li><a href="{{ route('home') }}">Menu</a></li>
        </ul>
        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
            @csrf
            <button type="submit" class="logout-btn">Logout</button>
        </form>
    </nav>

    <div class="container">
        <a href="{{ route('customer.dashboard') }}" class="btn-back">← Kembali ke Dashboard</a>

        <div class="page-header">
            <h1>📋 Riwayat Pesanan</h1>
            <p>Lihat semua pesanan Anda di Donatoku De Patisserie</p>
        </div>

        <div class="orders-section">
            <h3>Semua Pesanan</h3>
            @if($orders->count() > 0)
                <table class="orders-table">
                    <thead>
                        <tr>
                            <th>PO Number</th>
                            <th>Produk</th>
                            <th>Ukuran & Qty</th>
                            <th>Pickup</th>
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
                            <td>{{ $order->pickup_date ? $order->pickup_date->format('d/m/Y') : '—' }} {{ $order->pickup_time ?? '' }}</td>
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

                <div class="pagination">
                    {{ $orders->links() }}
                </div>
            @else
                <p style="text-align: center; color: var(--text-light); padding: 2rem;">
                    Anda belum memiliki pesanan.
                    <a href="{{ route('customer.create-order') }}" style="color: var(--primary-pink);">Buat pesanan pertama Anda!</a>
                </p>
            @endif
        </div>
    </div>
</body>
</html>