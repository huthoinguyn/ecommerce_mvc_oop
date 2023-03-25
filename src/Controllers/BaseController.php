<?php

namespace App\Controllers;

use Exception;


class BaseController
{
    protected function render($view, $data = [])
    {
        // xác định đường dẫn tới file view
        $viewPath = __DIR__ . '/../Views/' . $view . '.php';

        // kiểm tra file view có tồn tại không
        if (!file_exists($viewPath)) {
            throw new Exception('Không tìm thấy view.');
        }

        // truyền dữ liệu vào file view
        extract($data);

        // tải nội dung của file view
        ob_start();
        include $viewPath;
        $content = ob_get_clean();

        // hiển thị nội dung của file view
        echo $content;
    }
    public function validation($data)
    {
        $data = trim($data);
        $data = stripcslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    public function textShorten($text, $limit = 400)
    {
        $text = $text . " ";
        $text = substr($text, 0, $limit);
        $text = substr($text, 0, strrpos($text, ' '));
        $text = $text . ".....";
        return $text;
    }
    public function formatDate($date)
    {
        return date('F j, Y, g:i a', strtotime($date));
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
            header("Location: /");
        }
    }
    public static function checkAdmin()
    {
        // self::init();
        if (self::get("admin") == false) {
            self::destroy();
            header("Location: /notfound");
        }
    }

    public static function checkLogin()
    {
        // self::init();
        if (self::get("userLogin") == true) {
            header("Location: /");
        }
    }

    public static function destroy()
    {
        session_destroy();
        header("Location: /login");
    }
}
