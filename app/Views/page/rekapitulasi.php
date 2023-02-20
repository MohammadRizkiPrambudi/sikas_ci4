<?php $this->extend('template/index') ?>
<?php $this->Section('konten') ?>
<div class="section-header">
    <h1>Data Rekapitulasi</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Manajemen Kas</a></div>
        <div class="breadcrumb-item">Rekapitulasi</div>
    </div>
</div>
<div class="flash-data" data-flash="<?= session()->getFlashdata('pesan'); ?>"></div>
<div class="flash-error" data-error="<?= session()->getFlashdata('error'); ?>"></div>
<div class="section-body">
    <div class="row">
        <div class="col-md-4">
            <div class="card card-statistic-1 bg-primary">
                <div class="card-icon bg-white">
                    <i class="fas fa-money-bill text-primary"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4 class="text-white">Total Pemasukan</h4>
                    </div>
                    <div class="card-body text-white">
                        <?php $total_kasm = 0;
                        foreach ($rekapitulasi as $total) {
                            $total_kasm += $total['jumlah_kas'];
                        } ?>
                        <span style="font-size: 16px;"> Rp. <?= number_format($total_kasm, 2, ',', '.'); ?>
                            <p style="font-size: 12px;">( <?= ucwords(terbilang($total_kasm)); ?> )</p>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-statistic-1 bg-danger">
                <div class="card-icon bg-white">
                    <i class="fas fa-hand-holding-usd text-danger"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4 class="text-white">Total Pengeluaran</h4>
                    </div>
                    <div class="card-body text-white">
                        <?php $total_kask = 0;
                        foreach ($rekapitulasi as $total) {
                            $total_kask += $total['kas_keluar'];
                        } ?>
                        <span style="font-size: 16px;"> Rp. <?= number_format($total_kask, 2, ',', '.'); ?>
                            <p style="font-size: 12px;">( <?= ucwords(terbilang($total_kask)); ?> )</p>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-statistic-1 bg-success">
                <div class="card-icon bg-white">
                    <i class="fas fa-wallet text-success"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4 class="text-white">Saldo Akhir</h4>
                    </div>
                    <div class="card-body text-white">
                        <?php $total_kasm = 0;
                        $total_kask = 0;
                        foreach ($rekapitulasi as $total) {
                            $total_kasm += $total['jumlah_kas'];
                            $total_kask += $total['kas_keluar'];
                            $saldo_akhir = $total_kasm -  $total_kask;
                        } ?>
                        <span style="font-size: 16px;"> Rp. <?= number_format($saldo_akhir, 2, ',', '.'); ?>
                            <p style="font-size: 12px;">( <?= ucwords(terbilang($saldo_akhir)); ?> )</p>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 mb-2">
                            <label for="keterangan_kas" class="form-label">Filter Berdasarkan Keterangan</label>
                            <select name="keterangan_kas" id="keterangan_kas" class="custom-select">
                                <option value="">--Silahkan Pilih---</option>
                                <?php foreach ($filter_keterangan as $fk) : ?>
                                    <option value="<?= $fk['keterangan_kas']; ?>"><?= $fk['keterangan_kas']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-4 mb-2">
                            <label for="tgl_kas" class="form-label">Filter Berdasarkan Tanggal</label>
                            <select name="tgl_kas" id="tgl_kas" class="custom-select">
                                <option value="">--Silahkan Pilih---</option>
                                <?php foreach ($filter_tanggal as $ft) : ?>
                                    <option value="<?= $ft['tgl_kas']; ?>"><?= Tanggal($ft['tgl_kas']); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-4 mb-2">
                            <label for="nama_pengguna" class="form-label">Filter Berdasarkan Nama</label>
                            <select name="nama_pengguna" id="nama_pengguna" class="custom-select">
                                <option value="">--Silahkan Pilih---</option>
                                <?php foreach ($filter_nama as $fm) : ?>
                                    <option value="<?= $fm['nama_pengguna']; ?>"><?= $fm['nama_pengguna']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="table-responsive mt-4">
                        <table class="table" id="tabel-rekapitulasi">
                            <thead>
                                <tr>
                                    <th class="text-center">
                                        No
                                    </th>
                                    <th>Kode Kas</th>
                                    <th>Keterangan</th>
                                    <th>Tanggal</th>
                                    <th>Kas Masuk</th>
                                    <th>Jenis</th>
                                    <th>Kas Keluar</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->endSection() ?>