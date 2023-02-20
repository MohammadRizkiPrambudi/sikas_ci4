<?php

namespace App\Models;

use CodeIgniter\Model;

class HomeModel extends Model
{
    public function totanggota()
    {
        return $this->db->table('anggota')->countAll();
    }
    public function totpengguna()
    {
        return $this->db->table('pengguna')->countAll();
    }

    public function totkasmasukhariini()
    {
        return $this->db->table('kas')
            ->select('SUM(jumlah_kas) as totkasmasukhariini')
            ->where('DATE(tgl_kas)', date('Y-m-d'))
            ->get()->getRowArray();
    }

    public function totkasmasukbulanini()
    {
        return $this->db->table('kas')
            ->select('SUM(jumlah_kas) as totkasmasukbulanini')
            ->where('MONTH(tgl_kas)', date('m'))
            ->get()->getRowArray();
    }
    public function totkasmasukkeseluruhan()
    {
        return $this->db->table('kas')
            ->select('SUM(jumlah_kas) as totkasmasukkeseluruhan')
            ->get()->getRowArray();
    }
    public function totkaskeluarhariini()
    {
        return $this->db->table('kas')
            ->select('SUM(kas_keluar) as totkaskeluarhariini')
            ->where('DATE(tgl_kas)', date('Y-m-d'))
            ->get()->getRowArray();
    }

    public function totkaskeluarbulanini()
    {
        return $this->db->table('kas')
            ->select('SUM(kas_keluar) as totkaskeluarbulanini')
            ->where('MONTH(tgl_kas)', date('m'))
            ->get()->getRowArray();
    }
    public function totkaskeluarkeseluruhan()
    {
        return $this->db->table('kas')
            ->select('SUM(kas_keluar) as totkaskeluarkeseluruhan')
            ->get()->getRowArray();
    }
    public function totkaspembayaranbulanini()
    {

        $bulan = bulan((int)date('m'));
        return $this->db->table('pembayaran_kas')
            ->join('bulan_pembayaran', 'bulan_pembayaran.id_bulan_pembayaran = pembayaran_kas.id_bulan_pembayaran')
            ->select('SUM(minggu_ke_1 +minggu_ke_2 +minggu_ke_3 +minggu_ke_4 ) as totkaspembayaranbulanini')
            ->where('nama_bulan', $bulan)
            ->get()->getRowArray();
    }

    public function totkaspembayarankeseluruhan()
    {
        return $this->db->table('pembayaran_kas')
            ->select('SUM(minggu_ke_1 +minggu_ke_2 +minggu_ke_3 +minggu_ke_4 ) as totkaspembayarankeseluruhan')
            ->get()->getRowArray();
    }
    public function ChartKasMasuk()
    {
        return $this->db->table('kas')
            ->select('MONTH(tgl_kas) as bulan')
            ->select('SUM(jumlah_kas) as kasmasuk')
            ->where('YEAR(tgl_kas)', date('Y'))
            ->groupBy('MONTH(tgl_kas)')
            ->get()->getResultArray();
    }
    public function ChartKasKeluar()
    {
        return $this->db->table('kas')
            ->select('MONTH(tgl_kas) as bulan')
            ->select('SUM(kas_keluar) as kaskeluar')
            ->where('YEAR(tgl_kas)', date('Y'))
            ->groupBy('MONTH(tgl_kas)')
            ->get()->getResultArray();
    }
    public function ChartPembayaranKas()
    {
        return $this->db->table('pembayaran_kas')
            ->select('nama_bulan')
            ->select('SUM(minggu_ke_1+minggu_ke_2+minggu_ke_3+minggu_ke_4) as jumlah_pembayaran')
            ->join('bulan_pembayaran', 'pembayaran_kas.id_bulan_pembayaran = bulan_pembayaran.id_bulan_pembayaran')
            ->where('tahun', date('Y'))
            ->groupBy('nama_bulan')
            ->orderBy('bulan_pembayaran.id_bulan_pembayaran', 'ASC')
            ->get()->getResultArray();
    }
}
