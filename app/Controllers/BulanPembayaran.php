<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BulanPembayaranModel;
use App\Models\PembayaranModel;
use App\Models\AnggotaModel;


class BulanPembayaran extends BaseController
{
    public function __construct()
    {
        $this->BulanPembayaranModel = new BulanPembayaranModel;
        $this->PembayaranModel = new PembayaranModel;
        $this->AnggotaModel = new AnggotaModel;
    }
    public function TambahBulanPembayaran()
    {
        $data = [
            'title' => 'Tambah Bulan Pembayaran',
            'masterpembayaran' => 'active',
            'mpembayaran' => 'active',
            'validasi' => \Config\Services::validation(),
            'kode' => $this->BulanPembayaranModel->KodeBulan(),
        ];
        return view('page/tambah_bulan_pembayaran', $data);
    }
    public function InsertData()
    {
        if (!$this->validate([
            'nama_bulan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Silahkan pilih bulan',
                ]
            ],
            'tahun' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tahun harus diisi',
                ]
            ],
            'jumlah' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jumlah harus diisi'
                ]
            ],
        ])) {
            return redirect()->to('BulanPembayaran/TambahBulanPembayaran')->withInput();
        }
        $nama_bulan = $this->request->getVar('nama_bulan');
        $tahun = $this->request->getVar('tahun');
        $cek_bulan = $this->BulanPembayaranModel->ValidasiBulan($nama_bulan, $tahun);
        if ($cek_bulan) {
            session()->setFlashData('error', 'Bulan pada tahun tersebut sudah ada!!!');
            return redirect()->to('Pembayaran');
        } else {
            $this->BulanPembayaranModel->save([
                'id_bulan_pembayaran' => $this->request->getVar('kode'),
                'nama_bulan' => $this->request->getVar('nama_bulan'),
                'tahun' => $this->request->getVar('tahun'),
                'pembayaran_mingguan' => $this->request->getVar('jumlah'),
            ]);
            $id_bulan_pembayaran = $this->BulanPembayaranModel->getInsertID();
            $anggota =  $this->AnggotaModel->findAll();
            $data = [];
            foreach ($anggota as $a) {
                $data[] = [
                    'id_bulan_pembayaran' => $id_bulan_pembayaran,
                    'id_anggota' => $a['id_anggota']
                ];
            }
            $this->PembayaranModel->insertBatch($data);
            session()->setFlashData('pesan', 'Data berhasil ditambahkan');
            return redirect()->to('Pembayaran');
        }
    }
    public function DeleteData($id_bulan_pembayaran)
    {
        $data = [
            'id_bulan_pembayaran' => $id_bulan_pembayaran
        ];
        $this->BulanPembayaranModel->delete($data);
        session()->setFlashData('pesan', 'Data berhasil dihapus');
        return redirect()->to('Pembayaran');
    }
}
