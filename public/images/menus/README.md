# Folder Gambar Menu

Folder ini berisi gambar-gambar untuk menu Donatoku De Patisserie.

## Struktur File Gambar

Setiap menu memiliki file gambar dengan format `.jpg` sesuai dengan nama menu:

### Kue Tart

-   `kue-tart-coklat.jpg`
-   `kue-tart-strawberry.jpg`
-   `kue-tart-rainbow.jpg`
-   `kue-tart-red-velvet.jpg`
-   `kue-tart-vanilla.jpg`

### Brownies

-   `brownies-coklat-original.jpg`
-   `brownies-keju.jpg`
-   `brownies-almond.jpg`
-   `brownies-pandan.jpg`
-   `brownies-cream-cheese.jpg`

### Bento Cake

-   `bento-cake-birthday.jpg`
-   `bento-cake-love.jpg`
-   `bento-cake-graduation.jpg`
-   `bento-cake-anniversary.jpg`
-   `bento-cake-character.jpg`

### Lekker Holland

-   `lekker-holland-coklat.jpg`
-   `lekker-holland-keju.jpg`
-   `lekker-holland-strawberry.jpg`
-   `lekker-holland-pandan.jpg`
-   `lekker-holland-mix.jpg`

### Default

-   `default-donut.jpg` - Gambar default untuk menu yang belum memiliki gambar

## Cara Menambahkan Gambar Baru

1. Simpan file gambar dalam format `.jpg` atau `.png`
2. Beri nama file sesuai dengan nama menu (lowercase, pisah dengan dash)
3. Upload file ke folder ini: `public/images/menus/`
4. Update path di database atau melalui admin panel dengan format: `/images/menus/nama-file.jpg`

## Rekomendasi Gambar

-   **Ukuran**: Minimal 800x600 piksel
-   **Format**: JPG atau PNG
-   **Rasio**: 4:3 atau 16:9 untuk hasil terbaik
-   **Ukuran File**: Maksimal 2MB per gambar

## Catatan

Jika gambar tidak ditemukan, sistem akan menampilkan icon donut 🍩 sebagai placeholder.
