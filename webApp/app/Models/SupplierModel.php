<?php

namespace App\Models;

use CodeIgniter\Model;

class SupplierModel extends Model
{
    protected $table = 'supplier';
    protected $useTimestamps = true;
    protected $allowedFields = [
        'kode_supplier',
        'supplier',
        'email',
        'telp',
        'alamat'
    ];

    public function getLast()
    {
        return $this->db->table($this->table)->select('kode_supplier')->get()->getLastRow('array');
    }
}
