<?php

namespace App\Models;

use CodeIgniter\Model;

class Pemesanan extends Model
{
    protected $table = "Pemesanan";

    protected $allowedFields = [
        'tanggalPemesanan',
        'totalHarga',
        'status',
    ];

    public function getDataPemesananRestoran($restoranId)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('Pemesanan');

        $builder->select('Pemesanan.id, Pemesanan.tanggalPemesanan as orderDate, sum(DetailPemesanan.harga * DetailPemesanan.jumlah) as totalHarga');
        $builder->join('DetailPemesanan', 'Pemesanan.id = DetailPemesanan.orderId');
        $builder->groupBy('Pemesanan.id');
        $builder->where('Pemesanan.restoranId', (int)$restoranId);
        $builder->orderBy('Pemesanan.tanggalPemesanan', 'DESC');

        $query = $builder->get();
        return $query->getResult();
    }

    public function addNewPemesanan($lamaPemesanan, $totalHarga)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('Pemesanan');
        $data = [
            'restoranId' => session()->get('restoranId'),
            'customerId' => session()->get('id'),
            'lamaPemesanan' => $lamaPemesanan,
            'tanggalPemesanan' => date("Y-m-d"),
            'totalHarga' => $totalHarga,
            // add more columns and values as needed
        ];
        $builder->insert($data);

        $inserted_id = $db->insertID();

        if ($db->affectedRows() > 0) {
            return $inserted_id;
        } else {
            echo 'Failed to insert data.';
        }
    }
}
