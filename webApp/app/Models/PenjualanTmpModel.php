<?php

namespace App\Models;

use CodeIgniter\Model;

class PenjualanTmpModel extends Model
{
    protected $table = 'penjualan_tmp';
    protected $primaryKey = 'produk_id';
    protected $allowedFields = [
        'produk_id',
        'jumlah',
        'user_id'
    ];

    public function getTmp($id)
    {
        return $this->db->table($this->table)
            ->select('*, (jumlah * harga) as total')
            ->join('produk', 'produk.id = penjualan_tmp.produk_id', 'left')
            ->having('user_id', $id)
            ->get()
            ->getResultArray();
    }

    public function getTotal($id)
    {
        return $this->db->table($this->table)
            ->select('user_id,SUM((jumlah * harga)) AS grand_total')
            ->join('produk', 'produk.id = penjualan_tmp.produk_id', 'left')
            ->where('user_id', $id)
            ->get()
            ->getRowArray();
    }

    public function deleteAll()
    {
        return $this->db->table($this->table)->emptyTable();
    }
}
