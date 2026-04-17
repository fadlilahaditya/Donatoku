<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Cek Status Pesanan Admin - Donatoku</title>
    <style>
        :root {
            --primary-pink: #B8336A;
            --primary-orange: #F4A261;
            --cream: #FAF0E6;
            --white: #FFFFFF;
            --text-dark: #2C2C2C;
            --text-light: #666;
            --success: #1F8A4D;
            --warning: #B17A00;
            --danger: #B33232;
            --shadow: rgba(184, 51, 106, 0.12);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', 'Segoe UI', Tahoma, sans-serif;
            background: linear-gradient(135deg, #ffe6ef 0%, #fff2e6 100%);
            min-height: 100vh;
            color: var(--text-dark);
            padding: 24px;
            overflow-x: hidden;
        }

        .wrap {
            max-width: 760px;
            margin: 0 auto;
        }

        .top-nav {
            margin-bottom: 16px;
        }

        .top-nav a {
            color: var(--primary-pink);
            text-decoration: none;
            font-weight: 600;
        }

        .top-nav a + a {
            margin-left: 12px;
        }

        .card {
            background: var(--white);
            border-radius: 18px;
            box-shadow: 0 15px 35px var(--shadow);
            overflow: hidden;
        }

        .header {
            background: linear-gradient(135deg, var(--primary-pink), var(--primary-orange));
            color: var(--white);
            padding: 28px;
            text-align: center;
        }

        .header h1 {
            font-size: 1.7rem;
            margin-bottom: 6px;
        }

        .header p {
            opacity: 0.95;
        }

        .body {
            padding: 24px;
        }

        .field {
            margin-bottom: 16px;
        }

        .field label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
        }

        .field input {
            width: 100%;
            border: 2px solid #f0dfe7;
            border-radius: 10px;
            padding: 12px 14px;
            font-size: 1rem;
            text-transform: uppercase;
        }

        .field input:focus {
            outline: none;
            border-color: var(--primary-pink);
            box-shadow: 0 0 0 3px rgba(184, 51, 106, 0.12);
        }

        .btn {
            width: 100%;
            border: none;
            border-radius: 10px;
            padding: 13px;
            background: linear-gradient(135deg, var(--primary-pink), var(--primary-orange));
            color: var(--white);
            font-weight: 700;
            cursor: pointer;
            font-size: 1rem;
        }

        .error {
            margin-bottom: 12px;
            background: #ffecec;
            color: #a43a3a;
            border: 1px solid #f3b8b8;
            border-radius: 8px;
            padding: 10px 12px;
            font-size: 0.92rem;
        }

        .result {
            margin-top: 20px;
            border: 2px solid #f3e7eb;
            border-radius: 12px;
            padding: 16px;
        }

        .status-badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 999px;
            font-weight: 700;
            font-size: 0.86rem;
            margin-top: 8px;
        }

        .pending { background: #fff4da; color: var(--warning); }
        .delivered { background: #e6f8ee; color: var(--success); }
        .cancelled { background: #fdeaea; color: var(--danger); }

        .meta {
            margin-top: 10px;
            color: var(--text-light);
            font-size: 0.95rem;
            line-height: 1.6;
            word-break: break-word;
        }

        @media (max-width: 640px) {
            body {
                padding: 14px;
            }

            .wrap {
                max-width: 100%;
            }

            .top-nav {
                margin-bottom: 12px;
            }

            .top-nav a {
                display: inline-block;
                padding: 8px 0;
            }

            .header, .body {
                padding: 18px;
            }

            .header h1 {
                font-size: 1.35rem;
            }

            .status-badge {
                display: inline-flex;
                width: 100%;
                justify-content: center;
            }

            .result {
                padding: 14px;
            }
        }
    </style>
</head>
<body>
    <div class="wrap">
        <div class="top-nav">
            <a href="{{ route('admin.dashboard') }}">&larr; Kembali ke Dashboard</a>
            <a href="{{ route('admin.orders') }}">Lihat Pesanan</a>
        </div>

        <div class="card">
            <div class="header">
                <h1>Cek Status Pesanan</h1>
                <p>Masukkan nomor PO untuk melihat status pesanan.</p>
            </div>

            <div class="body">
                @if($errors->any())
                    <div class="error">{{ $errors->first('po_number') }}</div>
                @endif

                <form action="{{ route('admin.order.track') }}" method="POST">
                    @csrf
                    <div class="field">
                        <label for="po_number">Nomor PO</label>
                        <input
                            type="text"
                            id="po_number"
                            name="po_number"
                            value="{{ old('po_number', $poNumber) }}"
                            placeholder="Contoh: PO0412001"
                            required
                        >
                    </div>
                    <button type="submit" class="btn">Cek Pesanan</button>
                </form>

                @if($poNumber)
                    <div class="result">
                        @if($order)
                            <strong>Nomor PO: {{ $order->po_number }}</strong>
                            <div>
                                <span class="status-badge {{ $order->status }}">
                                    @if($order->status === 'pending')
                                        Belum Diterima
                                    @elseif($order->status === 'delivered')
                                        Sudah Diterima
                                    @elseif($order->status === 'cancelled')
                                        Dibatalkan
                                    @else
                                        {{ ucfirst($order->status) }}
                                    @endif
                                </span>
                            </div>
                            <div class="meta">
                                Produk: {{ $order->product_name }}<br>
                                Total: Rp {{ number_format($order->total_amount, 0, ',', '.') }}<br>
                                Tanggal Pesan: {{ $order->created_at->format('d/m/Y H:i') }}
                            </div>
                        @else
                            <strong>Nomor PO tidak ditemukan.</strong>
                            <div class="meta">
                                Pastikan nomor PO sudah benar, lalu coba lagi.
                            </div>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>
</body>
</html>
