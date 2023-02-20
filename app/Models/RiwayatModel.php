<?php

namespace App\Models;

use CodeIgniter\Model;

class RiwayatModel extends Model
{
    protected $table            = 'riwayat_pembayaran';
    protected $primaryKey       = 'id_riwayat_pembayaran';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $protectFields    = true;
    protected $allowedFields    = ['id_pembayaran', 'penginput', 'keterangan', 'tanggal'];
}
