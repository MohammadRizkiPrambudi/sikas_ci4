<?php $this->extend('template/index') ?>
<?php $this->Section('konten') ?>
<div class="section-header">
    <h1>Pembayaran Transfer</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Pembayaran</a></div>
        <div class="breadcrumb-item">Pembayaran Transfer</div>
    </div>
</div>
<div class="flash-data" data-flash="<?= session()->getFlashdata('pesan'); ?>"></div>
<div class="flash-error" data-error="<?= session()->getFlashdata('error'); ?>"></div>
<div class="section-body">
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h4>Daftar Bank</h4>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        <?php foreach ($rekening as $rk) : ?>
                            <li class="list-group-item">Nama Bank : <?= $rk['nama_bank']; ?> - <?= $rk['atasnama']; ?></li>
                            <li class="list-group-item"><?= $rk['nomor_rekening']; ?></li>
                        <?php endforeach; ?>
                    </ul>
                    <div class="alert alert-warning alert-has-icon mt-2">
                        <div class="alert-icon"><i class="fas fa-exclamation"></i></div>
                        <div class="alert-body">
                            <div class="alert-title">Perhatian</div>
                            Untuk Pembayaran transfer bisa ditransfer menggunakan salah satu rekening diatas, silahkan kemudian konfirmasi dengan upload bukti transferan disertai screnshoot bukti transfer
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h4>Konfirmasi Pembayaran</h4>
                </div>
                <form method="post" action="/BuktiPembayaran/InsertData" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" class="form-control <?= ($validasi->hasError('nama_anggota')) ? 'is-invalid' : ''; ?>" value="<?= old('nama_anggota', $anggota['nama_anggota']); ?>" name="nama_anggota" placeholder="Nama" autocomplete="off" readonly>
                            <div class="invalid-feedback">
                                <?= $validasi->getError('nama_anggota'); ?>
                            </div>
                            <input type="hidden" value="<?= $anggota['id_anggota']; ?>" name="id_anggota">
                        </div>
                        <div class="form-group">
                            <label>Bank</label>
                            <select name="nama_bank" class="form-control <?= ($validasi->hasError('nama_bank')) ? 'is-invalid' : ''; ?>">
                                <option selected disabled>--Silahkan Pilih--</option>
                                <?php foreach ($rekening as $bank) : ?>
                                    <option value="<?= $bank['id_rekening']; ?>" <?= old('nama_bank') == $bank['id_rekening'] ? 'selected' : ''; ?>><?= $bank['nama_bank']; ?> - <?= $bank['nomor_rekening']; ?></option>
                                <?php endforeach ?>
                            </select>
                            <div class="invalid-feedback">
                                <?= $validasi->getError('nama_bank'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Keterangan</label>
                            <textarea name="keterangan_pembayaran" id="keterangan_pembayaran" class="form-control  <?= ($validasi->hasError('keterangan_pembayaran')) ? 'is-invalid' : ''; ?>" style="height: 80px;" placeholder="Contoh : Pembayaran Kas Minggu Pertama Bulan Januari 2023"><?= old('keterangan_pembayaran') ?></textarea>
                            <div class="invalid-feedback">
                                <?= $validasi->getError('keterangan_pembayaran'); ?>
                            </div>
                        </div>
                        <img src="https://via.placeholder.com/200x250" class="sampul img-preview mb-2" width="150">
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
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $this->endSection() ?>