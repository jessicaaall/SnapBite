<?php

namespace App\Controllers;

use App\Models\DetailPemesanan;
use CodeIgniter\RESTful\ResourceController;

class DetailPemesananController extends ResourceController
{
    public function index($seg1 = null)
    {

        $model = model(DetailPemesanan::class);
        $data = $model->getDetailPemesanan($seg1);

        return $this->respond($data, 200);
    }
}
