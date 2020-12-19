<?php

namespace App\Models;

use CodeIgniter\Model;

class ProdukTmpModel extends Model
{
    protected $table = 'produk_tmp';
    protected $primaryKey = 'bahan_id';
    protected $allowedFields = [
        'bahan_id',
        'jumlah',
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
