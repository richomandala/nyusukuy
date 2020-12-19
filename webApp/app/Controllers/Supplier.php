<?php

namespace App\Controllers;

use App\Models\SupplierModel;

class Supplier extends BaseController
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
        $model = new SupplierModel();
        $data = [
            'title' => 'Supplier',
            'menu' => 'supplier',
            'breadcumb' => [
                '<i class="fas fa-briefcase"></i> Supplier'
            ],
            'customJS' => [
                'pageSupplier.js'
            ],
            'supplier' => $model->findAll()
        ];
        return view('supplier/index', $data);
    }

    public function tambah()
    {
        $data = [
            'title' => 'Tambah supplier',
            'menu' => 'supplier',
            'breadcumb' => [
                '<a href="/supplier"><i class="fas fa-briefcase"></i> Supplier</a>',
                'Tambah'
            ],
            'customJS' => [
                'pageSupplier.js'
            ]
        ];
        return view('supplier/tambah', $data);
    }

    public function ubah($id)
    {
        // Initialization
        $model = new SupplierModel();
        $supplier = $model->where('kode_supplier', $id)->first();
        if (!$supplier) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }
        // End initialization

        $data = [
            'title' => 'Ubah supplier',
            'menu' => 'supplier',
            'breadcumb' => [
                '<a href="/supplier"><i class="fas fa-briefcase"></i> Supplier</a>',
                'Ubah'
            ],
            'customJS' => [
                'pageSupplier.js'
            ],
            'supplier' => $supplier
        ];
        return view('supplier/ubah', $data);
    }

    public function save()
    {
        // Initialization
        $model = new SupplierModel();
        $error = 0;
        // End initialization

        // Checking
        $supplier = trim($this->request->getPost('supplier'));
        if (!$supplier) {
            $error++;
            $msg[] = 'Nama supplier wajib diisi.';
        } elseif (strlen($supplier) > 255) {
            $error++;
            $msg[] = 'Nama supplier terlalu panjang. Maks 255 karakter.';
        }

        $email = trim($this->request->getPost('email'));
        if (!$email) {
            $error++;
            $msg[] = 'Email wajib diisi.';
        } elseif (strlen($email) > 255) {
            $error++;
            $msg[] = 'Email terlalu panjang. Maks 255 karakter.';
        }

        $telp = trim($this->request->getPost('telp'));
        if (!$telp) {
            $error++;
            $msg[] = 'Telp wajib diisi.';
        } elseif (!(int)$telp) {
            $error++;
            $msg[] = 'Telp tidak valid.';
        }

        $alamat = trim($this->request->getPost('alamat'));
        if (!$alamat) {
            $error++;
            $msg[] = 'Alamat wajib diisi.';
        }
        // End checking

        // Process
        if ($error == 0) {
            // Get id, if id will update else will insert and produce kode supplier
            $id = ($this->request->getPost('id')) ? $this->request->getPost('id') : null;
            $data = [
                'id' => $id,
                'supplier' => $supplier,
                'email' => $email,
                'telp' => $telp,
                'alamat' => $alamat
            ];
            if (!$id) {
                $data['kode_supplier'] = ($model->getLast()) ? 'SUP-' . sprintf('%04d', explode('-', $model->getLast()['kode_supplier'])[1] + 1) : 'SUP-0001';
                $act = 'menambah';
            } else {
                $act = 'mengubah';
            }
            // Proceed
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
        $model = new SupplierModel();
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
