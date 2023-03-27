<?php $this->extend('template/index') ?>
<?php $this->Section('konten') ?>
<div class="section-header">
    <h1>Data Kas Keluar</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Manajemen Kas</a></div>
        <div class="breadcrumb-item">Data Kasuk Keluar</div>
    </div>
</div>
<div class="flash-data" data-flash="<?= session()->getFlashdata('pesan'); ?>"></div>
<div class="flash-error" data-error="<?= session()->getFlashdata('error'); ?>"></div>
<div class="section-body">
    <div class="card card-statistic-1 bg-danger">
        <div class="card-icon bg-white">
            <i class="fas fa-money-bill text-danger"></i>
        </div>
        <div class="card-wrap">
            <div class="card-header">
                <h4 class="text-white">Total Pengeluaran</h4>
            </div>
            <div class="card-body text-white">
                <?php $total_kask = 0;
                foreach ($kas_keluar as $total) {
                    $total_kask += $total['kas_keluar'];
                } ?>
                <span style="font-size: 16px;"> Rp. <?= number_format($total_kask, 2, ',', '.'); ?>
                    <p style="font-size: 12px;">( <?= ucwords(terbilang($total_kask)); ?> )</p>
                </span>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <button type="button" data-toggle="modal" data-target="#TambahKasKeluar" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Tambah Data</button>
                        <hr>
                        <table class="table nowrap" id="tabel" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th class="text-center">
                                        No
                                    </th>
                                    <th>Kode Kas</th>
                                    <th>Keterangan</th>
                                    <th>Tanggal</th>
                                    <th>Jumlah</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($kas_keluar as $kk) : ?>
                                    <tr>
                                        <td class="text-center">
                                            <?= $no++; ?>
                                        </td>
                                        <td><?= $kk['kode_kas']; ?></td>
                                        <td><?= $kk['keterangan_kas']; ?></td>
                                        <td><?= Tanggal($kk['tgl_kas']); ?><br>
                                            Penginput : <?= $kk['nama_pengguna']; ?>
                                        </td>
                                        <td>Rp. <?= number_format($kk['kas_keluar']); ?></td>
                                        <td>
                                            <button type="button" class="btn btn-info btn-sm btn-ubah" data-target="#EditKasKeluar" data-kode="<?= $kk['kode_kas']; ?>" data-keterangan="<?= $kk['keterangan_kas']; ?>" data-tanggal="<?= $kk['tgl_kas']; ?>" data-jumlah="<?= $kk['kas_keluar']; ?>" data-toggle="modal"><i class="fas fa-edit"></i></button>
                                            <a href="/KasKeluar/DeleteData/<?= $kk['kode_kas']; ?>" class="btn btn-danger btn-sm hapus"><i class="fas fa-trash"></i></a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
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
<div class="modal fade" id="TambahKasKeluar" tabindex="-1" role="dialog" aria-labelledby="TambahKasKeluar" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="post" action="/KasKeluar/InsertData" id="frmKas">
            <?= csrf_field(); ?>
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="TambahKasKeluar">
                        Tambah Kas Keluar
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
                        <textarea name="keterangan" id="keterangan" class="form-control" autocomplete="off" placeholder="Keterangan" rows="3"></textarea>
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

<div class="modal fade" id="EditKasKeluar" tabindex="-1" role="dialog" aria-labelledby="EditKasKeluar" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="post" action="/KasKeluar/UpdateData" id="frmKas">
            <?= csrf_field(); ?>
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="EditKasKeluar">
                        Edit Kas Keluar
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
                    <input type="text" name="kas_lama" id="kas_lama">
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