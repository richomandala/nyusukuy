<?php

namespace App\Models;

use CodeIgniter\Model;

class PembelianTmpModel extends Model
{
    protected $table = 'pembelian_tmp';
    protected $primaryKey = 'bahan_id';
    protected $allowedFields = [
        'bahan_id',
        'jumlah',
        'harga',
        'user_id'
    ];

    public function getTmp($id)
    {
        return $this->db->table($this->table)
            ->select()
            ->join('bahan', 'bahan.id = ' . $this->table . '.bahan_id', 'LEFT')
            ->having('user_id', $id)
            ->get()
            ->getResultArray();
    }

    public function deleteAll()
    {
        return $this->db->table($this->table)->emptyTable();
    }
}
