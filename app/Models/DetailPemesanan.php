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
}
