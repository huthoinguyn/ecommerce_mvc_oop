<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Brands;
use App\Models\Categories;
use App\Models\Products;

class ProductController extends BaseController
{
    public function index()
    {
        $pd = new Products();
        $cat = new Categories();
        $cats = $cat->viewCategoryClient(['id', 'name', 'state'], ['state' => '1'], '', 0);
        $brand = new Brands();
        $brands = $brand->viewBrandClient(['id', 'name', 'state'], ['state' => '1'], '', 0);
        $prods = $pd->viewProducts(['id', 'name', 'price', 'image', 'description', 'catId', 'brandId', 'type'], [], 'id ASC', 0);
        $data = [
            $prods,
            $cats,
            $brands,
        ];
        return $this->render('shop', $data);
    }



    public function showDetails()
    {
        $pd = new Products();
        if (isset($_GET['prodId'])) {
            $prodId = $_GET['prodId'];
        }
        $conditions = ["id" => $prodId];
        $fields = ['name', 'price', 'image', 'description'];
        $prodDetails = $pd->viewProducts($fields, $conditions, '', 1);
        echo $prodId;
        $data = [
            "details" => $prodDetails
        ];
        return $this->render('details', $data);
    }
}
