<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Buat Pesanan - Donatoku De Patisserie</title>
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
            --danger: #E74C3C;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: var(--cream);
            line-height: 1.6;
            overflow-x: hidden;
        }

        .navbar {
            background: linear-gradient(135deg, var(--primary-pink), var(--primary-orange));
            padding: 1rem 2rem;
            color: var(--white);
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px var(--shadow);
        }

        .navbar-brand { display: flex; align-items: center; }
        .navbar-brand img { height: 50px; }

        .logout-btn {
            padding: 0.8rem 1.5rem;
            background: rgba(255,255,255,0.2);
            color: var(--white);
            border: none;
            border-radius: 25px;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        .logout-btn:hover { background: rgba(255,255,255,0.3); }

        .container {
            max-width: 1000px;
            margin: 2rem auto;
            padding: 0 2rem;
        }

        .page-header {
            background: var(--white);
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 4px 15px var(--shadow);
            margin-bottom: 2rem;
            text-align: center;
        }

        .page-header h1 {
            color: var(--primary-pink);
            font-size: 2rem;
            margin-bottom: 0.5rem;
        }

        .order-form {
            background: var(--white);
            padding: 2.5rem;
            border-radius: 15px;
            box-shadow: 0 4px 15px var(--shadow);
        }

        .form-section {
            margin-bottom: 2rem;
            padding-bottom: 2rem;
            border-bottom: 2px solid var(--cream);
        }

        .form-section:last-child {
            border-bottom: none;
            margin-bottom: 0;
        }

        .section-title {
            color: var(--primary-pink);
            font-size: 1.3rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: var(--text-dark);
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 0.9rem;
            border: 2px solid #E0E0E0;
            border-radius: 10px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: var(--primary-pink);
            box-shadow: 0 0 0 3px rgba(184, 51, 106, 0.1);
        }

        .delivery-options {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        .delivery-option {
            position: relative;
        }

        .delivery-option input[type="radio"] {
            position: absolute;
            opacity: 0;
        }

        .delivery-option label {
            display: block;
            padding: 1.5rem;
            border: 2px solid #E0E0E0;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-align: center;
        }

        .delivery-option input[type="radio"]:checked + label {
            border-color: var(--primary-pink);
            background: rgba(184, 51, 106, 0.05);
        }

        .delivery-details {
            display: none;
            margin-top: 1.5rem;
            padding: 1.5rem;
            background: rgba(184, 51, 106, 0.05);
            border-radius: 10px;
        }

        .delivery-details.active {
            display: block;
        }

        .pickup-schedule {
            display: none;
            margin-top: 1.5rem;
            padding: 1.5rem;
            background: rgba(222, 237, 255, 0.8);
            border-radius: 10px;
            border: 2px dashed #91B4E0;
        }

        .pickup-schedule.active {
            display: block;
        }

        .product-item {
            background: var(--cream);
            padding: 1.5rem;
            border-radius: 10px;
            margin-bottom: 1rem;
            border: 2px solid #E0E0E0;
            position: relative;
        }

        .product-item-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .btn-remove {
            background: var(--danger);
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            cursor: pointer;
            font-size: 0.9rem;
        }

        .btn-add-product {
            background: var(--success);
            color: white;
            border: none;
            padding: 1rem 1.5rem;
            border-radius: 10px;
            cursor: pointer;
            font-weight: 600;
            width: 100%;
            margin-top: 1rem;
        }

        .btn-submit {
            width: 100%;
            padding: 1.2rem;
            background: linear-gradient(135deg, var(--primary-pink), var(--primary-orange));
            color: var(--white);
            border: none;
            border-radius: 10px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 2rem;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(184, 51, 106, 0.3);
        }

        .btn-back {
            display: inline-block;
            padding: 0.8rem 1.5rem;
            background: var(--text-light);
            color: var(--white);
            text-decoration: none;
            border-radius: 8px;
            margin-bottom: 1rem;
        }

        .price-info {
            background: var(--cream);
            padding: 1.5rem;
            border-radius: 10px;
            margin-top: 1.5rem;
        }

        .price-row {
            display: flex;
            justify-content: space-between;
            padding: 0.5rem 0;
        }

        .price-row.total {
            border-top: 2px solid var(--primary-pink);
            margin-top: 1rem;
            padding-top: 1rem;
            font-weight: 700;
            font-size: 1.3rem;
            color: var(--primary-pink);
        }

        @media (max-width: 768px) {
            .navbar {
                padding: 1rem;
                flex-direction: column;
                gap: 1rem;
            }

            .container {
                margin: 1rem auto;
                padding: 0 1rem;
            }

            .page-header,
            .order-form {
                padding: 1.25rem;
            }

            .page-header h1 {
                font-size: 1.6rem;
            }

            .delivery-options {
                grid-template-columns: 1fr;
            }

            .product-item {
                padding: 1rem;
            }

            .product-item-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.75rem;
            }

            .price-row {
                gap: 1rem;
            }
        }

        @media (max-width: 640px) {
            .page-header h1 {
                font-size: 1.35rem;
            }

            .order-form {
                padding: 1rem;
            }

            .form-section {
                margin-bottom: 1.5rem;
                padding-bottom: 1.5rem;
            }

            .section-title {
                font-size: 1.1rem;
                align-items: flex-start;
            }

            .btn-add-product,
            .btn-submit,
            .logout-btn,
            .btn-back {
                width: 100%;
            }

            .price-row,
            .price-row.total {
                font-size: 1rem;
            }

            .price-row {
                flex-direction: column;
                align-items: flex-start;
            }
        }

        .required { color: var(--danger); }

        .info-box {
            background: #E3F2FD;
            color: #1976D2;
            padding: 1rem;
            border-radius: 8px;
            margin-top: 0.5rem;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="navbar-brand">
            <img src="{{ asset('images/logo-nav.png') }}" alt="Donatoku De Patisserie">
        </div>
        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
            @csrf
            <button type="submit" class="logout-btn">Logout</button>
        </form>
    </nav>

    <div class="container">
        <a href="{{ route('customer.dashboard') }}" class="btn-back">← Kembali ke Dashboard</a>

        <div class="page-header">
            <h1>🛒 Buat Pesanan Baru</h1>
            <p>Pesan kue favorit Anda dengan mudah dan cepat</p>
        </div>

        <form action="{{ route('customer.orders.store') }}" method="POST" class="order-form" id="orderForm">
            @csrf
            <input type="hidden" name="product_name" id="product_name_hidden">
            <input type="hidden" name="quantity" id="quantity_hidden">
            <input type="hidden" name="custom_message" id="custom_message_hidden">
            <!-- Hidden fields untuk nilai yang dihitung di klien -->
            <input type="hidden" name="subtotal" id="subtotal_hidden">
            <input type="hidden" name="delivery_fee" id="delivery_fee_hidden">
            <input type="hidden" name="total_amount" id="total_amount_hidden">

            <!-- Produk -->
            <div class="form-section">
                <h3 class="section-title">📋 Pilih Produk</h3>

                <div id="productsContainer">
                    <div class="product-item" data-index="0">
                        <div class="product-item-header">
                            <strong>Produk #1</strong>
                        </div>

                        <div class="form-group">
                            <label>Nama Produk <span class="required">*</span></label>
                            <select name="products[0][name]" class="product-select" required>
                                <option value="">-- Pilih Produk --</option>
                                <optgroup label="🎂 Kue Tart">
                                    <option value="Tart Hias Leleh Coklat (12 cm)" data-price="105000">Tart Hias Leleh Coklat (12 cm) - Rp 105.000</option>
                                    <option value="Tart Hias Leleh Coklat (15 cm)" data-price="160000">Tart Hias Leleh Coklat (15 cm) - Rp 160.000</option>
                                    <option value="Tart Hias Leleh Coklat (18 cm)" data-price="215000">Tart Hias Leleh Coklat (18 cm) - Rp 215.000</option>
                                    <option value="Tart Kupu Kupu" data-price="80000">Tart Kupu Kupu - Rp 80.000</option>
                                    <option value="Tart Merah Putih (12 cm)" data-price="110000">Tart Merah Putih (12 cm) - Rp 110.000</option>
                                    <option value="Tart Merah Putih (15 cm)" data-price="150000">Tart Merah Putih (15 cm) - Rp 150.000</option>
                                    <option value="Tart Merah Putih (18 cm)" data-price="180000">Tart Merah Putih (18 cm) - Rp 180.000</option>
                                    <option value="Tart 2 Boneka (12 cm)" data-price="135000">Tart 2 Boneka (12 cm) - Rp 135.000</option>
                                    <option value="Tart 2 Boneka (15 cm)" data-price="175000">Tart 2 Boneka (15 cm) - Rp 175.000</option>
                                    <option value="Tart 2 Boneka (18 cm)" data-price="225000">Tart 2 Boneka (18 cm) - Rp 225.000</option>
                                    <option value="Tart Anak Laki-Laki" data-price="90000">Tart Anak Laki-Laki - Rp 90.000</option>
                                    <option value="Tart Buket (12 cm)" data-price="115000">Tart Buket (12 cm) - Rp 115.000</option>
                                    <option value="Tart Buket (15 cm)" data-price="160000">Tart Buket (15 cm) - Rp 160.000</option>
                                    <option value="Tart Buket (18 cm)" data-price="220000">Tart Buket (18 cm) - Rp 220.000</option>
                                    <option value="Tart Serba Coklat (12 cm)" data-price="120000">Tart Serba Coklat (12 cm) - Rp 120.000</option>
                                    <option value="Tart Serba Coklat (15 cm)" data-price="165000">Tart Serba Coklat (15 cm) - Rp 165.000</option>
                                    <option value="Tart Serba Coklat (18 cm)" data-price="215000">Tart Serba Coklat (18 cm) - Rp 215.000</option>
                                    <option value="Tart Serba Coklat (20 cm)" data-price="265000">Tart Serba Coklat (20 cm) - Rp 265.000</option>
                                    <option value="Tart Serba Coklat (22 cm)" data-price="315000">Tart Serba Coklat (22 cm) - Rp 315.000</option>
                                    <option value="Tart Puding (18 cm)" data-price="165000">Tart Puding (18 cm) - Rp 165.000</option>
                                    <option value="Tart Puding (22 cm)" data-price="270000">Tart Puding (22 cm) - Rp 270.000</option>
                                    <option value="Tart Tingkat" data-price="335000">Tart Tingkat - Rp 335.000</option>
                                    <option value="Tart Coquette" data-price="250000">Tart Coquette - Rp 250.000</option>
                                    <option value="Tart Karakter" data-price="350000">Tart Karakter - Rp 350.000</option>
                                    <option value="Tart Topper" data-price="290000">Tart Topper - Rp 290.000</option>
                                    <option value="Tart Anak Perempuan" data-price="125000">Tart Anak Perempuan - Rp 125.000</option>
                                    <option value="Tart Hias Topper" data-price="300000">Tart Hias Topper - Rp 300.000</option>
                                </optgroup>
                                <optgroup label="🍫 Brownies">
                                    <option value="Fudgie Brownies Standard (23x10)" data-price="43000">Fudgie Brownies Standard (23x10) - Rp 43.000</option>
                                    <option value="Fudgie Brownies Standard (22x22)" data-price="85000">Fudgie Brownies Standard (22x22) - Rp 85.000</option>
                                    <option value="Basecake Brownies" data-price="25000">Basecake Brownies - Rp 25.000</option>
                                    <option value="Cup Brownies (isi 3)" data-price="52000">Cup Brownies (isi 3) - Rp 52.000</option>
                                    <option value="Brownies Cup Hias (isi 4)" data-price="60000">Brownies Cup Hias (isi 4) - Rp 60.000</option>
                                    <option value="Brownies Cup Hias (isi 5)" data-price="75000">Brownies Cup Hias (isi 5) - Rp 75.000</option>
                                    <option value="Brownies Cup Hias (isi 6)" data-price="90000">Brownies Cup Hias (isi 6) - Rp 90.000</option>
                                    <option value="Fudgy Hias (23x10)" data-price="75000">Fudgy Hias (23x10) - Rp 75.000</option>
                                    <option value="Fudgy Hias (22x22)" data-price="145000">Fudgy Hias (22x22) - Rp 145.000</option>
                                    <option value="Fudgy Brownies Hias (22x22)" data-price="185000">Fudgy Brownies Hias (22x22) - Rp 185.000</option>
                                    <option value="Brownies Cup (isi 4)" data-price="45000">Brownies Cup (isi 4) - Rp 45.000</option>
                                    <option value="Brownies Cup (isi 8)" data-price="85000">Brownies Cup (isi 8) - Rp 85.000</option>
                                    <option value="Popsicle Brownies" data-price="120000">Popsicle Brownies - Rp 120.000</option>
                                </optgroup>
                                <optgroup label="🎁 Bento Cake">
                                    <option value="Bento Cupcake (Bento + 5 Cupcakes)" data-price="150000">Bento Cupcake (Bento + 5 Cupcakes) - Rp 150.000</option>
                                    <option value="Bento Cupcake (Bento + 4 Cupcakes)" data-price="135000">Bento Cupcake (Bento + 4 Cupcakes) - Rp 135.000</option>
                                    <option value="Bento Cake (10 cm)" data-price="55000">Bento Cake (10 cm) - Rp 55.000</option>
                                </optgroup>
                                <optgroup label="🍪 Lekker Holland">
                                    <option value="Lekker Holland" data-price="40000">Lekker Holland - Rp 40.000</option>
                                </optgroup>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Jumlah <span class="required">*</span></label>
                            <input type="number" name="products[0][quantity]" class="quantity-input" min="1" value="1" required>
                        </div>

                        <div class="form-group">
                            <label>Pesan Khusus (Opsional)</label>
                            <textarea name="products[0][notes]" rows="2" placeholder="Contoh: Tulisan 'Happy Birthday' atau desain khusus"></textarea>
                        </div>
                    </div>
                </div>

                <button type="button" class="btn-add-product" onclick="addProduct()">➕ Tambah Produk Lain</button>
            </div>

            <!-- Metode Pengambilan -->
            <div class="form-section">
                <h3 class="section-title">🚚 Metode Pengambilan</h3>

                <div class="delivery-options">
                    <div class="delivery-option">
                        <input type="radio" name="delivery_method" id="pickup" value="pickup" checked>
                        <label for="pickup">
                            <div style="font-size: 2rem;">🏪</div>
                            <div style="font-weight: 600;">Ambil di Toko</div>
                            <div style="font-size: 0.85rem; color: var(--text-light);">Gratis</div>
                        </label>
                    </div>
                    <div class="delivery-option">
                        <input type="radio" name="delivery_method" id="delivery" value="delivery">
                        <label for="delivery">
                            <div style="font-size: 2rem;">🏍️</div>
                            <div style="font-weight: 600;">Antar ke Alamat</div>
                            <div style="font-size: 0.85rem; color: var(--text-light);">Rp 8.000 (flat)</div>
                        </label>
                    </div>
                </div>

                <div class="delivery-details" id="deliveryDetails">
                    <div class="form-group">
                        <label for="delivery_address">Alamat Lengkap <span class="required">*</span></label>
                        <textarea name="delivery_address" id="delivery_address" rows="3"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="delivery_date">Tanggal Pemesanan <span class="required">*</span></label>
                        <input type="date" name="delivery_date" id="delivery_date">
                    </div>

                    <div class="form-group">
                        <label for="delivery_time">Jam Pemesanan <span class="required">*</span></label>
                        <input type="time" name="delivery_time" id="delivery_time">
                        <div class="info-box">💡 Biaya pengiriman untuk antar ke alamat adalah Rp 8.000 (flat)</div>
                    </div>
                </div>

                    <div class="pickup-schedule active" id="pickupSchedule">
                        <div class="form-group">
                            <label for="pickup_date">Tanggal Pengambilan <span class="required">*</span></label>
                            <input type="date" name="pickup_date" id="pickup_date" required>
                        </div>
                        <div class="form-group">
                            <label for="pickup_time">Jam Pengambilan <span class="required">*</span></label>
                            <select name="pickup_time" id="pickup_time" required>
                                <option value="">-- Pilih Jam --</option>
                            </select>
                            <div class="info-box">💡 Pilih tanggal terlebih dahulu untuk melihat jam yang tersedia. Maksimal 3 pesanan per jam.</div>
                        </div>
                    </div>
                </div>

                <!-- Metode Pembayaran -->
                <div class="form-section">
                    <h3 class="section-title">💳 Metode Pembayaran</h3>

                    <div class="delivery-options">
                        <div class="delivery-option">
                            <input type="radio" name="payment_method" id="pay_in_store" value="in_store" checked>
                            <label for="pay_in_store">
                                <div style="font-size: 1.5rem;">🏪</div>
                                <div style="font-weight: 600;">Bayar di Toko</div>
                                <div style="font-size: 0.85rem; color: var(--text-light);">Bayar saat mengambil pesanan</div>
                            </label>
                        </div>
                        <div class="delivery-option">
                            <input type="radio" name="payment_method" id="pay_whatsapp" value="whatsapp">
                            <label for="pay_whatsapp">
                                <div style="font-size: 1.5rem;">💬</div>
                                <div style="font-weight: 600;">Pesan via WhatsApp</div>
                                <div style="font-size: 0.85rem; color: var(--text-light);">Akan diarahkan ke WhatsApp Donatoku untuk konfirmasi & pembayaran</div>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Ringkasan Harga -->
            <div class="form-section">
                <h3 class="section-title">💰 Ringkasan Pembayaran</h3>

                <div class="price-info">
                    <div class="price-row">
                        <span>Subtotal Produk:</span>
                        <span id="subtotal">Rp 0</span>
                    </div>
                    <div class="price-row">
                        <span>Biaya Pengiriman:</span>
                        <span id="deliveryFee">Rp 0</span>
                    </div>
                    <div class="price-row total">
                        <span>Total Pembayaran:</span>
                        <span id="totalAmount">Rp 0</span>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn-submit">🛒 Buat Pesanan</button>
        </form>
    </div>

    <script>
        let productIndex = 1;

        function addProduct() {
            const container = document.getElementById('productsContainer');
            const newProduct = document.createElement('div');
            newProduct.className = 'product-item';
            newProduct.setAttribute('data-index', productIndex);
            newProduct.innerHTML = `
                <div class="product-item-header">
                    <strong>Produk #${productIndex + 1}</strong>
                    <button type="button" class="btn-remove" onclick="removeProduct(this)">🗑️ Hapus</button>
                </div>

                <div class="form-group">
                    <label>Nama Produk <span class="required">*</span></label>
                    <select name="products[${productIndex}][name]" class="product-select" required>
                        <option value="">-- Pilih Produk --</option>
                        <optgroup label="🎂 Kue Tart">
                            <option value="Tart Hias Leleh Coklat (12 cm)" data-price="105000">Tart Hias Leleh Coklat (12 cm) - Rp 105.000</option>
                            <option value="Tart Hias Leleh Coklat (15 cm)" data-price="160000">Tart Hias Leleh Coklat (15 cm) - Rp 160.000</option>
                            <option value="Tart Hias Leleh Coklat (18 cm)" data-price="215000">Tart Hias Leleh Coklat (18 cm) - Rp 215.000</option>
                            <option value="Tart Kupu Kupu" data-price="80000">Tart Kupu Kupu - Rp 80.000</option>
                            <option value="Tart Merah Putih (12 cm)" data-price="110000">Tart Merah Putih (12 cm) - Rp 110.000</option>
                            <option value="Tart Merah Putih (15 cm)" data-price="150000">Tart Merah Putih (15 cm) - Rp 150.000</option>
                            <option value="Tart Merah Putih (18 cm)" data-price="180000">Tart Merah Putih (18 cm) - Rp 180.000</option>
                            <option value="Tart 2 Boneka (12 cm)" data-price="135000">Tart 2 Boneka (12 cm) - Rp 135.000</option>
                            <option value="Tart 2 Boneka (15 cm)" data-price="175000">Tart 2 Boneka (15 cm) - Rp 175.000</option>
                            <option value="Tart 2 Boneka (18 cm)" data-price="225000">Tart 2 Boneka (18 cm) - Rp 225.000</option>
                            <option value="Tart Anak Laki-Laki" data-price="90000">Tart Anak Laki-Laki - Rp 90.000</option>
                            <option value="Tart Buket (12 cm)" data-price="115000">Tart Buket (12 cm) - Rp 115.000</option>
                            <option value="Tart Buket (15 cm)" data-price="160000">Tart Buket (15 cm) - Rp 160.000</option>
                            <option value="Tart Buket (18 cm)" data-price="220000">Tart Buket (18 cm) - Rp 220.000</option>
                            <option value="Tart Serba Coklat (12 cm)" data-price="120000">Tart Serba Coklat (12 cm) - Rp 120.000</option>
                            <option value="Tart Serba Coklat (15 cm)" data-price="165000">Tart Serba Coklat (15 cm) - Rp 165.000</option>
                            <option value="Tart Serba Coklat (18 cm)" data-price="215000">Tart Serba Coklat (18 cm) - Rp 215.000</option>
                            <option value="Tart Serba Coklat (20 cm)" data-price="265000">Tart Serba Coklat (20 cm) - Rp 265.000</option>
                            <option value="Tart Serba Coklat (22 cm)" data-price="315000">Tart Serba Coklat (22 cm) - Rp 315.000</option>
                            <option value="Tart Puding (18 cm)" data-price="165000">Tart Puding (18 cm) - Rp 165.000</option>
                            <option value="Tart Puding (22 cm)" data-price="270000">Tart Puding (22 cm) - Rp 270.000</option>
                            <option value="Tart Tingkat" data-price="335000">Tart Tingkat - Rp 335.000</option>
                            <option value="Tart Coquette" data-price="250000">Tart Coquette - Rp 250.000</option>
                            <option value="Tart Karakter" data-price="350000">Tart Karakter - Rp 350.000</option>
                            <option value="Tart Topper" data-price="290000">Tart Topper - Rp 290.000</option>
                            <option value="Tart Anak Perempuan" data-price="125000">Tart Anak Perempuan - Rp 125.000</option>
                            <option value="Tart Hias Topper" data-price="300000">Tart Hias Topper - Rp 300.000</option>
                        </optgroup>
                        <optgroup label="🍫 Brownies">
                            <option value="Fudgie Brownies Standard (23x10)" data-price="43000">Fudgie Brownies Standard (23x10) - Rp 43.000</option>
                            <option value="Fudgie Brownies Standard (22x22)" data-price="85000">Fudgie Brownies Standard (22x22) - Rp 85.000</option>
                            <option value="Basecake Brownies" data-price="25000">Basecake Brownies - Rp 25.000</option>
                            <option value="Cup Brownies (isi 3)" data-price="52000">Cup Brownies (isi 3) - Rp 52.000</option>
                            <option value="Brownies Cup Hias (isi 4)" data-price="60000">Brownies Cup Hias (isi 4) - Rp 60.000</option>
                            <option value="Brownies Cup Hias (isi 5)" data-price="75000">Brownies Cup Hias (isi 5) - Rp 75.000</option>
                            <option value="Brownies Cup Hias (isi 6)" data-price="90000">Brownies Cup Hias (isi 6) - Rp 90.000</option>
                            <option value="Fudgy Hias (23x10)" data-price="75000">Fudgy Hias (23x10) - Rp 75.000</option>
                            <option value="Fudgy Hias (22x22)" data-price="145000">Fudgy Hias (22x22) - Rp 145.000</option>
                            <option value="Fudgy Brownies Hias (22x22)" data-price="185000">Fudgy Brownies Hias (22x22) - Rp 185.000</option>
                            <option value="Brownies Cup (isi 4)" data-price="45000">Brownies Cup (isi 4) - Rp 45.000</option>
                            <option value="Brownies Cup (isi 8)" data-price="85000">Brownies Cup (isi 8) - Rp 85.000</option>
                            <option value="Popsicle Brownies" data-price="120000">Popsicle Brownies - Rp 120.000</option>
                        </optgroup>
                        <optgroup label="🎁 Bento Cake">
                            <option value="Bento Cupcake (Bento + 5 Cupcakes)" data-price="150000">Bento Cupcake (Bento + 5 Cupcakes) - Rp 150.000</option>
                            <option value="Bento Cupcake (Bento + 4 Cupcakes)" data-price="135000">Bento Cupcake (Bento + 4 Cupcakes) - Rp 135.000</option>
                            <option value="Bento Cake (10 cm)" data-price="55000">Bento Cake (10 cm) - Rp 55.000</option>
                        </optgroup>
                        <optgroup label="🍪 Lekker Holland">
                            <option value="Lekker Holland" data-price="40000">Lekker Holland - Rp 40.000</option>
                        </optgroup>
                    </select>
                </div>

                <div class="form-group">
                    <label>Jumlah <span class="required">*</span></label>
                    <input type="number" name="products[${productIndex}][quantity]" class="quantity-input" min="1" value="1" required>
                </div>

                <div class="form-group">
                    <label>Pesan Khusus (Opsional)</label>
                    <textarea name="products[${productIndex}][notes]" rows="2" placeholder="Contoh: Tulisan 'Happy Birthday' atau desain khusus"></textarea>
                </div>
            `;

            container.appendChild(newProduct);
            productIndex++;

            // Add event listeners to new product
            const selects = newProduct.querySelectorAll('.product-select');
            const inputs = newProduct.querySelectorAll('.quantity-input');
            selects.forEach(s => s.addEventListener('change', calculateTotal));
            inputs.forEach(i => i.addEventListener('input', calculateTotal));

            calculateTotal();
        }

        function removeProduct(btn) {
            const productItem = btn.closest('.product-item');
            productItem.remove();
            calculateTotal();

            // Renumber products
            const products = document.querySelectorAll('.product-item');
            products.forEach((item, index) => {
                const header = item.querySelector('.product-item-header strong');
                header.textContent = `Produk #${index + 1}`;
            });
        }

        function calculateTotal() {
            let subtotal = 0;

            // Calculate subtotal from all products
            const productItems = document.querySelectorAll('.product-item');
            productItems.forEach(item => {
                const select = item.querySelector('.product-select');
                const quantityInput = item.querySelector('.quantity-input');

                if (select && quantityInput) {
                    const selectedOption = select.options[select.selectedIndex];
                    const price = parseInt(selectedOption.getAttribute('data-price')) || 0;
                    const quantity = parseInt(quantityInput.value) || 0;
                    subtotal += price * quantity;
                }
            });

            // Calculate delivery fee
            let deliveryFee = 0;
            const deliveryRadio = document.getElementById('delivery');
            if (deliveryRadio.checked) {
                deliveryFee = 8000;
            }

            const total = subtotal + deliveryFee;

            // Update display
            document.getElementById('subtotal').textContent = 'Rp ' + subtotal.toLocaleString('id-ID');
            document.getElementById('deliveryFee').textContent = 'Rp ' + deliveryFee.toLocaleString('id-ID');
            document.getElementById('totalAmount').textContent = 'Rp ' + total.toLocaleString('id-ID');
        }

        // Function to update available pickup time slots
        async function updatePickupTimeSlots() {
            const dateInput = document.getElementById('pickup_date');
            const timeSelect = document.getElementById('pickup_time');
            const selectedDate = dateInput.value;

            if (!selectedDate) {
                timeSelect.innerHTML = '<option value="">-- Pilih Tanggal Terlebih Dahulu --</option>';
                return;
            }

            try {
                const response = await fetch(`/customer/pickup-slots?date=${selectedDate}`);
                const slots = await response.json();

                timeSelect.innerHTML = '<option value="">-- Pilih Jam --</option>';

                slots.forEach(slot => {
                    const option = document.createElement('option');
                    option.value = slot.time;
                    option.textContent = `${slot.formatted} (${slot.current_orders}/3 slot terisi)`;

                    if (!slot.available) {
                        option.disabled = true;
                        option.textContent += ' - PENUH';
                        option.style.color = '#E74C3C';
                    }

                    timeSelect.appendChild(option);
                });
            } catch (error) {
                console.error('Error fetching pickup slots:', error);
                timeSelect.innerHTML = '<option value="">-- Error loading slots --</option>';
            }
        }

        // Delivery method toggle
        const pickupSchedule = document.getElementById('pickupSchedule');
        const pickupDateInput = document.getElementById('pickup_date');
        const pickupTimeInput = document.getElementById('pickup_time');
        const deliveryDateInput = document.getElementById('delivery_date');
        const deliveryTimeInput = document.getElementById('delivery_time');

        document.getElementById('pickup').addEventListener('change', function() {
            document.getElementById('deliveryDetails').classList.remove('active');
            pickupSchedule.classList.add('active');
            document.getElementById('delivery_address').removeAttribute('required');
            deliveryDateInput.removeAttribute('required');
            deliveryTimeInput.removeAttribute('required');
            pickupDateInput.setAttribute('required', 'required');
            pickupTimeInput.setAttribute('required', 'required');
            updatePickupTimeSlots();
            calculateTotal();
        });

        document.getElementById('delivery').addEventListener('change', function() {
            document.getElementById('deliveryDetails').classList.add('active');
            pickupSchedule.classList.remove('active');
            document.getElementById('delivery_address').setAttribute('required', 'required');
            deliveryDateInput.setAttribute('required', 'required');
            deliveryTimeInput.setAttribute('required', 'required');
            pickupDateInput.removeAttribute('required');
            pickupTimeInput.removeAttribute('required');
            calculateTotal();
        });

        // Nomor WhatsApp Donatoku (format internasional tanpa +)
        // 085708123616 -> 6285708123616
        const DONATOKU_WHATSAPP = '6285708123616';

        // Compile products before submit
        document.getElementById('orderForm').addEventListener('submit', function(e) {
            const products = [];
            let notes = [];
            let totalQty = 0;

            document.querySelectorAll('.product-item').forEach(item => {
                const select = item.querySelector('.product-select');
                const qtyInput = item.querySelector('.quantity-input');
                const notesTextarea = item.querySelector('textarea');

                if (select.value) {
                    products.push(select.value);
                    totalQty += parseInt(qtyInput.value) || 1;
                    if (notesTextarea.value) {
                        notes.push(`${select.value}: ${notesTextarea.value}`);
                    }
                }
            });

            document.getElementById('product_name_hidden').value = products.join(', ');
            document.getElementById('quantity_hidden').value = totalQty;
            document.getElementById('custom_message_hidden').value = notes.join(' | ');

            // Kirim juga nilai jumlah yang dihitung di klien supaya server dapat menggunakan nilai ini
            // Ambil teks yang ditampilkan (mis. "Rp 75.000") lalu ekstrak angka
            function extractNumber(textId) {
                const txt = document.getElementById(textId).textContent || '';
                // hapus semua karakter selain digit dan titik
                const cleaned = txt.replace(/[^0-9\.]/g, '');
                return parseInt(cleaned.replace(/\./g, '')) || 0;
            }

            const subtotalVal = extractNumber('subtotal');
            const deliveryVal = extractNumber('deliveryFee');
            const totalVal = extractNumber('totalAmount');

            document.getElementById('subtotal_hidden').value = subtotalVal;
            document.getElementById('delivery_fee_hidden').value = deliveryVal;
            document.getElementById('total_amount_hidden').value = totalVal;

            // Jangan redirect langsung ke WhatsApp di klien.
            // Jika user memilih metode WhatsApp, server akan menyimpan pesanan dan
            // mengembalikan `whatsapp_url` agar dashboard menampilkan tombol konfirmasi.
        });

        // Initial setup
        document.addEventListener('DOMContentLoaded', function() {
            const selects = document.querySelectorAll('.product-select');
            const inputs = document.querySelectorAll('.quantity-input');

            // Preselect product/size when coming from menu pages
            try {
                const params = new URLSearchParams(window.location.search);
                const qProduct = params.get('product_name') || params.get('product') || '';
                const qSize = params.get('product_size') || params.get('size') || '';
                if (qProduct && selects.length > 0) {
                    const select = selects[0];
                    let matched = null;
                    select.querySelectorAll('option').forEach(opt => {
                        const val = (opt.value || '').toLowerCase();
                        if (!val) return;
                        if (val.includes(qProduct.toLowerCase())) {
                            if (qSize) {
                                if (val.includes(qSize.toLowerCase()) || val.includes(qSize + ' cm') || val.includes('(' + qSize)) {
                                    matched = opt;
                                }
                            } else if (!matched) {
                                matched = opt;
                            }
                        }
                    });
                    if (matched) {
                        select.value = matched.value;
                        select.dispatchEvent(new Event('change'));
                    }
                }
            } catch (err) {
                // ignore
            }

            selects.forEach(s => s.addEventListener('change', calculateTotal));
            inputs.forEach(i => i.addEventListener('input', calculateTotal));

            // Add event listener for pickup date change
            pickupDateInput.addEventListener('change', updatePickupTimeSlots);

            calculateTotal();
        });
    </script>
</body>
</html>
