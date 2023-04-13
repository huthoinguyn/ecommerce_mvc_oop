<?php

namespace App\Models;

use App\Models\BaseModel;
use App\Models\DeleteException;

/**
 * Summary of Products
 */
class Users extends BaseModel
{

    // ghi đè method và cả (thuộc tính) của class cha
    protected $table = "tbl_user";

    public function addUser($data)
    {
        return $this->createData($this->table, $data);
    }
    public function viewUser($fields, $conditions, $order, $limit)
    {
        return $this->readData($this->table, $fields, $conditions, $order, $limit);
    }
    public function checkUsernameExist($username)
    {
        $fields = ['username', 'code'];
        $conditions = [
            'username' => $username
        ];
        $order = '';
        $limit = 1;
        return $this->readData($this->table, $fields, $conditions, $order, $limit);
    }
    public function activeAccount($username)
    {
        $data = [
            'status' => 1,
            'code' => ''
        ];
        $conditions = [
            'username' => $username,
        ];

        return $this->updateData($this->table, $data, $conditions);
    }
}
