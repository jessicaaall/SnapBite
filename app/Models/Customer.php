<?php

namespace App\Models;

use CodeIgniter\Model;

class Customer extends Model
{
    protected $table = "Customer";
    protected $allowedFields = [
        'username',
        'password',
        'saldo',
        'lokasiX',
        'lokasiY'
    ];
    public function getDataCustomer()
    {
        return $this->findAll();
    }

    public function substractSaldo($newSaldo)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('Customer');
        $builder->set('saldo', $newSaldo);
        $builder->where('id', session()->get('id'));
        $builder->update();

        $inserted_id = $db->insertID();

        if ($db->affectedRows() > 0) {
            return $inserted_id;
        } else {
            echo 'Failed to update saldo.';
        }
    }
    public function getUserByUsername(string $username)
    {
        return $this->where('username', $username)->first();
    }
    public function validatePassword(string $username, string $password)
    {
        return $this->getUserByUsername($username)['password'] == md5($password);
    }
}
