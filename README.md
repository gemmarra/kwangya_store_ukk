# KWANGYA STORE

## Description

Kwangya Store adalah aplikasi Point Of Sale yang berfokus pada penjualan merchandise SM Entertainment 
yang sekaligus menjadi projek Uji Kompetensi Keahlian Rekayasa Perangkat Lunak 2023/2024.
Kwangya Store menyuguhkan antarmuka pengguna yang menarik yang tentunya akan menambah pengalaman pengguna.

## Teknologi yang digunakan
1. Codeigniter 4
2. MySQL
3. PHP, HTML, CSS, dan JavaScript
4. Jquery Mask
5. DataTables
6. Select2

## Fitur
1. Alat Penghitung
2. Manajement pengguna, penjualan, pemebelian, dan produk

## Download & Instalasi
1. Jalankan CMD / Terminal
2. Masuk ke drive D: atau yang lain jika di linux silahkan masuk direktori mana saja
3. Jalankan perintah : 
    <code>
    git clone https://github.com/gemmarra/kwangya_store_ukk.git
    </code>
4. Lakukan update dengan perintah 
   composer update
5. Ganti file env menjadi .env
6. Seting :
   <code> 
   CI_ENVIRONMENT = development atau production
   
   app.baseURL = 'http://localhost:8080'

   database.default.hostname = localhost
   database.default.database = kwangya_store
   database.default.username = root
   database.default.password = 
   database.default.DBDriver = MySQLi
    </code>
    
## Menjalankan aplikasi
1. Buka terminal
2. Jalankan perintah
   php spark serve
3. Buka browser, akeses URL
   http://localhost:8080
   
