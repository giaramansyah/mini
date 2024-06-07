
## Instruction
Buat project web dengan fitur sbb :
* register
* login
* logout
* upload file excel terlampir
* import data excel ke database

Catatan :
* bahasa pemrograman & framework yang digunakan dalam project tidak diatur 
* import seluruh data yang ada pada file excel terlampir (semua sheet)
* gunakan github sebagai repository project, buat sebagai public repository

## Cara Instalasi
Requirement
* PHP 8.2
* MySQL

Setup
1. ubah konfigurasi php.ini
* max_execution_time = 1800 
* max_input_vars = 1000000
* memory_limit = 1024M
* upload_max_filesize = 50M
* post_max_size = 50M

2. ubah konfigurasi engine server (jika menggunakan nginx)
* client_header_timeout   1800s;
* client_body_timeout     1800s;
* send_timeout           1800s;
* fastcgi_read_timeout    1800s;
* fastcgi_send_timeout    1800s;
* fastcgi_buffers         8 128k;
* fastcgi_buffer_size     128k;

3. ubah konfigurasi php-fpm (jika menggunakan nginx)
* request_terminate_timeout = 1800s

4. setup konfigurasi file .env
* APP_URL=http://miniapp.localhost (sesuaikan path urlnya, arahkan ke folder public jika menggunakan real path url)
* ASSET_URL=http://miniapp.localhost/assets (susuaikan path urlnya)
* DB_DATABASE=db_mini (sesuaikan nama databasenya)
* DB_USERNAME=root (sesuaikan username databasenya)
* DB_PASSWORD=asdasdF1@ (sesuaikan password databasenya)

Note
* dikarenakan downside dari upload excel jika datanya banyak maka akan memerlukan resource yang lebih besar juga dari standarnya makannya kenapa dibutuhkan setup konfigurasi pada sisi server dan php nya