<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PenggunaModel;

class Pengguna extends BaseController
{
    public function __construct()
    {
        $this->PenggunaModel = new PenggunaModel();
    }
    public function index()
    {
        $data = [
            'title' => 'Pengguna',
            'master' => 'active',
            'mpengguna' => 'active',
            'pengguna' => $this->PenggunaModel->findAll(),
        ];
        return view('page/pengguna', $data);
    }
    public function TambahPengguna()
    {
        $data = [
            'title' => 'Tambah Pengguna',
            'master' => 'active',
            'mpengguna' => 'active',
            'validasi' => \Config\Services::validation()
        ];
        return view('page/tambah_pengguna', $data);
    }
    public function InsertData()
    {
        if (!$this->validate([
            'nama_pengguna' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama harus diisi',
                ]
            ],
            'level_pengguna' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Silahkan pilih level pengguna',
                ]
            ],
            'username_pengguna' => [
                'rules' => 'required|is_unique[pengguna.username_pengguna]',
                'errors' => [
                    'required' => 'Username harus diisi',
                    'is_unique' => 'Username sudah ada'
                ]
            ],
            'password_pengguna' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Password harus diisi'
                ]
            ],
            'foto' => [
                'rules' => 'max_size[foto,1024]|is_image[foto]|mime_in[foto,image/jpg,image/png,image/jpeg]',
                'errors' => [
                    'max_size' => 'Foto tidak boleh lebih dari 1 MB',
                    'is_image' => 'Hanya boleh gambar',
                    'mime_in' => 'Hanya boleh gambar'
                ]
            ]
        ])) {
            return redirect()->to('Pengguna/TambahPengguna')->withInput();
        }
        $file = $this->request->getFile('foto');
        if ($file->getError() == 4) {
            $namafile = 'default.png';
        } else {
            $file->move('back-end/img/admin');
            $namafile = $file->getName();
        }
        $this->PenggunaModel->save([
            'nama_pengguna' => $this->request->getVar('nama_pengguna'),
            'level_pengguna' => $this->request->getVar('level_pengguna'),
            'username_pengguna' => $this->request->getVar('username_pengguna'),
            'password_pengguna' => sha1($this->request->getVar('password_pengguna')),
            'foto_pengguna' => $namafile
        ]);
        session()->setFlashData('pesan', 'Data berhasil ditambahkan');
        return redirect()->to('Pengguna');
    }
    public function EditData($id_pengguna)
    {
        $data = [
            'title' => 'Edit Pengguna',
            'pengguna' => $this->PenggunaModel->where('id_pengguna', $id_pengguna)->first(),
            'validasi' => \Config\Services::validation(),
            'master' => 'active',
            'mpengguna' => 'active'
        ];
        return view('page/edit_pengguna', $data);
    }
    public function UpdateData($id_pengguna)
    {
        if (!$this->validate([
            'nama_pengguna' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama harus diisi',
                ]
            ],
            'level_pengguna' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Silahkan pilih level pengguna',
                ]
            ],
            'username_pengguna' => [
                'rules' => 'required|is_unique[pengguna.username_pengguna, id_pengguna, ' . $id_pengguna . ']',
                'errors' => [
                    'required' => 'Username harus diisi',
                    'is_unique' => 'Username sudah ada'
                ]
            ],
            'foto' => [
                'rules' => 'max_size[foto,1024]|is_image[foto]|mime_in[foto,image/jpg,image/png,image/jpeg]',
                'errors' => [
                    'max_size' => 'Foto tidak boleh lebih dari 1 MB',
                    'is_image' => 'Hanya boleh gambar',
                    'mime_in' => 'Hanya boleh gambar'
                ]
            ]
        ])) {
            return redirect()->to('Pengguna/EditData/' . $id_pengguna)->withInput();
        }
        $file = $this->request->getFile('foto');
        if ($file->getError() == 4) {
            $namafile = $this->request->getVar('fotolama');
        } else {
            $file->move('back-end/img/admin');
            $namafile = $file->getName();
            if ($this->request->getVar('fotolama') != 'default.png') {
                unlink('back-end/img/admin/' . $this->request->getVar('fotolama'));
            }
        }
        $data = [
            'id_pengguna' => $id_pengguna,
            'nama_pengguna' => $this->request->getVar('nama_pengguna'),
            'level_pengguna' => $this->request->getVar('level_pengguna'),
            'username_pengguna' => $this->request->getVar('username_pengguna'),
            'foto_pengguna' => $namafile
        ];
        $cekpassword = $this->request->getVar('password_pengguna');
        if ($cekpassword != '' or $cekpassword != NULL) {
            $data['password_pengguna']    = sha1($this->request->getVar('password_pengguna'));
        }
        $this->PenggunaModel->save($data);
        session()->setFlashData('pesan', 'Data berhasil diubah');
        return redirect()->to('Pengguna');
    }
    public function DeleteData($id_pengguna)
    {
        $data = [
            'id_pengguna' => $id_pengguna
        ];
        $pengguna = $this->PenggunaModel->where('id_pengguna', $id_pengguna)->first();
        if ($pengguna['foto_pengguna'] != 'default.png') {
            unlink('back-end/img/admin/' . $pengguna['foto_pengguna']);
        }
        $this->PenggunaModel->Delete($data);
        session()->setFlashdata('pesan', 'Data Berhasil Dihapus');
        return redirect()->to('Pengguna');
    }
}
