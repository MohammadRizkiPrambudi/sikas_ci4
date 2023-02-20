<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KasModel;
use App\Models\RiwayatModel;

class KasKeluar extends BaseController
{
    public function __construct()
    {
        $this->KasModel = new KasModel;
        $this->RiwayatModel = new RiwayatModel;
    }
    public function index()
    {
        $data = [
            'title' => 'Kas Keluar',
            'mkaskeluar' => 'active',
            'masterpembayaran' => 'active',
            'kas_keluar' => $this->KasModel->where('jenis_kas', 'keluar')->findAll(),
            'nomer_transaksi' => $this->KasModel->KodeKas(),
        ];
        return view('page/kas_keluar', $data);
    }
    public function InsertData()
    {
        if (!$this->validate([
            'keterangan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Keterangan harus diisi',
                ]
            ],
            'tgl' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tanggal harus diisi',
                ]
            ],
        ])) {
            return redirect()->to('KasKeluar');
        }
        $this->KasModel->save([
            'kode_kas' => $this->request->getVar('kode'),
            'keterangan_kas' => $this->request->getVar('keterangan'),
            'tgl_kas' => $this->request->getVar('tgl'),
            'jumlah_kas' => 0,
            'jenis_kas' => 'keluar',
            'kas_keluar' => str_replace(".", "", $this->request->getVar('jumlah')),
            'nama_pengguna' => session()->get('nama_pengguna'),
        ]);
        session()->setFlashData('pesan', 'Data berhasil ditambahkan');
        return redirect()->to('KasKeluar');
    }
    public function UpdateData()
    {
        $kode_kas = $this->request->getVar('kode');
        if (!$this->validate([
            'keterangan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Keterangan harus diisi',
                ]
            ],
            'jumlah' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jumlah harus diisi',
                ]
            ],
            'tgl' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tanggal harus diisi',
                ]
            ],
        ])) {
            return redirect()->to('KasMasuk');
        }
        $this->KasModel->save([
            'kode_kas' => $kode_kas,
            'keterangan_kas' => $this->request->getVar('keterangan'),
            'tgl_kas' => $this->request->getVar('tgl'),
            'jumlah_kas' => 0,
            'jenis_kas' => 'keluar',
            'kas_keluar' => str_replace(".", "", $this->request->getVar('jumlah')),
            'nama_pengguna' => session()->get('nama_pengguna'),
        ]);
        $penginput = session()->get('nama_pengguna');
        $kas_lama = $this->request->getVar('kas_lama');
        $kas_baru = str_replace(".", "", $this->request->getVar('jumlah'));
        $riwayat = [
            'penginput' => $penginput,
            'keterangan' => " $penginput telah mengubah kas keluar dengan kode $kode_kas dari $kas_lama menjadi $kas_baru",
            'tanggal' => date('Y-m-d H:i:s'),
        ];
        $this->RiwayatModel->save($riwayat);
        session()->setFlashData('pesan', 'Data berhasil diubah');
        return redirect()->to('KasKeluar');
    }
    public function DeleteData($kode)
    {
        $data = [
            'kode_kas' => $kode,
        ];
        $this->KasModel->Delete($data);
        session()->setFlashData('pesan', 'Data berhasil dihapus');
        return redirect()->to('KasKeluar');
    }
}
