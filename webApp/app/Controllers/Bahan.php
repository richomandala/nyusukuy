<?php

namespace App\Controllers;

use App\Models\BahanModel;
use App\Models\ProdukDetailModel;

class Bahan extends BaseController
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
        $model = new BahanModel();
        $data = [
            'title' => 'Bahan',
            'menu' => 'bahan',
            'breadcumb' => [
                '<i class="fas fa-list-alt"></i> Produk',
                'Bahan mentah'
            ],
            'customJS' => [
                'pageBahan.js'
            ],
            'bahan' => $model->findAll()
        ];
        return view('bahan/index', $data);
    }

    public function tambah()
    {
        $data = [
            'title' => 'Tambah bahan',
            'menu' => 'bahan',
            'breadcumb' => [
                '<i class="fas fa-list-alt"></i> Produk',
                '<a href="/bahan">Bahan mentah</a>',
                'Tambah'
            ],
            'customJS' => [
                'pageBahan.js'
            ]
        ];
        return view('bahan/tambah', $data);
    }

    public function ubah($id)
    {
        $model = new BahanModel();
        $bahan = $model->where('kode_bahan', $id)->first();
        if (!$bahan) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }
        $data = [
            'title' => 'Ubah bahan',
            'menu' => 'bahan',
            'breadcumb' => [
                '<i class="fas fa-list-alt"></i> Produk',
                '<a href="/bahan">Bahan mentah</a>',
                'Tambah'
            ],
            'customJS' => [
                'pageBahan.js'
            ],
            'bahan' => $bahan
        ];
        return view('bahan/ubah', $data);
    }

    public function save()
    {
        // Initialization
        $model = new BahanModel();
        $error = 0;
        // End initialization

        // Checking
        $bahan = trim($this->request->getPost('bahan'));
        if (!$bahan) {
            $error++;
            $msg[] = 'Nama bahan wajib diisi.';
        } elseif (strlen($bahan) > 255) {
            $error++;
            $msg[] = 'Nama bahan terlalu panjang. Maks 255 karakter.';
        }
        $satuan = $this->request->getPost('satuan');
        if (!$satuan) {
            $error++;
            $msg[] = 'Satuan wajib diisi.';
        }
        // End checking

        // Process
        if ($error == 0) {
            // Get id
            $id = ($this->request->getPost('id')) ? $this->request->getPost('id') : null;
            // End get id

            // Initialization data
            $data = [
                'id' => $id,
                'bahan' => $bahan,
                'satuan' => $satuan
            ];
            // End initialization data

            // Check id, if id will update else will insert and produce kode bahan and stok value is zero
            if (!$id) {
                $data['kode_bahan'] = ($model->getLast()) ? 'BHN-' . sprintf('%04d', explode('-', $model->getLast()['kode_bahan'])[1] + 1) : 'BHN-0001';
                $data['stok'] = 0;
                $act = 'menambah';
            } else {
                $act = 'mengubah';
            }
            // End check id

            // Proceed to the db
            if ($model->save($data)) {
                $msg = 'Berhasil ' . $act . ' data';
            } else {
                $error++;
                $msg = 'Berhasil ' . $act . ' data';
            }
            // End proceed
        }
        // End process

        // Output
        echo json_encode(['error' => $error, 'msg' => $msg]);
    }

    public function delete()
    {
        // Initialization
        $model = new BahanModel();
        $produk_detail = new ProdukDetailModel;
        $error = 0;
        // End initialization

        // Procees
        if ($this->request->getPost('checkbox')) {
            foreach ($this->request->getPost('checkbox') as $checkbox) {
                // Check if exist in produk detail
                if ($produk_detail->where('bahan_id', $checkbox)->findAll()) {
                    $error++;
                    $msg[] = $model->find($checkbox)['bahan'] . ' terdapat pada suatu produk. Hapus bahan pada produk terlebih dahulu';
                    continue;
                }
                $data[] = $checkbox;
            }
        } else {
            $error++;
            $msg[] = 'Tidak ada data yang dihapus';
        }

        // Proceed
        if ($error == 0) {
            if ($model->delete($data)) {
                $msg[] = 'Data berhasil dihapus';
            } else {
                $msg[] = 'Data gagal dihapus';
            }
        }

        echo json_encode(['error' => $error, 'msg' => $msg]);
    }
}
