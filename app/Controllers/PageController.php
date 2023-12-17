<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class PageController extends ResourceController
{
    public function index($seg1 = null)
    {

        $client = \Config\Services::curlrequest();
        $apiURL = 'http://localhost:8081/restoranAPI/' . strval($seg1) . '?username=richeese&password=richeese123';
        $response = $client->request("get", $apiURL, [
            "headers" => [
                "Accept" => "application/json"
            ],
            'debug' => true,
        ]);
        if ($response->getStatusCode() == 200) {
            $data['restoran'] = json_decode($response->getBody(), true);
            $data['lokasiX'] = session()->get('lokasiX');
            $data['lokasiY'] = session()->get('lokasiY');
        }
        return view('restoran', $data);
    }

    public function makanan($seg1)
    {

        $client = \Config\Services::curlrequest();
        $apiURL = 'http://localhost:8081/makananAPI/' . $seg1 . '?username=richeese&password=richeese123';
        $response = $client->request("get", $apiURL, [
            "headers" => [
                "Accept" => "application/json"
            ],
            'debug' => true,
        ]);
        if ($response->getStatusCode() == 200) {
            $data['makanan'] = json_decode($response->getBody(), true);
        }
        $apiURL = 'http://localhost:8081/restoranbyid/' . strval($seg1) . '?username=richeese&password=richeese123';
        $response = $client->request("get", $apiURL, [
            "headers" => [
                "Accept" => "application/json"
            ],
            'debug' => true,
        ]);
        if ($response->getStatusCode() == 200) {
            $data['restoran'] = json_decode($response->getBody(), true);
        }
        $data['lokasiX'] = session()->get('lokasiX');
        $data['lokasiY'] = session()->get('lokasiY');
        // return $this->respond($data, 200);
        return view('makanan', $data);
    }

    public function cart()
    {

        $client = \Config\Services::curlrequest();
        $data['id'] = session()->get('id');
        $data['saldo'] = session()->get('saldo');
        $data['lokasiX'] = session()->get('lokasiX');
        $data['lokasiY'] = session()->get('lokasiY');
        $sessionRestoranId = session()->get('restoranId');
        if ($sessionRestoranId) {
            $data['cart'] = session()->get('cart');
            $apiURL = 'http://localhost:8081/restoranbyid/' . strval(session()->get('restoranId')) . '?username=richeese&password=richeese123';
            $response = $client->request("get", $apiURL, [
                "headers" => [
                    "Accept" => "application/json"
                ],
                'debug' => true,
            ]);
            if ($response->getStatusCode() == 200) {
                $data['restoran'] = json_decode($response->getBody(), true);
            }
        } else {
            $data['restoran'] = [];
            $data['cart'] = [];
        }

        // return $this->respond($data, 200);
        return view('cart', $data);
    }
}
