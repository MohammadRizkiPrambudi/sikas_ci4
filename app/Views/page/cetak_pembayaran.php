<div class="row mt-5 text-center">
    <div class="col">
        <h3>Laporan Pembayaran Kas Mingguan Pambrasta</h3>
        <span>
            <p>Desa Brangsong RT 06 RW 02 Kec. Brangsong</p>
            <b>Periode : <?= $bulan; ?> <?= $tahun; ?></b>
        </span>
    </div>
</div>
<hr>
<a href="<?= $cetak_pdf; ?>" class="btn btn-primary mb-2" target="blank"><i class="fas fa-file-pdf mr-1"></i>PDF</a>
<a href="<?= $cetak_excel; ?>" class="btn btn-success mb-2" target="blank"><i class="fas fa-file-excel mr-1"></i>EXCEL</a>
<div class="table-responsive">
    <table class="table nowrap" id="tabel" style="width:100%">
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
            <?php if ($lap_pembayaran) : ?>
                <?php $no = 1;
                foreach ($lap_pembayaran as $lp) : ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td>
                            <?= $lp['nama_anggota'] ?>
                        </td>
                        <td>
                            Rp. <?= number_format($lp['minggu_ke_1']) ?>
                        </td>
                        <td>
                            Rp. <?= number_format($lp['minggu_ke_2']) ?>
                        </td>
                        <td>
                            Rp. <?= number_format($lp['minggu_ke_3']) ?>
                        </td>
                        <td>
                            Rp. <?= number_format($lp['minggu_ke_4']) ?>
                        </td>
                    </tr>
                <?php endforeach ?>
            <?php else : ?>
                <tr>
                    <td colspan="6" class="text-center">Tidak ada data</td>
                </tr>
            <?php endif ?>
        </tbody>
    </table>
</div>