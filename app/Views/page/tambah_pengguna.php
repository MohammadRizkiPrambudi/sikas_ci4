<?php $this->extend('template/index') ?>
<?php $this->Section('konten') ?>
<div class="section-header">
    <h1>Tambah Pengguna</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Master Data</a></div>
        <div class="breadcrumb-item">Tambah Pengguna</div>
    </div>
</div>
<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <form method="post" action="/Pengguna/InsertData" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input type="text" class="form-control <?= ($validasi->hasError('nama_pengguna')) ? 'is-invalid' : ''; ?>" value="<?= old('nama_pengguna'); ?>" name="nama_pengguna" placeholder="Nama" autocomplete="off" autofocus>
                                    <div class="invalid-feedback">
                                        <?= $validasi->getError('nama_pengguna'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Username</label>
                                    <input type="text" class="form-control <?= ($validasi->hasError('username_pengguna')) ? 'is-invalid' : ''; ?>" value="<?= old('username_pengguna') ?>" name="username_pengguna" placeholder="Username">
                                    <div class="invalid-feedback">
                                        <?= $validasi->getError('username_pengguna'); ?>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Level</label>
                                    <select name="level_pengguna" class="form-control <?= ($validasi->hasError('level_pengguna')) ? 'is-invalid' : ''; ?>">
                                        <option selected disabled>--Silahkan Pilih--</option>
                                        <option value="ketua" <?= old('level_pengguna') == 'ketua' ? 'selected' : ''; ?>>Ketua</option>
                                        <option value="bendahara" <?= old('level_pengguna') == 'bendahara' ? 'selected' : ''; ?>>Bendahara</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        <?= $validasi->getError('level_pengguna'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" class="form-control <?= ($validasi->hasError('password_pengguna')) ? 'is-invalid' : ''; ?>" value="<?= old('password_pengguna') ?>" name="password_pengguna" placeholder="Password">
                                    <div class="invalid-feedback">
                                        <?= $validasi->getError('password_pengguna'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <img src="/back-end/img/admin/default.png" class="sampul img-preview" width="150">
                            </div>
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label for="foto" class="form-label">Foto</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input <?= ($validasi->hasError('foto')) ? 'is-invalid' : ''; ?>" id="foto" name="foto" accept=".png,.jpg,.jpeg" onchange="previewGambar()">
                                        <div class=" invalid-feedback">
                                            <?= $validasi->getError('foto'); ?>
                                        </div>
                                        <label class="custom-file-label" for="foto">Pilih Gambar</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                        <a href="/Pengguna" class="btn btn-danger"><i class="fas fa-times"></i> Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $this->endSection() ?>