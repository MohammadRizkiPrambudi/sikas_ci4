<?php $this->extend('template/index') ?>
<?php $this->Section('konten') ?>
<div class="section-header">
    <h1>Tambah Bulan Pembayaran</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Manajemen Kas</a></div>
        <div class="breadcrumb-item">Tambah Bulan Pembayaran</div>
    </div>
</div>
<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <form method="post" action="/BulanPembayaran/InsertData">
                    <?= csrf_field(); ?>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <input type="text" class="form-control <?= ($validasi->hasError('kode')) ? 'is-invalid' : ''; ?>" value="<?= old('kode', $kode); ?>" name="kode" autocomplete="off" readonly>
                                    <div class="invalid-feedback">
                                        <?= $validasi->getError('kode'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label>Nama Bulan</label>
                                    <select name="nama_bulan" id="nama_bulan" class="form-control <?= ($validasi->hasError('nama_bulan')) ? 'is-invalid' : ''; ?>">
                                        <?php
                                        $mulai = 1;
                                        for ($i = $mulai; $i < $mulai + 12; $i++) : ?>
                                            <option value="<?= bulan($i) ?>" <?= old('nama_bulan') == bulan($i) ? 'selected' : ''; ?>><?= bulan($i) ?></option>
                                        <?php endfor; ?>
                                    </select>
                                    <div class="invalid-feedback">
                                        <?= $validasi->getError('mapel'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label>Tahun</label>
                                    <input type="number" class="form-control <?= ($validasi->hasError('tahun')) ? 'is-invalid' : ''; ?>" value="<?= old('tahun', date('Y')); ?>" name="tahun" autocomplete="off">
                                    <div class="invalid-feedback">
                                        <?= $validasi->getError('tahun'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label>Jumlah</label>
                                    <input type="number" class="form-control <?= ($validasi->hasError('jumlah')) ? 'is-invalid' : ''; ?>" value="<?= old('jumlah'); ?>" name="jumlah" autocomplete="off" placeholder="Rp.">
                                    <div class="invalid-feedback">
                                        <?= $validasi->getError('jumlah'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="/BulanPembayaran" class="btn btn-danger">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $this->endSection() ?>