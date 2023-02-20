<?php $this->extend('template/index') ?>
<?php $this->Section('konten') ?>
<div class="section-header">
    <h1>Riwayat</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Riwayat</a></div>
        <div class="breadcrumb-item">Riwayat Pembayaran</div>
    </div>
</div>
<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="tabel">
                            <thead>
                                <tr>
                                    <th class="text-center" width="10%">
                                        No
                                    </th>
                                    <th width="20%">Nama Pengubah</th>
                                    <th width="20%">Tanggal</th>
                                    <th width="40%">Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($history as $r) : ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td>
                                            <?= $r['penginput']; ?>
                                        </td>
                                        <td>
                                            <?= Tanggal(date('Y-m-d', strtotime($r['tanggal']))) ?><br>
                                            <?= date('H:i:s', strtotime($r['tanggal'])) ?>
                                        </td>
                                        <td>
                                            <?= $r['keterangan']; ?>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->endSection() ?>