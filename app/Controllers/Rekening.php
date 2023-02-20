<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\RekeningModel;

class Rekening extends BaseController
{
    public function __construct()
    {
        $this->RekeningModel = new RekeningModel;
    }
    public function index()
    {
        $data = [
            'title' => 'Rekening',
            'rekening' => $this->RekeningModel->findAll(),
            'master' => 'active',
            'mrekening' => 'active',
        ];
        return view('page/rekening', $data);
    }
    public function TambahRekening()
    {
        $data = [
            'title' => 'Tambah Rekening',
            'validasi' => \Config\Services::validation(),
            'master' => 'active',
            'mrekening' => 'active',
        ];
        return view('page/tambah_rekening', $data);
    }
    public function InsertData()
    {
        if (!$this->validate([
            'nama_bank' => [
                'rules' => 'required|is_unique[rekening.nama_bank]',
                'errors' => [
                    'required' => 'Nama Bank harus diisi',
                    'is_unique' => 'Nama Bank Sudah Ada'
                ]
            ],
            'nomor_rekening' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nomor Rekening harus diisi',
                ]
            ],
            'atasnama' => [
                'rules' => 'required|is_unique[rekening.atasnama]',
                'errors' => [
                    'required' => 'Atas Nama harus diisi',
                    'is_unique' => 'Atas Nama Berikut Sudah ada'
                ]
            ],
        ])) {
            return redirect()->to('Rekening/TambahRekening')->withInput();
        }
        $this->RekeningModel->save([
            'nama_bank' => $this->request->getVar('nama_bank'),
            'nomor_rekening' => $this->request->getVar('nomor_rekening'),
            'atasnama' => $this->request->getVar('atasnama'),
        ]);
        session()->setFlashData('pesan', 'Data berhasil ditambahkan');
        return redirect()->to('Rekening');
    }
    public function EditData($id_rekening)
    {
        $data = [
            'title' => 'Edit Rekening',
            'validasi' => \Config\Services::validation(),
            'rekening' => $this->RekeningModel->where('id_rekening', $id_rekening)->first(),
            'master' => 'active',
            'mrekening' => 'active',
        ];
        return view('page/edit_rekening', $data);
    }
    public function UpdateData($id_rekening)
    {
        if (!$this->validate([
            'nama_bank' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Bank harus diisi',
                ]
            ],
            'nomor_rekening' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nomor Rekening harus diisi',
                ]
            ],
            'atasnama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Atas Nama harus diisi',
                ]
            ],
        ])) {
            return redirect()->to('Rekening/EditData/' . $id_rekening)->withInput();
        }
        $this->RekeningModel->save([
            'id_rekening' => $id_rekening,
            'nama_bank' => $this->request->getVar('nama_bank'),
            'nomor_rekening' => $this->request->getVar('nomor_rekening'),
            'atasnama' => $this->request->getVar('atasnama'),
        ]);
        session()->setFlashData('pesan', 'Data berhasil diubah');
        return redirect()->to('Rekening');
    }
    public function DeleteData($id_rekening)
    {
        $data = [
            'id_rekening' => $id_rekening
        ];
        $this->RekeningModel->Delete($data);
        session()->setFlashdata('pesan', 'Data Berhasil Dihapus');
        return redirect()->to('Rekening');
    }
}
