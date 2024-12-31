## **Kelompok 7 - SI4605**

- Maryam Grischelda (1202223262)
- Balqis Eka N (1202220223)
- Alisha Deanova O (1202223105)
- Ryannisa Syarifa T (1202223163)
- M. Daffa Robbani (1202223072)

## **Link Project Final Tugas Besar Kami:** https://drive.google.com/file/d/1ZPahJnU_dDz8xvRVggQivFkdryI4gsK7/view?usp=sharing
Langkah-langkah menjalankan Project:
- Pastikan path directory benar.
- Sesuaikan dahulu file .env dengan localhost masing-masing, pastikan sudah ada database dengan nama ***db_immuniverse*** di localhost.
- Jalankan perintah ***php artisan migrate*** atau ***php artisan migrate:fresh*** pada terminal.
- Jalankan perintah ***php artisan db:seed --class=AmbulanceSeeder*** pada terminal.
- Jalankan perintah ***php artisan db:seed --class=DoctorSeeder*** pada terminal.
- Jalankan perintah ***php artisan strorage:link*** agar file image yang diupload di website akan masuk ke dalam file project. Jika link already exists, lanjut saja ke langkah berikutnya
- Pastikan ***barryvdh/laravel-dompdf*** sudah terinstall. Jika belum, maka jalankan perintah ***composer require barryvdh/laravel-dompdf***
- Jalankan ***php artisan serve***

### *Note: Untuk fitur profile tidak ada dipush secara terpisah dikarenakan sudah digabungkan oleh project laravel yang final. Sedangkan project laravel final kami tidak bisa dipush dikarenakan size yang terlalu besar


