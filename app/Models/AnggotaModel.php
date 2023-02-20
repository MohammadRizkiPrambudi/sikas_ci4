<?php

namespace App\Models;

use CodeIgniter\Model;

class AnggotaModel extends Model
{
    protected $table            = 'anggota';
    protected $primaryKey       = 'id_anggota';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $protectFields    = true;
    protected $allowedFields    = ['nama_anggota', 'jk_anggota', 'nowa_anggota', 'username_anggota', 'password_anggota', 'foto_anggota'];

    public function DetailData($id_anggota)
    {
        return $this->db->table('anggota')->where('id_anggota', $id_anggota)->get()->getRowArray();
    }
    public function AnggotaBaru()
    {
        $builder = $this->db->table('anggota');
        $query = $this->db->table('pembayaran_kas')->select('id_anggota');
        return $builder->whereNotIn('id_anggota', $query)->get()->getResultArray();
    }
}
