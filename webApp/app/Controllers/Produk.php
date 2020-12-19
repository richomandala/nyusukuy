<?php

namespace App\Controllers;

use App\Models\ProdukModel;
use App\Models\ProdukDetailModel;
use App\Models\ProdukTmpModel;
use App\Models\BahanModel;

class Produk extends BaseController
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
        $model = new ProdukModel();
        $data = [
            'title' => 'Produk',
            'menu' => 'produk',
            'breadcumb' => [
                '<i class="fas fa-list-alt"></i> Produk',
                'Produk jadi'
            ],
            'customJS' => [
                'pageProduk.js'
            ],
            'produk' => $model->getProduk()
        ];
        return view('produk/index', $data);
    }

    public function tambah()
    {
        $model = new BahanModel();
        $modelProdukTmp = new ProdukTmpModel();
        $modelProdukTmp->deleteAll();
        $data = [
            'title' => 'Tambah produk',
            'menu' => 'produk',
            'breadcumb' => [
                '<i class="fas fa-list-alt"></i> Produk',
                '<a href="/produk">Produk jadi</a>',
                'Tambah'
            ],
            'customJS' => [
                'pageProduk.js'
            ],
            'bahan' => $model->findAll()
        ];
        return view('produk/tambah', $data);
    }

    public function ubah($id)
    {
        // Initialization
        $model = new ProdukModel();
        $modelProdukDetail = new ProdukDetailModel();
        $modelProdukTmp = new ProdukTmpModel();
        $modelBahan = new BahanModel();
        // End initialization

        // Get data and delete insert tmp
        $produk = $model->where('kode_produk', $id)->first();
        if (!$produk) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }
        $modelProdukTmp->deleteAll();
        $modelProdukTmp->insertBatch($modelProdukDetail->where('produk_id', $produk['id'])->select('bahan_id, jumlah')->findAll());
        // End get

        $data = [
            'title' => 'Ubah produk',
            'menu' => 'produk',
            'breadcumb' => [
                '<i class="fas fa-list-alt"></i> Produk',
                '<a href="/produk">Produk jadi</a>',
                'Ubah'
            ],
            'customJS' => [
                'pageProduk.js'
            ],
            'bahan' => $modelBahan->findAll(),
            'produk' => $produk
        ];
        return view('produk/ubah', $data);
    }

    public function save()
    {
        // Initialization
        $model = new ProdukModel();
        $modelProdukDetail = new ProdukDetailModel();
        $modelProdukTmp = new ProdukTmpModel();
        $modelBahan = new BahanModel();
        $error = 0;

        // Checking
        $produk = $this->request->getPost('produk');
        if (!trim($produk)) {
            $error++;
            $msg[] = 'Produk wajib diisi';
        } elseif (strlen($produk) > 255) {
            $error++;
            $msg[] = 'Nama produk tidak boleh melebihi 255 karakter';
        }

        $harga = $this->request->getPost('harga');
        if (!$harga) {
            $error++;
            $msg[] = 'Harga harus diisi';
        } elseif ($harga <= 0) {
            $error++;
            $msg[] = 'Harga tidak valid';
        }

        if (!$this->request->getPost('bahan_id')) {
            foreach ($this->request->getPost('bahan_id') as $i => $bahan) {
                if ($this->request->getPost('jumlah')[$i] < 0) {
                    $error++;
                    $msg[] = $modelBahan->find($bahan)['bahan'] . ' tidak boleh kosong';
                }
            }
        }

        // Process
        if ($error == 0) {
            // Check id, if id will update else will insert and produce kode produk
            $id = ($this->request->getPost('produk_id')) ? $this->request->getPost('produk_id') : null;
            $dataProduk = [
                'id' => $id,
                'produk' => $this->request->getPost('produk'),
                'harga' => $this->request->getPost('harga')
            ];
            (!$id) ? $dataProduk['kode_produk'] = (($model->getLast()) ? 'NK-' . sprintf('%04d', explode('-', $model->getLast()['kode_produk'])[1] + 1) : 'NK-0001') : '';
            // Proceed
            // Save data produk
            if ($model->save($dataProduk)) {
                $produk_id = ($id) ? $id : $model->getInsertID();
                $act = ($id) ? 'mengubah' : 'menambah';
                foreach ($this->request->getPost('bahan_id') as $i => $bahan_id) {
                    $dataProdukDetail[] = [
                        'produk_id' => $produk_id,
                        'bahan_id' => $bahan_id,
                        'jumlah' => $this->request->getPost('jumlah')[$i]
                    ];
                }
                // Save produk detail
                if ($modelProdukDetail->deleteAndSave($produk_id, $dataProdukDetail)) {
                    $modelProdukTmp->deleteAll();
                    $msg[] = 'Berhasil ' . $act . ' data';
                } else {
                    $error++;
                    $msg[] = 'Gagal ' . $act . ' data';
                }
                // End save produk detail
            }
            // End save produk
            // End proceed
        }
        // End process

        // Output
        echo json_encode(['error' => $error, 'msg' => $msg]);
    }

    public function delete()
    {
        $error = false;
        $model = new ProdukModel();
        $modelProdukDetail = new ProdukDetailModel();

        if ($this->request->getPost('checkbox')) {
            if ($model->delete($this->request->getPost('checkbox'))) {
                $modelProdukDetail->whereIn('produk_id', $this->request->getPost('checkbox'))->delete();
                $msg = 'Data berhasil dihapus';
            } else {
                $error = true;
                $msg = 'Data gagal dihapus';
            }
        } else {
            $error++;
            $msg = 'Tidak ada data yang dihapus';
        }

        echo json_encode(['error' => $error, 'msg' => $msg]);
    }

    public function tmp()
    {
        // Initialization
        $model = new ProdukTmpModel();
        // End initialization

        // Output
        echo json_encode($model->getTmp(getUser()['id']));
    }

    public function savetmp()
    {
        // Initialization
        $model = new ProdukTmpModel();
        // End initialization

        // Process
        $bahan_id = $this->request->getPost('id');
        $data['bahan_id'] = $bahan_id;
        $data['user_id'] = getUser()['id'];
        // Check id, if id will update else will insert
        if ($find = $model->find($bahan_id)) {
            $data['jumlah'] = ($this->request->getPost('jumlah')) ? $this->request->getPost('jumlah') : $find['jumlah'] + 1;
            // Proceed update
            if ($model->save($data)) {
                $output = true;
            } else {
                $output = false;
            }
            // End proceed
        } else {
            // Proceed insert
            $data['jumlah'] = 1;
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
        $model = new ProdukTmpModel();
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
