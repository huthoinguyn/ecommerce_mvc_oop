<?php

$filepath = realpath(dirname(__FILE__));
include_once $filepath . "/../lib/session.php";
Session::checkLogin();
include_once $filepath . "/../lib/database.php";
include_once $filepath . "/../helpers/format.php";

class user
{
    private $db;
    private $fm;
    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function user_login($adminUser, $adminPass)
    {
        $adminUser = $this->fm->validation($adminUser);
        $adminPass = $this->fm->validation($adminPass);

        $adminUser = mysqli_real_escape_string($this->db->link, $adminUser);
        $adminPass = mysqli_real_escape_string($this->db->link, $adminPass);
        if (empty($adminUser) || empty($adminPass)) {
            $alert = "User and Password must be not empty";
            return $alert;
        } else {
            $query = "SELECT * FROM tbl_user WHERE username = '" . $adminUser . "' AND password = '" . $adminPass . "' LIMIT 1";
            $result = $this->db->select($query);
            if ($result) {
                $value = $result->fetch_assoc();
                Session::set("userLogin", true);
                Session::set("userId", $value['id']);
                Session::set("username", $value['username']);
                Session::set("name", $value['name']);
                header("Location: index.php");
            } else {
                $alert = "Username or Password is not true";
                return $alert;
            }
        }
    }
}
