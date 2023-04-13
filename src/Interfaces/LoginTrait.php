<?php

namespace App\Interfaces;

// use App\helpers\Format;
// use App\lib\Session;

use App\Controllers\BaseController;
use App\Models\Users;

trait LoginTrait
{
    // private $_user;
    public function __construct()
    {
        // 
    }
    public function login($username, $password)
    {
        $user = new Users();
        $field = ['*'];
        $condition = [
            "username" => $username,
            "password" => $password,
            "status" => 1,
        ];
        $result = $user->viewUser($field, $condition, '', 1);
        return $result;
    }
    public function active($code)
    {
        $user = new Users();
        $field = ['*'];
        $condition = [
            "code" => $code,
        ];
        $result = $user->viewUser($field, $condition, '', 1);
        return $result;
    }
    public function register($username, $email, $name, $password, $code, $image = '', $position = 0)
    {
        $user = new Users();
        $data = [
            "username" => $username,
            "email" => $email,
            "name" => $name,
            "password" => $password,
            "image" => $image,
            "status" => 0,
            "position" => $position,
            "code" => $code
        ];
        return $user->addUser($data);
    }

    public function logout()
    {
    }

    public function isLoggedIn()
    {
        // Kiểm tra xem người dùng đã đăng nhập hay chưa
    }
}
