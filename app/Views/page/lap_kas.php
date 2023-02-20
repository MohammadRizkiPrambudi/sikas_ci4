<?php $this->extend('template/index') ?>
<?php $this->Section('konten') ?>
<div class="section-header">
    <h1>Laporan Kas</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Laporan</a></div>
        <div class="breadcrumb-item">Laporan Kas</div>
    </div>
</div>
<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-md-7">
                            <label class="text-center">Filter Berdasarkan Bulan</label>
                            <div class="input-group">
                                <select name="bulan" id="bulan" class="form-control">
                                    <?php
                                    $mulai = 1;
                                    for ($i = $mulai; $i < $mulai + 12; $i++) {
                                        echo '<option value="' . $i . '">' . bulan($i) . '</option>';
                                    }
                                    ?>
                                </select>
                                <select name="tahun" id="tahun" class="form-control">
                                    <?php
                                    $mulai = date('Y');
                                    for ($i = $mulai; $i < $mulai + 7; $i++) {
                                        echo '<option value="' . $i . '">' . $i . '</option>';
                                    }
                                    ?>
                                </select>
                                <button type="submit" class="btn btn-info filter" onclick="ViewLaporan()"><i class="fas fa-search"></i></button>
                                <button type="submit" class="btn btn-danger reload"><i class="fas fa-sync-alt"></i></button>
                            </div>
                        </div>
                    </div>
                    <div id="laporan-kas">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->endSection() ?>