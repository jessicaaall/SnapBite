<?php

namespace App\Models;

use CodeIgniter\Model;

class DetailPemesanan extends Model
{
    protected $table = "DetailPemesanan";

    protected $allowedFields = [
        'orderId',
        'namaMakanan',
        'harga',
        'jumlah',
    ];

    public function getDetailPemesanan($orderId)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('DetailPemesanan');

        $builder->select('DetailPemesanan.id, DetailPemesanan.namaMakanan, DetailPemesanan.harga, DetailPemesanan.jumlah, (DetailPemesanan.harga * DetailPemesanan.jumlah) as hargaPesanan');
        $builder->where('DetailPemesanan.orderId', (int)$orderId);

        $query = $builder->get();
        return $query->getResult();
    }

    public function addNewDetailPemesanan($orderId, $namaMakanan, $harga, $kuantitas)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('DetailPemesanan');
        $data = [
            'orderId' => $orderId,
            'namaMakanan' => $namaMakanan,
            'harga' => $harga,
            'jumlah' => $kuantitas,
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
