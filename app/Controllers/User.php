<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\Users;

class User extends BaseController
{
    use ResponseTrait;

    public function index()
    {
        $model = new Users();
        $data = $model->orderBy('id', 'DESC')->findAll();
        return $this->respond($data);
    }
    public function create()
    {
        $model = new Users();
        $data = [
            'name' => $this->request->getPost('name'),
            'username' => $this->request->getPost('username'),
            'password' => $this->request->getPost('password'),
            'access' => 2
        ];
        $model->insert($data);
        $response = [
            'status' => 201,
            'error' => null,
            'messages' => [
                'success' => 'Data user berhasil ditambahkan'
            ]
        ];
        return $this->respondCreated($response);
    }
    public function show($id = null)
    {
        $model = new Users();
        $data = $model->where('id', $id)->first();
        if ($data) {
            return $this->respond($data);
        } else {
            return $this->failNotFound('Data tidak ditemukan.');
        }
    }
    public function update($id = null)
    {
        $model = new Users();
        $id = $this->request->getPost('id');
        $data = [
            'name' => $this->request->getPost('name'),
            'username' => $this->request->getPost('username'),
            'password' => $this->request->getPost('password'),
        ];
        $model->update($id, $data);
        $response = [
            'status' => 200,
            'error' => null,
            'messages' => [
                'success' => 'Data user berhasil diubah'
            ]
        ];
        return $this->respond($response);
    }
    public function delete($id = null)
    {
        $model = new Users();
        $data = $model->where('id', $id)->delete($id);
        if ($data) {
            $model->delete($id);
            $response = [
                'status' => 200,
                'error' => null,
                'messages' => [
                    'success' => 'Data user berhasil dihapus'
                ]
            ];
            return $this->respondDeleted($response);
        } else {
            return $this->failNotFound('Data tidak ditemukan.');
        }
    }
}
