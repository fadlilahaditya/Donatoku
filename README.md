<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework. You can also check out [Laravel Learn](https://laravel.com/learn), where you will be guided through building a modern Laravel application.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Deploy Full Laravel to Vercel

Project ini sudah siap deploy ke Vercel dengan serverless PHP + Vite build setup.

**Files:**
- `api/index.php` → Serverless entrypoint
- `vercel.json` → Build & routing config
- `.env.vercel.example` → Template env untuk production

### Quickstart (5 menit)

#### Step 1: Persiapan Lokal
```bash
npm install
npm run build
git add .
git commit -m "Ready for Vercel deploy"
git push origin main
```

#### Step 2: Setup Database Production
Pilih salah satu:

**Option A: PlanetScale (MySQL) - RECOMMENDED**
1. Buka https://planetscale.com → Sign up free
2. Buat database baru
3. Copy connection string

**Option B: Supabase (PostgreSQL)**
1. Buka https://supabase.com → Sign up
2. Create project baru
3. Copy database credentials

#### Step 3: Deploy ke Vercel
1. Buka https://vercel.com → Login GitHub account
2. Import repository `RPLMantap`
3. Vercel auto-detect `vercel.json` dan `package.json`
4. **Klik "Deploy"**

#### Step 4: Set Environment Variables di Vercel
Dashboard Vercel → Settings → Environment Variables

Copy semua dari `.env.vercel.example`, ubah values dengan:
- `APP_KEY` → dari `php artisan key:generate --show` (lokal)
- `APP_URL` → domain Vercel kamu (misal: `https://rplmantap-xxx.vercel.app`)
- `DB_HOST`, `DB_USERNAME`, `DB_PASSWORD` → dari PlanetScale/Supabase

**Contoh:**
```
APP_NAME=RPLMantap
APP_ENV=production
APP_DEBUG=false
APP_KEY=base64:9HBKoNjpiJtQcECMgEai5t3IhTWuRtgmR2P6MwzMzYE=
APP_URL=https://rplmantap-123.vercel.app
DB_CONNECTION=mysql
DB_HOST=aws.connect.psdb.cloud
DB_PORT=3306
DB_DATABASE=rplmantap
DB_USERNAME=xxxxx
DB_PASSWORD=xxxxx
SESSION_DRIVER=cookie
CACHE_STORE=array
QUEUE_CONNECTION=sync
LOG_CHANNEL=stderr
```

#### Step 5: Jalankan Migration
Setelah env variables tersimpan dan redeploy, buka terminal:
```bash
php artisan migrate --force
```

Atau dari Vercel dashboard, gunakan built-in terminal (vercel cli) untuk run command.

### Troubleshooting

**Error: 404 NOT_FOUND**
- ✓ Pastikan semua env variables sudah di-set di Vercel
- ✓ Verifikasi `APP_KEY` dan `APP_URL` benar
- ✓ Cek logs di Vercel dashboard

**Error: Database connection refused**
- ✓ Database connection string harus accessible dari Vercel (public internet)
- ✓ PlanetScale/Supabase support ini, SQLite lokal tidak bisa

**Error: Build failed**
- ✓ Pastikan `npm run build` berhasil lokal
- ✓ Cek `vercel.json` config benar (lihat schema di file)

### Notes

- Vercel filesystem ephemeral → hindari menyimpan file permanently
- Queue jobs sync (tidak ada background worker) → cocok untuk app kecil/medium
- Session cookie-based → tidak perlu filesystem
- Logs ke stderr → visible di Vercel Function Logs
