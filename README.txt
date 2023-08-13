php version 8.1.10
Laravel Framework 10.18.0
MySQL Server version 8.0.30

panduan penggunaan:
- Run git clone https://github.com/sifaniaffan14/Inventory_Sekawan.git
- Run composer install
- Run cp .env.example .env
- Run php artisan key:generate
- Run php artisan migrate
- Run php artisan db:seed OR import database file inventory.db
- apabila menggunakan db:seed:
  - login user =
     1. admin = username:admin, password:admin
  - cara login manager: 
     a. buat user manager terlebih dahulu di sistem:
        1. masuk login sebagai admin
        2. pilih menu data karyawan
      	3. pilih tambah
      	4. masukkan data dan pilih option jabatan=manager
      	5. simpan data
     b. login manager:
	1. username:nama manager(dari data yang sudah sebelumnya dibuat)
        2. password:manager_123
  -  cara login direktur:
     a. buat user direktur terlebih dahulu di sistem:
        1. masuk login sebagai admin
        2. pilih menu data karyawan
      	3. pilih tambah
      	4. masukkan data dan pilih option jabatan=direktur
      	5. simpan data
     b. login direktur:
	1. username:nama direktur(dari data yang sudah sebelumnya dibuat)
        2. password:direktur_123
    
  