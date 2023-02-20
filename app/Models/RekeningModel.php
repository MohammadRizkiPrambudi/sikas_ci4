<?php

namespace App\Models;

use CodeIgniter\Model;

class RekeningModel extends Model
{
    protected $table            = 'rekening';
    protected $primaryKey       = 'id_rekening';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $protectFields    = true;
    protected $allowedFields    = ['nama_bank', 'nomor_rekening', 'atasnama'];
}
