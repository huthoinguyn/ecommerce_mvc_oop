<?php
$filepath = realpath(dirname(__FILE__));
include_once $filepath . "/../lib/database.php";
include_once $filepath . "/../helpers/format.php";

class cart
{
    private $db;
    private $fm;
    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function add_to_cart($quantity, $prodId)
    {
        $quantity = $this->fm->validation($quantity);
        $quantity = mysqli_real_escape_string($this->db->link, $quantity);
        $prodId = mysqli_real_escape_string($this->db->link, $prodId);
        $sId = session_id();

        $query = "SELECT * FROM tbl_product WHERE id = '" . $prodId . "' LIMIT 1";
        $ps = $this->db->select($query)->fetch_assoc();
        $queryCart = "SELECT * FROM tbl_cart WHERE prodId = '" . $prodId . "' AND sId ='" . $sId . "'";
        $checkCart = $this->db->select($queryCart);
        if ($checkCart) {
            $alert = "<span class='text-red-600 font-semibold mt-2'>Product already added!</span>";
            return $alert;
        } else {
            $query2 = "INSERT INTO tbl_cart(prodId,sId,prodName,price,quantity,image) VALUES('" . $prodId . "','" . $sId . "','" . $ps['name'] . "','" . $ps['price'] . "','" . $quantity . "','" . $ps['image'] . "')";
            $result = $this->db->insert($query2);
            if ($result) {
                // $alert = "<span class='text-green-700'>Add Cart Successfully</span>";
                // return $alert;
                echo "<script>window.location = 'cart.php'</script>";
            } else {
                $alert = "<span class='text-red-600'>Add Cart not Success</span>";
                return $alert;
            }
        }
    }

    public function update_cart($quantity, $cartId)
    {
        $quantity = mysqli_real_escape_string($this->db->link, $quantity);
        $cartId = mysqli_real_escape_string($this->db->link, $cartId);
        if ($quantity == 0) {
            $this->del_cart($cartId);
        } else {
            $query = "UPDATE tbl_cart SET quantity = '" . $quantity . "' WHERE id = '" . $cartId . "' LIMIT 1";
            $result = $this->db->update($query);
            if ($result) {
                $alert = "<span class='text-green-700'>Update Cart successfully</span>";
                return $alert;
            } else {
                $alert = "<span class='text-red-600'>Update Cart not success</span>";
                return $alert;
            }
        }
    }

    public function show_cart()
    {
        $sId = session_id();
        $query = "SELECT * FROM tbl_cart WHERE sId = '" . $sId . "'";
        $result = $this->db->select($query);
        return $result;
    }
    public function cart_count()
    {
        $sId = session_id();
        $query = "SELECT COUNT(*) AS cartCount FROM tbl_cart WHERE sId = '" . $sId . "'";
        $result = $this->db->select($query);
        return $result;
    }
    public function del_cart($cartId)
    {
        $query = "DELETE FROM tbl_cart WHERE id = '" . $cartId . "' LIMIT 1";
        $result = $this->db->delete($query);
        if ($result) {
            $alert = "<span class='text-green-700'>Delete Successfully</span>";
            return $alert;
        } else {
            $alert = "<span class='text-red-600'>Delete Fail</span>";
            return $alert;
        }
    }
}
