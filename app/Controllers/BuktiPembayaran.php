<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AnggotaModel;
use App\Models\BuktiPembayaranModel;
use App\Models\RekeningModel;

class BuktiPembayaran extends BaseController
{
    public function __construct()
    {
        $this->BuktiPembayaranModel = new BuktiPembayaranModel;
        $this->AnggotaModel = new AnggotaModel;
        $this->RekeningModel = new RekeningModel;
    }
    public function index()
    {
        $data = [
            'title' => 'Bukti Pembayaran Kas',
            'mbuktibayar' => 'active',
            'bukti_pembayaran' => $this->BuktiPembayaranModel->AllData(),
            'cek_status' => $this->BuktiPembayaranModel->CekNotif(),
        ];
        return view('page/bukti_pembayaran', $data);
    }
    public function Konfirmasi($id_bukti_pembayaran)
    {
        $data = [
            'id_bukti_pembayaran' => $id_bukti_pembayaran,
            'status_pembayaran' => 1
        ];
        $this->BuktiPembayaranModel->save($data);
        session()->setFlashData('pesan', 'Pembayaran Berhasil Terkonfirmasi');
        return redirect()->to('BuktiPembayaran');
    }
    public function Gagal($id_bukti_pembayaran)
    {
        $data = [
            'id_bukti_pembayaran' => $id_bukti_pembayaran,
            'status_pembayaran' => 2
        ];
        $this->BuktiPembayaranModel->save($data);
        session()->setFlashData('pesan', 'Pembayaran Berhasil Gagal Terkonfirmasi');
        return redirect()->to('BuktiPembayaran');
    }
    public function UploadBuktiPembayaran()
    {
        $data = [
            'title' => 'Pembayaran Transfer',
            'muppembayaran' => 'active',
            'rekening' => $this->RekeningModel->findAll(),
            'anggota' => $this->AnggotaModel->where('id_anggota', session()->get('id_pengguna'))->first(),
            'validasi' => \Config\Services::validation(),
        ];
        return view('page/upload_bukti', $data);
    }
    public function InsertData()
    {
        if (!$this->validate([
            'nama_anggota' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama harus diisi',
                ]
            ],
            'nama_bank' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Silahkan pilih bank',
                ]
            ],
            'keterangan_pembayaran' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Keterangan harus diisi'
                ]
            ],
            'foto' => [
                'rules' => 'uploaded[foto]|max_size[foto,1024]|is_image[foto]|mime_in[foto,image/jpg,image/png,image/jpeg]',
                'errors' => [
                    'uploaded' => 'Foto harus diisi',
                    'max_size' => 'Foto tidak boleh lebih dari 1 MB',
                    'is_image' => 'Hanya boleh gambar',
                    'mime_in' => 'Hanya boleh gambar'
                ]
            ]
        ])) {
            return redirect()->to('BuktiPembayaran/UploadBuktiPembayaran')->withInput();
        }
        $file = $this->request->getFile('foto');
        if ($file) {
            $file->move('back-end/img/transfer');
            $namafile = $file->getName();
        }
        $this->BuktiPembayaranModel->save([
            'id_anggota' => $this->request->getVar('id_anggota'),
            'id_rekening' => $this->request->getVar('nama_bank'),
            'keterangan_pembayaran' => $this->request->getVar('keterangan_pembayaran'),
            'foto_pembayaran' => $namafile,
            'status_pembayaran' => 0,
        ]);
        session()->setFlashData('pesan', 'Data berhasil disimpan');
        return redirect()->to('BuktiPembayaran/UploadBuktiPembayaran');
    }
    public function HistoryBuktiPembayaran()
    {
        $id_anggota = session()->get('id_pengguna');
        $data = [
            'title' => 'Bukti Pembayaran Kas',
            'mbuktibayar' => 'active',
            'cek_status' => $this->BuktiPembayaranModel->CekNotif(),
            'bukti_pembayaran' => $this->BuktiPembayaranModel->AllData($id_anggota),
        ];
        return view('page/bukti_pembayaran', $data);
    }
}
