<?php $this->extend('template/index') ?>
<?php $this->Section('konten') ?>
<div class="section-header">
    <h1>Tambah Rekening</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Master Data</a></div>
        <div class="breadcrumb-item">Tambah Rekening</div>
    </div>
</div>
<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <form method="post" action="/Rekening/InsertData">
                    <?= csrf_field(); ?>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label>Nama Bank</label>
                                    <input type="text" class="form-control <?= ($validasi->hasError('nama_bank')) ? 'is-invalid' : ''; ?>" value="<?= old('nama_bank'); ?>" name="nama_bank" autocomplete="off" autofocus placeholder="Nama Bank">
                                    <div class="invalid-feedback">
                                        <?= $validasi->getError('nama_bank'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label>Nomor Rekening</label>
                                    <input type="text" class="form-control <?= ($validasi->hasError('nomor_rekening')) ? 'is-invalid' : ''; ?>" value="<?= old('nomor_rekening'); ?>" name="nomor_rekening" autocomplete="off" placeholder="Nomor Rekening">
                                    <div class="invalid-feedback">
                                        <?= $validasi->getError('nomor_rekening'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label>Atas Nama</label>
                                    <input type="text" class="form-control <?= ($validasi->hasError('atasnama')) ? 'is-invalid' : ''; ?>" value="<?= old('atasnama'); ?>" name="atasnama" autocomplete="off" placeholder="Atas Nama">
                                    <div class="invalid-feedback">
                                        <?= $validasi->getError('atasnama'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="/Rekening" class="btn btn-danger">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $this->endSection() ?>