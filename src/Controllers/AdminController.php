<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Core\Request;
use App\Models\Brands;
use App\Models\Categories;
use App\Models\Products;

class AdminController extends BaseController
{
    private $_request;
    private $_cat;
    private $_brand;

    public function __construct()
    {
        $this->_request = new Request();
        $this->_cat = new Categories();
        $this->_brand = new Brands();
    }

    public function index()
    {
        $data = [];
        return $this->render('admin/index', $data);
    }

    public function getCat()
    {
        $catList = $this->_cat->viewCategoryAdmin(['id', 'name', 'state'], '');
        $data = $catList;
        $this->render('admin/category', $data);
    }
    public function getBrand()
    {
        $brandList = $this->_brand->viewBrandAdmin(['id', 'name', 'state'], '');
        $data = $brandList;
        $this->render('admin/brand', $data);
    }
    public function postCat()
    {
        $name = $_POST['catName'];
        $state = isset($_POST['state']) ? 1 : 0;
        $addCat = $this->_cat->addCat($name, $state);
        if (isset($addCat)) {
            header("Location: /admin/cat");
        } else {
            header("Location: /admin/cat");
        }
    }
    public function postBrand()
    {
        $name = $_POST['brandName'];
        $state = isset($_POST['state']) ? 1 : 0;
        $addBrand = $this->_brand->addBrand($name, $state);
        if (isset($addBrand)) {
            header("Location: /admin/brand");
        } else {
            header("Location: /admin/brand");
        }
    }
    public function deleteCat()
    {
        $id = $this->_request->getParam('id');
        $this->_cat->deleteCategories((int)$id);
        header('location: /admin/cat');
    }
    public function deleteBrand()
    {
        $id = $this->_request->getParam('id');
        $this->_brand->delBrand((int)$id);
        header('location: /admin/brand');
    }
    public function updateCat()
    {
        $id = $this->_request->getParam('id');
        $catSelect = $this->_cat->selectCatById($id);
        $data = $catSelect;
        $this->render('admin/cateupdate', $data);
    }
    public function updateBrand($id)
    {
        $id = $this->_request->getParam('id');
        $brandSelect = $this->_brand->selectBrandById($id);
        $data = [
            "brand" => $brandSelect
        ];

        $this->render('admin/brandupdate', $data);
    }

    public function postUpdateCat()
    {
        $id = (int)$_POST['id'] ?? '';
        $name = $_POST['catName'] ?? '';
        $state = $_POST['state'] ? 1 : 0;
        $this->_cat->updateCat($id, $name, $state);
        header("Location: /admin/cat");
    }
    public function postUpdateBrand()
    {
        $id = (int)$_POST['id'] ?? '';
        $name = $_POST['brandName'] ?? '';
        $state = $_POST['state'] ? 1 : 0;
        $this->_brand->updateBrand($id, $name, $state);
        header("Location: /admin/brand");
    }
}
