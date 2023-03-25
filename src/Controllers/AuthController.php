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
    public function getRegister()
    {
        $data = [];
        $this->render('register', $data);
    }

    public function postLogin()
    {
        $data = [];
        $username = $this->validation($_POST['username']);
        $password = $this->validation($_POST['password']);
        if (empty($username) || empty($password)) {
            $data = [
                "message" => "<span class='text-red-500'>All fields are required</span>"
            ];
            $this->render('login', $data);
        } else {
            $checkLogin = $this->login($username, md5($password));
            if (!empty($checkLogin)) {
                if (isset($checkLogin['position']) && $checkLogin['position'] == 1) {
                    BaseController::set('admin', true);
                }
                BaseController::set('checkLogin', true);
                BaseController::set('user', $checkLogin);
                $this->render('login-success');
            } else {
                $data = [
                    "message" => "<span class='text-red-500'>Username or Password is not true</span>"
                ];
                $this->render('login', $data);
            }
        }
    }
    public function postRegister()
    {
        $username = $this->validation($_POST['username']);
        $password = $this->validation($_POST['password']);
        $email = $this->validation($_POST['email']);
        $name = $this->validation($_POST['name']);
        if (empty($username) || empty($password) || empty($name) || empty($email)) {
            $data = [
                "message" => "<span class='text-red-500'>All fields are required</span>"
            ];
            $this->render('register', $data);
        } else {
            $checkRegister = $this->register($username, $email, $name, md5($password));
            if (!empty($checkRegister)) {

                $this->render('login');
            } else {
                $data = [
                    "message" => "<span class='text-red-500'>Register Fail</span>"
                ];
                $this->render('register', $data);
            }
        }
    }

    public function getLogout()
    {
        $_SESSION['checkLogin'] = false;
        unset($_SESSION['user']);
        header('Location: /');
    }
}
