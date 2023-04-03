<?php

namespace App\Models;

use App\Models\BaseModel;
use App\Models\DeleteException;

/**
 * Summary of Products
 */
class Products extends BaseModel
{

    // ghi đè method và cả (thuộc tính) của class cha
    protected $table = "tbl_product";

    const TABLE = 'tbl_product';

    // Thêm bài đăng
    public function addProducts($name, $catId, $brandId, $description, $type, $price, $image)
    {
        $data = [
            'name' => $name,
            'catId' => $catId,
            'brandId' => $brandId,
            'description' => $description,
            'type' => $type,
            'price' => $price,
            'image' => $image,
            'created_at' => date('Y-m-d H:i:s'),
        ];

        return $this->createData($this->table, $data);
    }


    // Sửa bài đăng
    public function updateProd($id, $name, $catId, $brandId, $description, $type, $price, $image)
    {
        $data = [
            'name' => $name,
            'catId' => $catId,
            'brandId' => $brandId,
            'description' => $description,
            'type' => $type,
            'price' => $price,
            'image' => $image,
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        $conditions = [
            'id' => $id,
        ];

        return $this->updateData($this->table, $data, $conditions);
    }
    public function updateProdnonImage($id, $name, $catId, $brandId, $description, $type, $price)
    {
        $data = [
            'name' => $name,
            'catId' => $catId,
            'brandId' => $brandId,
            'description' => $description,
            'type' => $type,
            'price' => $price,
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        $conditions = [
            'id' => $id,
        ];

        return $this->updateData($this->table, $data, $conditions);
    }

    /**
     * Summary of deletePost
     * @param int $id
     * @throws DeleteException
     * @return void
     */
    public function deleteProd($id)
    {
        try {
            if (!is_integer($id)) {
                throw new DeleteException();
            }

            $conditions = [
                'id' => $id,
            ];

            return $this->deleteData($this->table, $conditions);
        } catch (DeleteException $e) {
            // xử lý 1 cái gì đó mượt mà hơn
            echo $e->getCustomMessage();
        }
    }


    // Xem bài đăng
    public function viewProducts($fields, $conditions, $order, $limit)
    {
        return $this->readData($this->table, $fields, $conditions, $order, $limit);
    }
    public function viewAllProducts($fields, $inners, $conditions, $order,  $limit)
    {
        return $this->readDatas($this->table, $fields, $inners, $conditions, $order,  $limit);
    }

    public function showAllProd($fields, $conditions, $order, $limit)
    {
        return $this->readData($this->table, $fields, $conditions, $order, $limit);
    }

    /**
     * Summary of prodSelectById
     * @param mixed $id-0
     * @return array
     */
    public function prodSelectById($id)
    {
        $fields = [
            'tbl_product.id as prodId',
            'tbl_product.name as name',
            'tbl_product.price as price',
            'tbl_product.image as image',
            'tbl_product.description as description',
            'tbl_product.type as type',
            'tbl_category.name as catName',
            'tbl_category.id as catId',
            'tbl_brand.name as brandName',
            'tbl_brand.id as brandId',
        ];

        $inner = [
            'catId' => Categories::TABLE,
            'brandId' => Brands::TABLE,
        ];

        $conditions = [
            $this->table . ".id" => $id
        ];
        return $this->readDatas($this->table, $fields, $inner, $conditions, '', 1);
    }

    public function last_insert_id()
    {
        return $this->readData($this->table, ['id'], [], '', 1);
    }
}
