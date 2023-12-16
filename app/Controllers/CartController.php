<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\Pemesanan;
use App\Models\Customer;
use App\Models\DetailPemesanan;

class CartController extends ResourceController
{
    public function addToCart()
    {
        $foodItemId = $this->request->getPost('foodId');
        $restoranId = $this->request->getPost('restoranId');
        $foodName = $this->request->getPost('foodName');
        $foodWaktuProses = $this->request->getPost('foodWaktuProses');
        $foodKalori = $this->request->getPost('foodKalori');
        $foodHarga = $this->request->getPost('foodHarga');
        $cart = session()->get('cart') ?? [];
        $restoranSession = session()->get('restoranId') ?? $restoranId;

        // if from different restaurant, clear the cart before
        if ($restoranSession !== $restoranId) {
            $cart = [];
            $restoranSession = $restoranId;
        }

        // Check if the product is already in the cart
        if (isset($cart[$foodItemId])) {
            // Update quantity if the product is already in the cart
            $cart[$foodItemId]['quantity'] += 1;
        } else {
            // Add the product to the cart
            $cart[$foodItemId] = [
                'foodId' => $foodItemId,
                'foodName' => $foodName,
                'foodWaktuProses' => $foodWaktuProses,
                'foodKalori' => $foodKalori,
                'foodHarga' => $foodHarga,
                'quantity' => 1,
            ];
        }

        // Save the updated cart back to the session
        session()->set('restoranId', $restoranSession);
        session()->set('cart', $cart);
        return $this->response->setJSON(['success' => true, 'message' => 'Item added to cart']);
    }
    public function updateCart()
    {
        $foodItemId = $this->request->getPost('foodId');
        $action = $this->request->getPost('action');
        $cart = session()->get('cart') ?? [];

        if ($action === 'add') {
            $cart[$foodItemId]['quantity'] += 1; // You can use the existing add to cart logic for addition
        } elseif ($action === 'subtract') {
            // Check if the product is in the cart
            if (isset($cart[$foodItemId])) {
                // Update quantity if the product is in the cart and quantity is greater than 1
                if ($cart[$foodItemId]['quantity'] > 1) {
                    $cart[$foodItemId]['quantity'] -= 1;
                } else {
                    // Remove the item if the quantity becomes 0
                    unset($cart[$foodItemId]);
                    if (count($cart) === 0) {
                        session()->remove('restoranId');
                    };
                }
            }
        } elseif ($action === 'delete') {
            // Remove the item from the cart
            unset($cart[$foodItemId]);
            if (count($cart) === 0) {
                session()->remove('restoranId');
            };
        }
        // Save the updated cart back to the session
        session()->set('cart', $cart);
        return $this->response->setJSON(['success' => true, 'message' => 'Cart updated successfully']);
    }

    public function placeOrder()
    {
        $modelPemesanan = model(Pemesanan::class);
        $modelDetailPemesanan = model(DetailPemesanan::class);
        $modelCustomer = model(Customer::class);
        $lamaPemesanan = $this->request->getPost('lamaPemesanan');
        $totalHarga = $this->request->getPost('totalHarga');
        $cart = session()->get('cart');
        $orderId = $modelPemesanan->addNewPemesanan($lamaPemesanan, $totalHarga);
        foreach ($cart as $foodId => $foodInfo) {
            // Access individual properties of each food item
            $name = $foodInfo['foodName'];
            $harga = $foodInfo['foodHarga'];
            $kuantitas = $foodInfo['quantity'];
            $orderDetailsId = $modelDetailPemesanan->addNewDetailPemesanan($orderId, $name, $harga, $kuantitas);
        }
        session()->remove('restoranId');
        session()->remove('cart');
        $saldoSisa = session()->get('saldo') - $totalHarga;
        session()->set('saldo', $saldoSisa);
        $orderDetailsId = $modelCustomer->substractSaldo($saldoSisa);

        return $this->response->setJSON(['success' => $saldoSisa, 'message' => 'Food ordered successfully', 'id' => $orderDetailsId]);
    }
}
