<?php

namespace App\Controllers;

use App\Models\AuthModel;
use App\Models\BahanModel;
use CodeIgniter\RESTful\ResourceController;
use App\Models\InventarisModel;
use App\Models\PembelianModel;
use App\Models\PenjualanDetailModel;
use App\Models\PenjualanModel;
use App\Models\PenjualanTmpModel;
use App\Models\ProdukDetailModel;
use App\Models\ProdukModel;

class Api extends ResourceController
{
    protected $format    = 'json';

    public function index()
    {
        throw new \CodeIgniter\Exceptions\PageNotFoundException();
    }

    public function get_inventaris()
    {
        $model = new InventarisModel();
        $data = [
            'status' => true,
            'data' => $model->findAll()
        ];
        return $this->respond($data);
    }

    public function post_inventaris()
    {
        $model = new InventarisModel();
        $status = true;
        // End initialization

        // Checking
        $barang = trim($this->request->getPost('barang'));
        if (!$barang) {
            $status = false;
            $msg[] = 'Nama barang wajib diisi.';
        } elseif (strlen($barang) > 255) {
            $status = false;
            $msg[] = 'Nama barang terlalu panjang. Maks 255 karakter.';
        }

        $keterangan = trim($this->request->getPost('keterangan'));
        if (!$keterangan) {
            $status = false;
            $msg[] = 'Keterangan wajib diisi.';
        } elseif (strlen($keterangan) > 255) {
            $status = false;
            $msg[] = 'Keterangan terlalu panjang. Maks 255 karakter.';
        }

        $jumlah = $this->request->getPost('jumlah');
        if (!$jumlah) {
            $status = false;
            $msg[] = 'Jumlah wajib diisi.';
        } elseif ($jumlah < 1) {
            $status = false;
            $msg[] = 'Jumlah tidak valid.';
        }
        // End checking

        // Process
        if ($status) {
            $data = [
                'id' => null,
                'kode_inventaris' => ($model->getLast()) ? 'BRG-' . sprintf('%04d', explode('-', $model->getLast()['kode_inventaris'])[1] + 1) : 'BRG-0001',
                'barang' => $barang,
                'keterangan' => $keterangan,
                'jumlah' => $jumlah
            ];
            // Proceed
            if ($model->save($data)) {
                $msg = 'Berhasil menambahkan data';
            } else {
                $status = false;
                $msg = 'Gagal menambahkan data';
            }
            // End proceed
        }
        // End process

        // Output
        return $this->respond(['status' => $status, 'message' => $msg]);
    }

    public function put_inventaris()
    {
        $model = new InventarisModel();
        $status = true;
        // End initialization

        // Checking
        $id = $this->request->getRawInput()['id'];
        $barang = trim($this->request->getRawInput()['barang']);
        if (!$barang) {
            $status = false;
            $msg[] = 'Nama barang wajib diisi.';
        } elseif (strlen($barang) > 255) {
            $status = false;
            $msg[] = 'Nama barang terlalu panjang. Maks 255 karakter.';
        }

        $keterangan = trim($this->request->getRawInput()['keterangan']);
        if (!$keterangan) {
            $status = false;
            $msg[] = 'Keterangan wajib diisi.';
        } elseif (strlen($keterangan) > 255) {
            $status = false;
            $msg[] = 'Keterangan terlalu panjang. Maks 255 karakter.';
        }

        $jumlah = $this->request->getRawInput()['jumlah'];
        if (!$jumlah) {
            $status = false;
            $msg[] = 'Jumlah wajib diisi.';
        } elseif ($jumlah < 1) {
            $status = false;
            $msg[] = 'Jumlah tidak valid.';
        }
        // End checking

        // Process
        if ($status) {
            // Get id, if id will update else will insert and produce kode barang
            $data = [
                'id' => $id,
                'barang' => $barang,
                'keterangan' => $keterangan,
                'jumlah' => $jumlah
            ];
            // Proceed
            if ($model->save($data)) {
                $msg = 'Berhasil mengubah data';
            } else {
                $status = false;
                $msg = 'Berhasil mengubah data';
            }
            // End proceed
        }
        // End process

        // Output
        return $this->respond(['status' => $status, 'message' => $msg]);
    }

    public function delete_inventaris($id = null)
    {
        $model = new InventarisModel();
        $status = true;
        // End initialization

        // Proceed
        if ($id) {
            if ($model->delete($id)) {
                $msg = 'Data berhasil dihapus';
            } else {
                $status = false;
                $msg = 'Data gagal dihapus';
            }
        } else {
            $status = false;
            $msg = 'Tidak ada data yang dihapus';
        }
        // End proceed

        // Output
        return $this->respond(['status' => $status, 'message' => $msg]);
    }

    public function get_produk()
    {
        $model = new ProdukModel();
        $data = [
            'status' => true,
            'data' => $model->findAll()
        ];
        return $this->respond($data);
    }

    public function get_penjualanTmp($token)
    {
        helper('user');
        $user_id = getUser($token)['id'];
        $model = new PenjualanTmpModel();
        $data = [
            'status' => true,
            'data' => $model->getTmp($user_id),
            'total' => $model->getTotal($user_id)
        ];
        return $this->respond($data);
    }

    public function post_penjualanTmp()
    {
        helper('user');
        $model = new PenjualanTmpModel();
        $produk_id = $this->request->getPost('id');
        $token = $this->request->getPost('token');
        $data['produk_id'] = $produk_id;
        $data['user_id'] = getUser($token)['id'];
        // End initialization

        // Process
        // Find produk if exist will update jumlah else will produce jumlah is 1
        if ($find = $model->find($produk_id)) {
            $data['jumlah'] = $find['jumlah'] + 1;
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
        return $this->respond(['status' => $output]);
    }

    public function put_penjualanTmp($id, $token)
    {
        helper('user');
        $user_id = getUser($token)['id'];
        $model = new PenjualanTmpModel();

        if (!$id || !$model->find($id)) {
            $status = false;
        } else {
            if ($model->where('user_id', $user_id)->update($id, ['jumlah' => $this->request->getRawInput('jumlah')])) {
                $status = true;
            } else {
                $status = false;
            }
        }
        return $this->respond(['status' => $status]);
    }

    public function delete_penjualanTmp($id, $token)
    {
        helper('user');
        $user_id = getUser($token)['id'];
        $model = new PenjualanTmpModel();
        $status = true;
        // End initialization

        // Proceed
        if ($find = $model->where('user_id', $user_id)->find($id)) {
            if ($model->where('user_id', $user_id)->delete($id)) {
                $msg = 'Data berhasil dihapus';
            } else {
                $status = false;
                $msg = 'Data gagal dihapus';
            }
        }
        // End proceed

        // Output
        return $this->respond(['status' => $status, 'message' => $msg]);
    }

    public function get_penjualan($id = null)
    {
        $model = new PenjualanModel();
        if ($id) {
            $data = [
                'status' => true,
                'data' => $model->getPembelian($id)
            ];
        } else {
            $data = [
                'status' => true,
                'data' => $model->getPembelian()
            ];
        }
        return $this->respond($data);
    }

    public function post_penjualan()
    {
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

        $produk_id = explode(',', str_replace(array('[', ']'), '', $this->request->getPost('produk_id')));
        $jumlah_produk = explode(',', str_replace(array('[', ']'), '', $this->request->getPost('jumlah')));
        if (!$produk_id) {
            $error++;
            $msg[] = 'Harus ada produk yang ditambahkan';
        } else {
            for ($i = 0; $i < count($produk_id); $i++) {
                if ($jumlah_produk[$i] < 1) {
                    $error++;
                    $msg[] = 'Jumlah produk tidak boleh ada yg kosong';
                } else {
                    $produk = $modelProdukDetail->getDetail($produk_id[$i]);
                    foreach ($produk as $p) {
                        $jumlah = $jumlah_produk[$i];
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
                    $totalHarga[] = $modelProduk->find($produk_id[$i])['harga'] * $jumlah;
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
                for ($i = 0; $i < count($produk_id); $i++) {
                    $modelPenjualanDetail->insert([
                        'penjualan_id' => $id,
                        'produk_id' => $produk_id[$i],
                        'jumlah' => $jumlah_produk[$i]
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
        return $this->respond(['error' => $error, 'message' => $msg]);
    }

    public function get_checkLogin($token)
    {
        $model = new AuthModel();
        $data = $model->getToken($token);
        if (!$data || $data['is_active'] == 0) {
            return $this->respond(false);
        }
        return $this->respond(true);
    }

    public function post_login()
    {
        // Initialization
        $model = new AuthModel();
        $error = 0;
        $token = null;
        // End initialization

        // Check
        $username = trim($this->request->getPost('username'));
        $password = trim($this->request->getPost('password'));
        if (!$username || !$password) {
            $error++;
            $msg = 'Username atau password tidak boleh kosong';
        }
        // End check

        // Proceed
        if ($error == 0) {
            // Check username
            if ($data = $model->where('username', $username)->first()) {
                // Check password
                if (password_verify($password, $data['password'])) {
                    // Proccess
                    // Get token
                    $token = $model->setToken($data['id']);
                    if ($token) {
                        $msg = 'Login berhasil!';
                    } else {
                        $error++;
                        $msg = 'Token gagal dibuat';
                    }
                    // End process
                } else {
                    $error++;
                    $msg = 'Password salah';
                }
            } else {
                $error++;
                $msg = 'Username tidak ditemukan';
            }
        }
        // End proceed

        // Output
        return $this->respond(['error' => $error, 'msg' => $msg, 'token' => $token]);
    }

    public function get_logout($token)
    {
        $model = new AuthModel();
        if ($model->destroyToken(session('token'))) {
            return $this->respond(true);
        }
        return $this->respond(false);
    }

    public function get_github($username)
    {
        $data = [
            'avatar_url' => 'https://avatars1.githubusercontent.com/u/869684?v=4',
            'login' => 'test',
            'name' => 'test',
            'public_repos' => 1,
            'followers' => 1,
            'following' => 1,
            'company' => 'test',
            'location' => 'test'
        ];
        return $this->respond($data);
    }

    // ...
}
