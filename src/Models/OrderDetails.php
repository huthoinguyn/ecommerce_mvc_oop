<?php

namespace App\Models;

use App\Models\BaseModel;
use App\Models\DeleteException;

/**
 * Summary of Products
 */
class OrderDetails extends BaseModel
{

    // ghi đè method và cả (thuộc tính) của class cha
    protected $table = "tbl_order_details";

    const TABLE = 'tbl_order_details';

    public function getTable()
    {
        return self::$table;
    }

    // Thêm bài đăng
    public function addOrderDetails($order_id, $prod_id, $variant_id, $quantity)
    {
        $data = [
            'order_id' => $order_id,
            'prod_id' => $prod_id,
            'variant_id' => $variant_id,
            'quantity' => $quantity,
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
    public function delOrder($id)
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
    public function viewOrderClient($fields, $order, $limit = 0)
    {
        $conditions = [
            "state" => 1
        ];
        return $this->readData($this->table, $fields, $conditions, $order, $limit);
    }
    public function viewOrderAdmin($fields, $order, $limit = 0)
    {
        $conditions = [];
        return $this->readData($this->table, $fields, $conditions, $order, $limit);
    }

    public function selectOrderById($id)
    {
        $fields = [
            'id', 'name', 'state'
        ];
        $conditions = [
            "id" => $id
        ];
        return $this->readData($this->table, $fields, $conditions, '', 1);
    }
}
