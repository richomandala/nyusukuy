<?php

namespace App\Models;

use CodeIgniter\Model;

class PenjualanModel extends Model
{
    protected $table = 'penjualan';
    protected $useTimestamps = true;
    protected $allowedFields = [
        'kode_penjualan',
        'pembeli',
        'total',
        'bayar',
        'kembali'
    ];

    public function getPembelian($id = null)
    {
        $query = $this->db->table($this->table)
            ->select('penjualan.id,kode_penjualan,pembeli,total,bayar,kembali')
            ->select('GROUP_CONCAT(jumlah) as jumlah_jumlah')
            ->select('GROUP_CONCAT(produk) as produk_produk')
            ->select('GROUP_CONCAT(harga) as harga_harga')
            ->select('GROUP_CONCAT(total) as total_total')
            ->join('penjualan_detail', 'penjualan_detail.penjualan_id = ' . $this->table . '.id', 'left')
            ->join('produk', 'produk.id = penjualan_detail.produk_id', 'left')
            ->groupBy('penjualan.id');
        if ($id) {
            return $query->having('id', $id)->get()->getRowArray();
        } else {
            return $query->get()->getResultArray();
        }
    }

    public function getLast()
    {
        return $this->db->table($this->table)->select('kode_penjualan')->get()->getLastRow('array');
    }
}
