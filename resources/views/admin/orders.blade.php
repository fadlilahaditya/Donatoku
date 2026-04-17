<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Pesanan - Admin Donatoku</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        :root {
            --primary-pink: #B8336A;
            --primary-orange: #F4A261;
            --cream: #FAF0E6;
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

        .navbar-menu { display: flex; gap: 1.5rem; align-items: center; }
        .navbar-menu a {
            color: var(--white); text-decoration: none; padding: 0.5rem 1rem;
            border-radius: 8px; transition: all 0.3s ease;
        }
        .navbar-menu a:hover { background: rgba(255,255,255,0.2); }

        .logout-btn {
            padding: 0.8rem 1.5rem; background: rgba(255,255,255,0.2);
            color: var(--white); border: none; border-radius: 25px; cursor: pointer;
        }

        .container { max-width: 1200px; margin: 2rem auto; padding: 0 2rem; }

        .page-header {
            display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;
        }

        .page-header h1 { color: var(--primary-pink); font-size: 2rem; }

        .alert {
            padding: 1rem 1.5rem; border-radius: 10px; margin-bottom: 1.5rem;
        }
        .alert-success { background: #D4EDDA; color: #155724; border: 2px solid var(--success); }

        .orders-container {
            background: var(--white); border-radius: 15px;
            box-shadow: 0 4px 15px var(--shadow); padding: 2rem;
        }

        .orders-table {
            width: 100%; border-collapse: collapse;
        }

        .orders-table th {
            background: var(--cream); padding: 1rem; text-align: left;
            color: var(--text-dark); font-weight: 600;
        }

        .orders-table td {
            padding: 1rem; border-bottom: 1px solid #ECF0F1;
        }

        .status-badge {
            padding: 0.4rem 0.8rem; border-radius: 20px; font-size: 0.85rem;
            font-weight: 600; text-transform: uppercase; display: inline-block;
        }

        .status-pending { background: #FEF3CD; color: #B7950B; }
        .status-delivered { background: #D1F2EB; color: #0E6B47; }
        .status-cancelled { background: #F8D7DA; color: #721C24; }

        .action-buttons {
            display: flex; gap: 0.5rem;
        }

        .btn {
            padding: 0.5rem 1rem; border: none; border-radius: 5px;
            cursor: pointer; font-size: 0.9rem; transition: all 0.3s ease;
            text-decoration: none; display: inline-block;
        }

        .btn-success {
            background: var(--success); color: white;
        }

        .btn-success:hover {
            background: #229954;
        }

        .btn-danger {
            background: var(--danger); color: white;
        }

        .btn-danger:hover {
            background: #C0392B;
        }

        .btn:disabled {
            opacity: 0.5; cursor: not-allowed;
        }

        .empty-state {
            text-align: center; padding: 3rem; color: var(--text-light);
        }

        .filter-tabs {
            display: flex; gap: 1rem; margin-bottom: 1.5rem;
            border-bottom: 2px solid var(--cream);
        }

        .filter-tab {
            padding: 1rem 1.5rem; background: none; border: none;
            cursor: pointer; font-weight: 600; color: var(--text-light);
            border-bottom: 3px solid transparent; transition: all 0.3s ease;
        }

        .filter-tab.active {
            color: var(--primary-pink); border-bottom-color: var(--primary-pink);
        }

        .order-details {
            font-size: 0.9rem; color: var(--text-light);
            margin-top: 0.3rem;
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="navbar-brand">
            <img src="{{ asset('images/logo-nav.png') }}" alt="Admin Donatoku">
        </div>
        <div class="navbar-menu">
            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
            <a href="{{ route('admin.orders') }}">Pesanan</a>
            <a href="{{ route('admin.order.track') }}">Cek PO</a>
            <a href="{{ route('admin.menus') }}">Kelola Menu</a>
            <a href="{{ route('home') }}">Website</a>
            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="logout-btn">Logout</button>
            </form>
        </div>
    </nav>

    <div class="container">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="page-header">
            <h1>📋 Kelola Pesanan</h1>
        </div>

        <div class="orders-container">
            <div class="filter-tabs">
                <button class="filter-tab {{ request('status') == '' || !request('status') ? 'active' : '' }}" onclick="window.location='{{ route('admin.orders') }}'">
                    Semua ({{ $allCount }})
                </button>
                <button class="filter-tab {{ request('status') == 'pending' ? 'active' : '' }}" onclick="window.location='{{ route('admin.orders', ['status' => 'pending']) }}'">
                    Pending ({{ $pendingCount }})
                </button>
                <button class="filter-tab {{ request('status') == 'delivered' ? 'active' : '' }}" onclick="window.location='{{ route('admin.orders', ['status' => 'delivered']) }}'">
                    Selesai ({{ $completedCount }})
                </button>
                <button class="filter-tab {{ request('status') == 'cancelled' ? 'active' : '' }}" onclick="window.location='{{ route('admin.orders', ['status' => 'cancelled']) }}'">
                    Dibatalkan ({{ $cancelledCount }})
                </button>
            </div>

            @if($orders->count() > 0)
                <table class="orders-table">
                    <thead>
                        <tr>
                            <th>Pelanggan</th>
                            <th>Produk</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                        <tr>
                            <td>
                                <strong>{{ $order->user->name }}</strong>
                                <div class="order-details">{{ $order->user->email }}</div>
                            </td>
                            <td>
                                <strong>{{ $order->product_name }}</strong>
                                <div class="order-details">
                                    Qty: {{ $order->quantity }}
                                    @if($order->delivery_address)
                                        <br>📍 Delivery ({{ $order->delivery_distance }} km)
                                    @else
                                        <br>🏪 Pickup
                                    @endif
                                    @if($order->custom_message)
                                        <br>💬 {{ $order->custom_message }}
                                    @endif
                                </div>
                            </td>
                            <td><strong>Rp {{ number_format($order->total_amount, 0, ',', '.') }}</strong></td>
                            <td>
                                <span class="status-badge status-{{ $order->status }}">
                                    @if($order->status == 'pending') Pending
                                    @elseif($order->status == 'delivered') Selesai
                                    @elseif($order->status == 'cancelled') Dibatalkan
                                    @endif
                                </span>
                            </td>
                            <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                            <td>
                                @if($order->status == 'pending')
                                    <div class="action-buttons">
                                        <form action="{{ route('admin.orders.update-status', $order->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="delivered">
                                            <button type="submit" class="btn btn-success" onclick="return confirm('Tandai pesanan ini sebagai selesai?')">
                                                ✓ Selesai
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.orders.update-status', $order->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="cancelled">
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Batalkan pesanan ini?')">
                                                ✕ Batalkan
                                            </button>
                                        </form>
                                    </div>
                                @else
                                    <span style="color: var(--text-light); font-size: 0.9rem;">-</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="empty-state">
                    <h3>Belum ada pesanan</h3>
                    <p>Pesanan yang masuk akan muncul di sini</p>
                </div>
            @endif
        </div>
    </div>
</body>
</html>
