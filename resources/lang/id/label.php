<?php
return [
    'navigation' => [
        'home' => 'Beranda',
        'account' => 'Akun Saya',
        'logout' => 'Keluar',
        'password' => 'Ganti Kata Sandi',
        'parent_menu' => [
            'setting' => 'Setelan',
            'applog' => 'Log Aplikasi',
            'account' => 'Profil',
            'master' => 'Master'
        ],
        'menu' => [
            'privilege' => 'Hak Akses',
            'privigroup' => 'Grup Akses',
            'account' => 'Akun Pengguna',
            'accactivity' => 'Aktivitas Akun',
            'mailtrail' => 'Jejak Email',
            'apitrail' => 'Jejak API',
            'profile' => 'Akun Saya',
            'general' => 'General',
            'upload' => 'Unggah Data',
            'transaction' => 'Transaksi',
            'sales' => 'Penjualan',
            'product' => 'Produk',
            'ticket' => 'Tiket',
        ],
    ],

    'month' => [
        'jan' => 'Januari',
        'feb' => 'Februari',
        'mar' => 'Maret',
        'apr' => 'April',
        'may' => 'Mei',
        'jun' => 'Juni',
        'jul' => 'Juli',
        'aug' => 'Agustus',
        'sep' => 'September',
        'oct' => 'Ocktober',
        'nov' => 'November',
        'dec' => 'Desember',
    ],

    'day' => [
        'mon' => 'Senin',
        'tue' => 'Selasa',
        'wed' => 'Rabu',
        'thu' => 'Kamis',
        'fri' => 'Jumat',
        'sat' => 'Sabtu',
        'sun' => 'Minggu',
    ],

    'static' => [
        'select_option' => 'Pilih item',
        'empty_table' => 'Tidak Ada Data Ditemukan',
        'file' => 'Pilih File',
    ],

    'module' => [
        'create' => 'Buat Data',
        'update' => 'Perbaharui Data',
        'delete' => 'Hapus Data',
        'readall' => 'Baca Daftar Data',
        'readid' => 'Baca Detil Data',
    ],

    'button' => [
        'add' => 'Tambah baru',
        'edit' => 'Perbaharui',
        'delete' => 'Hapus',
        'submit' => 'Simpan',
        'back' => 'Kembali',
        'proceed' => 'Lanjutkan',
        'cancel' => 'Batal',
        'resetpass' => 'Kirim Ulang Kata Sandi',
        'deactive' => 'Non Aktifkan',
        'active' => 'Aktifkan',
        'lock' => 'Kunci Akun',
        'unlock' => 'Buka Akun',
        'logout' => 'Paksa Logout',
        'changepass' => 'Ganti Kata Sandi',
        'file' => 'Pilih File',
    ],

    'footer' => [
        'version' => 'Versi'
    ],

    '404' => [
        'name' => '404 Tidak Ditemukan',
        'title' => 'Oops! Halaman tidak ditemukan.',
        'message' => 'Kami tidak dapat menemukan halaman yang Anda cari. Sementara itu, Anda dapat kembali ke beranda.',
        'return' => 'Kembali ke Beranda',
    ],

    '401' => [
        'name' => '401 Akses Ditolak',
        'title' => 'Oops! Akses halaman ditolak.',
        'message' => 'Anda tidak memiliki izin untuk mengakses halaman ini. Sementara itu, Anda dapat kembali ke beranda atau menghubungi administrator sistem Anda.',
        'return' => 'Kembali ke Beranda',
    ],

    '406' => [
        'name' => '406 Tautan Kedaluwarsa',
        'title' => 'Oops! Tautan kedaluwarsa.',
        'message' => 'Tautan yang Anda kunjungi tidak lagi tersedia. Sementara itu, Anda dapat kembali ke beranda atau menghubungi administrator sistem Anda.',
        'return' => 'Kembali ke Beranda',
    ],

    'modal' => [
        'delete' => [
            'title' => 'Apakah anda yakin ingin menghapus data ini ?'
        ],
        'forcelogout' => [
            'title' => 'Apakah anda yakin ingin paksa logout akun ini ?'
        ],
        'resetpass' => [
            'title' => 'Apakah anda yakin ingin kirim ulang kata sandi akun ini ?'
        ],
        'lock' => [
            'title' => 'Apakah anda yakin ingin kunci data ini ?'
        ],
        'unlock' => [
            'title' => 'Apakah anda yakin ingin buka kunci data ini ?'
        ],
        'active' => [
            'title' => 'Apakah anda yakin ingin aktifkan data ini ?'
        ],
        'deactive' => [
            'title' => 'Apakah anda yakin ingin non aktifkan data ini ?'
        ],
        'auth' => [
            'title' => 'Autentikasi'
        ],
    ],

    'login' => [
        'login' => 'Masuk',
        'register' => 'Daftar Akun',
        'username' => 'Nama Pengguna',
        'password' => 'Kata Sandi',
        'remember' => 'Ingat Saya',
        'title' => 'Masuk untuk memulai sesi',
        'forget' => 'Lupa Kata Sandi',
    ],

    'register' => [
        'new' => 'Daftar',
        'title' => 'Daftar akun baru',
        'login' => 'Sudah punya akun? Masuk disini',
        'username' => 'Username',
        'first_name' => 'Nama Depan',
        'last_name' => 'Nama Belakang (Opsional)',
        'email' => 'Email',
    ],

    'password' => [
        'new' => 'Buat Kata Sandi',
        'new_message' => 'Buat kata sandi akun baru Anda',
        'forget' => 'Lupa Kata Sandi',
        'forget_message' => 'Masukkan username dan informasi email Anda. Kami akan mengirimkan tautan setel ulang kata sandi ke email Anda.',
        'username' => 'Username',
        'email' => 'email',
        'current' => 'Kata Sandi',
        'password' => 'Kata Sandi Baru',
        'retype' => 'Ketik Ulang Kata Sandi',
        'login' => 'Masuk',
        'tooltip' => [
            'current' => 'Kata sandi akun anda saat ini.',
            'password' => 'Kata sandi baru akun anda.',
            'retype' => 'Ketik ulang Kata sandi baru akun anda.',
        ]
    ],

    'privilege' => [
        'table' => [
            'no' => 'No',
            'code' => 'Kode',
            'menu' => 'Menu',
            'modules' => 'Modul',
            'description' => 'Deskripsi',
            'action' => 'Opsi',
        ],
        'form' => [
            'code' => 'Kode',
            'menu' => 'Menu',
            'modules' => 'Modul',
            'description' => 'Deskripsi',
        ],
        'tooltip' => [
            'code' => 'Alfanumerik unik untuk pengidentifikasi hak akses. Maksimal 4 karakter.',
            'menu' => 'Menu yang diasosiasikan dengan hak akses ini.',
            'modules' => 'Modul yang diasosiasikan dengan hak akses ini.',
            'description' => 'Deskripsi hak akses ini.',
        ]
    ],

    'privigroup' => [
        'table' => [
            'no' => 'No',
            'name' => 'Nama Group',
            'description' => 'Deskripsi',
            'updated_at' => 'Treakhir Diperbaharui',
            'action' => 'Opsi',
            'modules' => 'Modul'
        ],
        'form' => [
            'name' => 'Nama Group',
            'description' => 'Deskripsi',
            'privilege' => 'Hak Akses',
        ],
        'tooltip' => [
            'name' => 'Nama group hak akses.',
            'description' => 'Deskripsi group hak akses ini.',
            'privilege' => 'Hak akses yang diasosiasikan dengan group ini.',
        ]
    ],

    'account' => [
        'table' => [
            'no' => 'No',
            'account' => 'Akun',
            'email' => 'Email',
            'status' => 'Status',
            'last_login' => 'Terakhir Login',
            'updated_at' => 'Tgl. Diperbaharui',
            'action' => 'Opsi',
            'timestamp' => 'Linimasa',
            'privilege' => 'Hak Akses',
            'description' => 'Keterangan',
            'ip_address' => 'IP Address',
            'request' => 'UUID Request',
            'response' => 'UUID Response',
        ],
        'form' => [
            'username' => 'Username',
            'first_name' => 'Nama Depan',
            'last_name' => 'Nama Belakang',
            'email' => 'Email',
            'privigroup' => 'Grup Hak Akses',
            'cashier' => 'Pengguna Sebagai Kasir',
            'author' => 'Pemberi Wewenang',
        ],
        'tooltip' => [
            'username' => 'Nama pengguna yang digunakan untuk akun masuk.',
            'first_name' => 'Nama depan akun pengguna.',
            'last_name' => 'Nama belakang akun pengguna.',
            'email' => 'Email aktif akun pengguna.',
            'privigroup' => 'Grup hak akses akun pengguna.',
        ],
        'view' => [
            'email' => 'Email',
            'status' => 'Status',
            'last_login' => 'Terakhir Login',
            'updated_by' => 'Terakhir Diperbaharui',
            'privilege' => 'Hak Akses',
            'module' => 'Modul',
            'updated_at' => ':user pada :date',
            'activity' => 'Aktivitas Akun',
            'last_activity' => '10 Aktivitas Terakhir',
            'new' => 'Akun Baru',
            'active' => 'Aktif',
            'deactive' => 'Non Aktif',
            'lock' => 'Terkunci',
            'cashier' => 'Pengguna Sebagai Kasir',
            'author' => 'Pemberi Wewenang',
        ]
    ],

    'accactivity' => [
        'table' => [
            'no' => 'No',
            'timestamp' => 'Waktu',
            'username' => 'Akun',
            'privilege' => 'Hak Akses',
            'description' => 'Keterangan',
            'ip' => 'IP Address',
            'agent' => 'Perangkat',
            'request' => 'UUID Request',
            'response' => 'UUID Response',
        ],
        'form' => [
            'date' => 'Tanggal',
        ],
        'tooltip' => [
            'code' => 'Tanggal aktivitas yang ditampilkan.',
        ]
    ],

    'mailtrail' => [
        'table' => [
            'no' => 'No',
            'timestamp' => 'Waktu',
            'agent' => 'Agen',
            'target' => 'Kirim Kepada',
            'subject' => 'Subjek',
            'response' => 'UUID Response',
        ],
        'form' => [
            'date' => 'Tanggal',
        ],
        'tooltip' => [
            'code' => 'Tanggal log yang ditampilkan.',
        ]
    ],

    'apitrail' => [
        'table' => [
            'no' => 'No',
            'timestamp' => 'Waktu',
            'privilege' => 'Hak Akses',
            'description' => 'Keterangan',
            'ip' => 'IP Address',
            'request' => 'UUID Request',
            'response' => 'UUID Response',
        ],
        'form' => [
            'date' => 'Tanggal',
        ],
        'tooltip' => [
            'code' => 'Tanggal aktivitas yang ditampilkan.',
        ]
    ],

    'general' => [
        'form' => [
            'api' => 'API',
            'api_key' => 'API Key',
            'copied' => ':id berhasil disalin'
        ],
        'tooltip' => [
            'api_key' => 'API Key untuk aplikasi pihak ketiga.',
        ]
    ],

    'upload' => [
        'form' => [
            'file' => 'Unggah File',
        ],
        'tooltip' => [
            'file' => 'Unggah file hanya menerima ekstensi .xlsx atau .xls.',
        ]
    ],

    'transaction' => [
        'table' => [
            'invoice_no' => 'No. Invoice',
            'total_weight' => 'Berat Total',
            'shipping_fee_label' => 'Ongkos Kirim',
            'total_price_label' => 'Total Harga',
            'shipping_date' => 'Tgl. Kirim',
            'shipping_type' => 'Jenis Pengiriman',
            'transaction_date' => 'Tgl. Transaksi',
        ],
    ],

    'sales' => [
        'table' => [
            'invoice_no' => 'No. Invoice',
            'total_weight' => 'Berat Total',
            'shipping_fee_label' => 'Ongkos Kirim',
            'total_price_label' => 'Total Harga',
            'total_sale_label' => 'Total Harga Beli',
            'shipping_date' => 'Tgl. Kirim',
            'shipping_type' => 'Jenis Pengiriman',
            'sales_date' => 'Tgl. Penjualan',
            'product_id' => 'ID Produk',
            'qty' => 'Jml. Barang',
            'weight' => 'Berat',
            'unit_price' => 'Harga Satuan',
            'discount' => 'Diskon',
            'price' => 'Harga',
        ],
        'table' => [
            'id' => 'ID Penjualan',
            'invoice_no' => 'No. Invoice',
            'total_weight' => 'Berat Total',
            'shipping_fee' => 'Ongkos Kirim',
            'total_price' => 'Total Harga',
            'total_sale' => 'Total Harga Beli',
            'shipping_date' => 'Tgl. Kirim',
            'shipping_type' => 'Jenis Pengiriman',
            'sales_date' => 'Tgl. Penjualan',
            'user_code' => 'Kode User',
            'shipping_address' => 'Alamat Pengiriman',
            'expedition_id' => 'ID Ekspedisi',
            'sales_detail' => 'Detil Penjualan',
        ],
    ],

    'product' => [
        'table' => [
            'name' => 'Produk',
            'weight' => 'Berat',
            'price_label' => 'Harga Beli',
            'stock' => 'Stok',
            'sale_label' => 'Harga Jual',
        ],
    ],

    'ticket' => [
        'table' => [
            'ticket_code' => 'Ticket ID',
            'ticket_date' => 'Tgl. Tiket',
            'subject' => 'Subjek',
            'issue' => 'Masalah',
            'status' => 'Status',
            'user_id' => 'User ID',
            'update_date' => 'Tgl. Update',
        ],
        'view' => [
            'ticket_code' => 'Tiket ID',
            'ticket_date' => 'Tgl. Tiket',
            'customer_id' => 'Customer ID',
            'product_id' => 'Produk ID',
            'subject' => 'Subjek',
            'issue' => 'Masalah',
            'ticket_process' => 'Proses Tiket',
        ],
    ],
];
