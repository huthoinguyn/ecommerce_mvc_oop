<?php

namespace App\Models;

use App\Models\BaseModel;
use App\Models\DeleteException;

/**
 * Summary of Products
 */
class Variants extends BaseModel
{

    // ghi đè method và cả (thuộc tính) của class cha
    protected $table = "tbl_product_variant";

    // public static $TABLE = $this->table;
    const TABLE = 'tbl_product_variant';

    public static function getTable()
    {
        return self::$table;
    }

    // Thêm bài đăng
    public function insertVariant($prodId, $catId, $brandId, $color, $priceVariant, $quantity)
    {
        $data = [
            'prod_id' => $prodId,
            'cat_id' => $catId,
            'brand_id' => $brandId,
            'color_id' => $color,
            'price' => $priceVariant,
            'qty' => $quantity,
            'created_at' => date('Y-m-d H:i:s')
        ];
        return $this->createData($this->table, $data);
    }


    public function prodSelectById($id)
    {
        $fields = [
            'tbl_product_variant.id as id',
            'tbl_product.id as prodId',
            'tbl_product_variant.price as price_variant',
            'tbl_product_variant.color_id as colorId',
            'tbl_color.color as colorName',
            'tbl_product_variant.qty as qty_variant',
        ];
        
        $inner = [
            'cat_id' => Categories::TABLE,
            'brand_id' => Brands::TABLE,
            'prod_id' => Products::TABLE,
            'color_id' => Colors::TABLE
        ];
        
        $conditions = [
            $this->table . ".prod_id" => $id
        ];
        return $this->readDatas($this->table, $fields, $inner, $conditions, '', 0);
    }
    
    public function prodSelectByColor($id, $colorId)
    {
        $fields = [
            'tbl_product_variant.id as id',
            'tbl_product.id as prodId',
            'tbl_product_variant.price as price_variant',
            'tbl_product_variant.color_id as colorId',
            'tbl_color.color as colorName',
            'tbl_product_variant.qty as qty_variant',
        ];

        $inner = [
            'cat_id' => Categories::TABLE,
            'brand_id' => Brands::TABLE,
            'prod_id' => Products::TABLE,
            'color_id' => Colors::TABLE
        ];

        $conditions = [
            $this->table . ".prod_id" => $id,
            $this->table . ".color_id" => $colorId
        ];
        return $this->readDatas($this->table, $fields, $inner, $conditions, '', 0);
    }
}
