<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Core\Helpers\SessionHelper;
use App\Core\Request;
use App\Core\Upload;
use App\Core\ValidateInput;
use App\Models\Brands;
use App\Models\Categories;
use App\Models\Colors;
use App\Models\Products;
use App\Models\Variants;

/**
 * Summary of ProductController
 */
class ProductController extends BaseController
{
    private $cat;
    private $brand;
    private $pd;

    private $_validate;
    private $_variant;
    private $_color;
    private $_request;

    public function __construct()
    {
        $this->cat = new Categories();
        $this->brand = new Brands();
        $this->pd = new Products();
        $this->_validate = new ValidateInput();
        $this->_variant = new Variants();
        $this->_color = new Colors();
        $this->_request = new Request();
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
        $fields = [
            'tbl_product.id as id',
            'tbl_product.name as name',
            'tbl_product.price as price',
            'tbl_product.image as image',
            'tbl_product.description as description',
            'tbl_product.type as type',
            'tbl_category.name as catName',
            'tbl_brand.name as brandName',
        ];

        $inner = [
            'catId' => Categories::TABLE,
            'brandId' => Brands::TABLE,
        ];
        $prodList = $this->pd->viewAllProducts($fields, $inner, [], '', 0);
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
    public function prodSelectByBrand()
    {
        $id = $this->_request->getParam('id');
        $cats = $this->cat->viewCategoryClient(['id', 'name', 'state'], '', 0);
        $brands = $this->brand->viewBrandClient(['id', 'name', 'state'], '', 0);
        $prods = $this->pd->viewProducts(['*'], ['brandId' => (int)$id], 'id ASC', 0);
        $data = [
            "prods" => $prods,
            "cats" => $cats,
            "brands" => $brands,
        ];
        return $this->render('shop', $data);
    }

    /**
     * Summary of showDetails
     * @param mixed $id
     * @return void
     */
    public function showDetails()
    {
        $id = $this->_request->getParam('id');
        $prodDetails = $this->pd->prodSelectById((int)$id);
        $data = [
            "details" => $prodDetails
        ];
        return $this->render('details', $data);
    }

    public function addProd()
    {
        $catList = $this->cat->viewCategoryClient(['id', 'name'], '', 0);
        $brandList = $this->brand->viewBrandClient(['id', 'name'], '', 0);
        $colorList = $this->_color->viewAllColors(['id', 'color'], '', 0);
        $data = [
            "cats" => $catList,
            "brands" => $brandList,
            "colors" => $colorList
        ];
        $this->render('admin/addProd', $data);
    }
    public function postProd()
    {
        $catList = $this->cat->viewCategoryClient(['id', 'name'], '', 0);
        $brandList = $this->brand->viewBrandClient(['id', 'name'], '', 0);
        $name = $_POST['prodName'];
        $price = $_POST['price'];
        $priceVariant[] = $_POST['price_variant'] ?? [];
        $color[] = $_POST['color'] ?? [];
        $quantity[] = $_POST['quantity'] ?? [];
        $catId = (int)$_POST['category'] ?? [];
        $brandId = (int)$_POST['brand'];
        $description = $_POST['description'];
        $type = $_POST['type'];
        $file = $_FILES['image'];
        $file_name = $_FILES['image']['name'];
        if ($this->_validate->isEmpty([$name, $catId, $brandId, $description, $price, $type, $file_name])) {
            $message = $this->_validate->getErrorMessage('All fields are required!');
        } else {
            $fileUpload = new Upload($file);
            if ($fileUpload->uploadFile()) {
                $addProd = $this->pd->addProducts($name, $catId, $brandId, $description, (int)$type, $price, $fileUpload->getTargetFile());
                $prodId = $this->pd->last_insert_id();
                if (!empty($priceVariant[0])) {
                    foreach ($priceVariant[0] as $key => $value) {
                        $this->_variant->insertVariant((int)$prodId[0]['id'], $catId, $brandId, $color[0][$key], $priceVariant[0][$key],  $quantity[0][$key]);
                    }
                }
                if (!empty($addProd)) {
                    header("Location: /admin/prod");
                } else {
                    header("Location: /admin/addprod");
                }
            } else {
                $message = $this->_validate->getErrorMessage($fileUpload->getErrors());
            }
        }
        $data = [
            "cats" => $catList,
            "brands" => $brandList,
            "message" => $message
        ];
        $this->render('admin/addProd', $data);
    }


    /**
     * Summary of updateProd
     * @param mixed $id
     * @return void
     */
    public function updateProd()
    {
        $id = $this->_request->getParam('id');
        $cats = $this->cat->viewCategoryClient(['id', 'name'], '', 0);
        $brands = $this->brand->viewBrandClient(['id', 'name'], '', 0);
        $prodSelectById = $this->pd->prodSelectById((int)$id);
        $variants = $this->_variant->prodSelectById((int)$id);
        $colorList = $this->_color->viewAllColors(['id', 'color'], '', 0);
        $data = [
            "prod" => $prodSelectById,
            "cat" => $cats,
            "brand" => $brands,
            "variants" => $variants,
            "colors" => $colorList
        ];
        $this->render('admin/productupdate', $data);
    }
    public function postUpdateProd()
    {
        $id = (int)$_POST['id'];
        $name = $_POST['prodName'];
        $price = $_POST['price'];
        $catId = (int)$_POST['category'];
        $brandId = (int)$_POST['brand'];
        $description = $_POST['description'];
        $type = $_POST['type'];
        $file = $_FILES['image'];

        $file_name = $file['name'];
        if ($this->_validate->isEmpty([$name, $catId, $brandId, $description, $price, $type])) {
            SessionHelper::setError('updateProd', 'All field are required!');
        } else {
            if (!empty($file_name)) {
                $fileUpload = new Upload($file);
                if ($fileUpload->uploadFile()) {
                    $updateProd = $this->pd->updateProd($id, $name, $catId, $brandId, $description, (int)$type, $price, $fileUpload->getTargetFile());
                } else {
                    SessionHelper::setError('image', $this->_validate->getErrorMessage($fileUpload->getErrors()));
                }
            } else {
                $updateProd = $this->pd->updateProdnonImage($id, $name, $catId, $brandId, $description, $type, $price);
            }
        }
        if (!empty($updateProd)) {
            header("Location: /admin/prod");
        } else {
            header("Location: /admin/updateprod/" . $id);
        }
    }
    public function deleteProd()
    {
        $id = $this->_request->getParam('id');
        $this->pd->deleteProd((int)$id);
        header('Location: /admin/prod');
    }

    public function getAllProd()
    {
        $fields = [
            'tbl_product.id as id',
            'tbl_product.name as name',
            'tbl_product.price as price',
            'tbl_product.image as image',
            'tbl_product.type as type',
            'tbl_category.name as catName',
            'tbl_brand.name as brandName',
        ];

        $inner = [
            'catId' => Categories::TABLE,
            'brandId' => Brands::TABLE,
        ];
        $prodList = $this->pd->viewAllProducts($fields, $inner, [], '', 0);
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($prodList);
    }
}
