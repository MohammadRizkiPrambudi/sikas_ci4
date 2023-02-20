<?php $this->extend('template/index') ?>
<?php $this->Section('konten') ?>
<div class="section-header">
    <h1>Pembayaran Kas</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">History Pembayaran</a></div>
        <div class="breadcrumb-item">Pembayaran Kas</div>
    </div>
</div>
<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="alert alert-danger alert-has-icon">
                        <div class="alert-icon"><i class="fas fa-exclamation"></i></div>
                        <div class="alert-body">
                            <div class="alert-title">Perhatian</div>
                            - Apabila jumlah kas berwarna hitam berarti pembayaran anda sudah lunas <br>
                            - Sebaliknya jika jumlah kas berwarna merah berarti pembayaran masih kurang
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table" id="tabel">
                            <thead>
                                <tr>
                                    <th class="text-center">
                                        No
                                    </th>
                                    <th>Nama Anggota</th>
                                    <th>Bulan</th>
                                    <th>Minggu Ke-1</th>
                                    <th>Minggu Ke-2</th>
                                    <th>Minggu Ke-3</th>
                                    <th>Minggu Ke-4</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($kas as $k) : ?>
                                    <tr>
                                        <td class="text-center">
                                            <?= $no++; ?>
                                        </td>
                                        <td>
                                            <?= $k['nama_anggota']; ?>
                                        </td>
                                        <td>
                                            <?= $k['nama_bulan']; ?><br>
                                            <?= $k['tahun']; ?>
                                        </td>

                                        <?php if ($k['minggu_ke_1'] == $k['pembayaran_mingguan']) : ?>
                                            <td>Rp. <?= number_format($k['minggu_ke_1']); ?></td>
                                        <?php else : ?>
                                            <td class="text-danger"> Rp. <?= number_format($k['minggu_ke_1']); ?></td>
                                        <?php endif ?>

                                        <?php if ($k['minggu_ke_2'] == $k['pembayaran_mingguan']) : ?>
                                            <td> Rp. <?= number_format($k['minggu_ke_2']); ?></td>
                                        <?php else : ?>
                                            <td class="text-danger"> Rp. <?= number_format($k['minggu_ke_2']); ?></td>
                                        <?php endif ?>

                                        <?php if ($k['minggu_ke_3'] == $k['pembayaran_mingguan']) : ?>
                                            <td> Rp. <?= number_format($k['minggu_ke_3']); ?></td>
                                        <?php else : ?>
                                            <td class="text-danger"> Rp. <?= number_format($k['minggu_ke_3']); ?></td>
                                        <?php endif ?>

                                        <?php if ($k['minggu_ke_4'] == $k['pembayaran_mingguan']) : ?>
                                            <td> Rp. <?= number_format($k['minggu_ke_4']); ?></td>
                                        <?php else : ?>
                                            <td class="text-danger"> Rp. <?= number_format($k['minggu_ke_4']); ?></td>
                                        <?php endif ?>
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