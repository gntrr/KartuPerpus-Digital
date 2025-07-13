# Deployment Guide - KartuPerpus Digital

## Coolify Deployment dengan Nixpacks

### Prerequisites
- Akun Coolify yang aktif
- Repository Git (GitHub, GitLab, atau Bitbucket)
- Domain atau subdomain (opsional)

### Step 1: Prepare Repository
1. Push semua file ke repository Git Anda
2. Pastikan file `nixpacks.toml` ada di root directory
3. Pastikan file `composer.json` sudah dikonfigurasi dengan benar

### Step 2: Setup di Coolify
1. Login ke Coolify dashboard
2. Klik "New Resource" → "Application"
3. Pilih repository Git Anda
4. Pilih branch yang akan di-deploy (biasanya `main` atau `master`)

### Step 3: Configure Build Settings
1. **Build Pack**: Pilih "Nixpacks" (auto-detected)
2. **Build Command**: Akan otomatis menggunakan konfigurasi dari `nixpacks.toml`
3. **Install Command**: `composer install --no-dev --optimize-autoloader`
4. **Start Command**: `php -S 0.0.0.0:$PORT -t .`

### Step 4: Environment Variables
Set environment variables berikut di Coolify:

```
PORT=8080
PHP_VERSION=8.2
APP_ENV=production
APP_DEBUG=false
```

### Step 5: Domain Configuration
1. Tambahkan domain atau gunakan subdomain Coolify
2. Enable HTTPS jika menggunakan custom domain
3. Uncomment redirect HTTPS di `.htaccess` jika diperlukan

### Step 6: Deploy
1. Klik "Deploy" untuk memulai deployment
2. Monitor logs untuk memastikan build berhasil
3. Akses aplikasi melalui URL yang disediakan

### Step 7: Verification
1. Akses `/health.php` untuk memastikan aplikasi berjalan
2. Test fitur utama aplikasi
3. Periksa permission folder `members/` dan `logs/`

## File Structure untuk Deployment

```
KartuPerpus-Digital/
├── nixpacks.toml          # Konfigurasi Nixpacks
├── composer.json          # Dependencies PHP
├── .htaccess             # Konfigurasi Apache
├── .dockerignore         # File yang diabaikan saat build
├── .env.example          # Template environment variables
├── README.md             # Dokumentasi project
├── health.php            # Health check endpoint
├── setup.sh              # Setup script (Linux/Mac)
├── setup.bat             # Setup script (Windows)
├── index.php             # Main application
├── register.php          # Registration page
├── dashboard.php         # Dashboard page
├── members/              # Data storage (JSON files)
├── public/               # Static assets
│   ├── style.css
│   ├── chart.js/
│   └── Font-Awesome-6.x/
└── logs/                 # Application logs
```

## Troubleshooting

### Common Issues

1. **Build Failed**
   - Periksa `nixpacks.toml` syntax
   - Pastikan PHP version sesuai
   - Check composer dependencies

2. **Permission Denied**
   - Pastikan folder `members/` dan `logs/` memiliki permission 755
   - Jalankan setup script jika diperlukan

3. **Static Assets Not Loading**
   - Periksa path di file CSS/JS
   - Pastikan folder `public/` ter-commit ke repository

4. **Health Check Failed**
   - Akses `/health.php` untuk detail error
   - Periksa file permission dan keberadaan folder

### Monitoring
- Gunakan Coolify logs untuk monitoring
- Setup alerting untuk uptime monitoring
- Monitor `/health.php` endpoint untuk health checks

### Scaling
- Coolify mendukung horizontal scaling
- Untuk high traffic, pertimbangkan database eksternal
- Implement caching untuk performa lebih baik

## Support
Jika mengalami masalah deployment, periksa:
1. Coolify documentation
2. Nixpacks documentation
3. Project logs di `/health.php`
