# SIMPEL

**Sistem Manajemen PKL (SIMPEL)** adalah aplikasi web berbasis Laravel untuk mengelola proses Praktik Kerja Lapangan (PKL) siswa SMK ICB Cinta Niaga Bandung.

SIMPEL membantu siswa, Hubin, dan perusahaan mitra dalam mengelola pengajuan PKL, data perusahaan, proses persetujuan, surat pengantar, serta informasi penerimaan siswa.

---

## Fitur

### Student

- Login menggunakan akun yang dibuat oleh sekolah.
- Melihat daftar perusahaan mitra.
- Melihat informasi dan kuota perusahaan.
- Mengajukan PKL secara individu.
- Mengajukan PKL secara kelompok.
- Menambahkan anggota kelompok tanpa batas jumlah tertentu.
- Mengubah pengajuan selama masih berstatus menunggu proses.
- Membatalkan pengajuan.
- Keluar dari kelompok.
- Mengalihkan kepemimpinan kelompok.
- Melihat status pengajuan PKL.
- Melihat informasi surat pengantar PKL.
- Melihat respons perusahaan.
- Melihat daftar siswa yang diterima.

### Hubin

- Dashboard Hubin.
- Mengelola data perusahaan mitra.
- Mengatur status perusahaan.
- Mengatur kuota perusahaan.
- Melihat seluruh pengajuan PKL.
- Mencari pengajuan berdasarkan kode, siswa, atau perusahaan.
- Memfilter pengajuan berdasarkan status.
- Menyetujui pengajuan PKL.
- Menolak pengajuan PKL.
- Mengembalikan pengajuan yang telah diproses ke status menunggu.
- Membuat dan mengelola surat pengantar PKL.
- Memberikan nomor surat.
- Menerbitkan surat pengantar.
- Menangguhkan surat.
- Membatalkan surat.
- Memulihkan surat yang dibatalkan.
- Menampilkan surat pengantar dalam format PDF.

### Company

- Dashboard perusahaan.
- Mengelola informasi perusahaan.
- Mengelola kontak HR.
- Mengelola kuota perusahaan.
- Melihat pengajuan siswa yang telah disetujui Hubin dan memiliki surat pengantar terbit.
- Menerima pengajuan PKL.
- Menolak pengajuan PKL.
- Membatalkan respons perusahaan.
- Melihat daftar siswa yang diterima.
- Memisahkan data siswa yang masih aktif dan alumni berdasarkan tanggal selesai PKL.

---

## Alur Sistem

Secara umum proses PKL pada SIMPEL berjalan sebagai berikut:

```text
Student
   │
   ▼
Memilih perusahaan
   │
   ▼
Membuat pengajuan PKL
   │
   ▼
Status: Submitted
   │
   ▼
Hubin memeriksa pengajuan
   │
   ├── Reject ───────────────► Status: Rejected
   │
   └── Approve
          │
          ▼
   Membuat Surat Pengantar
          │
          ▼
   Surat diterbitkan
          │
          ▼
   Company melihat pengajuan
          │
          ├── Reject ───────► Company Response: Rejected
          │
          └── Accept ───────► Company Response: Accepted
                                      │
                                      ▼
                              Siswa Diterima
```

Status pengajuan Hubin dan respons perusahaan dipisahkan.

### Status Pengajuan PKL

| Status      | Keterangan                                        |
| ----------- | ------------------------------------------------- |
| `submitted` | Pengajuan telah dikirim dan menunggu proses Hubin |
| `approved`  | Pengajuan telah disetujui Hubin                   |
| `rejected`  | Pengajuan ditolak Hubin                           |

### Status Respons Perusahaan

| Status      | Keterangan                     |
| ----------- | ------------------------------ |
| `pending`   | Belum ada keputusan perusahaan |
| `accepted`  | Perusahaan menerima pengajuan  |
| `rejected`  | Perusahaan menolak pengajuan   |
| `withdrawn` | Respons perusahaan dibatalkan  |

---

## Teknologi

SIMPEL dibangun menggunakan:

- **Laravel 13**
- **PHP 8.3**
- **MySQL**
- **Blade**
- **Tailwind CSS**
- **Vite**
- **DomPDF**
- **Laravel Eloquent ORM**
- **Laravel Authentication**

---

## Struktur Database

Database utama yang digunakan:

```text
simpel
```

Tabel utama:

```text
users
companies
internship_applications
group_members
introduction_letters
company_responses
```

### `users`

Menyimpan akun pengguna sistem.

Role yang tersedia:

```text
student
hubin
company
```

### `companies`

Menyimpan data perusahaan mitra.

Data utama:

```text
company_name
full_address
hr_contact
available_quota
partner_status
```

### `internship_applications`

Menyimpan pengajuan PKL.

Data utama:

```text
application_code
leader_student_id
company_id
application_date
internship_start_date
internship_end_date
status
response_letter_file
```

### `group_members`

Menyimpan anggota kelompok PKL.

Sistem tidak membatasi jumlah anggota kelompok secara maksimal.

### `introduction_letters`

Menyimpan surat pengantar PKL yang dibuat oleh Hubin.

Surat dapat memiliki beberapa versi untuk satu pengajuan.

Status surat:

```text
draft
issued
suspended
cancelled
```

### `company_responses`

Menyimpan keputusan perusahaan terhadap pengajuan PKL.

Tabel ini dipisahkan dari status pengajuan Hubin sehingga keputusan Hubin dan keputusan perusahaan tidak tercampur.

---

# Instalasi

Bagian berikut digunakan untuk menjalankan SIMPEL pada komputer baru.

## 1. Persyaratan

Pastikan komputer telah memiliki:

- PHP 8.3 atau lebih baru
- Composer
- Node.js dan npm
- MySQL atau MariaDB
- Git
- Web browser

Versi yang digunakan saat pengembangan:

```text
Laravel 13.31.0
PHP 8.3.30
MySQL
Node.js
npm
```

---

## 2. Clone Repository

Clone repository menggunakan Git:

```bash
git clone <URL_REPOSITORY>
```

Masuk ke folder proyek:

```bash
cd simpel
```

> Ganti `<URL_REPOSITORY>` dengan URL repository GitHub proyek SIMPEL.

---

## 3. Install Dependency Laravel

Jalankan:

```bash
composer install
```

Perintah ini akan memasang seluruh dependency PHP yang dibutuhkan Laravel.

---

## 4. Install Dependency Frontend

Jalankan:

```bash
npm install
```

Perintah ini memasang dependency frontend yang digunakan oleh Vite dan Tailwind CSS.

---

## 5. Membuat File `.env`

Salin file konfigurasi contoh:

```bash
cp .env.example .env
```

Pada Windows jika perintah `cp` tidak tersedia, file dapat dibuat secara manual dengan menyalin:

```text
.env.example
```

menjadi:

```text
.env
```

---

## 6. Generate Application Key

Jalankan:

```bash
php artisan key:generate
```

Laravel akan mengisi:

```env
APP_KEY=
```

dengan application key baru.

---

## 7. Konfigurasi Database

Buat database MySQL dengan nama:

```text
simpel
```

Contoh menggunakan MySQL:

```sql
CREATE DATABASE simpel;
```

Kemudian buka file `.env` dan sesuaikan konfigurasi database:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=simpel
DB_USERNAME=root
DB_PASSWORD=
```

Jika MySQL menggunakan password, isi nilai:

```env
DB_PASSWORD=
```

sesuai password MySQL pada komputer tersebut.

---

## 8. Menjalankan Migration dan Seeder

Untuk instalasi baru, gunakan:

```bash
php artisan migrate:fresh --seed
```

Perintah tersebut akan:

1. Menghapus tabel database yang sudah ada.
2. Membuat seluruh tabel berdasarkan migration.
3. Menjalankan seeder.
4. Mengisi data awal yang diperlukan sistem.

> **Perhatian:** `migrate:fresh` menghapus seluruh tabel beserta datanya. Jangan menjalankan perintah ini pada database yang berisi data penting tanpa membuat backup terlebih dahulu.

---

## 9. Membuat Storage Link

Laravel menggunakan storage untuk file yang perlu diakses melalui web.

Jalankan:

```bash
php artisan storage:link
```

---

## 10. Menjalankan Vite

Buka terminal:

```bash
npm run dev
```

Vite akan menjalankan development server untuk asset frontend.

Biarkan terminal ini tetap berjalan selama proses development.

---

## 11. Menjalankan Laravel

Buka terminal lain pada folder proyek dan jalankan:

```bash
php artisan serve
```

Laravel akan tersedia pada:

```text
http://127.0.0.1:8000
```

atau:

```text
http://localhost:8000
```

Buka alamat tersebut melalui browser.

---

# Login

SIMPEL menggunakan sistem login berbasis role.

Akun pengguna dibuat oleh pihak sekolah/Hubin dan bukan melalui registrasi publik.

Role yang tersedia:

```text
student
hubin
company
```

Setelah login, pengguna akan diarahkan ke dashboard berdasarkan role masing-masing.

```text
student  → Student Dashboard
hubin    → Hubin Dashboard
company  → Company Dashboard
```

---

# Development

Untuk menjalankan proyek selama development:

### Terminal 1

```bash
npm run dev
```

### Terminal 2

```bash
php artisan serve
```

Kemudian buka:

```text
http://localhost:8000
```

---

# Perintah Artisan yang Berguna

### Menjalankan migration

```bash
php artisan migrate
```

### Menjalankan seeder

```bash
php artisan db:seed
```

### Reset database dan jalankan seeder

```bash
php artisan migrate:fresh --seed
```

### Melihat daftar route

```bash
php artisan route:list
```

### Membersihkan cache

```bash
php artisan optimize:clear
```

### Membuat model dan migration

```bash
php artisan make:model ModelName -m
```

### Membuat controller

```bash
php artisan make:controller ControllerName
```

---

# Struktur Direktori

Struktur utama proyek:

```text
simpel/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       ├── Company/
│   │       ├── Hubin/
│   │       └── Student/
│   │
│   └── Models/
│       ├── User.php
│       ├── Company.php
│       ├── InternshipApplication.php
│       ├── GroupMember.php
│       ├── IntroductionLetter.php
│       └── CompanyResponse.php
│
├── database/
│   ├── migrations/
│   └── seeders/
│
├── resources/
│   └── views/
│       ├── company/
│       ├── hubin/
│       ├── student/
│       ├── auth/
│       └── layouts/
│
├── routes/
│   └── web.php
│
├── storage/
│
├── public/
│
├── .env
├── artisan
├── composer.json
├── package.json
└── README.md
```

---

# Keamanan dan Authorization

SIMPEL menggunakan middleware berdasarkan role untuk membatasi akses halaman.

Contoh:

```text
student
    ↓
Student routes

hubin
    ↓
Hubin routes

company
    ↓
Company routes
```

Selain middleware, beberapa proses memiliki pemeriksaan authorization tambahan di controller.

Contohnya:

- Student hanya dapat mengubah pengajuan miliknya.
- Leader memiliki hak khusus terhadap kelompok.
- Company hanya dapat melihat pengajuan yang ditujukan kepada perusahaannya.
- Hubin dapat mengelola pengajuan dan surat pengantar.
- Surat pengantar PDF hanya dapat dilihat oleh pengguna yang berhubungan dengan pengajuan tersebut.

---

# Surat Pengantar PKL

Hubin dapat membuat surat pengantar berdasarkan pengajuan PKL.

Surat memiliki nomor surat dan status.

Surat dengan status:

```text
issued
```

dapat ditampilkan dalam format PDF.

PDF surat dapat diakses oleh:

- Hubin
- Perusahaan tujuan
- Siswa yang menjadi leader
- Anggota kelompok terkait

Akses terhadap PDF tetap diperiksa oleh controller sehingga pengguna tidak dapat membuka surat milik pengajuan lain hanya dengan mengetahui ID surat.

---

# Group Application

SIMPEL mendukung pengajuan individu maupun kelompok.

Struktur kelompok:

```text
Leader
 ├── Member
 ├── Member
 ├── Member
 └── ...
```

Jumlah anggota tidak dibatasi oleh sistem.

Leader memiliki tanggung jawab utama terhadap pengajuan kelompok.

Anggota dapat keluar dari kelompok selama pengajuan masih berada pada kondisi yang memungkinkan perubahan.

---

# Company Response

Respons perusahaan disimpan secara terpisah dari status pengajuan Hubin.

Contoh:

```text
Hubin:
approved

Company:
accepted
```

Artinya:

> Hubin telah menyetujui pengajuan dan perusahaan telah menerima siswa.

Kedua status tersebut memiliki fungsi yang berbeda dan tidak digabungkan menjadi satu status.

---

# Status Siswa Diterima

Data siswa yang diterima perusahaan ditentukan berdasarkan:

```text
InternshipApplication
        +
CompanyResponse
        +
IntroductionLetter
```

Siswa dianggap diterima apabila:

```text
application.status = approved
company_response.status = accepted
introduction_letter.status = issued
```

Status aktif atau alumni ditentukan berdasarkan:

```text
internship_end_date
```

Jika tanggal selesai PKL belum terlewati, siswa ditampilkan sebagai siswa aktif.

Jika tanggal selesai PKL telah terlewati, siswa ditampilkan sebagai alumni.

---

# Tujuan Pengembangan

SIMPEL dikembangkan sebagai implementasi tugas Praktik Pemrograman Web dan Bergerak (PWB) dengan studi kasus pengelolaan Praktik Kerja Lapangan.

Sistem ini dirancang untuk mengurangi proses manual dalam:

- pengelolaan perusahaan mitra,
- pengajuan PKL,
- pengelolaan kelompok,
- validasi pengajuan,
- pembuatan surat pengantar,
- pemantauan status,
- dan konfirmasi penerimaan perusahaan.

---

# Status Proyek

**Development Status: Feature Complete / Finalization**

Fitur utama sistem telah selesai dikembangkan.

Tahap berikutnya berfokus pada:

- testing,
- perbaikan bug,
- pengecekan authorization,
- penyempurnaan UI,
- pengecekan data dan seeder,
- dokumentasi,
- serta persiapan presentasi dan laporan.

Beberapa fitur yang tercantum pada rancangan awal LKPD tidak menjadi bagian dari implementasi final, terutama:

- QR Code / digital stamp pada surat.
- Modul plotting pembimbing.
- Upload file surat balasan industri.

Untuk respons perusahaan, SIMPEL menggunakan mekanisme respons digital:

```text
pending
accepted
rejected
withdrawn
```

sehingga tidak diperlukan upload PDF surat balasan industri pada implementasi final.

---

## Author

**SIMPEL — Sistem Manajemen PKL**

Dikembangkan untuk kebutuhan pembelajaran:

**SMK ICB Cinta Niaga Bandung**

Program Keahlian:

**Pengembangan Perangkat Lunak dan Gim (PPLG)**
