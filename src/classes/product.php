<?php
$filepath = realpath(dirname(__FILE__));
include_once $filepath . "/../lib/database.php";
include_once $filepath . "/../helpers/format.php";

class product
{
    private $db;
    private $fm;
    public function __construct()
    {
        // $this->db = new Database();
        // $this->fm = new Format();
    }

    public function insert_product($data, $file)
    {

        $prodName = mysqli_real_escape_string($this->db->link, $data['prodName']);
        $category = mysqli_real_escape_string($this->db->link, $data['category']);
        $brand = mysqli_real_escape_string($this->db->link, $data['brand']);
        $description = mysqli_real_escape_string($this->db->link, $data['description']);
        $price = mysqli_real_escape_string($this->db->link, $data['price']);
        $type = mysqli_real_escape_string($this->db->link, $data['type']);

        $permited = array('jpg', 'jpeg', 'png', 'gif');
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_temp = $_FILES['image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
        $uploaded_image = 'uploads/' . $unique_image;

        if ($prodName == "" || $category == "" || $brand == "" || $description == "" || $price == "" || $type == "" || $file_name == "") {
            $alert = "<span class='text-red-600'>All fields are require</span>";
            return $alert;
        } else {
            move_uploaded_file($file_temp, $uploaded_image);
            $query = "INSERT INTO tbl_product(name,catId,brandId,description,type,price,image) VALUES('" . $prodName . "','" . $category . "','" . $brand . "','" . $description . "','" . $type . "','" . $price . "','" . $unique_image . "')";
            $result = $this->db->insert($query);
            if ($result) {
                $alert = "<span class='text-green-700'>Add product successfully</span>";
                return $alert;
            } else {
                $alert = "<span class='text-red-600'>Add product not success</span>";
                return $alert;
            }
        }
    }

    public function show_product()
    {
        $query = "SELECT p.id, p.name AS prodName,c.name AS catName, b.name AS brandName , p.price, p.type, p.image, p.description
        FROM tbl_product AS p 
        INNER JOIN tbl_category AS c ON p.catId = c.id 
        INNER JOIN tbl_brand AS b ON p.brandId = b.id
        ORDER BY p.id DESC";
        $result = $this->db->select($query);
        return $result;
    }

    public function select_product_by_id($prodId)
    {
        $query = "SELECT * FROM tbl_product WHERE id = '" . $prodId . "' LIMIT 1";
        $result = $this->db->select($query);
        return $result;
    }
    public function show_product_by_cat($catId)
    {
        $query = "SELECT * FROM tbl_product WHERE catId = '" . $catId . "' ORDER BY id DESC";
        $result = $this->db->select($query);
        return $result;
    }
    public function product_details($prodId)
    {
        $query = "SELECT p.id, p.name AS prodName,c.name AS catName, b.name AS brandName , p.price, p.type, p.image, p.description, c.id AS catId
        FROM tbl_product AS p 
        INNER JOIN tbl_category AS c ON p.catId = c.id 
        INNER JOIN tbl_brand AS b ON p.brandId = b.id
        WHERE p.id = '" . $prodId . "' LIMIT 1";
        $result = $this->db->select($query);
        return $result;
    }



    public function update_product($data, $files, $id)
    {

        $prodName = mysqli_real_escape_string($this->db->link, $data['prodName']);
        $category = mysqli_real_escape_string($this->db->link, $data['category']);
        $brand = mysqli_real_escape_string($this->db->link, $data['brand']);
        $description = mysqli_real_escape_string($this->db->link, $data['description']);
        $price = mysqli_real_escape_string($this->db->link, $data['price']);
        $type = mysqli_real_escape_string($this->db->link, $data['type']);

        $permited = array('jpg', 'jpeg', 'png', 'gif');
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_temp = $_FILES['image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
        $uploaded_image = 'uploads/' . $unique_image;

        if ($prodName == "" || $category == "" || $brand == "" || $description == "" || $price == "" || $type == "") {
            $alert = "<span class='text-red-600'>All fields are require</span>";
            return $alert;
        } else {
            if (!empty($file_name)) {
                if ($file_size > 1048567) {
                    $alert =  "<span class='text-red-600'>Image size should be less then 10MB!</span>";
                    return $alert;
                } else if (in_array($file_ext, $permited) === false) {

                    $alert = "<span class='text-red-600'>You can upload only:" . implode(',', $permited) . "</span>";
                    return $alert;
                }
                $query = "UPDATE tbl_product SET name = '" . $prodName . "', catId = '" . $category . "', brandId = '" . $brand . "',description = '" . $description . "',type = '" . $type . "',price = '" . $price . "', image = '" . $unique_image . "' WHERE id = '" . $id . "' LIMIT 1";
                move_uploaded_file($file_temp, $uploaded_image);
            } else {
                $query = "UPDATE tbl_product SET name = '" . $prodName . "', catId = '" . $category . "', brandId = '" . $brand . "',description = '" . $description . "',type = '" . $type . "',price = '" . $price . "' WHERE id = '" . $id . "' LIMIT 1";
            }
            $result = $this->db->update($query);
            if ($result) {
                $alert = "<span class='text-green-700'>update product successfully</span>";
                return $alert;
            } else {
                $alert = "<span class='text-red-600'>Update product not success</span>";
                return $alert;
            }
        }
    }

    public function del_product($prodId)
    {
        $query = "DELETE FROM tbl_product WHERE id = '" . $prodId . "' LIMIT 1";
        $result = $this->db->delete($query);
        if ($result) {
            $alert = "<span class='text-green-700'>Delete product successfully</span>";
            return $alert;
        } else {
            $alert = "<span class='text-red-600'>Delete product not success</span>";
            return $alert;
        }
    }

    public function show_feature_product()
    {
        $query = "SELECT * FROM tbl_product WHERE type = 1 ORDER BY id DESC";
        $result = $this->db->select($query);
        return $result;
    }
    public function show_new_product()
    {
        $query = "SELECT * FROM tbl_product ORDER BY id DESC LIMIT 4";
        $result = $this->db->select($query);
        return $result;
    }
}
