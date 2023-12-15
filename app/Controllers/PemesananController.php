<?php

namespace App\Controllers;

use App\Models\Pemesanan;
use CodeIgniter\RESTful\ResourceController;

class PemesananController extends ResourceController
{
    public function index($seg1 = null)
    {

        $model = model(Pemesanan::class);
        $data = $model->getDataPemesananRestoran($seg1);

        return $this->respond($data, 200);
    }
}
