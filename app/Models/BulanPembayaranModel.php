<?php

namespace App\Models;

use CodeIgniter\Model;

class BulanPembayaranModel extends Model
{
    protected $table            = 'bulan_pembayaran';
    protected $primaryKey       = 'id_bulan_pembayaran';
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';
    protected $protectFields    = true;
    protected $allowedFields    = ['id_bulan_pembayaran', 'nama_bulan', 'tahun', 'pembayaran_mingguan'];

    public function ValidasiBulan($bulan, $tahun)
    {
        return $this->db->table('bulan_pembayaran')->where('nama_bulan', $bulan)->where('tahun', $tahun)->get()->getRowArray();
    }
    public function DetailBulanPembayaran($id_bulan_pembayaran)
    {
        return $this->db->table('bulan_pembayaran')->where('id_bulan_pembayaran', $id_bulan_pembayaran)->get()->getRowArray();
    }
    public function BulanPembayaranPertama()
    {
        return $this->db->table('bulan_pembayaran')->orderBy('id_bulan_pembayaran', 'ASC')->limit(1)->get()->getRowArray();
    }
    public function KodeBulan()
    {
        $query =  $this->db->table('bulan_pembayaran')->selectMax('id_bulan_pembayaran', 'kode')->get();
        if (count($query->getResultArray()) > 0) {
            foreach ($query->getResult() as $key) {
                $kd = '';
                $ambildata = substr($key->kode, 0);
                $increment = intval($ambildata) + 1;
                $kd = sprintf('%01s', $increment);
            }
        } else {
            $kd = 1;
        }
        return $kd;
    }
}
