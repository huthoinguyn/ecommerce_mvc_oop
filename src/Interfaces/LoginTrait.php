<?php

namespace App\Interfaces;

// use App\helpers\Format;
// use App\lib\Session;

use App\Controllers\BaseController;
use App\Models\Users;

trait LoginTrait
{
    private $fm;
    public function __construct()
    {
        // $this->fm = new Format();
    }
    public function login($username, $password)
    {
        $user = new Users();
        $field = ['id', 'username', 'name', 'password', 'position'];
        $condition = [
            "username" => $username,
            "password" => $password,
        ];
        $result = $user->viewUser($field, $condition, '', 1);
        return $result;
    }
    public function register($username, $email, $name, $password, $image = '', $status = 1, $position = 0)
    {
        $user = new Users();
        // $field = ['id', 'username', 'name', 'password'];
        $data = [
            "username" => $username,
            "email" => $email,
            "name" => $name,
            "password" => $password,
            "image" => $image,
            "status" => $status,
            "position" => $position
        ];
        $table = 'tbl_user';
        return $user->createData($table, $data);
    }

    public function logout()
    {
    }

    public function isLoggedIn()
    {
        // Kiểm tra xem người dùng đã đăng nhập hay chưa
    }
}
