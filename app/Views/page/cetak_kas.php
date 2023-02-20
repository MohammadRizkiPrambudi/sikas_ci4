<div class="row mt-5 text-center">
    <div class="col">
        <h3>Laporan Kas Pambrasta</h3>
        <span>
            <p>Desa Brangsong RT 06 RW 02 Kec. Brangsong</p>
            <b>Periode : <?= bulan($bulan); ?> <?= $tahun; ?></b>
        </span>
    </div>
</div>
<hr>
<a href="<?= $cetak_pdf; ?>" class="btn btn-primary mb-2" target="blank"><i class="fas fa-file-pdf mr-1"></i>PDF</a>
<a href="<?= $cetak_excel; ?>" class="btn btn-success mb-2" target="blank"><i class="fas fa-file-excel mr-1"></i>EXCEL</a>
<div class="table-responsive">
    <table class="table nowrap" id="tabel-laporankas" style="width:100%">
        <thead>
            <tr>
                <th class="text-center">
                    No
                </th>
                <th>Kode Kas</th>
                <th>Keterangan</th>
                <th>Tanggal</th>
                <th>Kas Masuk</th>
                <th>Jenis kas</th>
                <th>Kas Keluar</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
<input type="hidden" value="<?= $bulan; ?>" id="bulan">
<input type="hidden" value="<?= $tahun; ?>" id="tahun">
<script src="/back-end/js/myscripts.js"></script>