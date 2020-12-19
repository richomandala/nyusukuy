<?php

namespace App\Models;

use CodeIgniter\Model;

class BahanModel extends Model
{
    protected $table = 'bahan';
    protected $useTimestamps = true;
    protected $allowedFields = [
        'kode_bahan',
        'bahan',
        'stok',
        'satuan'
    ];

    public function getLast()
    {
        return $this->db->table($this->table)->select('kode_bahan')->get()->getLastRow('array');
    }
}
