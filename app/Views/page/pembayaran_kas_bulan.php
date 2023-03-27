<?php $this->extend('template/index') ?>
<?php $this->Section('konten') ?>
<div class="section-header">
    <h1>Detail Pembayaran Kas</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Manajemen Kas</a></div>
        <div class="breadcrumb-item">Detail Pembayaran Kas</div>
    </div>
</div>
<div class="flash-data" data-flash="<?= session()->getFlashdata('pesan'); ?>"></div>
<div class="flash-error" data-error="<?= session()->getFlashdata('error'); ?>"></div>
<div class="section-body">
    <div class="row">
        <div class="col-md-6">
            <div class="card card-statistic-1 bg-info">
                <div class="card-icon bg-white">
                    <i class="fas fa-info text-info"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4 class="text-white">Keterangan</h4>
                    </div>
                    <div class="card-body text-white">
                        <span style="font-size: 16px;">
                            Bulan : <?= $detail_bulan_pembayaran['nama_bulan'] ?> - <?= $detail_bulan_pembayaran['tahun'] ?>
                            <p style="font-size: 12px;"> Kas: Rp. <?= number_format($detail_bulan_pembayaran['pembayaran_mingguan']); ?> Perminggu</p>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card card-statistic-1 bg-warning">
                <div class="card-icon bg-white">
                    <i class="fas fa-wallet text-warning"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4 class="text-white">Total Pemasukan</h4>
                    </div>
                    <div class="card-body text-white">
                        <p style="font-size: 17px;" class="font-weight-bold"> Rp. <?= number_format($total_kasperbulan['total_perbulan']); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <span data-toggle="modal" data-target="#masukkan_anggota" class="btn btn-primary"><i class="fas fa-plus-circle mr-1"></i>Masukkan Anggota</span>
                        <hr>
                        <table class="table" id="tabel">
                            <thead>
                                <tr>
                                    <th class="text-center">
                                        No
                                    </th>
                                    <th>Nama</th>
                                    <th>Minggu ke-1</th>
                                    <th>Minggu ke-2</th>
                                    <th>Minggu ke-3</th>
                                    <th>Minggu ke-4</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php
                                $id_bulan_pembayaran  = $detail_bulan_pembayaran['id_bulan_pembayaran'];
                                // id bulan pembayaran pertama
                                $id_bulan_pembayaran_pertama = $bulan_pembayaran_pertama['id_bulan_pembayaran'];

                                // cek id bulan sebelumnya
                                $id_bulan_pembayaran_sebelum = $detail_bulan_pembayaran['id_bulan_pembayaran'] - 1;
                                if ($id_bulan_pembayaran_sebelum <= 0) {
                                    $id_bulan_pembayaran_sebelum = 1;
                                }
                                // menampilkan uang kas senelumnya
                                if ($detail_bulan_pembayaran['id_bulan_pembayaran'] != $id_bulan_pembayaran_pertama) {
                                    $data_kas_sebelum = array_column($kas_sebelum, "status_lunas", 'id_anggota');
                                }
                                ?>
                                <?php foreach ($pembayaran_kas_peranggota as $pkp) : ?>
                                    <?php
                                    $id_anggota = $pkp['id_anggota'];
                                    $kas_perminggu = $pkp['pembayaran_mingguan'];
                                    ?>
                                    <?php if (session()->get('level_pengguna') === 'bendahara') : ?>
                                        <?php if ($detail_bulan_pembayaran['id_bulan_pembayaran'] != $id_bulan_pembayaran_pertama and $data_kas_sebelum[$id_anggota] == '0') : ?>
                                            <tr class="bg-danger text-white">
                                            <?php else : ?>
                                            <tr>
                                            <?php endif ?>
                                            <td><?= $i++; ?></td>
                                            <td><?= $pkp["nama_anggota"]; ?></td>
                                            <?php if ($pkp['minggu_ke_1'] == $pkp['pembayaran_mingguan']) : ?>
                                                <?php if ($pkp['minggu_ke_2'] !== "0") : ?>
                                                    <td>
                                                        <button type="button" class="badge badge-success" data-container="body" data-toggle="popover" data-placement="bottom" data-trigger="focus" data-content="Tidak bisa mengubah minggu ke 1, kalau minggu ke 2 dan seterusnya sudah lunas, jika ingin mengubah, ubahlah minggu ke 2 atau ke 3 atau ke 4 terlebih dahulu menjadi 0."><i class="fas fa-fw fa-check mr-1"></i>Lunas</button>
                                                    </td>
                                                <?php else : ?>
                                                    <td>
                                                        <a href="" data-toggle="modal" data-target="#editMingguKe1<?= $pkp['id_pembayaran']; ?>" class="badge badge-success"><i class="fas fa-fw fa-check mr-1"></i>Lunas</a>
                                                        <a href="https://api.whatsapp.com/send?phone=<?= $pkp['nowa_anggota']; ?>&text=Terima Kasih <?= $pkp['nama_anggota']; ?> Atas Pembayaran Kas Pada Minggu Pertama Bulan <?= $pkp['nama_bulan']; ?> Tahun <?= $pkp['tahun']; ?> Sebesar Rp. <?= number_format($pkp['minggu_ke_1']); ?> " target="_blank"><span class="badge badge-success badge-sm"><i class="fab fa-whatsapp mr-1"></i>Notifikasi</span></a>
                                                    </td>
                                                <?php endif ?>
                                            <?php else : ?>
                                                <td>
                                                    <?php if (
                                                        $detail_bulan_pembayaran['id_bulan_pembayaran'] !=
                                                        $id_bulan_pembayaran_pertama and $data_kas_sebelum[$id_anggota] == '0'
                                                    ) : ?>
                                                        <button type="button" class="badge badge-danger" data-container="body" data-toggle="popover" data-trigger="focus" data-placement="top" data-content="Tidak bisa melakukan pembayaran, jika bulan pembayaran sebelumnya belum lunas."> <i class="fas fa-fw fa-times"></i>
                                                        </button>
                                                    <?php else : ?>
                                                        <a href="" data-toggle="modal" data-target="#editMingguKe1<?= $pkp['id_pembayaran']; ?>" class="badge badge-danger"><?= number_format($pkp['minggu_ke_1']); ?></a>
                                                        <?php if ($pkp['minggu_ke_1'] != 0) : ?>
                                                            <a href="https://api.whatsapp.com/send?phone=<?= $pkp['nowa_anggota']; ?>&text=Terima Kasih <?= $pkp['nama_anggota']; ?> Atas Pembayaran Kas Pada Minggu Pertama Bulan <?= $pkp['nama_bulan']; ?> Tahun <?= $pkp['tahun']; ?> Sebesar Rp. <?= number_format($pkp['minggu_ke_1']); ?> Pembayaran Anda Kurang <?php $kurang = $pkp['pembayaran_mingguan'] - $pkp['minggu_ke_1'] ?> Rp. <?= number_format($kurang); ?>" target="_blank"><span class="badge badge-success badge-sm"><i class="fab fa-whatsapp mr-1"></i>Notifikasi</span></a>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                </td>
                                            <?php endif ?>
                                            <?php if ($pkp["minggu_ke_1"] !== $pkp["pembayaran_mingguan"]) : ?>
                                                <td>---</td>
                                                <td>---</td>
                                                <td>---</td>
                                            <?php else : ?>
                                                <?php if ($pkp["minggu_ke_2"] == $pkp["pembayaran_mingguan"]) : ?>
                                                    <?php if ($pkp["minggu_ke_3"] !== "0") : ?>
                                                        <td>
                                                            <button type="button" class="badge badge-success" data-container="body" data-toggle="popover" data-trigger="focus" data-placement="top" data-content="Tidak bisa mengubah minggu ke 2, jika minggu ke 3 dan seterusnya sudah lunas, jika ingin mengubah, ubahlah minggu ke 3 atau ke 4 terlebih dahulu menjadi 0."><i class="fas fa-fw fa-check mr-1"></i>Lunas</button>
                                                        </td>
                                                    <?php else : ?>
                                                        <td>
                                                            <a href="" data-toggle="modal" data-target="#editMingguKe2<?= $pkp['id_pembayaran']; ?>" class="badge badge-success"><i class="fas fa-fw fa-check mr-1"></i>Lunas</a>
                                                            <a href="https://api.whatsapp.com/send?phone=<?= $pkp['nowa_anggota']; ?>&text=Terima Kasih <?= $pkp['nama_anggota']; ?> Atas Pembayaran Kas Pada Minggu Kedua Bulan <?= $pkp['nama_bulan']; ?> Tahun <?= $pkp['tahun']; ?> Sebesar Rp. <?= number_format($pkp['minggu_ke_2']); ?>" target="_blank"><span class="badge badge-success badge-sm"><i class="fab fa-whatsapp mr-1"></i>Notifikasi</span></a>
                                                        </td>
                                                    <?php endif ?>
                                                <?php else : ?>
                                                    <td>
                                                        <a href="" data-toggle="modal" data-target="#editMingguKe2<?= $pkp['id_pembayaran']; ?>" class="badge badge-danger"><?= number_format($pkp['minggu_ke_2']); ?></a>
                                                        <?php if ($pkp['minggu_ke_2'] != 0) : ?>
                                                            <a href="https://api.whatsapp.com/send?phone=<?= $pkp['nowa_anggota']; ?>&text=Terima Kasih <?= $pkp['nama_anggota']; ?> Atas Pembayaran Kas Pada Minggu Kedua Bulan <?= $pkp['nama_bulan']; ?> Tahun <?= $pkp['tahun']; ?> Sebesar Rp. <?= number_format($pkp['minggu_ke_2']); ?> Pembayaran Anda Kurang <?php $kurang = $pkp['pembayaran_mingguan'] - $pkp['minggu_ke_2'] ?> Rp. <?= number_format($kurang); ?>" target="_blank"><span class="badge badge-success badge-sm"><i class="fab fa-whatsapp mr-1"></i>Notifikasi</span></a>
                                                        <?php endif ?>
                                                    </td>
                                                <?php endif ?>
                                                <?php if ($pkp["minggu_ke_2"] !== $pkp["pembayaran_mingguan"]) : ?>
                                                    <td>---</td>
                                                    <td>---</td>
                                                <?php else : ?>
                                                    <?php if ($pkp["minggu_ke_3"] == $pkp["pembayaran_mingguan"]) : ?>
                                                        <?php if ($pkp["minggu_ke_4"] !== "0") : ?>
                                                            <td>
                                                                <button type="button" class="badge badge-success" data-container="body" data-toggle="popover" data-trigger="focus" data-placement="top" data-content="Tidak bisa mengubah minggu ke 3, jika minggu ke 4 dan seterusnya sudah lunas, jika ingin mengubah, ubahlah minggu ke 4 dahulu menjadi 0."><i class="fas fa-fw fa-check mr-1"></i>Lunas</button>
                                                            </td>
                                                        <?php else : ?>
                                                            <td>
                                                                <a href="" data-toggle="modal" data-target="#editMingguKe3<?= $pkp['id_pembayaran']; ?>" class="badge badge-success"><i class="fas fa-fw fa-check mr-1"></i>Lunas</a>
                                                                <a href="https://api.whatsapp.com/send?phone=<?= $pkp['nowa_anggota']; ?>&text=Terima Kasih <?= $pkp['nama_anggota']; ?> Atas Pembayaran Kas Pada Minggu Ketiga Bulan <?= $pkp['nama_bulan']; ?> Tahun <?= $pkp['tahun']; ?> Sebesar Rp. <?= number_format($pkp['minggu_ke_3']); ?>" target="_blank"><span class="badge badge-success badge-sm"><i class="fab fa-whatsapp mr-1"></i>Notifikasi</span></a>
                                                            </td>
                                                        <?php endif ?>
                                                    <?php else : ?>
                                                        <td>
                                                            <a href="" data-toggle="modal" data-target="#editMingguKe3<?= $pkp['id_pembayaran']; ?>" class="badge badge-danger"><?= number_format($pkp['minggu_ke_3']); ?></a>
                                                            <?php if ($pkp['minggu_ke_3'] != 0) : ?>
                                                                <a href="https://api.whatsapp.com/send?phone=<?= $pkp['nowa_anggota']; ?>&text=Terima Kasih <?= $pkp['nama_anggota']; ?> Atas Pembayaran Kas Pada Minggu Ketiga Bulan <?= $pkp['nama_bulan']; ?> Tahun <?= $pkp['tahun']; ?> Sebesar Rp. <?= number_format($pkp['minggu_ke_3']); ?> Pembayaran Anda Kurang <?php $kurang = $pkp['pembayaran_mingguan'] - $pkp['minggu_ke_3'] ?> Rp. <?= number_format($kurang); ?>" target="_blank"><span class="badge badge-success badge-sm"><i class="fab fa-whatsapp mr-1"></i>Notifikasi</span></a>
                                                            <?php endif ?>
                                                        </td>
                                                    <?php endif ?>
                                                    <?php if ($pkp["minggu_ke_3"] !== $pkp["pembayaran_mingguan"]) : ?>
                                                        <td>---</td>
                                                    <?php else : ?>
                                                        <?php if ($pkp["minggu_ke_4"] == $pkp["pembayaran_mingguan"]) : ?>
                                                            <td>
                                                                <a href="" data-toggle="modal" data-target="#editMingguKe4<?= $pkp['id_pembayaran']; ?>" class="badge badge-success"><i class="fas fa-fw fa-check mr-1"></i>Lunas</a>
                                                                <a href="https://api.whatsapp.com/send?phone=<?= $pkp['nowa_anggota']; ?>&text=Terima Kasih <?= $pkp['nama_anggota']; ?> Atas Pembayaran Kas Pada Minggu Keempat Bulan <?= $pkp['nama_bulan']; ?> Tahun <?= $pkp['tahun']; ?> Sebesar Rp. <?= number_format($pkp['minggu_ke_4']); ?>" target="_blank"><span class="badge badge-success badge-sm"><i class="fab fa-whatsapp mr-1"></i>Notifikasi</span></a>
                                                            </td>
                                                        <?php else : ?>
                                                            <td>
                                                                <a href="" data-toggle="modal" data-target="#editMingguKe4<?= $pkp['id_pembayaran']; ?>" class="badge badge-danger"><?= number_format($pkp['minggu_ke_4']); ?></a>
                                                                <?php if ($pkp['minggu_ke_4'] != 0) : ?>
                                                                    <a href="https://api.whatsapp.com/send?phone=<?= $pkp['nowa_anggota']; ?>&text=Terima Kasih <?= $pkp['nama_anggota']; ?> Atas Pembayaran Kas Pada Minggu Keempat Bulan <?= $pkp['nama_bulan']; ?> Tahun <?= $pkp['tahun']; ?> Sebesar Rp. <?= number_format($pkp['minggu_ke_4']); ?> Pembayaran Anda Kurang <?php $kurang = $pkp['pembayaran_mingguan'] - $pkp['minggu_ke_4'] ?> Rp. <?= number_format($kurang); ?>" target="_blank"><span class="badge badge-success badge-sm"><i class="fab fa-whatsapp mr-1"></i>Notifikasi</span></a>
                                                                <?php endif ?>
                                                            </td>
                                                        <?php endif ?>
                                                    <?php endif; ?>
                                                <?php endif ?>
                                            <?php endif ?>
                                            </tr>
                                        <?php elseif (session()->get('level_pengguna') != 'bendahara') : ?>
                                        <?php endif ?>
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
<?php $this->Section('modal') ?>
<!-- modal minggu ke 1 -->
<?php foreach ($pembayaran_kas_peranggota as $pkp) : ?>
    <div class="modal fade" id="editMingguKe1<?= $pkp['id_pembayaran']; ?>" tabindex="-1" role="dialog" aria-labelledby="editMingguKe1Label = <?= $pkp['id_pembayaran']; ?> " aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form method="post" action="/Pembayaran/UpdatePembayaranMingguPertama">
                <?= csrf_field(); ?>
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editMingguKe1Label = <?= $pkp['id_pembayaran']; ?> ">
                            Pembayaran minggu ke-1 : <?= $pkp["nama_anggota"]; ?>
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="minggu_ke_1">Minggu ke- 1</label>
                            <input type="hidden" name="kas_sebelumnya" value="<?= $pkp["minggu_ke_1"]; ?>">
                            <input type="hidden" name="id_pembayaran" value="<?= $pkp["id_pembayaran"]; ?>">
                            <input type="hidden" name="anggota" value="<?= $pkp["nama_anggota"]; ?>">
                            <input type="hidden" name="id_bulan_pembayaran" value="<?= $pkp["id_bulan_pembayaran"]; ?>">
                            <input type="hidden" name="id_user" value="<?= session()->get('nama_pengguna') ?>">
                            <input type="number" max="<?= $pkp["pembayaran_mingguan"]; ?>" name="minggu_ke_1" id="minggu_ke_1" class="form-control" value="<?= $pkp["minggu_ke_1"]; ?>">
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
    <!-- modal minggu ke 2 -->
    <div class="modal fade" id="editMingguKe2<?= $pkp['id_pembayaran']; ?>" tabindex="-1" role="dialog" aria-labelledby="editMingguKe2Label = <?= $pkp['id_pembayaran']; ?> " aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form method="post" action="/Pembayaran/UpdatePembayaranMingguKedua">
                <?= csrf_field(); ?>
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editMingguKe2Label = <?= $pkp['id_pembayaran']; ?> ">
                            Pembayaran minggu ke-2 : <?= $pkp["nama_anggota"]; ?>
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="minggu_ke_2">Minggu ke- 2</label>
                            <input type="hidden" name="kas_sebelumnya" value="<?= $pkp["minggu_ke_2"]; ?>">
                            <input type="hidden" name="anggota" value="<?= $pkp["nama_anggota"]; ?>">
                            <input type="hidden" name="id_pembayaran" value="<?= $pkp["id_pembayaran"]; ?>">
                            <input type="hidden" name="id_bulan_pembayaran" value="<?= $pkp["id_bulan_pembayaran"]; ?>">
                            <input type="hidden" name="id_user" value="<?= session()->get('nama_pengguna') ?>">
                            <input type="number" max="<?= $pkp["pembayaran_mingguan"]; ?>" name="minggu_ke_2" id="minggu_ke_2" class="form-control" value="<?= $pkp["minggu_ke_2"]; ?>">
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
    <!-- modal minggu ke 3 -->
    <div class="modal fade" id="editMingguKe3<?= $pkp['id_pembayaran']; ?>" tabindex="-1" role="dialog" aria-labelledby="editMingguKe3Label = <?= $pkp['id_pembayaran']; ?> " aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form method="post" action="/Pembayaran/UpdatePembayaranMingguKetiga">
                <?= csrf_field(); ?>
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editMingguKe3Label = <?= $pkp['id_pembayaran']; ?> ">
                            Pembayaran minggu ke-3 : <?= $pkp["nama_anggota"]; ?>
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="minggu_ke_3">Minggu ke- 3</label>
                            <input type="hidden" name="kas_sebelumnya" value="<?= $pkp["minggu_ke_3"]; ?>">
                            <input type="hidden" name="id_pembayaran" value="<?= $pkp["id_pembayaran"]; ?>">
                            <input type="hidden" name="anggota" value="<?= $pkp["nama_anggota"]; ?>">
                            <input type="hidden" name="id_bulan_pembayaran" value="<?= $pkp["id_bulan_pembayaran"]; ?>">
                            <input type="hidden" name="id_user" value="<?= session()->get('nama_pengguna') ?>">
                            <input type="number" max="<?= $pkp["pembayaran_mingguan"]; ?>" name="minggu_ke_3" id="minggu_ke_3" class="form-control" value="<?= $pkp["minggu_ke_3"]; ?>">
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
    <!-- modal minggu ke 4 -->
    <div class="modal fade" id="editMingguKe4<?= $pkp['id_pembayaran']; ?>" tabindex="-1" role="dialog" aria-labelledby="editMingguKe4Label = <?= $pkp['id_pembayaran']; ?> " aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form method="post" action="/Pembayaran/UpdatePembayaranMingguKeempat">
                <?= csrf_field(); ?>
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editMingguKe4Label = <?= $pkp['id_pembayaran']; ?> ">
                            Pembayaran minggu ke-4 : <?= $pkp["nama_anggota"]; ?>
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="minggu_ke_4">Minggu ke- 4</label>
                            <input type="hidden" name="kas_sebelumnya" value="<?= $pkp["minggu_ke_4"]; ?>">
                            <input type="hidden" name="id_pembayaran" value="<?= $pkp["id_pembayaran"]; ?>">
                            <input type="hidden" name="pembayaran_perminggu" value="<?= $pkp["pembayaran_mingguan"]; ?>">
                            <input type="hidden" name="anggota" value="<?= $pkp["nama_anggota"]; ?>">
                            <input type="hidden" name="id_bulan_pembayaran" value="<?= $pkp["id_bulan_pembayaran"]; ?>">
                            <input type="hidden" name="id_user" value="<?= session()->get('nama_pengguna') ?>">
                            <input type="number" max="<?= $pkp["pembayaran_mingguan"]; ?>" name="minggu_ke_4" id="minggu_ke_4" class="form-control" value="<?= $pkp["minggu_ke_4"]; ?>">
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
<?php endforeach ?>

<!-- masukkan_anggota -->
<div class="modal fade" id="masukkan_anggota" tabindex="-1" role="dialog" aria-labelledby="masukkan_anggotaLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="post" action="/Anggota/MasukkanAnggota">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="masukkan_anggotaModalLabel">Masukkan Anggota</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id_bulan_pembayaran" value="<?= $id_bulan_pembayaran; ?>">
                    <div class="form-group">
                        <label for="id_anggota">Nama Anggota</label>
                        <select name="id_anggota" id="id_anggota" class="form-control">
                            <option value="">--Silahkan dipilih--</option>
                            <?php foreach ($anggota_baru as $ag) : ?>
                                <option value="<?= $ag['id_anggota']; ?>"><?= $ag['nama_anggota']; ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <a href="/Anggota/TambahAnggota">
                        <div class="alert alert-warning alert-has-icon col-md-9">
                            <div class="alert-body">
                                Nama anggota tidak ada ? Tambahkan disini!!!
                            </div>
                        </div>
                    </a>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fas fa-fw fa-times"></i>Batal</button>
                    <button type="submit" name="tambah" class="btn btn-primary btn-sm"><i class="fas fa-fw fa-save mr-1"></i>Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>
<?php $this->endSection() ?>