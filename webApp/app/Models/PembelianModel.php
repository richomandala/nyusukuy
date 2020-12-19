<?php

namespace App\Models;

use CodeIgniter\Model;

class PembelianModel extends Model
{
    protected $table = 'pembelian';
    protected $useTimestamps = true;
    protected $allowedFields = [
        'kode_pembelian',
        'supplier_id',
        'keterangan'
    ];

    public function getPembelian($id = null)
    {
        if ($id) {
            return $this->db->table($this->table)->select()->join('supplier', 'supplier.id = pembelian.supplier_id', 'left')->having('pembelian_id', $id)->get()->getRowArray();
        }
        return $this->db->table($this->table)->select()->join('supplier', 'supplier.id = pembelian.supplier_id', 'left')->get()->getResultArray();
    }

    public function getLast()
    {
        return $this->db->table($this->table)->select('kode_pembelian')->get()->getLastRow('array');
    }
}
