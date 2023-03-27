<?php $this->extend('template/index') ?>
<?php $this->Section('konten') ?>
<div class="section-header">
    <h1>Data Pengguna</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Master Data</a></div>
        <div class="breadcrumb-item">Data Pengguna</div>
    </div>
</div>
<div class="flash-data" data-flash="<?= session()->getFlashdata('pesan'); ?>"></div>
<div class="flash-error" data-error="<?= session()->getFlashdata('error'); ?>"></div>
<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <a href="/Pengguna/TambahPengguna" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Tambah Data</a>
                        <hr>
                        <table class="table" id="tabel">
                            <thead>
                                <tr>
                                    <th class="text-center">
                                        No
                                    </th>
                                    <th>Nama Anggota</th>
                                    <th>Foto</th>
                                    <th>Level</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($pengguna as $p) : ?>
                                    <tr>
                                        <td class="text-center">
                                            <?= $no++; ?>
                                        </td>
                                        <td>
                                            <?= $p['nama_pengguna']; ?><br>
                                        </td>
                                        <td><img src="/back-end/img/admin/<?= $p['foto_pengguna']; ?>" width="80"></td>
                                        <td>
                                            <?= $p['level_pengguna']; ?><br>
                                        </td>
                                        <td>
                                            <a href="/Pengguna/EditData/<?= $p['id_pengguna']; ?>" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                            <a href="/Pengguna/DeleteData/<?= $p['id_pengguna']; ?>" class="btn btn-danger btn-sm hapus"><i class="fas fa-trash"></i></a>
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