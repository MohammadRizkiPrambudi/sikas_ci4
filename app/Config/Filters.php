<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Filters\CSRF;
use CodeIgniter\Filters\DebugToolbar;
use CodeIgniter\Filters\Honeypot;
use CodeIgniter\Filters\InvalidChars;
use CodeIgniter\Filters\SecureHeaders;

class Filters extends BaseConfig
{
    /**
     * Configures aliases for Filter classes to
     * make reading things nicer and simpler.
     *
     * @var array
     */
    public $aliases = [
        'csrf'          => CSRF::class,
        'toolbar'       => DebugToolbar::class,
        'honeypot'      => Honeypot::class,
        'invalidchars'  => InvalidChars::class,
        'secureheaders' => SecureHeaders::class,
        'FilterAnggota' => \App\Filters\FilterAnggota::class,
        'FilterKetua' => \App\Filters\FilterKetua::class,
        'FilterBendahara' => \App\Filters\FilterBendahara::class,
    ];

    /**
     * List of filter aliases that are always
     * applied before and after every request.
     *
     * @var array
     */
    public $globals = [
        'before' => [
            // 'honeypot',
            // 'csrf',
            // 'invalidchars',
            'FilterAnggota' => ['except' => [
                'Auth', 'Auth/*',
                '/'
            ]],
            'FilterKetua' => ['except' => [
                'Auth', 'Auth/*',
                '/'
            ]],
            'FilterBendahara' => ['except' => [
                'Auth', 'Auth/*',
                '/'
            ]],
        ],
        'after' => [
            'toolbar',
            // 'honeypot',
            // 'secureheaders',
            'FilterAnggota' => ['except' => [
                'Auth', 'Auth/*',
                '/', 'Home', 'Home/*', 'Pembayaran/UploadBuktiPembayaran', 'BuktiPembayaran/InsertData', 'pembayaran/upload-bukti-pembayaran', 'BuktiPembayaran/HistoryBuktiPembayaran', 'Pembayaran/HistoryPembayaran'
            ]],
            'FilterKetua' => ['except' => [
                'Auth', 'Auth/*',
                '/', 'Home', 'Home/*', 'Anggota', 'Anggota/*', 'Rekening', 'Rekening/*', 'Pengguna', 'Pengguna/*', 'BuktiPembayaran', 'Laporan', 'Laporan/*', 'Riwayat', 'Riwayat/*', 'Pengaturan', 'Pengaturan/*', 'Rekapitulasi', 'Rekapitulasi/*',
            ]],
            'FilterBendahara' => ['except' => [
                'Auth', 'Auth/*',
                '/', 'Home', 'Home/*', 'Anggota', 'Anggota/*', 'Rekening', 'Rekening/*', 'BuktiPembayaran', 'BuktiPembayaran/*', 'Pembayaran', 'Pembayaran/*', 'BulanPembayaran', 'BulanPembayaran/*', 'KasMasuk', 'KasMasuk/*', 'KasKeluar', 'KasKeluar/*', 'Rekapitulasi', 'Rekapitulasi/*', 'Laporan', 'Laporan/*', 'Riwayat', 'Riwayat/*',
            ]],
        ],
    ];

    /**
     * List of filter aliases that works on a
     * particular HTTP method (GET, POST, etc.).
     *
     * Example:
     * 'post' => ['csrf', 'throttle']
     *
     * @var array
     */
    public $methods = [];

    /**
     * List of filter aliases that should run on any
     * before or after URI patterns.
     *
     * Example:
     * 'isLoggedIn' => ['before' => ['account/*', 'profiles/*']]
     *
     * @var array
     */
    public $filters = [];
}
