<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AnggotaModel;
use App\Models\PembayaranModel;

class Anggota extends BaseController
{
    public function __construct()
    {
        $this->AnggotaModel = new AnggotaModel;
        $this->PembayaranModel = new PembayaranModel;
    }
    public function index()
    {
        $data = [
            'title' => 'Anggota',
            'anggota' => $this->AnggotaModel->findAll(),
            'master' => 'active',
            'manggota' => 'active'
        ];
        return view('page/anggota', $data);
    }
    public function TambahAnggota()
    {
        $data = [
            'title' => 'Tambah Anggota',
            'validasi' => \Config\Services::validation(),
            'master' => 'active',
            'manggota' => 'active'
        ];
        return view('page/tambah_anggota', $data);
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
            'jk_anggota' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Silahkan pilih jenis kelamin',
                ]
            ],
            'nowa_anggota' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'No HP harus diisi'
                ]
            ],
            'username_anggota' => [
                'rules' => 'required|is_unique[anggota.username_anggota]',
                'errors' => [
                    'required' => 'Username harus diisi',
                    'is_unique' => 'Username sudah ada'
                ]
            ],
            'password_anggota' => [
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
            return redirect()->to('Anggota/TambahAnggota')->withInput();
        }
        $file = $this->request->getFile('foto');
        if ($file->getError() == 4) {
            $namafile = 'default.png';
        } else {
            $file->move('back-end/img/anggota');
            $namafile = $file->getName();
        }
        $this->AnggotaModel->save([
            'nama_anggota' => $this->request->getVar('nama_anggota'),
            'jk_anggota' => $this->request->getVar('jk_anggota'),
            'nowa_anggota' => $this->request->getVar('nowa_anggota'),
            'username_anggota' => $this->request->getVar('username_anggota'),
            'password_anggota' => sha1($this->request->getVar('password_anggota')),
            'foto_anggota' => $namafile
        ]);
        session()->setFlashData('pesan', 'Data berhasil ditambahkan');
        return redirect()->to('Anggota');
    }
    public function EditData($id_anggota)
    {
        $data = [
            'title' => 'Edit Anggota',
            'anggota' => $this->AnggotaModel->DetailData($id_anggota),
            'validasi' => \Config\Services::validation(),
            'master' => 'active',
            'manggota' => 'active'
        ];
        return view('page/edit_anggota', $data);
    }
    public function UpdateData($id_anggota)
    {
        if (!$this->validate([
            'nama_anggota' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama harus diisi',
                ]
            ],
            'jk_anggota' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Silahkan pilih jenis kelamin',
                ]
            ],
            'nowa_anggota' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'No HP harus diisi'
                ]
            ],
            'username_anggota' => [
                'rules' => 'required|is_unique[anggota.username_anggota, id_anggota, ' . $id_anggota . ']',
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
            return redirect()->to('Anggota/EditData/' . $id_anggota)->withInput();
        }
        $file = $this->request->getFile('foto');
        if ($file->getError() == 4) {
            $namafile = $this->request->getVar('fotolama');
        } else {
            $file->move('back-end/img/anggota');
            $namafile = $file->getName();
            if ($this->request->getVar('fotolama') != 'default.png') {
                unlink('back-end/img/anggota/' . $this->request->getVar('fotolama'));
            }
        }
        $data = [
            'id_anggota' => $id_anggota,
            'nama_anggota' => $this->request->getVar('nama_anggota'),
            'jk_anggota' => $this->request->getVar('jk_anggota'),
            'nowa_anggota' => $this->request->getVar('nowa_anggota'),
            'username_anggota' => $this->request->getVar('username_anggota'),
            'foto_anggota' => $namafile
        ];
        $cekpassword = $this->request->getVar('password_anggota');
        if ($cekpassword != '' or $cekpassword != NULL) {
            $data['password_anggota']    = sha1($this->request->getVar('password'));
        }
        $this->AnggotaModel->save($data);
        session()->setFlashData('pesan', 'Data berhasil ditambahkan');
        return redirect()->to('Anggota');
    }
    public function DeleteData($id_anggota)
    {
        $data = [
            'id_anggota' => $id_anggota
        ];
        $anggota = $this->AnggotaModel->DetailData($id_anggota);
        if ($anggota['foto_anggota'] != 'default.png') {
            unlink('back-end/img/anggota/' . $anggota['foto_anggota']);
        }
        $this->AnggotaModel->Delete($data);
        session()->setFlashdata('pesan', 'Data Berhasil Dihapus');
        return redirect()->to('Anggota');
    }
    public function MasukkanAnggota()
    {
        $data = [
            'id_anggota' => $this->request->getVar('id_anggota'),
            'id_bulan_pembayaran' => $this->request->getVar('id_bulan_pembayaran'),
        ];
        $id_bulan_pembayaran = $this->request->getVar('id_bulan_pembayaran');
        $this->PembayaranModel->save($data);
        session()->setFlashdata('pesan', 'Anggota berhasil ditambahkan');
        return redirect()->to('Pembayaran/DetailPembayaranBulan/' . $id_bulan_pembayaran);
    }
}
