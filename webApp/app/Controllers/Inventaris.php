<?php

namespace App\Controllers;

use App\Models\InventarisModel;

class Inventaris extends BaseController
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
        $model = new InventarisModel();
        $data = [
            'title' => 'Inventaris',
            'menu' => 'inventaris',
            'breadcumb' => [
                '<i class="fas fa-briefcase"></i> Inventaris'
            ],
            'customJS' => [
                'pageInventaris.js'
            ],
            'inventaris' => $model->findAll()
        ];
        return view('inventaris/index', $data);
    }

    public function tambah()
    {
        $data = [
            'title' => 'Tambah inventaris',
            'menu' => 'inventaris',
            'breadcumb' => [
                '<a href="/inventaris"><i class="fas fa-briefcase"></i> Inventaris</a>',
                'Tambah'
            ],
            'customJS' => [
                'pageInventaris.js'
            ]
        ];
        return view('inventaris/tambah', $data);
    }

    public function ubah($id)
    {
        // Initialization
        $model = new InventarisModel();
        $inventaris = $model->where('kode_inventaris', $id)->first();
        if (!$inventaris) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }
        // End initialization

        $data = [
            'title' => 'Ubah inventaris',
            'menu' => 'inventaris',
            'breadcumb' => [
                '<a href="/inventaris"><i class="fas fa-briefcase"></i> Inventaris</a>',
                'Ubah'
            ],
            'customJS' => [
                'pageInventaris.js'
            ],
            'inventaris' => $inventaris
        ];
        return view('inventaris/ubah', $data);
    }

    public function save()
    {
        // Initialization
        $model = new InventarisModel();
        $error = 0;
        // End initialization

        // Checking
        $barang = trim($this->request->getPost('barang'));
        if (!$barang) {
            $error++;
            $msg[] = 'Nama barang wajib diisi.';
        } elseif (strlen($barang) > 255) {
            $error++;
            $msg[] = 'Nama barang terlalu panjang. Maks 255 karakter.';
        }

        $keterangan = trim($this->request->getPost('keterangan'));
        if (!$keterangan) {
            $error++;
            $msg[] = 'Keterangan wajib diisi.';
        } elseif (strlen($keterangan) > 255) {
            $error++;
            $msg[] = 'Keterangan terlalu panjang. Maks 255 karakter.';
        }

        $jumlah = $this->request->getPost('jumlah');
        if (!$jumlah) {
            $error++;
            $msg[] = 'Jumlah wajib diisi.';
        } elseif ($jumlah < 1) {
            $error++;
            $msg[] = 'Jumlah tidak valid.';
        }
        // End checking

        // Process
        if ($error == 0) {
            // Get id, if id will update else will insert and produce kode barang
            $id = ($this->request->getPost('id')) ? $this->request->getPost('id') : null;
            $data = [
                'id' => $id,
                'barang' => $barang,
                'keterangan' => $keterangan,
                'jumlah' => $jumlah
            ];
            if (!$id) {
                $data['kode_inventaris'] = ($model->getLast()) ? 'BRG-' . sprintf('%04d', explode('-', $model->getLast()['kode_inventaris'])[1] + 1) : 'BRG-0001';
                $act = 'menambah';
            } else {
                $act = 'mengubah';
            }
            // Proceed
            if ($model->save($data)) {
                $msg = 'Berhasil ' . $act . ' data';
            } else {
                $error++;
                $msg = 'Gagal ' . $act . ' data';
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
        $model = new InventarisModel();
        $error = false;
        // End initialization

        // Proceed
        if ($this->request->getPost('checkbox')) {
            if ($model->delete($this->request->getPost('checkbox'))) {
                $msg = 'Data berhasil dihapus';
            } else {
                $error = true;
                $msg = 'Data gagal dihapus';
            }
        } else {
            $error = true;
            $msg = 'Tidak ada data yang dihapus';
        }
        // End proceed

        // Output
        echo json_encode(['error' => $error, 'msg' => $msg]);
    }
}
