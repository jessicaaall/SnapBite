<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class HomeController extends ResourceController
{
    public function index($seg1 = null)
    {

        $client = \Config\Services::curlrequest();
        $apiURL = 'http://localhost:8081/restoranAPI/"' . $seg1 . '"';
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
        return view('home', $data);
    }

    public function makanan($seg1)
    {

        $client = \Config\Services::curlrequest();
        $apiURL = 'http://localhost:8081/makananAPI/' . $seg1;
        $response = $client->request("get", $apiURL, [
            "headers" => [
                "Accept" => "application/json"
            ],
            'debug' => true,
        ]);
        if ($response->getStatusCode() == 200) {
            $data['makanan'] = json_decode($response->getBody(), true);
        }
        $apiURL = 'http://localhost:8081/restoranbyid/' . $seg1;
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
        return view('makanan', $data);
    }
}
