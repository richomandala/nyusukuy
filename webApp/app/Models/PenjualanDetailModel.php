<?php

namespace App\Models;

use CodeIgniter\Model;

class PenjualanDetailModel extends Model
{
    protected $table = 'penjualan_detail';
    protected $allowedFields = [
        'penjualan_id',
        'produk_id',
        'jumlah'
    ];
}
