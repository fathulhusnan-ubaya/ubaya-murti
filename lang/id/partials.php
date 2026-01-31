<?php

return [
    'table' => [
        'export' => [
            'title'      => 'Ekspor',
            'select-all' => 'Semua',
            'print'      => 'Cetak',
        ],

        'pagination' => [
            'length' => [
                'all' => 'Semua',
            ],
        ],

        'order' => [
            'title' => 'Urut:',
            'asc'   => 'A-Z',
            'desc'  => 'Z-A',
        ],

        'search' => [
            'title' => 'Cari:',
        ],

        'advanced-search' => [
            'title' => 'Pencarian Lanjutan',
        ],
    ],

    'action-button' => [
        'back'    => 'Kembali',
        'move'    => 'Pindah',
        'detail'  => 'Detail',
        'create'  => 'Tambah',
        'edit'    => 'Ubah',
        'delete'  => 'Hapus',
        'restore' => 'Pulihkan',
        'remove'  => 'Hapus Permanen',
        'save'    => 'Simpan',
    ],

    'title' => [
        'detail'  => 'Detail',
        'create'  => 'Tambah',
        'edit'    => 'Ubah',
        'delete'  => 'Yakin ingin menghapus<br>:Name?',
        'restore' => 'Yakin ingin memulihkan<br>:Name?',
        'remove'  => 'Yakin ingin menghapus permanen<br>:Name?',
    ],

    'number'          => 'No.',
    'action'          => 'Tindakan',
    'yes'             => 'Ya',
    'no'              => 'Tidak',
    'choose'          => '-- Pilih --',
    'clear'           => 'Bersihkan',
    'no-data'         => 'Masih belum ada :object',
    'server-error'    => 'Waduh! Terjadi masalah pada server!',
    'processing'      => 'Memproses ...',
    'loading'         => 'Memuat ...',
    'saving'          => 'Menyimpan ...',
    'created'         => ':Object baru berhasil ditambahkan!',
    'updated'         => ':Object berhasil diperbarui!',
    'deleting'        => 'Menghapus ...',
    'deleted'         => ':Object berhasil dihapus!',
    'restoring'       => 'Memulihkan ...',
    'restored'        => ':Object berhasil dipulihkan!',
    'removing'        => 'Menghapus permanen...',
    'removed'         => ':Object berhasil dihapus permanen!',
    'is-deleted'      => 'Dihapus Kah',
    'constrained'     => ':Object masih digunakan di :other!',
    'constrained-any' => ':Object masih digunakan!',
    'unrecoverable'   => 'Data ini tidak bisa dipulihkan!',
    'start'           => 'Awal',
    'end'             => 'Akhir',

    'join' => [
        'comma' => ', ',
        'final' => ' dan ',
    ],

    'error' => [
        '403' => 'Akses dilarang!',
        '404' => 'Halaman tidak ditemukan!',
        '500' => 'Waduh! Terjadi masalah pada server!',
    ],

    'email' => [
        'greeting' => 'Halo!',
        'regards'  => 'Salam hangat, <br>' . config('app.name'),
    ],
];
