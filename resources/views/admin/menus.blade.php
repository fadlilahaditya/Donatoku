<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Menu - Admin Donatoku</title>
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

        .navbar-menu {
            display: flex;
            gap: 1.5rem;
            align-items: center;
        }

        .navbar-menu a {
            color: var(--white);
            text-decoration: none;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .navbar-menu a:hover {
            background: rgba(255,255,255,0.2);
        }

        .logout-btn {
            padding: 0.8rem 1.5rem;
            background: rgba(255,255,255,0.2);
            color: var(--white);
            border: none;
            border-radius: 25px;
            cursor: pointer;
        }

        .container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 2rem;
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .page-header h1 {
            color: var(--primary-pink);
            font-size: 2rem;
        }

        .btn {
            padding: 0.8rem 1.5rem;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s ease;
            font-weight: 600;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary-pink), var(--primary-orange));
            color: var(--white);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(184, 51, 106, 0.3);
        }

        .btn-success {
            background: var(--success);
            color: var(--white);
        }

        .btn-danger {
            background: var(--danger);
            color: var(--white);
        }

        .btn-sm {
            padding: 0.5rem 1rem;
            font-size: 0.9rem;
        }

        .alert {
            padding: 1rem 1.5rem;
            border-radius: 10px;
            margin-bottom: 1.5rem;
        }

        .alert-success {
            background: #D4EDDA;
            color: #155724;
            border: 2px solid var(--success);
        }

        .menu-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 1.5rem;
            margin-top: 2rem;
        }

        .menu-card {
            background: var(--white);
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 4px 15px var(--shadow);
            transition: all 0.3s ease;
        }

        .menu-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px var(--shadow);
        }

        .menu-card-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
            background: var(--cream);
        }

        .menu-card-content {
            padding: 1.5rem;
        }

        .menu-card h3 {
            color: var(--primary-pink);
            margin-bottom: 0.5rem;
            font-size: 1.3rem;
        }

        .menu-category {
            display: inline-block;
            padding: 0.3rem 0.8rem;
            background: var(--cream);
            color: var(--text-dark);
            border-radius: 20px;
            font-size: 0.85rem;
            margin-bottom: 0.8rem;
        }

        .menu-price {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary-orange);
            margin: 1rem 0;
        }

        .menu-description {
            color: var(--text-light);
            margin-bottom: 1rem;
            line-height: 1.6;
        }

        .menu-actions {
            display: flex;
            gap: 0.5rem;
            margin-top: 1rem;
        }

        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            z-index: 1000;
            align-items: center;
            justify-content: center;
        }

        .modal.active {
            display: flex;
        }

        .modal-content {
            background: var(--white);
            border-radius: 15px;
            padding: 2rem;
            max-width: 500px;
            width: 90%;
            max-height: 90vh;
            overflow-y: auto;
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .modal-header h2 {
            color: var(--primary-pink);
        }

        .close-modal {
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: var(--text-light);
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
            padding: 0.8rem;
            border: 2px solid #E0E0E0;
            border-radius: 8px;
            font-size: 1rem;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: var(--primary-pink);
        }

        .form-group textarea {
            resize: vertical;
            min-height: 100px;
        }

        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            color: var(--text-light);
        }

        .empty-state h3 {
            font-size: 1.5rem;
            margin-bottom: 1rem;
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
            <h1>📋 Kelola Menu</h1>
            <button class="btn btn-primary" onclick="openModal('create')">➕ Tambah Menu Baru</button>
        </div>

        <div class="menu-grid">
            @forelse($menus as $menu)
                <div class="menu-card">
                    @if($menu->image_url)
                        <img src="{{ asset($menu->image_url) }}" alt="{{ $menu->name }}" class="menu-card-image" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                        <div class="menu-card-image" style="display: none; align-items: center; justify-content: center; color: var(--text-light); font-size: 3rem;">🍩</div>
                    @else
                        <div class="menu-card-image" style="display: flex; align-items: center; justify-content: center; color: var(--text-light); font-size: 3rem;">🍩</div>
                    @endif
                    <div class="menu-card-content">
                        <span class="menu-category">{{ $menu->category }}</span>
                        <h3>{{ $menu->name }}</h3>
                        <p class="menu-description">{{ $menu->description }}</p>
                        <div class="menu-price">Rp {{ number_format($menu->price, 0, ',', '.') }}</div>
                        <div class="menu-actions">
                            <button class="btn btn-success btn-sm" onclick="editMenu({{ $menu->id }}, '{{ $menu->name }}', '{{ $menu->category }}', {{ $menu->price }}, '{{ addslashes($menu->description) }}', '{{ $menu->image_url }}')">✏️ Edit</button>
                            <form action="{{ route('admin.menus.destroy', $menu->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin ingin menghapus menu ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">🗑️ Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="empty-state" style="grid-column: 1/-1;">
                    <h3>Belum ada menu</h3>
                    <p>Klik tombol "Tambah Menu Baru" untuk menambahkan menu pertama Anda</p>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Create Modal -->
    <div class="modal" id="createModal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Tambah Menu Baru</h2>
                <button class="close-modal" onclick="closeModal('create')">&times;</button>
            </div>
            <form action="{{ route('admin.menus.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="create_name">Nama Menu <span style="color: red;">*</span></label>
                    <input type="text" id="create_name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="create_category">Kategori <span style="color: red;">*</span></label>
                    <select id="create_category" name="category" required>
                        <option value="">-- Pilih Kategori --</option>
                        <option value="Kue Tart">Kue Tart</option>
                        <option value="Brownies">Brownies</option>
                        <option value="Bento Cake">Bento Cake</option>
                        <option value="Lekker Holland">Lekker Holland</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="create_price">Harga (Rp) <span style="color: red;">*</span></label>
                    <input type="number" id="create_price" name="price" min="0" step="1000" required>
                </div>
                <div class="form-group">
                    <label for="create_description">Deskripsi</label>
                    <textarea id="create_description" name="description"></textarea>
                </div>
                <div class="form-group">
                    <label for="create_image_url">Path Gambar</label>
                    <input type="text" id="create_image_url" name="image_url" placeholder="/images/menus/nama-file.jpg">
                    <small style="color: var(--text-light); display: block; margin-top: 0.5rem;">Masukkan path gambar lokal (contoh: /images/menus/kue-tart.jpg)</small>
                </div>
                <button type="submit" class="btn btn-primary" style="width: 100%;">Simpan Menu</button>
            </form>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal" id="editModal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Edit Menu</h2>
                <button class="close-modal" onclick="closeModal('edit')">&times;</button>
            </div>
            <form id="editForm" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="edit_name">Nama Menu <span style="color: red;">*</span></label>
                    <input type="text" id="edit_name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="edit_category">Kategori <span style="color: red;">*</span></label>
                    <select id="edit_category" name="category" required>
                        <option value="">-- Pilih Kategori --</option>
                        <option value="Kue Tart">Kue Tart</option>
                        <option value="Brownies">Brownies</option>
                        <option value="Bento Cake">Bento Cake</option>
                        <option value="Lekker Holland">Lekker Holland</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="edit_price">Harga (Rp) <span style="color: red;">*</span></label>
                    <input type="number" id="edit_price" name="price" min="0" step="1000" required>
                </div>
                <div class="form-group">
                    <label for="edit_description">Deskripsi</label>
                    <textarea id="edit_description" name="description"></textarea>
                </div>
                <div class="form-group">
                    <label for="edit_image_url">Path Gambar</label>
                    <input type="text" id="edit_image_url" name="image_url" placeholder="/images/menus/nama-file.jpg">
                    <small style="color: var(--text-light); display: block; margin-top: 0.5rem;">Masukkan path gambar lokal (contoh: /images/menus/kue-tart.jpg)</small>
                </div>
                <button type="submit" class="btn btn-success" style="width: 100%;">Update Menu</button>
            </form>
        </div>
    </div>

    <script>
        function openModal(type) {
            document.getElementById(type + 'Modal').classList.add('active');
        }

        function closeModal(type) {
            document.getElementById(type + 'Modal').classList.remove('active');
        }

        function editMenu(id, name, category, price, description, image_url) {
            document.getElementById('edit_name').value = name;
            document.getElementById('edit_category').value = category;
            document.getElementById('edit_price').value = price;
            document.getElementById('edit_description').value = description;
            document.getElementById('edit_image_url').value = image_url || '';
            document.getElementById('editForm').action = '/admin/menus/' + id;
            openModal('edit');
        }

        // Close modal when clicking outside
        window.onclick = function(event) {
            if (event.target.classList.contains('modal')) {
                event.target.classList.remove('active');
            }
        }
    </script>
</body>
</html>
