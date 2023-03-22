<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Brands;
use App\Models\Categories;
use App\Models\Products;

class AdminController extends BaseController
{

    public function index()
    {
        $data = [];
        return $this->render('admin/index', $data);
    }

    public function getCat()
    {
        $cat = new Categories();
        $catList = $cat->viewCategoryAdmin(['id', 'name', 'state'], '');
        $data = $catList;
        $this->render('admin/category', $data);
    }
    public function getBrand()
    {
        $brand = new Brands();
        $brandList = $brand->viewBrandAdmin(['id', 'name', 'state'], '');
        $data = $brandList;
        $this->render('admin/brand', $data);
    }
    public function getProd()
    {
        $prod = new Products();
        $prodList = $prod->viewProducts(['id', 'name', 'catId', 'brandId', 'price', 'image', 'description', 'type'], [], '', 0);
        $data = $prodList;
        $this->render('admin/product', $data);
    }
}
