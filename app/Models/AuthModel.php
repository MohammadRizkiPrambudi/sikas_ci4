<?php

namespace App\Models;

use CodeIgniter\Model;

class AuthModel extends Model
{
    public function LoginPengguna($username)
    {
        return $this->db->table('pengguna')->where([
            'username_pengguna' => $username
        ])->get()->getRowArray();
    }
    public function LoginAnggota($username)
    {
        return $this->db->table('anggota')->where([
            'username_anggota' => $username
        ])->get()->getRowArray();
    }
}
