<?php

namespace App\Models;

use CodeIgniter\Model;

class InventarisModel extends Model
{
    protected $table = 'inventaris';
    protected $useTimestamps = true;
    protected $allowedFields = [
        'kode_inventaris',
        'barang',
        'keterangan',
        'jumlah'
    ];

    public function getLast()
    {
        return $this->db->table($this->table)->select('kode_inventaris')->get()->getLastRow('array');
    }
}
