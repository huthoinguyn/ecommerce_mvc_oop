<?php

namespace App\Models;

use App\Models\BaseModel;
use App\Models\DeleteException;

/**
 * Summary of Products
 */
class Categories extends BaseModel
{

    // ghi đè method và cả (thuộc tính) của class cha
    protected $table = "tbl_category";

    // public static $TABLE = $this->table;
    const TABLE = 'tbl_category';

    public static function getTable (){
        return self::$table;
    }

    // Thêm bài đăng
    public function addCat($name, $state)
    {
        $data = [
            'name' => $name,
            'state' => $state,
            'created_at' => date('Y-m-d H:i:s')
        ];
        return $this->createData($this->table, $data);
    }


    // Sửa bài đăng
    public function updateCat($id, $name, $state)
    {
        $data = [
            'name' => $name,
            'state' => $state,
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
    public function deleteCategories($id)
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
    public function viewCategoryClient($fields, $order, $limit = 0)
    {
        $conditions = [
            "state" => 1
        ];
        return $this->readData($this->table, $fields, $conditions, $order, $limit);
    }
    public function viewCategoryAdmin($fields, $order, $limit = 0)
    {
        $conditions = [];
        return $this->readData($this->table, $fields, $conditions, $order, $limit);
    }

    public function selectCatById($id)
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
