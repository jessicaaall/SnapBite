<?php

namespace App\Controllers;

use App\Models\Customer;
use CodeIgniter\RESTful\ResourceController;

class CustomerController extends ResourceController
{
    public function index()
    {
        $model = model(Customer::class);
        $data = $model->getDataCustomer();
        return $this->respond($data, 200);
    }
}
