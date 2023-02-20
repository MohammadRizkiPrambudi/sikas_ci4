<?php

use App\Models\BuktiPembayaranModel;

$this->BuktiPembayaranModel = new BuktiPembayaranModel();
$cek_notif = $this->BuktiPembayaranModel->CekNotif();
?>
<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="/">SISFO KAS</a>
        </div>
        <ul class="sidebar-menu">
            <li class="nav-item <?= isset($mdashboard) ? 'active' : '' ?>">
                <a href="/Home" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
            </li>
            <?php if (session()->get('level_pengguna') == 'bendahara') : ?>
                <li class="menu-header">Main Menu</li>
                <li class="nav-item dropdown <?= isset($master) ? 'active' : '' ?>">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-database"></i> <span>Master Data</span></a>
                    <ul class="dropdown-menu">
                        <li class="<?= isset($manggota) ? 'active' : '' ?>"><a class="nav-link" href="/Anggota">Anggota</a></li>
                        <li class="<?= isset($mrekening) ? 'active' : '' ?>"><a class="nav-link" href="/Rekening">Rekening</a></li>
                    </ul>
                </li>
                <li class="nav-item <?= isset($mbuktibayar) ? 'active' : '' ?>">
                    <a href="/BuktiPembayaran" class="nav-link <?= $cek_notif == 0 ? '' : 'beep beep-sidebar' ?>"><i class="fas fa-image"></i> <span>Bukti Pembayaran</span></a>
                </li>
                <li class="nav-item dropdown <?= isset($masterpembayaran) ? 'active' : '' ?>">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-list"></i> <span>Manajemen Kas</span></a>
                    <ul class="dropdown-menu">
                        <li class="<?= isset($mpembayaran) ? 'active' : '' ?>"><a class="nav-link" href="/Pembayaran">Pembayaran Kas</a></li>
                        <li class="<?= isset($mkasmasuk) ? 'active' : '' ?>"><a class="nav-link" href="/KasMasuk">Kas Masuk</a></li>
                        <li class="<?= isset($mkaskeluar) ? 'active' : '' ?>"><a class="nav-link" href="/KasKeluar">Kas Keluar</a></li>
                        <li class="<?= isset($mrekapitulasi) ? 'active' : '' ?>"><a class="nav-link" href="/Rekapitulasi">Rekapitulasi</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown <?= isset($masterlaporan) ? 'active' : '' ?>">
                    <a href="#" class="nav-link has-dropdown"><i class="far fa-file"></i> <span>Laporan</span></a>
                    <ul class="dropdown-menu">
                        <li class="<?= isset($mlaporankas) ? 'active' : '' ?>"><a href="/Laporan/LaporanKas">Laporan Kas</a></li>
                        <li class="<?= isset($mlaporanpembayaran) ? 'active' : '' ?>"><a href="/Laporan/LaporanPembayaranKas">Laporan Pembayaran</a></li>
                    </ul>
                </li>
                <!-- <li class="menu-header">Riwayat</li> -->
                <li class="nav-item <?= isset($mriwayat) ? 'active' : '' ?>">
                    <a href="/Riwayat" class="nav-link"><i class="fas fa-newspaper"></i> <span>History Kas</span></a>
                </li>
            <?php endif ?>
            <?php if (session()->get('level_pengguna') == 'ketua') : ?>
                <li class="menu-header">Main Menu</li>
                <li class="nav-item dropdown <?= isset($master) ? 'active' : '' ?>">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-database"></i> <span>Master Data</span></a>
                    <ul class="dropdown-menu">
                        <li class="<?= isset($manggota) ? 'active' : '' ?>"><a class="nav-link" href="/Anggota">Anggota</a></li>
                        <li class="<?= isset($mrekening) ? 'active' : '' ?>"><a class="nav-link" href="/Rekening">Rekening</a></li>
                        <li class="<?= isset($mpengguna) ? 'active' : '' ?>"><a class="nav-link" href="/Pengguna">Pengguna</a></li>
                    </ul>
                </li>
                <li class="nav-item <?= isset($mbuktibayar) ? 'active' : '' ?>">
                    <a href="/BuktiPembayaran" class="nav-link <?= $cek_notif == 0 ? '' : 'beep beep-sidebar' ?>"><i class="fas fa-image"></i> <span>Bukti Pembayaran</span></a>
                </li>
                <li class="<?= isset($mrekapitulasi) ? 'active' : '' ?>"><a class="nav-link" href="/Rekapitulasi"><i class="fas fa-list"></i><span>Rekapitulasi</span></a></li>
                <li class="nav-item dropdown <?= isset($masterlaporan) ? 'active' : '' ?>">
                    <a href="#" class="nav-link has-dropdown"><i class="far fa-file"></i> <span>Laporan</span></a>
                    <ul class="dropdown-menu">
                        <li class="<?= isset($mlaporankas) ? 'active' : '' ?>"><a href="/Laporan/LaporanKas">Laporan Kas</a></li>
                        <li class="<?= isset($mlaporanpembayaran) ? 'active' : '' ?>"><a href="/Laporan/LaporanPembayaranKas">Laporan Pembayaran</a></li>
                    </ul>
                </li>
                <!-- <li class="menu-header">Riwayat</li> -->
                <li class="nav-item <?= isset($mriwayat) ? 'active' : '' ?>">
                    <a href="/Riwayat" class="nav-link"><i class="fas fa-newspaper"></i> <span>Riwayat</span></a>
                </li>
                <li class="nav-item <?= isset($mpengaturan) ? 'active' : '' ?>">
                    <a href="/Pengaturan" class="nav-link"><i class="fas fa-cog"></i> <span>Pengaturan</span></a>
                </li>
            <?php endif ?>
            <?php if (session()->get('level_pengguna') == 'anggota') : ?>
                <li class="menu-header">Main Menu</li>
                <li class="<?= isset($muppembayaran) ? 'active' : '' ?>"><a class="nav-link" href="/pembayaran/upload-bukti-pembayaran"><i class="fas fa-money-bill"></i><span>Transfer Online</span></a></li>
                <li class="<?= isset($mbuktibayar) ? 'active' : '' ?>"><a class="nav-link" href="/BuktiPembayaran/HistoryBuktiPembayaran"><i class="fas fa-image"></i><span>Bukti Pembayaran</span></a></a></li>
                <li class="<?= isset($mpembayaran) ? 'active' : '' ?>"><a class="nav-link" href="/Pembayaran/HistoryPembayaran"><i class="fas fa-list"></i><span>History Pembayaran</span></a></a></li>
            <?php endif ?>
        </ul>
    </aside>
</div>