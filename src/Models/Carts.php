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
    public function addCart($prodId, $variantId, $userId, $sId,$qty)
    {
        $data = [
            'prod_id' => $prodId,
            'variant_id' => $variantId,
            'userId' => $userId,
            'sId' => $sId,
            'quantity' => $qty,
            'created_at' => date('Y-m-d H:i:s'),
        ];
        return $this->createData($this->table, $data);
    }


    // Sửa bài đăng
    /**
     * Summary of updateCart
     * @param mixed $variantId
     * @param mixed $quantity
     * @param mixed $cartId
     * @return bool
     */
    public function updateCart($variantId, $quantity, $cartId)
    {
        $data = [
            'variant_id' => (int)$variantId,
            'quantity' => (int)$quantity,
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


    public function viewAllCart($userId, $limit = 0)
    {
        $fields = [
            'tbl_cart.id as id',
            'tbl_cart.quantity as quantity',
            'tbl_cart.prod_id as prod_id',
            'tbl_product_variant.id as variant_id',
            'tbl_product.image as image',
            'tbl_product.name as prodName',
            'tbl_product_variant.price as price',
            'tbl_product_variant.color_id as colorId',
        ];
        $inner = [
            'variant_id' => Variants::TABLE,
            'prod_id' => Products::TABLE,
        ];
        $conditions = ['userId' => $userId];
        return $this->readDatas($this->table, $fields, $inner, $conditions, '', $limit);
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

    public function checkCart($prodId, $variantId, $userId)
    {
        $fields = [
            '*'
        ];
        $conditions = [
            "prod_id" => $prodId,
            "variant_id" => $variantId,
            "userId" => $userId
        ];
        return $this->readData($this->table, $fields, $conditions, '', 1);
    }

    public function cartCount($userId)
    {
        $fields = [
            'COUNT(*) AS cartCount'
        ];

        $conditions = [
            "userId" => $userId
        ];
        return $this->readData($this->table, $fields, $conditions, '', 1);
    }

    public function cartDeleteAll($user_id){
        $conditions = [
            'userId' => $user_id
        ];
        return $this->deleteData($this->table, $conditions);
    }
}
