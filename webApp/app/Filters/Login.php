<?php

namespace App\Filters;

use App\Models\AuthModel;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class Login implements FilterInterface
{
    public function before(RequestInterface $request)
    {
        if (!session('token')) {
            return redirect()->to('/auth');
        } else {
            $model = new AuthModel();
            $data = $model->getToken(session('token'));
            if (!$data || $data['is_active'] == 0) {
                session()->remove('token');
                return redirect()->to('/auth');
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response)
    {
        // Do something here
    }
}
