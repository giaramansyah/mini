<?php
return [
    'error' => [
        '404' => 'Bad Request',
        '401' => 'Maaf, Anda tidak berwenang untuk tindakan ini',
    ],

    'login' => [
        'welcome' => 'Selamat datang, :name',
        'invalid' => 'Kredensial tidak valid',
        'disabled' => 'Akun telah dinonaktifkan. Hubungi administrator Anda',
        'unregister' => 'Akun tidak terdaftar',
        'locked' => 'Akun telah dikunci. Hubungi administrator Anda',
        'logged' => 'Akun sedang login di perangkat lain',
    ],

    'password' => [
        'data' => [
            'failed' => 'Data akun tidak ditemukan',
        ],
        'add' => [
            'success' => 'Kata sandi baru berhasil dibuat',
            'failed' => 'Pembuatan kata sandi baru gagal. Silakan coba lagi',
        ],
        'edit' => [
            'success' => 'Kata sandi berhasil diperbaharui',
            'failed' => 'Perbaharui kata sandi gagal. Silakan coba lagi',
            'invalid' => 'Kata sandi anda tidak valid. Silakan coba lagi',
        ],
        'resend' => [
            'success' => 'Tautan setel ulang kata sandi berhasil dikirim ke email akun',
            'failed' => 'Pengiriman tautan setel ulang kata sandi gagal. Silakan coba lagi',
            'hasty' => 'Tautan setel ulang kata sandi telah dikirim beberapa waktu lalu. Harap tunggu 6 jam lagi',
        ],
        'forget' => [
            'success' => 'Tautan pengaturan ulang kata sandi berhasil dikirim ke email akun Anda',
            'failed' => 'Pengiriman tautan setel ulang kata sandi gagal. Silakan coba lagi',
        ],
    ],

    'privilege' => [
        'data' => [
            'success' => 'Data hak akses ditemukan',
            'failed' => 'Data hak akses tidak ditemukan',
        ],
        'add' => [
            'success' => 'Hak akses berhasil dibuat',
            'failed' => 'Pembuatan hak akses gagal. Silakan coba lagi',
            'exist' => 'Kode hak akses sudah ada',
        ],
        'edit' => [
            'success' => 'Hak akses berhasil diperbarui',
            'failed' => 'Pembaruan hak akses gagal. Silakan coba lagi',
        ],
        'delete' => [
            'success' => 'Hak akses berhasil dihapus',
            'failed' => 'Penghapusan hak akses gagal. Silakan coba lagi',
        ],
    ],

    'privigroup' => [
        'data' => [
            'success' => 'Data group hak akses ditemukan',
            'failed' => 'Data group hak akses tidak ditemukan',
        ],
        'add' => [
            'success' => 'Group hak akses berhasil dibuat',
            'failed' => 'Pembuatan group hak akses gagal. Silakan coba lagi',
            'exist' => 'Nama group hak akses sudah ada',
        ],
        'edit' => [
            'success' => 'Group hak akses berhasil diperbarui',
            'failed' => 'Pembaruan group hak akses gagal. Silakan coba lagi',
        ],
        'delete' => [
            'success' => 'Group hak akses berhasil dihapus',
            'failed' => 'Penghapusan group hak akses gagal. Silakan coba lagi',
        ],
    ],

    'account' => [
        'data' => [
            'success' => 'Data akun ditemukan',
            'failed' => 'Data akun tidak ditemukan',
        ],
        'add' => [
            'success' => 'Akun berhasil dibuat',
            'failed' => 'Pembuatan akun gagal. Silakan coba lagi',
            'exist' => 'Kode akun sudah ada',
        ],
        'edit' => [
            'success' => 'Akun berhasil diperbarui',
            'failed' => 'Pembaruan akun gagal. Silakan coba lagi',
        ],
        'delete' => [
            'success' => 'Akun berhasil dihapus',
            'failed' => 'Penghapusan akun gagal. Silakan coba lagi',
        ],
        'active' => [
            'activate' => 'Akun berhasil di aktifkan',
            'deactivate' => 'Akun berhasil dinonaktifkan',
            'failed' => 'Aktivasi akun gagal. Silakan coba lagi',
        ],
        'lock' => [
            'locked' => 'Akun berhasil dikunci',
            'unlocked' => 'Akun berhasil dibuka',
            'failed' => 'penguncian akun gagal. Silakan coba lagi',
        ],
        'logout' => [
            'success' => 'Akun berhasil dikeluarkan',
            'failed' => 'Logout akun gagal. Silakan coba lagi',
        ],
    ],

    'log' => [
        'data' => [
            'success' => 'Data log akun ditemukan',
            'failed' => 'Data log akun tidak ditemukan',
        ],
    ],

    'general' => [
        'api' => [
            'success' =>'API key berhasil diperbaharui'
        ],
        'edit' => [
            'success' => 'Setelan general berhasil diperbarui',
            'failed' => 'Pembaruan setelan general gagal. Silakan coba lagi',
        ],
    ],

    'upload' => [
        'file' => [
            'success' => 'File berhasil diunggah',
            'failed' => 'Unggah file gagal. Silakan coba lagi.',
            'column' => 'File ditolak, format kolom tidak valid di sheet :name',
            'column' => 'File ditolak, data cuaca dalam tipe data wajib atau tidak valid, sheet :name; baris :row; kolom :column',
        ],
    ],
];
