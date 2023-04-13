<?php


namespace App\Controllers;

use App\Core\Helpers\MailerHelper;
use App\Core\Request;
use App\Core\ValidateInput;
use App\Interfaces\LoginTrait;
use App\Controllers\BaseController;
use App\Core\Helpers\SessionHelper;
use App\Models\Users;

class AuthController extends BaseController
{

    use LoginTrait;

    private $_validate;
    private $_mail;
    private $_user;
    private $_request;

    public function __construct()
    {
        $this->_validate = new ValidateInput();
        $this->_mail = new MailerHelper();
        $this->_user = new Users();
        $this->_request = new Request();
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
        if ($this->_validate->isValid) {
            $checkLogin = $this->login($username, md5($password));
            if (!empty($checkLogin)) {
                if (isset($checkLogin['position']) && $checkLogin['position'] == 1) {
                    SessionHelper::set('admin', true);
                }
                SessionHelper::set('checkLogin', true);
                SessionHelper::set('user', $checkLogin);
                SessionHelper::set('userId', $checkLogin[0]['id']);
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
        $fullname = $_POST['name'];
        if (!$this->_validate->isEmpty($username)) {
            if ($this->_validate->isValidUsername($username)) {
                $usernameExist = $this->_user->checkUsernameExist($username);
                if (!empty($usernameExist)) {
                    $this->_validate->isValid = false;
                    SessionHelper::setError('username', 'Username is already exist!');
                }
            } else {
                SessionHelper::setError('username', 'Username is unvalid!');
            }
        } else {
            SessionHelper::setError('username', 'Username is required!');
        }
        if (!$this->_validate->isEmpty($password)) {
            if (!$this->_validate->isValidPassword($password)) {
                SessionHelper::setError('password', 'Password is unvalid!');
            }
        } else {
            SessionHelper::setError('password', 'Password are required!');
        }
        if (!$this->_validate->isEmpty($confirm)) {
            if (!$this->_validate->matchPassword($password, $confirm)) {
                SessionHelper::setError('cfpassword', 'Confirm password is not matches!');
            }
        } else {
            SessionHelper::setError('cfpassword', 'Confirm password are required!');
        }
        if (!$this->_validate->isEmpty($email)) {
            if (!$this->_validate->isValidEmail($email)) {
                SessionHelper::setError('email', 'Email is unvalid!');
            }
        } else {
            SessionHelper::setError('email', 'Email are required!');
        }
        if (!$this->_validate->isEmpty($fullname)) {
            if (!$this->_validate->isValidfullname($fullname)) {
                SessionHelper::setError('fullname', 'Fullname is unvalid!');
            }
        } else {
            SessionHelper::setError('fullname', 'Fullname are required!');
        }
        if ($this->_validate->isValid) {
            $code = rand(100000, 999999);
            $checkRegister = $this->register($username, $email, $fullname, md5($password), $code);
            if (!empty($checkRegister)) {
                $this->_mail->recipients([], [$email => $fullname]);
                $this->_mail->content('Active Your Account', 'Your activation code is: <strong>' . $code . '</strong> <br/> Or  visit the link below to activate your account: <br/> <a href="' . $_SERVER['HTTP_HOST'] . '/verify-account?username=' . $username . '">T-store/verify-account</a>');
                $this->_mail->send();
                SessionHelper::setSuccess('register', "<div class='text-green-700 text-center p-2 bg-green-200'>Register Successfully. We already sent activation code to <strong>" . $email . "</strong></div>");
                SessionHelper::setSuccess('username', $username);
                header('location: /active-account');
            }
        }
        $data = [
            "values" => [
                "username" =>  $username,
                "name" =>  $fullname,
                "email" => $email,
                "password" => $password,
                "confirm" => $confirm
            ],
            // "message" => $message
        ];
        $this->render('register', $data);
    }

    public function getLogout()
    {
        SessionHelper::destroy();
    }

    public function getActive($username = '')
    {
        $data = [
            'username' => $username
        ];
        $this->render('active-account', $data);
    }
    public function postActive()
    {
        $activeCode = $_POST['activeCode'];
        $username = $_POST['username'];
        if ($this->_validate->isEmpty($activeCode)) {
            SessionHelper::setError('activeCode', 'Active code are required!');
        }
        if ($this->_validate->isValid) {
            $code = $this->_user->checkUsernameExist($username)[0]['code'];
            if ($activeCode == $code) {
                $updateAcc = $this->_user->activeAccount($username);
                if (!empty($updateAcc)) {
                    SessionHelper::setSuccess('login', "<div class='text-green-700 text-center p-2 bg-green-200'>Your Account Is Activated. Please login to continue shopping.</div>");
                    unset($_SESSION['active']['username']);
                    header('location: /login');
                }
            } else {
                SessionHelper::setError('active', "<div class='text-red-500 text-center p-2 bg-red-200'>Active Code is not true!</div>");
                $this->getActive($username);
            }
        } else {
            header('location: /active-account');
        }
    }

    public function verifyAccount()
    {
        $username = $this->_request->getParam('username');
        // $password = $this->_request->getParam('password');
        if ($this->_validate->isValid) {
            $updateAcc = $this->_user->activeAccount($username);
            if (!empty($updateAcc)) {
                SessionHelper::setSuccess('login', "<div class='text-green-700 text-center p-2 bg-green-200'>Your Account Is Activated. Please login to continue shopping.</div>");
                unset($_SESSION['active']['username']);
                header('location: /login');
            }
        }
    }
}
