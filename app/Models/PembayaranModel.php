<?php

namespace App\Models;

use CodeIgniter\Model;
use Kint\Zval\Value;

class PembayaranModel extends Model
{
    protected $table            = 'pembayaran_kas';
    protected $primaryKey       = 'id_pembayaran';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $protectFields    = true;
    protected $allowedFields    = ['id_bulan_pembayaran', 'id_anggota', 'minggu_ke_1', 'minggu_ke_2', 'minggu_ke_3', 'minggu_ke_4', 'status_lunas'];

    public function PembayaranKasPerAnggota($id_bulan_pembayaran)
    {
        return $this->db->table('anggota')
            ->join('pembayaran_kas', 'anggota.id_anggota = pembayaran_kas.id_anggota')
            ->join('bulan_pembayaran', 'bulan_pembayaran.id_bulan_pembayaran=pembayaran_kas.id_bulan_pembayaran')->where('pembayaran_kas.id_bulan_pembayaran', $id_bulan_pembayaran)->get()->getResultArray();
    }
    public function KasSebelum($id_bulan_pembayaran)
    {
        return $this->db->table('anggota')
            ->join('pembayaran_kas', 'anggota.id_anggota = pembayaran_kas.id_anggota', 'left')
            ->join('bulan_pembayaran', 'bulan_pembayaran.id_bulan_pembayaran=pembayaran_kas.id_bulan_pembayaran', 'left')->where('pembayaran_kas.id_bulan_pembayaran', $id_bulan_pembayaran)->get()->getResultArray();
    }
    public function TotalKasPerbulan($id_bulan_pembayaran)
    {
        return $this->db->table('pembayaran_kas')
            ->select('SUM(minggu_ke_1+ minggu_ke_2 + minggu_ke_3 + minggu_ke_4) as total_perbulan')
            ->where('id_bulan_pembayaran', $id_bulan_pembayaran)->get()->getRowArray();
    }
    public function TotalCetakKasPerbulan($bulan, $tahun)
    {
        return $this->db->table('pembayaran_kas')
            ->join('bulan_pembayaran', 'bulan_pembayaran.id_bulan_pembayaran = pembayaran_kas.id_bulan_pembayaran', 'left')->where('bulan_pembayaran.nama_bulan', $bulan)->where('bulan_pembayaran.tahun', $tahun)
            ->select('SUM(minggu_ke_1+ minggu_ke_2 + minggu_ke_3 + minggu_ke_4) as total_perbulan')->get()->getRowArray();
    }
    public function LaporanPembayaran($bulan, $tahun)
    {
        return $this->db->table('pembayaran_kas')
            ->join('bulan_pembayaran', 'bulan_pembayaran.id_bulan_pembayaran = pembayaran_kas.id_bulan_pembayaran', 'left')
            ->join('anggota', 'anggota.id_anggota=pembayaran_kas.id_anggota', 'left')->where('bulan_pembayaran.nama_bulan', $bulan)->where('bulan_pembayaran.tahun', $tahun)->get()->getResultArray();
    }
    public function HistoryPembayaran()
    {
        return $this->db->table('pembayaran_kas')
            ->join('anggota', 'anggota.id_anggota = pembayaran_kas.id_anggota', 'left')
            ->join('bulan_pembayaran', 'bulan_pembayaran.id_bulan_pembayaran=pembayaran_kas.id_bulan_pembayaran', 'left')
            ->select('nama_anggota')
            ->select('nama_bulan')
            ->select('tahun')
            ->select('minggu_ke_1')
            ->select('minggu_ke_2')
            ->select('minggu_ke_3')
            ->select('minggu_ke_4')
            ->select('pembayaran_mingguan')
            ->where('pembayaran_kas.id_anggota', session()->get('id_pengguna'))
            ->get()->getResultArray();
    }
}
