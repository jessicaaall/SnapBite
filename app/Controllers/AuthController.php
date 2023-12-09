<?php

namespace App\Controllers;

use App\Models\Customer;

class AuthController extends BaseController
{
    public function index()
    {
        if (session()->get('isLoggedIn'))
        {
            return redirect()
                ->to('/');
        }
        helper(['form']);
        echo view('sign-in');
    }

    public function loginAuth()
    {
        $session = session();
        $customerModel = new Customer();
        $username = $this->request->getVar('username');
        $password = md5($this->request->getVar('password'));

        $data = $customerModel->where('username', $username)->first();

        if ($data) {
            $pass = $data['password'];
            $authenticatePassword = $password === $pass;
            if ($authenticatePassword) {
                $ses_data = [
                    'id' => $data['id'],
                    'username' => $data['username'],
                    'saldo' => $data['saldo'],
                    'lokasiX' => $data['lokasiX'],
                    'lokasiY' => $data['lokasiY'],
                    'isLoggedIn' => TRUE
                ];
                $session->set($ses_data);
                return redirect()->to('/');
            } else {
                $session->setFlashdata('msg', 'Password is incorrect.');
                return redirect()->to('/login');
            }
        } else {
            $session->setFlashdata('msg', 'Username does not exist.');
            return redirect()->to('/login');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
