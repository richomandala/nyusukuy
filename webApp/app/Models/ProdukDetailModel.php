<?php

namespace App\Models;

use CodeIgniter\Model;

class ProdukDetailModel extends Model
{
    protected $table = 'produk_detail';
    protected $useTimestamps = true;
    protected $allowedFields = [
        'produk_id',
        'bahan_id',
        'jumlah'
    ];

    public function getDetail($id)
    {
        return $this->db->table($this->table)->select()->join('bahan', 'bahan.id = ' . $this->table . '.bahan_id')->having('produk_id', $id)->get()->getResultArray();
    }

    public function deleteAndSave($id, $data)
    {
        if ($this->db->table($this->table)->where('produk_id', $id)->countAll()) {
            $this->db->table($this->table)->delete(['produk_id' => $id]);
        }
        if ($this->insertBatch($data)) {
            return true;
        } else {
            return false;
        }
    }
}
