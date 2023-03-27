<?php $this->extend('template/index') ?>
<?php $this->Section('konten') ?>
<div class="section-header">
    <h1>Dashboard</h1>
</div>
<div class="row">
    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-primary">
                <i class="fas fa-users"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Total Anggota</h4>
                </div>
                <div class="card-body">
                    <?= $totanggota; ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-danger">
                <i class="fas fa-money-bill-wave"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Total Kas Masuk Hari Ini</h4>
                </div>
                <div class="card-body">
                    Rp. <?= $totkasmasukhariini['totkasmasukhariini'] == 0 ? '0' : number_format($totkasmasukhariini['totkasmasukhariini']); ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-warning">
                <i class="fas fa-money-bill-alt"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Total Kas Masuk Bulan Ini</h4>
                </div>
                <div class="card-body">
                    Rp. <?= $totkasmasukbulanini['totkasmasukbulanini'] == 0 ? '0' : number_format($totkasmasukbulanini['totkasmasukbulanini']); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-primary">
                <i class="far fa-user"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Total Pengguna</h4>
                </div>
                <div class="card-body">
                    <?= $totpengguna; ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-danger">
                <i class="fas fa-money-bill-wave"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Total Pembayaran Kas Bulan Ini</h4>
                </div>
                <div class="card-body">
                    Rp. <?= $totkaspembayaranbulanini['totkaspembayaranbulanini'] == 0 ? '0' : number_format($totkaspembayaranbulanini['totkaspembayaranbulanini']); ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-warning">
                <i class="fas fa-money-bill-alt"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Total Pembayaran Kas Keseluruhan</h4>
                </div>
                <div class="card-body">
                    Rp. <?= $totkaspembayarankeseluruhan['totkaspembayarankeseluruhan'] == 0 ? '0' : number_format($totkaspembayarankeseluruhan['totkaspembayarankeseluruhan']); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-primary">
                <i class="fas fa-money-bill-wave"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Total Kas Keluar Hari Ini</h4>
                </div>
                <div class="card-body">
                    Rp. <?= $totkaskeluarhariini['totkaskeluarhariini'] == 0 ? '0' : number_format($totkaskeluarhariini['totkaskeluarhariini']); ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-danger">
                <i class="fas fa-money-bill-alt"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Total Kas Keluar Bulan Ini</h4>
                </div>
                <div class="card-body">
                    Rp. <?= $totkaskeluarbulanini['totkaskeluarbulanini'] == 0 ? '0' : number_format($totkaskeluarbulanini['totkaskeluarbulanini']); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-success">
                <i class="fas fa-money-check"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Total Kas Masuk Keseluruhan</h4>
                </div>
                <div class="card-body">
                    Rp. <?= number_format($totkasmasukkeseluruhan['totkasmasukkeseluruhan']); ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-success">
                <i class="fas fa-hand-holding-usd"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Total Kas Keluar Keseluruhan</h4>
                </div>
                <div class="card-body">
                    Rp. <?= number_format($totkaskeluarkeseluruhan['totkaskeluarkeseluruhan']); ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-success">
                <i class="fas fa-wallet"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Saldo akhir</h4>
                </div>
                <div class="card-body">
                    <?php $saldoakhir =  $totkasmasukkeseluruhan['totkasmasukkeseluruhan'] - $totkaskeluarkeseluruhan['totkaskeluarkeseluruhan'] ?>
                    Rp. <?= number_format($saldoakhir); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row justify-content-center">
    <div class="col-12 col-md-8 col-lg-8">
        <div class="card">
            <div class="card-header">
                <h4>Grafik Kas Masuk <?= date('Y'); ?></h4>
            </div>
            <div class="card-body">
                <canvas id="myChart"></canvas>
            </div>
        </div>
    </div>
</div>
<div class="row justify-content-center">
    <div class="col-12 col-md-8 col-lg-8">
        <div class="card">
            <div class="card-header">
                <h4>Grafik Kas Keluar <?= date('Y'); ?></h4>
            </div>
            <div class="card-body">
                <canvas id="myChart2"></canvas>
            </div>
        </div>
    </div>
</div>
<div class="row justify-content-center">
    <div class="col-12 col-md-8 col-lg-8">
        <div class="card">
            <div class="card-header">
                <h4>Grafik Pembayaran Kas <?= date('Y'); ?></h4>
            </div>
            <div class="card-body">
                <canvas id="myChart3"></canvas>
            </div>
        </div>
    </div>
</div>

<?php

$mulai = 1;
for ($i = $mulai; $i < $mulai + 12; $i++) {
    $namabulan[] = bulan($i);
}

if (count($chartkasmasuk) > 0) {
    foreach ($chartkasmasuk as $km) {
        $kasmasuk[] = $km['kasmasuk'];
    }
}


if (count($chartkaskeluar) > 0) {
    foreach ($chartkaskeluar as $kk) {
        $kaskeluar[] = $kk['kaskeluar'];
    }
}

if (count($chartpembayarankas) > 0) {
    foreach ($chartpembayarankas as $c) {
        $jumlahpembayaran[] = $c['jumlah_pembayaran'];
    }
}
?>
<script src="/back-end/node_modules/chart.js/dist/Chart.min.js"></script>
<script>
    var ctx = document.getElementById("myChart").getContext("2d");
    var myChart = new Chart(ctx, {
        type: "line",
        data: {
            labels: <?php echo json_encode($namabulan) ?>,
            datasets: [{
                label: "Kas Masuk :",
                data: <?php echo json_encode($kasmasuk) ?>,
                borderWidth: 2,
                backgroundColor: "#6777ef",
                borderColor: "#6777ef",
                borderWidth: 2.5,
                pointBackgroundColor: "#ffffff",
                pointRadius: 4,
            }, ],
        },
        options: {
            legend: {
                display: false,
            },
            scales: {
                yAxes: [{
                    gridLines: {
                        drawBorder: false,
                        color: "#f2f2f2",
                    },
                    ticks: {
                        beginAtZero: true,
                        // stepSize: 150,
                    },
                }, ],
                xAxes: [{
                    ticks: {
                        display: true,
                    },
                    gridLines: {
                        display: false,
                    },
                }, ],
            },
        },
    });

    var ctx = document.getElementById("myChart2").getContext("2d");
    var myChart = new Chart(ctx, {
        type: "bar",
        data: {
            labels: <?php echo json_encode($namabulan) ?>,
            datasets: [{
                label: "Kas Keluar :",
                data: <?php echo json_encode($kaskeluar) ?>,
                borderWidth: 2,
                backgroundColor: "#fc544b",
                borderColor: "#fc544b",
                borderWidth: 2.5,
                pointBackgroundColor: "#ffffff",
                pointRadius: 4,
            }, ],
        },
        options: {
            legend: {
                display: false,
            },
            scales: {
                yAxes: [{
                    gridLines: {
                        drawBorder: false,
                        color: "#f2f2f2",
                    },
                    ticks: {
                        beginAtZero: true,
                        // stepSize: 20000,
                    },
                }, ],
                xAxes: [{
                    ticks: {
                        display: true,
                    },
                    gridLines: {
                        display: false,
                    },
                }, ],
            },
        },
    });

    var ctx = document.getElementById("myChart3").getContext("2d");
    var myChart = new Chart(ctx, {
        type: "line",
        data: {
            labels: <?php echo json_encode($namabulan) ?>,
            datasets: [{
                label: "Pembayaran Kas :",
                data: <?php echo json_encode($jumlahpembayaran) ?>,
                borderWidth: 2,
                backgroundColor: "#63ed7a",
                borderColor: "#63ed7a",
                borderWidth: 2.5,
                pointBackgroundColor: "#ffffff",
                pointRadius: 4,
            }, ],
        },
        options: {
            legend: {
                display: false,
            },
            scales: {
                yAxes: [{
                    gridLines: {
                        drawBorder: false,
                        color: "#f2f2f2",
                    },
                    ticks: {
                        beginAtZero: true,
                        // stepSize: 150,
                    },
                }, ],
                xAxes: [{
                    ticks: {
                        display: true,
                    },
                    gridLines: {
                        display: false,
                    },
                }, ],
            },
        },
    });
</script>
<?php $this->endSection() ?>