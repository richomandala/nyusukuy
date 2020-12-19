<?php

namespace App\Controllers;

use App\Models\AuthModel;

class Auth extends BaseController
{

    public function index()
    {
        if (session('token')) {
            return redirect()->to('/home');
        }
        return view('auth/index');
    }

    public function login()
    {
        // Initialization
        $model = new AuthModel();
        $error = 0;
        // End initialization

        // Check
        $username = trim($this->request->getPost('username'));
        if (!$username) {
            $error++;
            $msg[] = 'Username tidak boleh kosong';
        }
        $password = trim($this->request->getPost('password'));
        if (!$password) {
            $error++;
            $msg[] = 'Password tidak boleh kosong';
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
                        session()->set('token', $token);
                        $msg = 'Login berhasil!';
                    } else {
                        $error++;
                        $msg[] = 'Token gagal dibuat';
                    }
                    // End process
                } else {
                    $error++;
                    $msg[] = 'Password salah';
                }
            } else {
                $error++;
                $msg[] = 'Username tidak ditemukan';
            }
        }
        // End proceed

        // Output
        echo json_encode(['error' => $error, 'msg' => $msg]);
    }

    public function logout()
    {
        $model = new AuthModel();
        $model->destroyToken(session('token'));
        session()->remove('token');
        return redirect()->to('/auth');
    }
}
