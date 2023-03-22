<?php


namespace App\Controllers;

use App\Interfaces\LoginTrait;
use App\Controllers\BaseController;

class AuthController extends BaseController
{

    use LoginTrait;

    public function getLogin()
    {
        $data = [];
        $this->render('login', $data);
    }

    public function postLogin()
    {
        $username = $_POST['username'];
        $password = md5($_POST['password']);
        $checkLogin = $this->login($username, $password);
        // Xử lý sau khi đăng nhập thành công
        $data = [];
        if (isset($checkLogin)) {
            $_SESSION['checkLogin'] = true;
            $_SESSION['user'] = $checkLogin;
            $this->render('login-success', $data);
        } else {
            $this->render('login', $data);
        }
    }

    public function getLogout()
    {
        $_SESSION['checkLogin'] = false;
        unset($_SESSION['user']);
        header('Location: /');
    }
}
