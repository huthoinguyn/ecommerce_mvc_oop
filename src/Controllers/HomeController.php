<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Products;

class HomeController extends BaseController
{

    public function index()
    {
        $pd = new Products();
        $featuredProd = $pd->viewProducts(['id', 'name', 'price', 'image'], ['type' => '1'], '', 4);
        $newArrival = $pd->viewProducts(['id', 'name', 'price', 'image'], [], '', 4);
        $data = [
            "featuredProd" => $featuredProd,
            "newArrival" => $newArrival,
        ];
        return $this->render('home', $data);
    }
}
