<?php

namespace App\Controllers;

use App\Models\BahanModel;
use \App\Models\PembelianModel;
use \App\Models\PembelianDetailModel;
use App\Models\PembelianTmpModel;
use App\Models\SupplierModel;

class Pembelian extends BaseController
{

    public function __construct()
    {
        helper('user');
        if (!in_array(getUser()['role_id'], [1])) {
            echo view('errors/html/error_403');
            exit;
        }
    }

    public function index()
    {
        $model = new PembelianModel();
        $data = [
            'title' => 'Pembelian',
            'menu' => 'pembelian',
            'breadcumb' => [
                '<i class="fas fa-shopping-cart"></i> Transaksi',
                'Pembelian'
            ],
            'customJS' => [
                'pagePembelian.js'
            ],
            'pembelian' => $model->getPembelian()
        ];
        return view('pembelian/index', $data);
    }

    public function tambah()
    {
        $modelSupplier = new SupplierModel();
        $modelBahan = new BahanModel();
        $modelPembelianTmp = new PembelianTmpModel();
        $modelPembelianTmp->deleteAll();

        $data = [
            'title' => 'Tambah pembelian',
            'menu' => 'pembelian',
            'breadcumb' => [
                '<i class="fas fa-shopping-cart"></i> Transaksi',
                '<a href="/pembelian">Pembelian</a>',
                'Tambah'
            ],
            'customJS' => [
                'pagePembelian.js'
            ],
            'supplier' => $modelSupplier->findAll(),
            'bahan' => $modelBahan->findAll()
        ];
        return view('pembelian/tambah', $data);
    }

    public function ubah($id)
    {
        // Initialization
        $model = new PembelianModel();
        $modelPembelianDetail = new PembelianDetailModel();
        $modelPembelianTmp = new PembelianTmpModel();
        $modelSupplier = new SupplierModel();
        $modelBahan = new BahanModel();
        $pembelian = $model->where('kode_pembelian', $id)->first();
        if (!$pembelian) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }
        $supplier = $modelSupplier->findAll();
        $bahan = $modelBahan->findAll();
        // End initialization

        // Get data and delete insert tmp
        $pembelian = $model->where('kode_pembelian', $id)->first();
        $modelPembelianTmp->deleteAll();
        $modelPembelianTmp->insertBatch($modelPembelianDetail->where('pembelian_id', $pembelian['id'])->select('bahan_id, jumlah, harga')->findAll());
        // End get

        $data = [
            'title' => 'Ubah pembelian',
            'menu' => 'pembelian',
            'breadcumb' => [
                '<i class="fas fa-shopping-cart"></i> Transaksi',
                '<a href="/pembelian">Pembelian</a>',
                'Ubah'
            ],
            'customJS' => [
                'pagePembelian.js'
            ],
            'pembelian' => $pembelian,
            'supplier' => $supplier,
            'bahan' => $bahan
        ];
        return view('pembelian/ubah', $data);
    }

    public function save()
    {
        // Initialization
        $model = new PembelianModel();
        $modelPembelianDetail = new PembelianDetailModel();
        $modelPembelianTmp = new PembelianTmpModel();
        $modelBahan = new BahanModel();
        $id = ($this->request->getPost('pembelian_id')) ? $this->request->getPost('pembelian_id') : null;
        $error = 0;
        // End initialization

        // Checking
        $supplier = $this->request->getPost('supplier_id');
        if (!trim($supplier)) {
            $error++;
            $msg[] = 'Supplier wajib diisi';
        }
        $keterangan = $this->request->getPost('keterangan');
        if (!$keterangan) {
            $error++;
            $msg[] = 'Keterangan harus diisi';
        } elseif (strlen($keterangan) > 255) {
            $error++;
            $msg[] = 'Keterangan terlalu panjang. Maks 255 karakter';
        }
        $bahan_id = $this->request->getPost('bahan_id');
        if (!$bahan_id) {
            $error++;
            $msg[] = 'Harus ada bahan yang ditambahkan';
        } else {
            foreach ($bahan_id as $i => $bi) {
                $bahan = $modelBahan->find($bi);
                if ($this->request->getPost('jumlah')[$i] < 0) {
                    $error++;
                    $msg[] = 'Jumlah ' . $bahan['bahan'] . ' tidak valid';
                } else {
                    $old = 0;
                    if ($id) {
                        $old = $modelPembelianDetail->where('pembelian_id', $id)->where('bahan_id', $bi)->findAll()[0]['jumlah'];
                    }
                    $diff = $this->request->getPost('jumlah')[$i] - $old;
                    $bahan = $modelBahan->find($bi);
                    if ($diff < 0 && $bahan['stok'] < ($diff * (-1))) {
                        $error++;
                        $msg[] = 'Stok ' . $bahan['bahan'] . ' sudah digunakan';
                    }
                    $stok[] = ['stok' => $bahan['stok'] + $diff];
                }
                if ($this->request->getPost('harga')[$i] < 0) {
                    $error++;
                    $msg[] = 'Harga ' . $bahan['bahan'] . ' tidak valid';
                }
                $dataPembelianDetail[] = [
                    'bahan_id' => $bi,
                    'jumlah' => $this->request->getPost('jumlah')[$i],
                    'harga' => $this->request->getPost('harga')[$i]
                ];
            }
        }
        // End checking

        // Process
        if ($error == 0) {
            $dataPembelian = [
                'id' => $id,
                'supplier_id' => $supplier,
                'keterangan' => $keterangan
            ];
            // If id will update else will insert and produce kode pembelian
            if ($id) {
                $act = 'mengubah';
            } else {
                $act = 'menambah';
                $dataPembelian['kode_pembelian'] = ($model->getLast()) ? 'PB-' . sprintf('%04d', explode('-', $model->getLast()['kode_pembelian'])[1] + 1) : 'PB-0001';
            }
            // Proceed
            if ($model->save($dataPembelian)) {
                $pembelian_id = ($id) ? $id : $model->getInsertID();
                // Delete first before insert
                $modelPembelianDetail->where('pembelian_id', $pembelian_id)->delete();
                // Insert detail and update bahan
                foreach ($dataPembelianDetail as $i => $data) {
                    // Insert detail
                    $modelPembelianDetail->insert([
                        'pembelian_id' => $pembelian_id,
                        'bahan_id' => $data['bahan_id'],
                        'jumlah' => $data['jumlah'],
                        'harga' => $data['harga']
                    ]);
                    // Update bahan
                    $modelBahan->update($data['bahan_id'], $stok[$i]);
                }

                // Delete tmp
                $modelPembelianTmp->deleteAll();
                $msg[] = 'Berhasil ' . $act . ' data';
            } else {
                $error++;
                $msg[] = 'Gagal ' . $act . ' data';
            }
            // End proceed
        }
        // End process

        // Output
        echo json_encode(['error' => $error, 'msg' => $msg]);
    }

    public function tmp()
    {
        // Initialization
        $model = new PembelianTmpModel();
        // End initialization

        // Output
        echo json_encode($model->getTmp(getUser()['id']));
    }

    public function savetmp()
    {
        // Initialization
        $model = new PembelianTmpModel();
        // End initialization

        // Process
        $bahan_id = $this->request->getPost('id');
        // Check id, if id will update else will insert
        if ($find = $model->find($bahan_id)) {
            $data = [
                'bahan_id' => $bahan_id,
                'jumlah' => ($this->request->getPost('jumlah') !== null) ? $this->request->getPost('jumlah') : $find['jumlah'],
                'harga' => ($this->request->getPost('harga') !== null) ? $this->request->getPost('harga') : $find['harga'],
                'user_id' => getUser()['id']
            ];
            // Proceed update
            if ($model->save($data)) {
                $output = true;
            } else {
                $output = false;
            }
            // End proceed
        } else {
            // Proceed insert
            $data = [
                'bahan_id' => $bahan_id,
                'jumlah' => 1,
                'harga' => 1,
                'user_id' => getUser()['id']
            ];
            $model->insert($data);
            $output = true;
            // End proceed
        }
        // End check
        // End process

        // Output
        echo json_encode($output);
    }

    public function deletetmp()
    {
        // Initialization
        $model = new PembelianTmpModel();
        // End initialization

        // Process
        $bahan_id = $this->request->getPost('id');
        // Proceed
        if ($model->delete($bahan_id)) {
            $output = true;
        } else {
            $output = false;
        }
        // End proceed
        // End process

        // Output
        echo json_encode($output);
    }
}
