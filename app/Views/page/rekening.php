<?php $this->extend('template/index') ?>
<?php $this->Section('konten') ?>
<div class="section-header">
    <h1>Data Rekening</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Master Data</a></div>
        <div class="breadcrumb-item">Data Rekening</div>
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
                        <a href="/Rekening/TambahRekening" class="btn btn-primary">Tambah Data</a>
                        <hr>
                        <table class="table" id="tabel">
                            <thead>
                                <tr>
                                    <th class="text-center">
                                        No
                                    </th>
                                    <th>Nama Bank</th>
                                    <th>Nomor Rekening</th>
                                    <th>Atas Nama</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($rekening as $r) : ?>
                                    <tr>
                                        <td class="text-center">
                                            <?= $no++; ?>
                                        </td>
                                        <td>
                                            <?= $r['nama_bank']; ?><br>
                                        </td>
                                        <td>
                                            <?= $r['nomor_rekening']; ?><br>
                                        </td>
                                        <td>
                                            <?= $r['atasnama']; ?><br>
                                        </td>
                                        <td>
                                            <a href="/Rekening/EditData/<?= $r['id_rekening']; ?>" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                            <a href="/Rekening/DeleteData/<?= $r['id_rekening']; ?>" class="btn btn-danger btn-sm hapus"><i class="fas fa-trash"></i></a>
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