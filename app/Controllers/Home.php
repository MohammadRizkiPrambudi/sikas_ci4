<?php

namespace App\Controllers;

use App\Models\HomeModel;

class Home extends BaseController
{
    public function __construct()
    {
        $this->HomeModel = new HomeModel;
    }
    public function index()
    {
        $data = [
            'mhome' => 'active',
            'title' => 'Dashboard',
            'mdashboard' => 'active',
            'totanggota' => $this->HomeModel->totanggota(),
            'totpengguna' => $this->HomeModel->totpengguna(),
            'totkasmasukhariini' => $this->HomeModel->totkasmasukhariini(),
            'totkasmasukbulanini' => $this->HomeModel->totkasmasukbulanini(),
            'totkasmasukkeseluruhan' => $this->HomeModel->totkasmasukkeseluruhan(),
            'totkaskeluarhariini' => $this->HomeModel->totkaskeluarhariini(),
            'totkaskeluarbulanini' => $this->HomeModel->totkaskeluarbulanini(),
            'totkaskeluarkeseluruhan' => $this->HomeModel->totkaskeluarKeseluruhan(),
            'totkaspembayaranbulanini' => $this->HomeModel->totkaspembayaranbulanini(),
            'totkaspembayarankeseluruhan' =>  $this->HomeModel->totkaspembayarankeseluruhan(),
            'chartkasmasuk' => $this->HomeModel->ChartKasMasuk(),
            'chartkaskeluar' => $this->HomeModel->ChartKasKeluar(),
            'chartpembayarankas' => $this->HomeModel->ChartPembayaranKas(),
        ];
        return view('page/index', $data);
    }
}
