<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Controllers\Checkout\QRMomo;
use App\Models\Carts;
use App\Models\Products;
use App\Models\Variants;

class CheckoutController extends BaseController
{

    private $_userId;
    private $_cart;
    private $_variant;

    public function __construct()
    {
        $this->_userId = BaseController::get('userId');
        $this->_cart = new Carts();
        $this->_variant = new Variants();
    }
    public function index()
    {
        $carts = $this->_cart->viewAllCart($this->_userId);
        $variants = [];
        foreach ($carts as $cart) {
            $variants[] = $this->_variant->VariantSelectById((int)$cart['variant_id']);
        }
        $data = [
            "cart" => $carts,
            "variants" => $variants,
        ];
        return $this->render('checkout', $data);
    }
    
    public function QRMomo(){
        require __DIR__ .'/Checkout/momo.php';
    }
}
