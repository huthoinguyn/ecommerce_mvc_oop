<?php

namespace App\Models;

use App\Models\BaseModel;
use App\Models\DeleteException;

/**
 * Summary of Carts
 */
class Carts extends BaseModel
{

    // ghi đè method và cả (thuộc tính) của class cha
    protected $table = "tbl_cart";

    // Thêm bài đăng
    public function addCart($prodId, $userId, $sId, $prodName, $prodPrice, $prodImage, $qty)
    {
        $data = [
            'prodId' => $prodId,
            'userId' => $userId,
            'sId' => $sId,
            'prodName' => $prodName,
            'price' => $prodPrice,
            'quantity' => $qty,
            'image' => $prodImage,
            'created_at' => date('Y-m-d H:i:s'),
        ];
        return $this->createData($this->table, $data);
    }


    // Sửa bài đăng
    public function updateCart($quantity, $cartId)
    {
        $data = [
            'quantity' => $quantity,
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        $conditions = [
            'id' => $cartId,
        ];

        return $this->updateData($this->table, $data, $conditions);
    }

    /**
     * Summary of deletePost
     * @param int $id
     * @throws DeleteException
     * @return void
     */
    public function delCart($id)
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


    public function viewAllCart($fields, $conditions, $order, $limit = 0)
    {
        return $this->readData($this->table, $fields, $conditions, $order, $limit);
    }

    public function selectCartById($id)
    {
        $fields = [
            'id', 'name', 'state'
        ];
        $conditions = [
            "id" => $id
        ];
        return $this->readData($this->table, $fields, $conditions, '', 1);
    }

    public function checkCart($prodId, $userId)
    {
        $fields = [
            '*'
        ];
        $conditions = [
            "prodId" => $prodId,
            "userId" => $userId
        ];
        return $this->readData($this->table, $fields, $conditions, '', 1);
    }
}
