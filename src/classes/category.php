<?php

$filepath = realpath(dirname(__FILE__));
include_once $filepath . "/../lib/database.php";
include_once $filepath . "/../helpers/format.php";

class category
{
    private $db;
    private $fm;
    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function insert_category($catName, $state)
    {
        $catName = $this->fm->validation($catName);

        $catName = mysqli_real_escape_string($this->db->link, $catName);
        $state = mysqli_real_escape_string($this->db->link, $state);
        if (empty($catName)) {
            $alert = "<span class='text-red-600'>Category must be not empty</span>";
            return $alert;
        } else {
            $query = "INSERT INTO tbl_category(name,state) VALUES('" . $catName . "','" . $state . "')";
            $result = $this->db->insert($query);
            if ($result) {
                $alert = "<span class='text-green-700'>Add category successfully</span>";
                return $alert;
            } else {
                $alert = "<span class='text-red-600'>Add category not success</span>";
                return $alert;
            }
        }
    }

    public function show_category()
    {
        $query = "SELECT * FROM tbl_category ORDER BY id DESC";
        $result = $this->db->select($query);
        return $result;
    }

    public function select_cat_by_id($catId)
    {
        $query = "SELECT * FROM tbl_category WHERE id = '" . $catId . "' LIMIT 1";
        $result = $this->db->select($query);
        return $result;
    }

    public function update_category($catName, $state, $catId)
    {
        $catName = $this->fm->validation($catName);

        $catName = mysqli_real_escape_string($this->db->link, $catName);
        $state = mysqli_real_escape_string($this->db->link, $state);
        $catId = mysqli_real_escape_string($this->db->link, $catId);
        if (empty($catName)) {
            $alert = "<span class='text-red-600'>Category must be not empty</span>";
            return $alert;
        } else {
            $query = "UPDATE tbl_category SET name = '" . $catName . "', state = '" . $state . "' WHERE id = '" . $catId . "' LIMIT 1";
            $result = $this->db->update($query);
            if ($result) {
                $alert = "<span class='text-green-700'>update category successfully</span>";
                return $alert;
            } else {
                $alert = "<span class='text-red-600'>Update category not success</span>";
                return $alert;
            }
        }
    }

    public function del_category($delId)
    {
        $query = "DELETE FROM tbl_category WHERE id = '" . $delId . "' LIMIT 1";
        $result = $this->db->delete($query);
        if ($result) {
            $alert = "<span class='text-green-700'>Delete category successfully</span>";
            return $alert;
        } else {
            $alert = "<span class='text-red-600'>Delete category not success</span>";
            return $alert;
        }
    }
}
