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
                "message" => "<div class='text-red-500 text-center p-2 bg-red-200'>All Fields Are Required!</div>"
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
                BaseController::set('userId', $checkLogin[0]['id']);
                $this->render('login-success');
            } else {
                $data = [
                    "message" => "<div class='text-red-500 text-center p-2 bg-red-200'>Username or Password is not true!</div>"
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
                "message" => "<div class='text-red-500 text-center p-2 bg-red-200'>All Fields Are Required!</div>"
            ];
            $this->render('register', $data);
        } else {
            $checkRegister = $this->register($username, $email, $name, md5($password));
            if (!empty($checkRegister)) {
                $data = [
                    "message" => "<div class='text-green-700 text-center p-2 bg-green-200'>Register Successfully</div>",
                ];
                $this->render('login', $data);
            } else {
                $data = [
                    "message" => "<div class='text-red-500 text-center p-2 bg-red-200'>Register Fail!</div>"
                ];
                $this->render('register', $data);
            }
        }
    }

    public function getLogout()
    {
        BaseController::destroy();
    }
}
