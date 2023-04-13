<?php

namespace App\Core\Helpers;

class SessionHelper
{

    private static $_typeSuccess = 'success';

    private static $_typeError = 'error';


    public static function setError($name, $content)
    {
        $_SESSION[self::$_typeError][$name] = $content;
    }

    public static function setSuccess($name, $content)
    {
        $_SESSION[self::$_typeSuccess][$name] = $content;
    }

    public static function getError($name)
    {
        echo $_SESSION[self::$_typeError][$name] ?? '';
        unset($_SESSION[self::$_typeError][$name]);
    }

    public static function getSuccess($name)
    {
        echo $_SESSION[self::$_typeSuccess][$name] ?? '';
        unset($_SESSION[self::$_typeSuccess][$name]);
    }

    public static function saveValue($key, $value)
    {
        // return $_SESSION['old'][$key][$value];
    }

    public static function old($key)
    {
        return $_SESSION['old'][$key];
    }

    public static function init()
    {
        if (version_compare(phpversion(), '5.4.0', '<')) {
            if (session_id() == '') {
                session_start();
            }
        } else {
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
        }
    }

    public static function set($key, $val)
    {
        $_SESSION[$key] = $val;
    }

    public static function get($key)
    {
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        } else {
            return false;
        }
    }

    public static function checkSession()
    {
        // self::init();
        if (self::get("checkLogin") == false) {
            self::destroy();
            header("Location: /notfound");
        }
    }
    public static function checkAdmin()
    {
        // self::init();
        if (self::get("admin") == false) {
            self::destroy();
            return false;
        }
    }

    public static function checkLogin()
    {
        // self::init();
        if (self::get("checkLogin") == false) {
            return false;
        }
    }

    public static function destroy()
    {
        session_destroy();
        self::set('checkLogin', false);
        header("Location: /login");
    }
}
