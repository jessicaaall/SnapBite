<?php
namespace App\Models;

use CodeIgniter\Model;

class Customer extends Model {
    protected $table = "Customer";
    protected $allowedFields = [
        'username',
        'password',
        'saldo',
        'lokasiX',
        'lokasiY'
    ];
    public function getDataCustomer() {
        return $this->findAll();
    }
}