<?php $this->extend('backend/index') ?>
<?php $this->Section('konten') ?>
<div class="section-header">
    <h1>Edit Slider</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Pengaturan</a></div>
        <div class="breadcrumb-item">Edit Slider</div>
    </div>
</div>

<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <form method="post" action="/Slider/UpdateData/<?= $slider['id_slider']; ?>" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                    <div class="card-body">
                        <input type="hidden" name="gambarlama" value="<?= $slider['gambar_slider']; ?>">
                        <div class="form-group">
                            <label>Judul</label>
                            <input type="text" class="form-control <?= ($validasi->hasError('judul')) ? 'is-invalid' : ''; ?>" value="<?= old('judul', $slider['judul_slider']); ?>" name="judul" placeholder="Judul Slider" autocomplete="off">
                            <div class="invalid-feedback">
                                <?= $validasi->getError('judul'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Deskripsi</label>
                            <textarea name="deskripsi" id="isi" class="form-control <?= ($validasi->hasError('deskripsi')) ? 'is-invalid' : ''; ?>"><?= old('deskripsi', $slider['deskripsi_slider']); ?></textarea>
                            <div class="invalid-feedback">
                                <?= $validasi->getError('deskripsi'); ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <img src="/front-end/slider/<?= $slider['gambar_slider']; ?>" class="sampul img-preview" width="150">
                            </div>
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label for="foto" class="form-label">Gambar</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input <?= ($validasi->hasError('foto')) ? 'is-invalid' : ''; ?>" id="foto" name="foto" accept=".png,.jpg,.jpeg" onchange="previewGambar()">
                                        <div class=" invalid-feedback">
                                            <?= $validasi->getError('foto'); ?>
                                        </div>
                                        <label class="custom-file-label" for="foto"><?= $slider['gambar_slider']; ?></label>
                                    </div>
                                    <small class="text-danger mt-5">*Ukuran Gambar 1800 x 1006 PX </small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="/Slider" class="btn btn-danger">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $this->endSection() ?>