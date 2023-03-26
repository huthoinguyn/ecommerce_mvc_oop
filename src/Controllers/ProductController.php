<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Brands;
use App\Models\Categories;
use App\Models\Products;

/**
 * Summary of ProductController
 */
class ProductController extends BaseController
{
    private $cat;
    private $brand;
    private $pd;

    public function __construct()
    {
        $this->cat = new Categories();
        $this->brand = new Brands();
        $this->pd = new Products();
    }
    public function index()
    {
        $cats = $this->cat->viewCategoryClient(['id', 'name', 'state'], '', 0);
        $brands = $this->brand->viewBrandClient(['id', 'name', 'state'], '', 0);
        $prods = $this->pd->viewProducts(['id', 'name', 'price', 'image', 'description', 'catId', 'brandId', 'type'], [], 'id ASC', 0);
        $data = [
            "prods" => $prods,
            "cats" => $cats,
            "brands" => $brands,
        ];
        return $this->render('shop', $data);
    }

    public function getProd()
    {
        $prodList = $this->pd->viewProducts(['id', 'name', 'catId', 'brandId', 'price', 'image', 'description', 'type'], [], '', 0);
        $data = $prodList;
        $this->render('admin/product', $data);
    }

    public function prodSelectByCat($id)
    {
        $cats = $this->cat->viewCategoryClient(['id', 'name', 'state'], '', 0);
        $brands = $this->brand->viewBrandClient(['id', 'name', 'state'], '', 0);
        $prods = $this->pd->viewProducts(['*'], ['catId' => (int)$id['id']], 'id ASC', 0);
        $data = [
            "prods" => $prods,
            "cats" => $cats,
            "brands" => $brands,
        ];
        return $this->render('shop', $data);
    }
    public function prodSelectByBrand($id)
    {
        $cats = $this->cat->viewCategoryClient(['id', 'name', 'state'], '', 0);
        $brands = $this->brand->viewBrandClient(['id', 'name', 'state'], '', 0);
        $prods = $this->pd->viewProducts(['*'], ['brandId' => (int)$id['id']], 'id ASC', 0);
        $data = [
            "prods" => $prods,
            "cats" => $cats,
            "brands" => $brands,
        ];
        return $this->render('shop', $data);
    }

    public function showDetails($id)
    {
        $conditions = ["id" => $id['id']];
        $fields = ['*'];
        $prodDetails = $this->pd->viewProducts($fields, $conditions, '', 1);
        $data = [
            "details" => $prodDetails
        ];
        return $this->render('details', $data);
    }

    public function addProd()
    {
        $catList = $this->cat->viewCategoryAdmin(['id', 'name'], '', 0);
        $brandList = $this->brand->viewBrandClient(['id', 'name'], '', 0);
        $data = [
            "cats" => $catList,
            "brands" => $brandList,
        ];
        $this->render('admin/addProd', $data);
    }
    public function postProd()
    {
        $catList = $this->cat->viewCategoryClient(['id', 'name'], '', 0);
        $brandList = $this->brand->viewBrandClient(['id', 'name'], '', 0);
        $name = $_POST['prodName'];
        $price = $_POST['price'];
        $catId = (int)$_POST['category'];
        $brandId = (int)$_POST['brand'];
        $description = $_POST['description'];
        $type = $_POST['type'];

        $permited = array('jpg', 'jpeg', 'png', 'gif', 'webp');
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_temp = $_FILES['image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
        $uploaded_image = 'src/uploads/' . $unique_image;
        if ($name == "" || $catId == "" || $brandId == "" || $description == "" || $price == "" || $type == "" || $file_name == "") {
            $data = [
                "cats" => $catList,
                "brands" => $brandList,
                "message" => "<span class='text-red-600'>All fields are require</span>"
            ];
            $this->render('admin/addProd', $data);
        } else {
            if ($file_size > 1048567) {
                $data = [
                    "cats" => $catList,
                    "brands" => $brandList,
                    "message" => "<span class='text-red-600'>Image size should be less than 10MB!</span>"
                ];
                $this->render('admin/addProd', $data);
            } else if (in_array($file_ext, $permited) === false) {
                $data = [
                    "cats" => $catList,
                    "brands" => $brandList,
                    "message" => "<span class='text-red-600'>You can upload only:" . implode(',', $permited) . "</span>"
                ];
                $this->render('admin/addProd', $data);
            } else {
                move_uploaded_file($file_temp, $uploaded_image);

                // var_dump()
                $addProd = $this->pd->addProducts($name, $catId, $brandId, $description, (int)$type, $price, $unique_image);
                if (!empty($addProd)) {
                    header("Location: /admin/prod");
                } else {
                    header("Location: /admin/addprod");
                }
            }
        }
    }


    /**
     * Summary of updateProd
     * @param mixed $id
     * @return void
     */
    public function updateProd($id)
    {
        $cats = $this->cat->viewCategoryClient(['id', 'name'], '', 0);
        $brands = $this->brand->viewBrandClient(['id', 'name'], '', 0);
        $prodSelectById = $this->pd->prodSelectById((int)$id['id']);
        $data = [
            "prod" => $prodSelectById,
            "cat" => $cats,
            "brand" => $brands
        ];
        $this->render('admin/productupdate', $data);
    }
    public function postUpdateProd()
    {
        $catList = $this->cat->viewCategoryClient(['id', 'name'], '', 0);
        $brandList = $this->brand->viewBrandClient(['id', 'name'], '', 0);
        $id = (int)$_POST['id'];
        $name = $_POST['prodName'];
        $price = $_POST['price'];
        $catId = (int)$_POST['category'];
        $brandId = (int)$_POST['brand'];
        $description = $_POST['description'];
        $type = $_POST['type'];

        $permited = array('jpg', 'jpeg', 'png', 'gif', 'webp');
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_temp = $_FILES['image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
        $uploaded_image = 'src/uploads/' . $unique_image;
        if ($name == "" || $catId == "" || $brandId == "" || $description == "" || $price == "" || $type == "") {
            $data = [
                "cats" => $catList,
                "brands" => $brandList,
                "message" => "<span class='text-red-600'>All fields are require</span>"
            ];
            $this->render('admin/addProd', $data);
        } else {
            if (!empty($file_name)) {
                if ($file_size > 1048567) {
                    $data = [
                        "cats" => $catList,
                        "brands" => $brandList,
                        "message" => "<span class='text-red-600'>Image size should be less than 10MB!</span>"
                    ];
                    $this->render('admin/addProd', $data);
                } else if (in_array($file_ext, $permited) === false) {
                    $data = [
                        "cats" => $catList,
                        "brands" => $brandList,
                        "message" => "<span class='text-red-600'>You can upload only:" . implode(',', $permited) . "</span>"
                    ];
                    $this->render('admin/addProd', $data);
                } else {
                    move_uploaded_file($file_temp, $uploaded_image);
                    // var_dump()
                    $updateProd = $this->pd->updateProd($id, $name, $catId, $brandId, $description, (int)$type, $price, $unique_image);
                }
            } else {
                $updateProd = $this->pd->updateProdnonImage($id, $name, $catId, $brandId, $description, $type, $price);
            }
            if (!empty($updateProd)) {
                header("Location: /admin/prod");
            } else {
                header("Location: /admin/updateprod/" . $id);
            }
        }
    }
    public function deleteProd($id)
    {
        $this->pd->deleteProd((int)$id['id']);
        header('Location: /admin/prod');
    }
}
