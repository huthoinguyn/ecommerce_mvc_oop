<?php

namespace App\Controllers;

use Exception;


class BaseController
{
    protected function render($view, $data = [])
    {
        // xác định đường dẫn tới file view
        $viewPath = __DIR__ . '/../views/' . $view . '.php';

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
}
