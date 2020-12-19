<?php

namespace App\Controllers;

use App\Models\BahanModel;
use \App\Models\PenjualanModel;
use \App\Models\PenjualanDetailModel;
use \App\Models\PenjualanTmpModel;
use App\Models\ProdukModel;
use App\Models\ProdukDetailModel;

class Penjualan extends BaseController
{

    public function __construct()
    {
        helper('user');
        if (!in_array(getUser()['role_id'], [1, 2])) {
            echo view('errors/html/error_403');
            exit;
        }
    }

    public function index()
    {
        $model = new PenjualanModel();
        $data = [
            'title' => 'Penjualan',
            'menu' => 'penjualan',
            'breadcumb' => [
                '<i class="fas fa-shopping-cart"></i> Transaksi',
                'Penjualan'
            ],
            'customJS' => [
                'pagePenjualan.js'
            ],
            'penjualan' => $model->getPembelian()
        ];
        return view('penjualan/index', $data);
    }

    public function tambah()
    {
        $model = new ProdukModel();
        $data = [
            'title' => 'Tambah Penjualan',
            'menu' => 'penjualan',
            'breadcumb' => [
                '<i class="fas fa-shopping-cart"></i> Transaksi',
                '<a href="/penjualan/">Penjualan</a>',
                'Tambah'
            ],
            'customJS' => [
                'pagePenjualan.js'
            ],
            'produk' => $model->findAll()
        ];
        return view('penjualan/tambah', $data);
    }

    public function tmp()
    {
        $model = new PenjualanTmpModel();
        echo json_encode($model->getTmp(getUser()['id']));
    }

    public function savetmp()
    {
        // Initialization
        $model = new PenjualanTmpModel();
        $produk_id = $this->request->getPost('id');
        $data['produk_id'] = $produk_id;
        $data['user_id'] = getUser()['id'];
        // End initialization

        // Process
        // Find produk if exist will update jumlah else will produce jumlah is 1
        if ($find = $model->find($produk_id)) {
            if ($this->request->getPost('jumlah')) {
                $data['jumlah'] = $this->request->getPost('jumlah');
            } elseif ($this->request->getPost('jumlah') < 1) {
                $data['jumlah'] = $find['jumlah'];
            } else {
                $data['jumlah'] = $find['jumlah'] + 1;
            }
            if ($model->save($data)) {
                $output = true;
            } else {
                $output = false;
            }
        } else {
            $data['jumlah'] = 1;
            $model->insert($data);
            $output = true;
        }
        // End find
        // End Process

        // Output
        echo json_encode($output);
    }

    public function deletetmp()
    {
        $tmp = new PenjualanTmpModel();
        $produk_id = $this->request->getPost('id');
        if ($tmp->delete($produk_id)) {
            echo json_encode(true);
        } else {
            echo json_encode(false);
        }
    }

    public function save()
    {
        // Initialization
        $model = new PenjualanModel();
        $modelPenjualanDetail = new PenjualanDetailModel();
        $modelPenjualanTmp = new PenjualanTmpModel();
        $modelProduk = new ProdukModel();
        $modelProdukDetail = new ProdukDetailModel();
        $modelBahan = new BahanModel();
        $error = 0;
        // End initialization

        // Checking
        $pembeli = $this->request->getPost('pembeli');
        if (!trim($pembeli)) {
            $error++;
            $msg[] = 'Nama pembeli wajib diisi';
        } else {
            if (strlen($pembeli) > 255) {
                $error++;
                $msg[] = 'Nama pembeli terlalu panjang. Maks 255 karakter';
            }
        }
        $produk_id = $this->request->getPost('produk_id');
        if (!$produk_id) {
            $error++;
            $msg[] = 'Harus ada produk yang ditambahkan';
        } else {
            foreach ($produk_id as $i => $pi) {
                if ($this->request->getPost('jumlah')[$i] < 1) {
                    $error++;
                    $msg[] = 'Jumlah produk tidak boleh ada yg kosong';
                } else {
                    $produk = $modelProdukDetail->getDetail($pi);
                    foreach ($produk as $p) {
                        $jumlah = $this->request->getPost('jumlah')[$i];
                        if (($jumlah * $p['jumlah']) > $p['stok']) {
                            $error++;
                            $msg[] = 'Stok ' . $p['bahan'] . ' kurang';
                        } else {
                            if (isset($updateStok[$p['bahan_id']])) {
                                $updateStok[$p['bahan_id']] += ($jumlah * $p['jumlah']);
                            } else {
                                $updateStok[$p['bahan_id']] = ($jumlah * $p['jumlah']);
                            }
                        }
                    }
                    $totalHarga[] = $modelProduk->find($pi)['harga'] * $jumlah;
                }
            }
            $total = array_sum($totalHarga);
            $bayar = $this->request->getPost('bayar');
            if ($total > $bayar) {
                $error++;
                $msg[] = 'Uang tidak mencukupi';
            }
        }

        // Process
        if ($error == 0) {
            // Proceed
            // Save penjualan
            $dataPenjualan = [
                'kode_penjualan' => ($model->getLast()) ? 'PJ-' . sprintf('%04d', explode('-', $model->getLast()['kode_penjualan'])[1] + 1) : 'PJ-0001',
                'pembeli' => $pembeli,
                'total' => $total,
                'bayar' => $bayar,
                'kembali' => ($bayar - $total)
            ];
            $model->save($dataPenjualan);
            if ($id = $model->getInsertID()) {
                // Save penjualan detail
                foreach ($produk_id as $i => $pi) {
                    $modelPenjualanDetail->insert([
                        'penjualan_id' => $id,
                        'produk_id' => $pi,
                        'jumlah' => $this->request->getPost('jumlah')[$i]
                    ]);
                }
                // Update stok
                foreach ($updateStok as $i => $us) {
                    $stok = $modelBahan->find($i)['stok'];
                    $modelBahan->update($i, ['stok' => ($stok - $us)]);
                }
                // Delete tmp
                $modelPenjualanTmp->deleteAll();
                $msg[] = 'Berhasil menambahkan data';
            } else {
                $error++;
                $msg[] = 'Gagal menambahkan data';
            }
            // End proceed
        }
        // End process

        // Output
        echo json_encode(['error' => $error, 'msg' => $msg]);
    }

    //--------------------------------------------------------------------

}
