<?php

namespace App\Models;

use Exception;

class DeleteException extends Exception{
    protected $message = "Sai kiểu dữ liệu";

    protected $code  = 500;

    public function __construct($message = "", $code = 0, Exception $previous = null){
        if($message){
            $this->message = $message;
        }

        if($code){
            $this->code = $code;
        }

        parent::__construct($this->message, $this->code, $previous);
    }

     
    public function getCustomMessage()
    {
        return 'Lỗi sai kiểu dữ liệu';
    }
}