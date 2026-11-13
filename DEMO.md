# Skenario Demo Aplikasi Perpustakaan

Dokumen ini berisi urutan demonstrasi aplikasi Perpustakaan Digital Kampus.

## 1. Persiapan Demo

Sebelum demo dimulai:

1. Reset database biar datanya bersih: `php artisan migrate:fresh --seed`.
2. Jalankan server utama pada port `8000`.
3. Jalankan internal API pada port `8011` di terminal lain.
4. Siapkan akun untuk login (lihat tabel di bawah).
5. Siapkan Postman dan request API yang akan ditunjukkan.

Akun yang disiapkan:

| Email | Password | Role |
|---|---|---|
| admin@pens.ac.id | password | admin |
| petugas1@pens.ac.id | password | petugas |

## 2. Urutan Demonstrasi

### Langkah 1 — Login

1. Buka aplikasi melalui `http://127.0.0.1:8000`.
2. Masukkan email dan password akun admin yang telah disiapkan.
3. Tunjukkan pesan sukses dan pengguna otomatis diarahkan ke halaman Dashboard.

### Langkah 2 — Menampilkan Dashboard

1. Setelah login, akan terbuka halaman Dashboard.
2. Tunjukkan tiga kartu statistik: Total Buku, Total Anggota, dan Peminjaman Aktif.
3. Jelaskan bahwa data ini diambil lewat `GET /api/stats` dari server kedua (port 8011), bukan query langsung ke database.

### Langkah 3 — Menambahkan Kategori

1. Buka menu Kategori pada navigasi di atas.
2. Klik tombol "+ Tambah Kategori".
3. Isi nama kategori dan deskripsi.
4. Pastikan data kategori sudah benar, lalu klik tombol "Simpan".

### Langkah 4 — Menambahkan Buku

1. Buka menu Buku pada navigasi di atas.
2. Klik tombol "+ Tambah Buku".
3. Isi data buku sesuai form, pilih kategori yang baru dibuat di Langkah 3.
4. Pastikan data buku sudah benar, lalu klik tombol "Simpan".
5. Tunjukkan nama kategori muncul di tabel (bukan ID-nya).

### Langkah 5 — Menambahkan Anggota

1. Buka menu Anggota pada navigasi di atas.
2. Klik tombol "+ Tambah Anggota".
3. Isi data anggota sesuai form.
4. Pastikan data anggota sudah benar, lalu klik tombol "Simpan".

### Langkah 6 — Membuat Peminjaman

1. Buka menu Peminjaman pada navigasi di atas.
2. Klik tombol "+ Tambah Peminjaman".
3. Pilih anggota, isi tanggal pinjam dan kembali, centang buku yang akan dipinjam.
4. Tunjukkan kolom Petugas sudah otomatis terisi nama akun yang sedang login, tidak perlu pilih manual.
5. Klik "Simpan" untuk menyimpan transaksi.

### Langkah 7 — Melihat Daftar Peminjaman Aktif

1. Buka menu Peminjaman.
2. Tunjukkan list seluruh transaksi beserta badge status berwarna (kuning = dipinjam, hijau = dikembalikan, merah = terlambat).

### Langkah 8 — Memproses Pengembalian

1. Pilih salah satu transaksi yang masih berstatus "Dipinjam" pada halaman Peminjaman.
2. Klik tombol "Kembalikan".
3. Tunjukkan status berubah menjadi "Dikembalikan" dan tanggal pengembalian terisi otomatis.

### Langkah 9 — Menampilkan Laporan

1. Buka menu Laporan pada navigasi di atas.
2. Tunjukkan tabel laporan peminjaman lengkap dengan nama anggota, petugas, dan daftar buku.
3. Jelaskan datanya diambil dari `GET /api/loans`, bukan query Eloquent langsung dari Controller web.

### Langkah 10 — Demo API Menggunakan Postman

1. Buka Postman.
2. Siapkan request ke base URL API: `http://127.0.0.1:8000/api`.
3. Tunjukkan `GET /api/books` — format response `{"data": [...], "links": {...}, "meta": {...}}`.
4. Tunjukkan `GET /api/books?judul=...` — hasil sudah terfilter.
5. Tunjukkan `POST /api/books` dengan data lengkap — status `201 Created`.
6. Tunjukkan `POST /api/books` dengan data kosong — status `422 Unprocessable Entity` beserta pesan error per field.
7. Tunjukkan `GET /api/books/999` — status `404 Not Found`.
8. Tunjukkan `GET /api/stats` — ringkasan statistik.

> Catatan: siapkan request Postman dan tambahkan header `Accept: application/json` di setiap request sebelum demo, supaya tidak perlu mengetik ulang saat presentasi.

## 3. Penutup

Akhiri demonstrasi dengan memastikan alur utama aplikasi telah ditunjukkan, mulai dari pengelolaan data kategori, buku, dan anggota hingga transaksi peminjaman, pengembalian, laporan, serta API.

Hal yang juga ditekankan: middleware `auth` dan `admin` beneran mengunci akses (bukan cuma disembunyikan di tampilan) — akun petugas yang mencoba akses `/categories` akan mendapat halaman 403. Kalau server API internal (port 8011) dimatikan, Dashboard dan Laporan tetap bisa dibuka (datanya kosong/nol), tidak sampai error 500.