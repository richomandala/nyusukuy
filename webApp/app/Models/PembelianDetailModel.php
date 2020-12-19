<?php

namespace App\Models;

use CodeIgniter\Model;

class PembelianDetailModel extends Model
{
    protected $table = 'pembelian_detail';
    protected $allowedFields = [
        'pembelian_id',
        'bahan_id',
        'jumlah',
        'harga'
    ];

    public function deleteAndSave($id, $data)
    {
        if ($this->db->table($this->table)->where('pembelian_id', $id)->countAll()) {
            $this->db->table($this->table)->delete(['pembelian_id' => $id]);
        }
        if ($this->insertBatch($data)) {
            return true;
        } else {
            return false;
        }
    }
}
