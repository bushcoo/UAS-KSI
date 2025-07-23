# Ecommerce-App

Aplikasi Ecommerce berbasis Laravel 12 + Filament v3

## Demo Tampilan

### Halaman Login Register
<img width="700" height="600" alt="image" src="https://github.com/user-attachments/assets/aa112a46-2367-40f8-9a7e-28d74b84fa52" />
<img width="700" height="600" alt="image" src="https://github.com/user-attachments/assets/174bb33a-703c-45d4-88b0-43336ca9b74a" />

### Dashboard Admin
<img width="700" height="600" alt="image" src="https://github.com/user-attachments/assets/ef3a1af6-6883-4025-88c2-b3e1d34ac37c" />

### Halaman Produk
<img width="700" height="600" alt="image" src="https://github.com/user-attachments/assets/a8849cb8-5f5a-4055-be90-79cd5bc0e9bb" />

### Halaman Checkout
<img width="700" height="600" alt="image" src="https://github.com/user-attachments/assets/6a5a0c73-583b-4c15-8b1a-70fa3fbc61e0" />
<img width="700" height="600" alt="image" src="https://github.com/user-attachments/assets/a7e6fa8a-69d6-4933-9976-81212d0f293b" />
<img width="700" height="600" alt="image" src="https://github.com/user-attachments/assets/e7a4f39d-c7f4-4d29-ac9c-c910b3b5950d" />
<img width="700" height="600" alt="image" src="https://github.com/user-attachments/assets/f32bb4ff-4647-4ee0-a21b-075cb706715b" />

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
  
## Security Assessment & Best Practice
Aplikasi ini telah menerapkan beberapa best practice keamanan dan dilakukan assessment sebagai berikut:

- **Autentikasi & Otorisasi**
  - Menggunakan Laravel Breeze untuk frontend dan guard terpisah untuk admin panel (Filament)
  - Session admin dan frontend terpisah (guard `web` dan `admin`)
  - Proteksi route dengan middleware `auth` dan `role`

- **Validasi & Sanitasi Input**
  - Semua input divalidasi menggunakan Form Request
  - Validasi tipe data, panjang, dan format
  - Validasi unik untuk email, slug, SKU, dsb

- **Keamanan Data**
  - Password di-hash dengan bcrypt
  - Data sensitif tidak pernah ditampilkan di frontend
  - Soft delete untuk data penting (produk, kategori, order)

- **Proteksi CSRF & XSS**
  - Semua form menggunakan CSRF token
  - Output di-escape di Blade
  - Tidak ada eval/exec di sisi backend

- **Rate Limiting**
  - Pembatasan request login, register, dan API

- **File Upload**
  - Upload gambar hanya ke folder `storage/app/public/products`
  - Validasi file type dan size (di Filament resource)
  - File diakses via symlink `public/storage`

- **Session & Cookie**
  - Cookie terenkripsi
  - Session timeout mengikuti default Laravel
  - Session admin dan frontend tidak saling overwrite

- **Assessment Manual**
  - Uji coba brute force login (rate limit aktif)
  - Uji upload file non-gambar (ditolak)
  - Uji XSS di input produk/kategori (output aman)
  - Uji akses admin tanpa login (redirect ke login)
  - Uji akses frontend tanpa login (redirect ke login/register)

- **Best Practice Lainnya**
  - Tidak ada hardcoded credentials di kode
  - Tidak ada file .env di repo
  - Tidak ada debug mode di production
  
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
