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
        $cats = $cat->viewCategoryClient(['id', 'name', 'state'], '', 0);
        $brand = new Brands();
        $brands = $brand->viewBrandClient(['id', 'name', 'state'], '', 0);
        $prods = $pd->viewProducts(['id', 'name', 'price', 'image', 'description', 'catId', 'brandId', 'type'], [], 'id ASC', 0);
        $data = [
            "prods" => $prods,
            "cats" => $cats,
            "brands" => $brands,
        ];
        return $this->render('shop', $data);
    }

    public function getProd()
    {
        $prod = new Products();
        $prodList = $prod->viewProducts(['id', 'name', 'catId', 'brandId', 'price', 'image', 'description', 'type'], [], '', 0);
        $data = $prodList;
        $this->render('admin/product', $data);
    }

    public function showDetails($id)
    {
        $pd = new Products();
        $conditions = ["id" => $id['id']];
        $fields = ['name', 'price', 'image', 'description'];
        $prodDetails = $pd->viewProducts($fields, $conditions, '', 1);
        $data = [
            "details" => $prodDetails
        ];
        return $this->render('details', $data);
    }

    public function addProd()
    {
        $cat = new Categories();
        $catList = $cat->viewCategoryAdmin(['id', 'name'], '', 0);
        $brand = new Brands();
        $brandList = $brand->viewBrandClient(['id', 'name'], '', 0);
        $data = [
            "cats" => $catList,
            "brands" => $brandList,
        ];
        $this->render('admin/addProd', $data);
    }
    public function postProd()
    {
        $pd = new Products();
        $name = $_POST['prodName'];
        $price = $_POST['price'];
        $catId = (int)$_POST['category'];
        $brandId = (int)$_POST['brand'];
        $description = $_POST['description'];
        $type = isset($_POST['type']) ? 1 : 0;

        $permited = array('jpg', 'jpeg', 'png', 'gif');
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_temp = $_FILES['image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
        $uploaded_image = 'src/uploads/' . $unique_image;

        move_uploaded_file($file_temp, $uploaded_image);

        // var_dump()
        $addProd = $pd->addProducts($name, $catId, $brandId, $description, $type, $price, $unique_image);
        if (isset($addProd)) {
            header("Location: /admin/prod");
        } else {
            header("Location: /admin/addprod");
        }
    }

    public function deleteProd($id)
    {
        $prod = new Products();
        $prod->deleteProd((int)$id['id']);
        header('Location: /admin/prod');
    }
}
