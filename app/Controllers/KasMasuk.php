<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KasModel;
use App\Models\RiwayatModel;

use \Hermawan\DataTables\DataTable;

class KasMasuk extends BaseController
{
    public function __construct()
    {
        $this->KasModel = new KasModel;
        $this->RiwayatModel = new RiwayatModel;
    }
    public function index()
    {
        $data = [
            'title' => 'Kas Masuk',
            'mkasmasuk' => 'active',
            'masterpembayaran' => 'active',
            'kas_masuk' => $this->KasModel->where('jenis_kas', 'masuk')->findAll(),
            'nomer_transaksi' => $this->KasModel->KodeKas(),
        ];
        return view('page/kas_masuk', $data);
    }
    public function DataKasMasuk()
    {
        if ($this->request->isAJAX()) {
            $KasMasuk = new KasModel();
            $KasMasuk->select('kode_kas,keterangan_kas,tgl_kas,nama_pengguna,jumlah_kas')
                ->where('jenis_kas', 'masuk');
            return DataTable::of($KasMasuk)
                ->addNumbering('no')
                ->add('aksi', function ($row) {
                    return '<button type="button" class="btn btn-info btn-sm btn-edit" data-target="#EditKasMasuk" data-kode="' . $row->kode_kas . '" data-keterangan="' . $row->keterangan_kas . '" data-tanggal= "' . $row->tgl_kas . '" data-jumlah="' . $row->jumlah_kas . '" data-toggle="modal"><i class="fas fa-edit"></i></button> <a href="/KasMasuk/DeleteData/' . $row->kode_kas . '" class="btn btn-danger btn-sm hapus"><i class="fas fa-trash"></i></a>';
                })
                ->edit('tgl_kas', function ($row) {
                    return '<span>' . tanggal($row->tgl_kas) . '<br> Penginput : ' . $row->nama_pengguna . '</span>';
                })
                ->toJson(true);
        }
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
            'kode_kas' => $this->request->getVar('kode'),
            'keterangan_kas' => $this->request->getVar('keterangan'),
            'tgl_kas' => $this->request->getVar('tgl'),
            'jumlah_kas' => str_replace(".", "", $this->request->getVar('jumlah')),
            'jenis_kas' => 'masuk',
            'kas_keluar' => 0,
            'nama_pengguna' => session()->get('nama_pengguna'),
        ]);
        session()->setFlashData('pesan', 'Data berhasil ditambahkan');
        return redirect()->to('KasMasuk');
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
            'jumlah_kas' => str_replace(".", "", $this->request->getVar('jumlah')),
            'jenis_kas' => 'masuk',
            'kas_keluar' => 0,
            'nama_pengguna' => session()->get('nama_pengguna'),
        ]);
        $penginput = session()->get('nama_pengguna');
        $kas_lama = $this->request->getVar('kas_lama');
        $kas_baru = str_replace(".", "", $this->request->getVar('jumlah'));
        $riwayat = [
            'penginput' => $penginput,
            'keterangan' => " $penginput telah mengubah kas masuk dengan kode $kode_kas dari $kas_lama menjadi $kas_baru",
            'tanggal' => date('Y-m-d H:i:s'),
        ];
        $this->RiwayatModel->save($riwayat);
        session()->setFlashData('pesan', 'Data berhasil diubah');
        return redirect()->to('KasMasuk');
    }
    public function DeleteData($kode)
    {
        $data = [
            'kode_kas' => $kode,
        ];
        $this->KasModel->Delete($data);
        session()->setFlashData('pesan', 'Data berhasil dihapus');
        return redirect()->to('KasMasuk');
    }
}
