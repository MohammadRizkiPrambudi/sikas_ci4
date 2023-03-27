<?php $this->extend('template/index') ?>
<?php $this->Section('konten') ?>
<div class="section-header">
    <h1>Data Anggota</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Master Data</a></div>
        <div class="breadcrumb-item">Daftar Anggota</div>
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
                        <a href="/Anggota/TambahAnggota" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Tambah Data</a>
                        <hr>
                        <table class="table" id="tabel">
                            <thead>
                                <tr>
                                    <th class="text-center">
                                        No
                                    </th>
                                    <th>Nama Anggota</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Username</th>
                                    <th>Foto</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($anggota as $a) : ?>
                                    <tr>
                                        <td class="text-center">
                                            <?= $no++; ?>
                                        </td>
                                        <td>
                                            <?= $a['nama_anggota']; ?><br>
                                            <a href="https://wa.me/<?= $a['nowa_anggota']; ?>" target="_blank"><span class="badge badge-success badge-sm"><i class="fab fa-whatsapp mr-1"></i><?= $a['nowa_anggota']; ?></span></a>
                                        </td>
                                        <td><?= $a['jk_anggota'] == 'L' ? 'Laki-Laki' : 'Perempuan'; ?></td>
                                        <td><?= $a['username_anggota']; ?></td>
                                        <td><img src="/back-end/img/anggota/<?= $a['foto_anggota']; ?>" width="80"></td>
                                        <td>
                                            <a href="/Anggota/EditData/<?= $a['id_anggota']; ?>" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                            <a href="/Anggota/DeleteData/<?= $a['id_anggota']; ?>" class="btn btn-danger btn-sm hapus"><i class="fas fa-trash"></i></a>
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