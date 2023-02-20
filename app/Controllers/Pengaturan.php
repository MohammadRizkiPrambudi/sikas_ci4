<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PengaturanModel;

class Pengaturan extends BaseController
{
    public function __construct()
    {
        $this->PengaturanModel = new PengaturanModel;
    }
    public function index()
    {
        $data = [
            'title' => 'Pengaturan Aplikasi',
            'mpengaturan' => 'active',
            'config' => $this->PengaturanModel->first(),
            'validasi' => \Config\Services::validation(),
        ];
        return view('page/pengaturan', $data);
    }
    public function UpdatePengaturan($id_organisasi)
    {
        if (!$this->validate([
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Organisasi harus diisi',
                ]
            ],
            'ketua' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Ketua Organisasi harus diisi',
                ]
            ],
            'alamat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Alamat Organisasi harus diisi',
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
            return redirect()->to('Pengaturan')->withInput();
        }
        $file = $this->request->getFile('foto');
        if ($file->getError() == 4) {
            $namafile = $this->request->getVar('fotolama');
        } else {
            $file->move('back-end/img/logo');
            $namafile = $file->getName();
            if ($this->request->getVar('fotolama')) {
                unlink('back-end/img/logo/' . $this->request->getVar('fotolama'));
            }
        }
        $data = [
            'id_pengaturan' => $id_organisasi,
            'nama_organisasi' => $this->request->getVar('nama'),
            'alamat_organisasi' => $this->request->getVar('alamat'),
            'ketua_organisasi' => $this->request->getVar('ketua'),
            'logo_organisasi' => $namafile
        ];
        $this->PengaturanModel->save($data);
        session()->setFlashData('pesan', 'Data berhasil diubah');
        return redirect()->to('Pengaturan');
    }
}
