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
    public function updatePost($id, $title, $content)
    {
        $data = [
            'title' => $title,
            'content' => $content,
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
    public function viewAllProducts($fields, $conditions, $limit)
    {
        // return $this->readData($this->table, $fields, $conditions, $limit);
    }

    public function showAllProd($fields, $conditions, $order, $limit)
    {
        return $this->readData($this->table, $fields, $conditions, $order, $limit);
    }
}
