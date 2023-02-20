<?php $this->extend('template/index') ?>
<?php $this->Section('konten') ?>
<div class="section-header">
    <h1>Pembayaran</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Manajemen Kas</a></div>
        <div class="breadcrumb-item">Pembayaran Kas</div>
    </div>
</div>

<div class="flash-data" data-flash="<?= session()->getFlashdata('pesan'); ?>"></div>
<div class="flash-error" data-error="<?= session()->getFlashdata('error'); ?>"></div>
<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <?php if (session()->get('level_pengguna') == 'bendahara') : ?>
                        <a href="/BulanPembayaran/TambahBulanPembayaran" class="btn btn-primary"><i class="fas fa-plus mr-1"></i>Tambah Bulan</a>
                        <hr>
                        <div class="alert alert-warning alert-has-icon">
                            <div class="alert-icon"><i class="fas fa-exclamation"></i></div>
                            <div class="alert-body">
                                <div class="alert-title">Perhatian</div>
                                Setelah pembayaran kas pada setiap bulan selesai harap masukkan total kas mingguan ke kas masuk!!!
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="row">
                        <?php $total = 0;
                        foreach ($bulanbayar as $bb) : ?>
                            <?php
                            $id_bulan_pembayaran = $bb['id_bulan_pembayaran'];
                            $db = \Config\Database::connect();
                            $total_kas_perbulan = $db->table('pembayaran_kas')
                                ->select('SUM(minggu_ke_1+ minggu_ke_2 + minggu_ke_3 + minggu_ke_4) as total_perbulan')
                                ->where('id_bulan_pembayaran', $id_bulan_pembayaran)->get()->getRowArray(); ?>
                            <div class="col-12 col-md-4 col-lg-4">
                                <div class="card card-info shadow">
                                    <div class="card-header">
                                        <h4>Pembayaran Kas Mingguan</h4>
                                    </div>
                                    <div class="card-body">
                                        <h6>Bulan <?= $bb['nama_bulan']; ?> Tahun. <?= $bb['tahun']; ?></h6>
                                        <h6>Rp. <?= number_format($bb['pembayaran_mingguan']); ?> Perminggu</h6>
                                        </h2>
                                        <p>Total kas bulan ini :</p>
                                        <span class="badge badge-success">Rp. <?= number_format($total_kas_perbulan['total_perbulan']); ?></span><br><br>
                                        <a href="/Pembayaran/DetailPembayaranBulan/<?= $bb['id_bulan_pembayaran']; ?>" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="Lihat Kas Bulan <?= $bb["nama_bulan"]; ?>"><i class="fas fa-list"></i></a>
                                        <?php if (session()->get('level_pengguna') == 'bendahara') : ?>
                                            <a href="/BulanPembayaran/DeleteData/<?= $bb['id_bulan_pembayaran']; ?>" class="btn btn-danger hapus" data-toggle="tooltip" data-placement="top" title="Hapus Kas Bulan <?= $bb["nama_bulan"]; ?>"><i class="fas fa-trash"></i></a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach ?>
                    </div>
                    <?= $pager->links('default', 'bulan_pagination') ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->endSection() ?>