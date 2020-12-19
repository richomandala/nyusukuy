<?php

namespace App\Models;

use CodeIgniter\Model;

class ProdukModel extends Model
{
    protected $table = 'produk';
    protected $useTimestamps = true;
    protected $allowedFields = [
        'kode_produk',
        'produk',
        'harga'
    ];

    public function getProduk()
    {
        return $this->db->table($this->table)
            ->select('produk.id, kode_produk, produk, harga')
            ->select('GROUP_CONCAT(jumlah) as jumlah_jumlah')
            ->select('GROUP_CONCAT(satuan) as satuan_satuan')
            ->select('GROUP_CONCAT(bahan) as bahan_bahan')
            ->join('produk_detail', 'produk_detail.produk_id = produk.id', 'LEFT')
            ->join('bahan', 'produk_detail.bahan_id = bahan.id', 'LEFT')
            ->groupBy('produk.id')
            ->get()
            ->getResultArray();
    }

    public function getLast()
    {
        return $this->db->table($this->table)->select('kode_produk')->get()->getLastRow('array');
    }
}
