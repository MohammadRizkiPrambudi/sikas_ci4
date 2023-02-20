<?php

namespace App\Models;

use CodeIgniter\Model;

class BuktiPembayaranModel extends Model
{
    protected $table            = 'bukti_pembayaran';
    protected $primaryKey       = 'id_bukti_pembayaran';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $protectFields    = true;
    protected $allowedFields    = ['id_rekening', 'id_anggota', 'keterangan_pembayaran', 'foto_pembayaran', 'status_pembayaran'];

    public function AllData($id_anggota = NULL)
    {
        if ($id_anggota) {
            return $this->db->table('bukti_pembayaran')
                ->join('rekening', 'bukti_pembayaran.id_rekening = rekening.id_rekening', 'left')
                ->join('anggota', 'bukti_pembayaran.id_anggota = anggota.id_anggota', 'left')
                ->where('anggota.id_anggota', $id_anggota)
                ->get()->getResultArray();
        } else {
            return $this->db->table('bukti_pembayaran')
                ->join('rekening', 'bukti_pembayaran.id_rekening = rekening.id_rekening', 'left')
                ->join('anggota', 'bukti_pembayaran.id_anggota = anggota.id_anggota', 'left')
                ->get()->getResultArray();
        }
    }
    public function CekNotif()
    {
        return $this->db->table('bukti_pembayaran')
            ->join('rekening', 'bukti_pembayaran.id_rekening = rekening.id_rekening', 'left')
            ->join('anggota', 'bukti_pembayaran.id_anggota = anggota.id_anggota', 'left')
            ->where('status_pembayaran', 0)
            ->countAllResults();
    }
}
