<?php

namespace App\Controllers;

use App\Models\Pemesanan;
use App\Models\Customer;
use CodeIgniter\RESTful\ResourceController;

class PemesananController extends ResourceController
{
    public function index($seg1 = null)
    {
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');
        $modelCustomer = model(Customer::class);

        if (!($modelCustomer->validatePassword($username, $password))) {
            $response = [
                'status' => 'error',
                'message' => 'Credential salah!'
            ];
            return $this->respond($response, 403);
        }

        $model = model(Pemesanan::class);
        $data = $model->getDataPemesananRestoran($seg1);

        return $this->respond($data, 200);
    }
}
