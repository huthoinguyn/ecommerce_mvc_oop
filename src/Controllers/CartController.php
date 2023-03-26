<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class CartController extends BaseController
{

    public function index()
    {
        $data = [
            "cart" => []
        ];
        return $this->render('cart', $data);
    }
}
