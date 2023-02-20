<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AuthModel;
use App\Models\PengaturanModel;

class Auth extends BaseController
{
    public function __construct()
    {
        $this->AuthModel = new AuthModel;
        $this->PengaturanModel = new PengaturanModel;
    }
    public function index()
    {
        $data = [
            'title' => 'Login',
            'validasi' => \Config\Services::validation(),
            'pengaturan' => $this->PengaturanModel->first(),
        ];
        return view('auth/index', $data);
    }
    public function Login()
    {
        if ($this->validate(
            [
                'username' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Username tidak boleh kosong'
                    ]
                ],
                'password' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Password harus diisi'
                    ]
                ]
            ]
        )) {
            // jika valid
            $username = $this->request->getVar('username');
            $password = sha1($this->request->getVar('password'));
            $cekpengguna = $this->AuthModel->LoginPengguna($username);
            $cekanggota = $this->AuthModel->LoginAnggota($username);

            if ($cekpengguna) {
                if ($cekpengguna["password_pengguna"] == $password) {
                    session()->set('login', true);
                    session()->set('id_pengguna', $cekpengguna['id_pengguna']);
                    session()->set('nama_pengguna', $cekpengguna['nama_pengguna']);
                    session()->set('username_pengguna', $cekpengguna['username_pengguna']);
                    session()->set('level_pengguna', $cekpengguna['level_pengguna']);
                    session()->set('foto_pengguna', $cekpengguna['foto_pengguna']);
                    return redirect()->to(base_url('Home'));
                } else {
                    session()->setFlashdata('error', 'Password anda salah');
                    return redirect()->to(base_url('Auth'))->withInput();
                }
            } elseif ($cekanggota) {
                if ($cekanggota["password_anggota"] == $password) {
                    session()->set('login', true);
                    session()->set('id_pengguna', $cekanggota['id_anggota']);
                    session()->set('nama_pengguna', $cekanggota['nama_anggota']);
                    session()->set('username_pengguna', $cekanggota['username_anggota']);
                    session()->set('level_pengguna', 'anggota');
                    session()->set('foto_pengguna', $cekanggota['foto_anggota']);
                    return redirect()->to(base_url('Home'));
                } else {
                    session()->setFlashdata('error', 'Password anda salah');
                    return redirect()->to(base_url('Auth'))->withInput();
                }
            } else {
                session()->setFlashdata('error', 'Username anda salah');
                return redirect()->to(base_url('Auth'))->withInput();
            }
        } else {
            return redirect()->to(base_url('Auth'))->withInput();
        }
    }
    public function Logout()
    {
        session()->remove('login');
        session()->remove('id_pengguna');
        session()->remove('nama_pengguna');
        session()->remove('username_pengguna');
        session()->remove('level_pengguna');
        session()->remove('foto_pengguna');
        session()->setFlashdata('pesan', 'Anda berhasil logout');
        return redirect()->to('Auth');
    }
}
