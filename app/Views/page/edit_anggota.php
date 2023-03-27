<?php $this->extend('template/index') ?>
<?php $this->Section('konten') ?>
<div class="section-header">
    <h1>Edit Anggota</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Master Data</a></div>
        <div class="breadcrumb-item">Edit Anggota</div>
    </div>
</div>
<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <form method="post" action="/Anggota/UpdateData/<?= $anggota['id_anggota']; ?>" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input type="text" class="form-control <?= ($validasi->hasError('nama_anggota')) ? 'is-invalid' : ''; ?>" value="<?= old('nama_anggota', $anggota['nama_anggota']); ?>" name="nama_anggota" placeholder="Nama" autocomplete="off">
                                    <div class="invalid-feedback">
                                        <?= $validasi->getError('nama_anggota'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Jenis Kelamin</label>
                                    <select name="jk_anggota" class="form-control <?= ($validasi->hasError('jk_anggota')) ? 'is-invalid' : ''; ?>">
                                        <option selected disabled>--Silahkan Pilih--</option>
                                        <option value="L" <?= old('jk_anggota', $anggota['jk_anggota']) == 'L' ? 'selected' : ''; ?>>Laki-Laki</option>
                                        <option value="P" <?= old('jk_anggota', $anggota['jk_anggota']) == 'P' ? 'selected' : ''; ?>>Perempuan</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        <?= $validasi->getError('jk_anggota'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>No HP</label>
                                    <input type="text" class="form-control <?= ($validasi->hasError('nowa_anggota')) ? 'is-invalid' : ''; ?>" value="<?= old('nowa_anggota', $anggota['nowa_anggota']) ?>" name="nowa_anggota" placeholder="No HP" autocomplete="off">
                                    <div class="invalid-feedback">
                                        <?= $validasi->getError('nowa_anggota'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Username</label>
                                    <input type="text" class="form-control <?= ($validasi->hasError('username_anggota')) ? 'is-invalid' : ''; ?>" value="<?= old('username_anggota', $anggota['username_anggota']) ?>" name="username_anggota" placeholder="Username">
                                    <div class="invalid-feedback">
                                        <?= $validasi->getError('username_anggota'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" class="form-control" name="password_anggota" placeholder="Masukkan jika ingin mengganti">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <img src="/back-end/img/anggota/<?= $anggota['foto_anggota']; ?>" class="sampul img-preview" width="150">
                            </div>
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label for="foto" class="form-label">Foto</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input <?= ($validasi->hasError('foto')) ? 'is-invalid' : ''; ?>" id="foto" name="foto" accept=".png,.jpg,.jpeg" onchange="previewGambar()">
                                        <div class=" invalid-feedback">
                                            <?= $validasi->getError('foto'); ?>
                                        </div>
                                        <label class="custom-file-label" for="foto"><?= $anggota['foto_anggota']; ?></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="fotolama" value="<?= $anggota['foto_anggota']; ?>">
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                        <a href="/Anggota" class="btn btn-danger"><i class="fas fa-times"></i> Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $this->endSection() ?>