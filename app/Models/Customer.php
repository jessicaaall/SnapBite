<?php
namespace App\Models;

use CodeIgniter\Model;

class Customer extends Model {
    protected $table = "Customer";
    public function getDataCustomer() {
        return $this->findAll();
    }
}