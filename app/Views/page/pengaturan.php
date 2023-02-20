<?php $this->extend('template/index') ?>
<?php $this->Section('konten') ?>
<div class="section-header">
    <h1>Pengaturan Aplikasi</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="/Pengaturan/ProfilSekolah">Pengaturan</a></div>
        <div class="breadcrumb-item">Pengaturan Aplikasi</div>
    </div>
</div>
<div class="flash-data" data-flash="<?= session()->getFlashdata('pesan'); ?>"></div>
<div class="flash-error" data-error="<?= session()->getFlashdata('error'); ?>"></div>
<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <form method="post" action="/Pengaturan/UpdatePengaturan/<?= $config['id_pengaturan']; ?>" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nama Organisasi</label>
                                    <input type="text" class="form-control <?= ($validasi->hasError('nama')) ? 'is-invalid' : ''; ?>" value="<?= old('nama', $config['nama_organisasi']); ?>" name="nama" placeholder="Nama Organisasi">
                                    <div class="invalid-feedback">
                                        <?= $validasi->getError('nama'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Ketua Organisasi</label>
                                    <textarea name="ketua" id="ketua" class="form-control <?= ($validasi->hasError('ketua')) ? 'is-invalid' : ''; ?>" placeholder="ketua Organisasi"><?= old('ketua',  $config['ketua_organisasi']); ?></textarea>
                                    <div class="invalid-feedback">
                                        <?= $validasi->getError('ketua'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Nama Organisasi</label>
                            <textarea class="form-control <?= ($validasi->hasError('alamat')) ? 'is-invalid' : ''; ?>" name="alamat" style="height: 80px;"><?= old('alamat', $config['alamat_organisasi']); ?></textarea>
                            <div class="invalid-feedback">
                                <?= $validasi->getError('alamat'); ?>
                            </div>
                        </div>
                        <img src="/back-end/img/logo/<?= $config['logo_organisasi']; ?>" width="30%" class="sampul img-preview">
                        <div class="form-group col-md-6">
                            <label for="foto" class="form-label">Foto</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input <?= ($validasi->hasError('foto')) ? 'is-invalid' : ''; ?>" id="foto" name="foto" accept=".png,.jpg,.jpeg" onchange="previewGambar()">
                                <div class=" invalid-feedback">
                                    <?= $validasi->getError('foto'); ?>
                                </div>
                                <label class="custom-file-label" for="foto">Pilih Gambar</label>
                                <input type="hidden" name="fotolama" value="<?= $config['logo_organisasi']; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $this->endSection() ?>