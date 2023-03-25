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
    public function postCat()
    {
        $cat = new Categories();
        $name = $_POST['catName'];
        $state = isset($_POST['state']) ? 1 : 0;
        $addCat = $cat->addCat($name, $state);
        if (isset($addCat)) {
            header("Location: /admin/cat");
        } else {
            header("Location: /admin/cat");
        }
    }
    public function postBrand()
    {
        $brand = new Brands();
        $name = $_POST['brandName'];
        $state = isset($_POST['state']) ? 1 : 0;
        $addBrand = $brand->addBrand($name, $state);
        if (isset($addBrand)) {
            header("Location: /admin/brand");
        } else {
            header("Location: /admin/brand");
        }
    }
    public function deleteCat($id)
    {
        $cat = new Categories();
        $cat->deleteCategories((int)$id['id']);
        header('location: /admin/cat');
    }
    public function deleteBrand($id)
    {
        $brand = new Brands();
        $brand->delBrand((int)$id['id']);
        header('location: /admin/brand');
    }
    public function updateCat($id)
    {
        $cat = new Categories();
        $catSelect = $cat->selectCatById($id['id']);
        $data = $catSelect;
        $this->render('admin/cateupdate', $data);
    }
    public function updateBrand($id)
    {
        $cat = new Categories();
        $catSelect = $cat->selectCatById($id['id']);
        $data = $catSelect;
        $this->render('admin/cateupdate', $data);
    }

    public function postUpdateCat()
    {
        $id = (int)$_POST['id'] ?? '';
        $name = $_POST['catName'] ?? '';
        $state = $_POST['state'] ? 1 : 0;
        $cat = new Categories();
        $cat->updateCat($id, $name, $state);
        header("Location: /admin/cat");
    }
}
