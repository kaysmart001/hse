## CBT Dokumentasi

## Langkah-langkah
1. Tambah/Buat Topik terlebih dahulu
2. Tambah/Buat/Import Soal berdasarkan Topik
3. Tambah/Buat Ujian

## Import Soal
- File excel
- Ikuti template
- Ubah dibagian yang sudah ditentukan saja
- Soal yang dapat diimport hanya pilihan ganda (karena harus dikoreksi oleh sistem, maka ada relasi antara soal dan jawaban siswa)
- Soal ujian tidak boleh kurang dari 1 (jika kurang dari 1 maka ada bug ketika ujian sedang berjalan)

## Ujian
- Ujian tidak dapat diubah ketika siswa/user yang sedang atau sudah berjalan
- Ujian dapat dilakukan kembali selama waktu/durasi masih ada
- Ujian disimpan otomatis setelah memilih jawaban (antisipasi ketika ujian berhenti ditengah jalan, mati lampu, gangguan koneksi, dan waktu habis sebelum distop oleh siswa)
- Ujian tipe essai dikoreksi oleh admin/guru melalui menu ujian pada detail ujian masing-masing
- Ujian secara default nilai masing-masing dari tiap soal 1 poin