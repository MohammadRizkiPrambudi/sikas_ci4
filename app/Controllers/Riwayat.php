<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\RiwayatModel;

class Riwayat extends BaseController
{
    public function __construct()
    {
        $this->RiwayatModel = new RiwayatModel;
    }
    public function index()
    {
        if (session()->get('level_pengguna') != 'bendahara') :
            $data = [
                'title' => 'History Kas',
                'history' => $this->RiwayatModel->findAll(),
                'mriwayat' => 'active'
            ];
        else :
            $data = [
                'title' => 'History Kas',
                'history' => $this->RiwayatModel->where('penginput', session()->get('nama_pengguna'))->findAll(),
                'mriwayat' => 'active'
            ];
        endif;
        return view('page/riwayat_pembayaran', $data);
    }
}
