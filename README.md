# 📦 PORTOFOLIO Laravel Project

Project ini adalah aplikasi Laravel yang berjalan di lingkungan lokal menggunakan XAMPP atau Laravel Sail.

---

## 🛠️ Cara Menjalankan Project di Lokal (Manual Book)

### 1. **Ekstrak File**
Ekstrak `laravel.zip` ke direktori lokal, misalnya:
```
C:\xampp\htdocs\laravel\PORTOFOLIO
```

---

### 2. **Jalankan XAMPP**

- Buka **XAMPP Control Panel**
- Aktifkan:
  - `Apache`
  - `MySQL`

---

### 3. **Copy `.env`**

Salin file `.env.example` menjadi `.env`:
```bash
cp .env.example .env
```

---

### 4. **Install Dependency Composer**

Jalankan perintah ini di terminal dalam folder project:

```bash
composer install
```

> Jika `composer` belum diinstal, download di: https://getcomposer.org/download/

---

### 5. **Generate Application Key**

```bash
php artisan key:generate
```

---

### 6. **Setup Database**

- Buka `phpMyAdmin`
- Buat database, misalnya `portofolio`
- Di file `.env`, atur bagian ini:

```
DB_DATABASE=portofolio
DB_USERNAME=root
DB_PASSWORD=
```

---

### 7. **Migrasi dan Seeder (Opsional)**

Jika kamu punya file migrasi dan seeder:

```bash
php artisan migrate
php artisan db:seed
```

---

### 8. **Jalankan Server Laravel**

```bash
php artisan serve
```

Lalu buka browser di:
```
http://127.0.0.1:8000
```

---

## 🔐 Catatan Tambahan

- Jangan lupa ubah permission folder `storage` dan `bootstrap/cache` jika error permission.
- `.env` tidak disarankan diupload ke GitHub karena menyimpan konfigurasi sensitif.
- Untuk memastikan semua fitur jalan, pastikan `mod_rewrite` Apache aktif.
## 💾 Database Backup

File backup database tersedia di:
---
Untuk mengimpor:
1. Buka `phpMyAdmin`
2. Buat database baru (misal: `fdrix`)
3. Pilih tab `Import`, lalu upload `db_fdrix.sql`
## 👤 Author

- Nama: [Kelompok]
- GitHub: [https://github.com/ibehhh](https://github.com/ibehhh)
