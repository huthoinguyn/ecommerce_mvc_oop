<?php

namespace App\Models;

use App\Models\BaseModel;
use App\Models\DeleteException;

/**
 * Summary of Products
 */
class Colors extends BaseModel
{

    // ghi đè method và cả (thuộc tính) của class cha
    protected $table = "tbl_color";

    // public static $TABLE = $this->table;
    const TABLE = 'tbl_color';

    public static function getTable()
    {
        return self::$table;
    }
    public function viewAllColors($fields, $order, $limit = 0)
    {
        $conditions = [
            // "state" => 1
        ];
        return $this->readData($this->table, $fields, $conditions, $order, $limit);
    }
}
