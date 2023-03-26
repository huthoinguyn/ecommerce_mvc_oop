<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Carts;
use App\Models\Products;

class CartController extends BaseController
{

    private $cart;
    private $pd;

    public function __construct()
    {
        $this->cart = new Carts();
        $this->pd = new Products();
    }
    public function index()
    {
        $checkLogin = BaseController::checkLogin();
        if (isset($checkLogin)) {
            $data = [
                "message" => "<div class='text-red-500 text-center p-2 bg-red-200'>Please login to view your cart!</div>"
            ];
            $this->render("/login", $data);
        } else {
            $userId = BaseController::get('userId');
            $carts = $this->cart->viewAllCart(['*'], ['userId' => $userId], '', 0);
            $data = [
                "cart" => $carts,
            ];
            return $this->render('cart', $data);
        }
    }
    public function addToCart()
    {
        $prodId = $_POST['id'];
        if (BaseController::get('checkLogin')) {
            $qty = $this->validation($_POST['quantity']);
            $sId = session_id();
            $userId = BaseController::get('userId');
            $p = $this->pd->prodSelectById($prodId)[0];

            $addCart = $this->cart->addCart($prodId, $userId, $sId, $p['name'], $p['price'], $p['image'], $qty);
            if (!empty($addCart)) {
                $carts = $this->cart->viewAllCart(['*'], ['userId' => $userId], '', 0);
                $data = [
                    "cart" => $carts,
                    "message" => "<div class='text-green-700 text-center p-2 bg-green-200'>Add to cart successfully.</div>"
                ];
                return $this->render('cart', $data);
            }
        } else {
            $prodDetails = $this->pd->viewProducts(['*'], ['id' => $prodId], '', 1);
            $data = [
                "details" => $prodDetails,
                "message" => "<div class='text-red-500 text-center p-2 bg-red-200'>Please login to add to cart</div>"
            ];
            $this->render('details', $data);
        }
    }
}
