<?php


namespace App\Controllers;

use App\Core\ValidateInput;
use App\Interfaces\LoginTrait;
use App\Controllers\BaseController;
use App\Core\Helpers\SessionHelper;

class AuthController extends BaseController
{

    use LoginTrait;

    private $_validate;

    public function __construct()
    {
        $this->_validate = new ValidateInput();
    }

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
        $username = $_POST['username'];
        $password = $_POST['password'];
        if ($this->_validate->isEmpty($username)) {
            SessionHelper::setError('username', 'Username are required!');
        }
        if ($this->_validate->isEmpty($password)) {
            SessionHelper::setError('password', 'Password are required!');
        }
        if (isset($this->_validate->isValid)) {
            $checkLogin = $this->login($username, md5($password));
            var_dump(SessionHelper::getError('loginError'));
            if (!empty($checkLogin)) {
                if (isset($checkLogin['position']) && $checkLogin['position'] == 1) {
                    BaseController::set('admin', true);
                }
                BaseController::set('checkLogin', true);
                BaseController::set('user', $checkLogin);
                BaseController::set('userId', $checkLogin[0]['id']);
                return $this->render('login-success');
            } else {
                SessionHelper::setError('loginError', 'Username or Password is not true!');
            }
        }
        $data = [
            "username" => $username,
            "password" => $password,
        ];
        $this->render('login', $data);
    }
    public function postRegister()
    {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $confirm = $_POST['confirm'];
        $email = $_POST['email'];
        $name = $_POST['name'];
        if ($this->_validate->isEmpty($username)) {
            SessionHelper::setError('emptyUsername', 'Username are required!');
        }
        if ($this->_validate->isEmpty($password)) {
            SessionHelper::setError('emptyPassword', 'Password are required!');
        }
        if ($this->_validate->isEmpty($email)) {
            SessionHelper::setError('emptyEmail', 'Email are required!');
        }

        if (!empty($username) && !empty($password) && !empty($confirm) && !empty($name) && !empty($email)) {
            if (preg_match('/^(?=[a-zA-Z0-9._]{8,20}$)(?!.*[_.]{2})[^_.].*[^_.]$/', $username)) {
                if (preg_match('/^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i', $email)) {
                    if (preg_match('/^[A-Z][a-zA-Z]{3,}(?: [A-Z][a-zA-Z]*){0,2}$/i', $name)) {
                        if (preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/', $password)) {
                            if ($password == $confirm) {
                                $checkRegister = $this->register($username, $email, $name, md5($password));
                                if (!empty($checkRegister)) {
                                    $message = "<div class='text-green-700 text-center p-2 bg-green-200'>Register Successfully</div>";
                                    $data = [
                                        "message" => $message,
                                    ];
                                    return $this->render('login', $data);
                                } else {
                                    $message  = "<div class='text-red-500 text-center p-2 bg-red-200'>Register Fail!</div>";
                                }
                            } else {
                                $message  = "<div class='text-red-500 text-center p-2 bg-red-200'>Confirm password does not match!</div>";
                            }
                        } else {
                            $message  = "<div class='text-red-500 text-center p-2 bg-red-200'>Password is not valid!</div>";
                        }
                    } else {
                        $message  = "<div class='text-red-500 text-center p-2 bg-red-200'>Full Name is not valid!</div>";
                    }
                } else {
                    $message  = "<div class='text-red-500 text-center p-2 bg-red-200'>Email is not valid!</div>";
                }
            } else {
                $message  = "<div class='text-red-500 text-center p-2 bg-red-200'>Username is not valid!</div>";
            }
        } else {
            $message = "<div class='text-red-500 text-center p-2 bg-red-200'>All Fields Are Required!</div>";
        }
        $data = [
            "values" => [
                "username" =>  $username,
                "name" =>  $name,
                "email" => $email,
                "password" => $password,
                "confirm" => $confirm
            ],
            "message" => $message
        ];
        $this->render('register', $data);
    }

    public function getLogout()
    {
        BaseController::destroy();
    }
}
