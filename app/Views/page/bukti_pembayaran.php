<?php $this->extend('template/index') ?>
<?php $this->Section('konten') ?>
<div class="section-header">
    <h1>Bukti Pembayaran</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Bukti Pembayaran</a></div>
        <div class="breadcrumb-item">Bukti Pembayaran</div>
    </div>
</div>
<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <?php if (session()->get('level_pengguna') == 'anggota') : ?>
                        <div class="alert alert-danger alert-has-icon mt-2">
                            <div class="alert-icon"><i class="fas fa-exclamation"></i></div>
                            <div class="alert-body">
                                <div class="alert-title">Perhatian</div>
                                Untuk Pembayaran transfer silahkan tunggu sampai dikonfirmasi oleh bendahara, jika terlalu lama silahkan kontak bendahara melalui WA dinomer berikut <b> <a href="https://wa.me/6281225166751">+6281225166751</a><b>
                            </div>
                        </div>
                    <?php elseif (session()->get('level_pengguna') == 'bendahara') : ?>
                        <div class="alert alert-danger alert-has-icon mt-2">
                            <div class="alert-icon"><i class="fas fa-exclamation"></i></div>
                            <div class="alert-body">
                                <div class="alert-title">Perhatian</div>
                                Silahkan cek menu bukti pembayaran, jika terdapat icon kedip kedip segera untuk konfirmasi pembayaran transfer dan jangan lupa untuk menginputkan ke pembayaran kas mingguan.
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="table-responsive">
                        <table class="table" id="tabel">
                            <thead>
                                <tr>
                                    <th class="text-center" width="5%">
                                        No
                                    </th>
                                    <th class="15%">Nama Anggota</th>
                                    <th width="10%">Nama Rekening</th>
                                    <th width="20%">Keterangan</th>
                                    <th width="10%">Foto</th>
                                    <th width="20%">Status Pembayaran</th>
                                    <?php if (session()->get('level_pengguna') == 'bendahara') : ?>
                                        <th width="10%">
                                            <?php if ($cek_status >  0) : ?>
                                                Opsi
                                            <?php endif ?>
                                        <?php endif ?>
                                        </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($bukti_pembayaran as $r) : ?>
                                    <tr>
                                        <td class="text-center"><?= $no++; ?></td>
                                        <td>
                                            <?= $r['nama_anggota']; ?>
                                        </td>
                                        <td>
                                            <?= $r['nama_bank']; ?>
                                        </td>
                                        <td>
                                            <?= $r['keterangan_pembayaran']; ?>
                                        </td>
                                        <td>
                                            <a href="/back-end/img/transfer/bukti.PNG" data-lightbox="bukti-bayar<?= $r['nama_anggota']; ?>" data-title="Bukti pembayaran kas <?= $r['nama_anggota']; ?>"><img src="/back-end/img/transfer/bukti.PNG" alt="#" width="100%"></a>
                                        </td>
                                        <td>
                                            <?php if ($r['status_pembayaran'] == 0) : ?>
                                                <span class="badge badge-warning">Menunggu</span>
                                            <?php elseif ($r['status_pembayaran'] == 1) : ?>
                                                <span class="badge badge-success">Berhasil</span>
                                            <?php else : ?>
                                                <span class="badge badge-danger">Gagal</span>
                                            <?php endif; ?>
                                        </td>
                                        <?php if (session()->get('level_pengguna') == 'bendahara') : ?>
                                            <td>
                                                <?php if ($cek_status  > 0 and $r['status_pembayaran'] == 0) : ?>
                                                    <a href="/BuktiPembayaran/Konfirmasi/<?= $r['id_bukti_pembayaran']; ?>" class="btn btn-success btn-sm konfirmasi"><i class="fas fa-check"></i></a>
                                                    <a href="/BuktiPembayaran/Gagal/<?= $r['id_bukti_pembayaran']; ?>" class="btn btn-danger btn-sm konfirmasi"><i class="fas fa-times"></i></a>
                                                <?php endif ?>
                                            </td>
                                        <?php endif; ?>
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