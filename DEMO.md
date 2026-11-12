Skenario Demo UAS

Catatan saya untuk urutan demo aplikasi Perpustakaan Digital Kampus pas UAS nanti, biar tidak lupa langkahnya dan sesuai outline Pertemuan 11.

Sebelum mulai

Reset database biar datanya bersih dan konsisten:

php artisan migrate:fresh --seed

Nyalakan dua server (wajib, biar Dashboard dan Laporan tidak error):

php artisan serve --port=8000
php artisan serve --port=8011

Buka Postman juga, siapin collection app-perpustakaan buat demo API di langkah terakhir.

Akun yang dipakai

- admin@pens.ac.id / password - role admin
- petugas1@pens.ac.id / password - role petugas

Urutan demo

- Login sebagai admin di http://127.0.0.1:8000/login, tunjukkan pesan sukses dan otomatis masuk ke Dashboard.
- Tampilkan Dashboard, jelaskan tiga kartu statistik (Total Buku, Total Anggota, Peminjaman Aktif) itu bukan query langsung ke database, tapi diambil lewat GET /api/stats dari server kedua (port 8011).
- Tambah Kategori, buka menu Kategori, tambah satu kategori baru, tunjukkan langsung muncul di tabel.
- Tambah Buku, buka menu Buku, isi form lengkap pakai kategori yang baru dibuat tadi, tunjukkan nama kategori muncul (bukan ID-nya).
- Tambah Anggota, isi form anggota baru, tunjukkan validasi NIM/email unik jalan.
- Buat Peminjaman, pilih anggota, tanggal, centang buku yang mau dipinjam. Tunjukkan kolom Petugas sudah otomatis terisi nama saya yang sedang login, tidak perlu pilih manual lagi.
- Lihat daftar peminjaman aktif, tunjukkan badge status berwarna (kuning = dipinjam, hijau = dikembalikan, merah = terlambat).
- Proses pengembalian, klik tombol "Kembalikan" di salah satu transaksi yang masih dipinjam, tunjukkan status dan tanggal kembali berubah otomatis.
- Tampilkan Laporan, buka menu Laporan, jelaskan datanya diambil dari GET /api/loans, bukan query Eloquent langsung dari Controller web.
- Demo API di Postman:
  - GET /api/books, tunjukkan format {"data": [...], "links": {...}, "meta": {...}}
  - GET /api/books?judul=..., tunjukkan hasil terfilter
  - POST /api/books data lengkap, status 201
  - POST /api/books data kosong, status 422 dengan pesan error per field
  - GET /api/books/999, status 404
  - GET /api/stats, tunjukkan ringkasan angka

Hal yang mau saya tekankan ke dosen

- Middleware auth dan admin beneran mengunci akses, bukan cuma disembunyikan di tampilan, saya coba akses /categories pakai akun petugas, hasilnya 403.
- Kalau server API internal (port 8011) saya matikan, Dashboard dan Laporan tetap kebuka (cuma datanya kosong/nol), tidak sampai error 500, karena sudah ditangani ConnectionException.