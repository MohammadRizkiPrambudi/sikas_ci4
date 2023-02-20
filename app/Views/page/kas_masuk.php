<?php $this->extend('template/index') ?>
<?php $this->Section('konten') ?>
<div class="section-header">
    <h1>Data Kas Masuk</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Manajemen Kas</a></div>
        <div class="breadcrumb-item">Data Kasuk Masuk</div>
    </div>
</div>
<div class="flash-data" data-flash="<?= session()->getFlashdata('pesan'); ?>"></div>
<div class="flash-error" data-error="<?= session()->getFlashdata('error'); ?>"></div>
<div class="section-body">
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
                foreach ($kas_masuk as $total) {
                    $total_kasm += $total['jumlah_kas'];
                } ?>
                <span style="font-size: 16px;"> Rp. <?= number_format($total_kasm, 2, ',', '.'); ?>
                    <p style="font-size: 12px;">( <?= ucwords(terbilang($total_kasm)); ?> )</p>
                </span>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <button type="button" data-toggle="modal" data-target="#TambahKasMasuk" class="btn btn-primary">Tambah Data</button>
                        <hr>
                        <table class="table nowrap" id="tabel-kasmasuk" style="width:100%">
                            <thead>
                                <tr>
                                    <th class="text-center">
                                        No
                                    </th>
                                    <th>Kode Kas</th>
                                    <th>Keterangan</th>
                                    <th>Tanggal</th>
                                    <th>Jumlah</th>
                                    <th>Aksi</th>
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
<?php $this->Section('modal') ?>
<div class="modal fade" id="TambahKasMasuk" tabindex="-1" role="dialog" aria-labelledby="TambahKasMasuk" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="post" action="/KasMasuk/InsertData" id="frmKas">
            <?= csrf_field(); ?>
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="TambahKasMasuk">
                        Tambah Kas Masuk
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="kode">Kode</label>
                        <input type="number" name="kode" id="kode" class="form-control" autocomplete="off" value="<?= $nomer_transaksi; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <textarea name="keterangan" id="keterangan" class="form-control" autocomplete="off" placeholder="Keterangan" style="height: 80px;"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="tgl">Tanggal</label>
                        <input type="date" name="tgl" id="tgl" class="form-control" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="jumlah">Jumlah</label>
                        <input type="text" name="jumlah" id="jumlah" class="form-control uang" autocomplete="off" placeholder="Rp. ">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fas fa-fw fa-times"></i>Batal</button>
                    <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-fw fa-save mr-1"></i>Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="EditKasMasuk" tabindex="-1" role="dialog" aria-labelledby="EditKasMasuk" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="post" action="/KasMasuk/UpdateData" id="frmKas">
            <?= csrf_field(); ?>
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="EditKasMasuk">
                        Edit Kas Masuk
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body modal-edit">
                    <div class="form-group">
                        <label for="kode">Kode</label>
                        <input type="number" name="kode" id="kode" class="form-control" autocomplete="off" readonly>
                    </div>
                    <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <textarea name="keterangan" id="keterangan" class="form-control" autocomplete="off" placeholder="Keterangan" style="height: 80px;"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="tgl">Tanggal</label>
                        <input type="date" name="tgl" id="tgl" class="form-control" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="jumlah">Jumlah</label>
                        <input type="text" name="jumlah" id="jumlah" class="form-control uang" autocomplete="off" placeholder="Rp. ">
                    </div>
                    <input type="hidden" name="kas_lama" id="kas_lama">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fas fa-fw fa-times"></i>Batal</button>
                    <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-fw fa-save mr-1"></i>Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>
<?php $this->endSection() ?>