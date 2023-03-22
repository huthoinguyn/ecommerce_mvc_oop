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
        // $username = $this->fm->validation($username);
        // $password = $this->fm->validation($password);
        $field = ['id', 'username', 'name', 'password'];
        $condition = [
            "username" => $username,
            "password" => $password,
        ];
        $result = $user->viewUser($field, $condition, '', 1);
        return $result;
    }

    public function logout($request)
    {
    }

    public function isLoggedIn()
    {
        // Kiểm tra xem người dùng đã đăng nhập hay chưa
    }
}
