# Kartu Perpustakaan Digital

Sistem manajemen keanggotaan perpustakaan digital yang modern dan responsif.

## Fitur Utama

- 📚 Manajemen anggota perpustakaan
- 🎨 Interface modern dan responsif
- 📊 Dashboard dengan statistik
- 🔍 Pencarian dan verifikasi anggota
- 📱 Mobile-friendly design

## Teknologi yang Digunakan

- PHP 8.2+
- HTML5, CSS3, JavaScript
- Chart.js untuk visualisasi data
- Font Awesome untuk ikon

## Deployment

### Coolify dengan Nixpacks

Project ini telah dikonfigurasi untuk deployment di Coolify menggunakan Nixpacks:

1. **Build Configuration**: `nixpacks.toml` mengatur PHP environment dan dependencies
2. **Port Configuration**: Aplikasi akan berjalan pada port yang ditetapkan oleh Coolify
3. **Static Assets**: Folder `public/` berisi CSS, JS, dan font yang diperlukan
4. **Data Storage**: Folder `members/` untuk menyimpan data anggota dalam format JSON

### Konfigurasi Environment

- **PHP Version**: 8.2
- **Port**: Menggunakan environment variable `$PORT` (default: 8080)
- **Web Server**: PHP built-in server

### File Penting

- `nixpacks.toml` - Konfigurasi build Nixpacks
- `composer.json` - Dependencies dan scripts PHP
- `index.php` - Halaman utama aplikasi
- `register.php` - Form pendaftaran anggota
- `dashboard.php` - Dashboard keanggotaan
- `members/` - Storage untuk data anggota

## Cara Menjalankan Lokal

```bash
# Install dependencies
composer install

# Jalankan server development
composer run dev

# Atau jalankan server production
composer run start
```

## Struktur Data

Data anggota disimpan dalam format JSON di folder `members/` dengan struktur:

```json
{
  "nim": "21533480",
  "nama": "Nama Lengkap",
  "email": "email@example.com",
  "fakultas": "Fakultas",
  "jurusan": "Jurusan",
  "tahun_masuk": "2021",
  "tanggal_daftar": "2024-01-15",
  "status": "aktif"
}
```

## Lisensi

Project ini dibuat untuk keperluan akademik dan pembelajaran.
