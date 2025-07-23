# Ecommerce-App

Aplikasi Ecommerce berbasis Laravel 12 + Filament v3

## Demo Tampilan

### Dashboard Admin
![Dashboard Admin](public/screenshots/dashboard-admin.png)

### Halaman Produk
![Halaman Produk](public/screenshots/produk.png)

### Halaman Login Register


### Halaman Checkout


## Fitur Utama
- Manajemen Produk (CRUD, gambar, kategori, stok, harga)
- Manajemen Kategori
- Manajemen Order & Cart
- Checkout & Riwayat Pesanan
- Admin Panel dengan Filament (role admin terpisah dari frontend)
- Autentikasi (Laravel Breeze)
- Validasi & keamanan data
- Upload gambar produk (storage public)
- Responsive UI (Tailwind CSS)
- Notifikasi database (Filament)

## Instalasi & Setup

### 1. Clone Repository
```bash
# Ganti URL sesuai repo Anda
git clone <repo-url>
cd UAS-KSI
```

### 2. Install Dependency
```bash
composer install
npm install
```

### 3. Copy & Edit .env
```bash
cp .env.example .env
# Edit DB_DATABASE, DB_USERNAME, DB_PASSWORD sesuai environment Anda
```

### 4. Generate Key
```bash
php artisan key:generate
```

### 5. Migrasi & Seeder
```bash
php artisan migrate:fresh --seed
```

### 6. Storage Link
```bash
php artisan storage:link
```

### 7. Build Frontend Assets
```bash
npm run build
```

### 8. Jalankan Server
```bash
php artisan serve
```

## Login Default
- **Admin Panel (Filament):**
  - URL: `/admin`
  - Email: `admin@example.com`
  - Password: `password123`
- **Frontend:**
  - Register akun baru atau login dengan admin di atas

## Struktur Folder Penting
- `app/Filament/Resources` : Resource admin panel
- `app/Http/Controllers` : Controller frontend
- `resources/views` : Blade views frontend
- `storage/app/public/products` : Upload gambar produk
- `database/seeders/DatabaseSeeder.php` : Seeder data awal

## Catatan
- Untuk upload gambar produk, gunakan fitur upload di admin panel (Filament)
- Jika gambar tidak tampil, pastikan sudah menjalankan `php artisan storage:link` dan file ada di `storage/app/public/products/`
- Untuk development, gunakan `npm run dev` agar assets auto-reload

## Lisensi
MIT
