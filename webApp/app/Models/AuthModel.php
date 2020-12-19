<?php

namespace App\Models;

use CodeIgniter\Model;

class AuthModel extends Model
{
    protected $table = 'users';
    protected $allowedFields = [
        'username',
        'password'
    ];

    public function getUser($id = null)
    {
        if ($id) {
            return $this->db->table($this->table)
                ->select('users.id,nama,username,role_id,role')
                ->join('users_role', 'users_role.user_id = ' . $this->table . '.id', 'left')
                ->join('role', 'role.id = users_role.role_id', 'left')
                ->having('users.id', $id)
                ->get()
                ->getFirstRow('array');
        } else {
            return $this->db->table($this->table)
                ->select('users.id,nama,username,role_id,role')
                ->join('users_role', 'users_role.user_id = ' . $this->table . '.id', 'left')
                ->join('role', 'role.id = users_role.role_id', 'left')
                ->get()
                ->getResultArray();
        }
    }

    public function getToken($token)
    {
        return $this->db->table('token')->where('token', $token)->get()->getRowArray();
    }

    public function setToken($id)
    {
        $token = hash('sha256', time() . rand(0, 1000));
        $this->db->table('token')->insert([
            'token' => $token,
            'user_id' => $id,
            'is_active' => 1
        ]);
        return $token;
    }

    public function destroyToken($token)
    {
        return $this->db->table('token')->where('token', $token)->update(['is_active' => 0]);
    }
}
