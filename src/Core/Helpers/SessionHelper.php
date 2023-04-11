<?php

namespace App\Core\Helpers;

class SessionHelper{
    
    private static $_typeSuccess = 'success';

    private static $_typeError = 'error';


    public static function setError($name, $content){
        $_SESSION[self::$_typeError][$name] = $content;
    }

    public static function setSuccess($name, $content){
        $_SESSION[self::$_typeSuccess][$name] = $content;
    }

    public static function getError($name){
        echo $_SESSION[self::$_typeError][$name]??'';
        unset($_SESSION[self::$_typeError][$name]);
    }

    public static function getSuccess($name){
        echo $_SESSION[self::$_typeSuccess][$name]??'';
        unset($_SESSION[self::$_typeSuccess][$name]);
    }

    public static function saveValue($key, $value){
        // return $_SESSION['old'][$key][$value];
    }

    public static function old($key){
        return $_SESSION['old'][$key];
    }
}