<?php

$filepath = realpath(dirname(__FILE__));
include_once $filepath . "/../lib/database.php";
include_once $filepath . "/../helpers/format.php";

class brand
{
    private $db;
    private $fm;
    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function insert_brand($brandName, $state)
    {
        $brandName = $this->fm->validation($brandName);

        $brandName = mysqli_real_escape_string($this->db->link, $brandName);
        $state = mysqli_real_escape_string($this->db->link, $state);
        if (empty($brandName)) {
            $alert = "<span class='error'>brand must be not empty</span>";
            return $alert;
        } else {
            $query = "INSERT INTO tbl_brand(name,state) VALUES('" . $brandName . "','" . $state . "')";
            $result = $this->db->insert($query);
            if ($result) {
                $alert = "<span class='success'>Add brand successfully</span>";
                return $alert;
            } else {
                $alert = "<span class='error'>Add brand not success</span>";
                return $alert;
            }
        }
    }

    public function show_brand()
    {
        $query = "SELECT * FROM tbl_brand ORDER BY id DESC";
        $result = $this->db->select($query);
        return $result;
    }

    public function select_brand_by_id($brandId)
    {
        $query = "SELECT * FROM tbl_brand WHERE id = '" . $brandId . "' LIMIT 1";
        $result = $this->db->select($query);
        return $result;
    }

    public function update_brand($brandName, $state, $brandId)
    {
        $brandName = $this->fm->validation($brandName);

        $brandName = mysqli_real_escape_string($this->db->link, $brandName);
        $state = mysqli_real_escape_string($this->db->link, $state);
        $brandId = mysqli_real_escape_string($this->db->link, $brandId);
        if (empty($brandName)) {
            $alert = "<span class='error'>brand must be not empty</span>";
            return $alert;
        } else {
            $query = "UPDATE tbl_brand SET name = '" . $brandName . "' ,state = '" . $state . "' WHERE id = '" . $brandId . "' LIMIT 1";
            $result = $this->db->update($query);
            if ($result) {
                $alert = "<span class='success'>update brand successfully</span>";
                return $alert;
            } else {
                $alert = "<span class='error'>Update brand not success</span>";
                return $alert;
            }
        }
    }

    public function del_brand($delId)
    {
        $query = "DELETE FROM tbl_brand WHERE id = '" . $delId . "' LIMIT 1";
        $result = $this->db->delete($query);
        if ($result) {
            $alert = "<span class='success'>Delete brand successfully</span>";
            return $alert;
        } else {
            $alert = "<span class='error'>Delete brand not success</span>";
            return $alert;
        }
    }
}
