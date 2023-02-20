<?php

namespace App\Models;

use CodeIgniter\Model;

class KasModel extends Model
{
    protected $table            = 'kas';
    protected $primaryKey       = 'kode_kas';
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';
    protected $protectFields    = true;
    protected $allowedFields    = ['kode_kas', 'keterangan_kas', 'jumlah_kas', 'tgl_kas', 'jenis_kas', 'kas_keluar', 'nama_pengguna'];

    public function KodeKas()
    {
        $today = date('Ymd');
        $query =  $this->db->table('kas')->selectMax('kode_kas', 'kode_otomatis')->like('kode_kas', "$today", 'after')->get()->getRowArray();
        $noterakhir = $query['kode_otomatis'];
        $terakhirNoUrut = substr($noterakhir, 8, 2);
        $tambahNoUrut = $terakhirNoUrut + 1;
        $nextNoTransaksi = $today . sprintf('%02s', $tambahNoUrut);
        return $nextNoTransaksi;
    }
    public function GetAllKeterangan()
    {
        return $this->db->table('kas')->groupBY('keterangan_kas')->get()->getResultArray();
    }
    public function GetAllTanggal()
    {
        return $this->db->table('kas')->groupBY('tgl_kas')->get()->getResultArray();
    }
    public function GetAllNama()
    {
        return $this->db->table('kas')->groupBY('nama_pengguna')->get()->getResultArray();
    }
}
