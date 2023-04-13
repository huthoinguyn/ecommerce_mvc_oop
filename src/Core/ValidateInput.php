<?php

namespace App\Core;

/**
 * Validate Form ValidateInput
 * 
 */
class ValidateInput
{

    public $isValid = true;


    /**
     * Kiểm tra xem một chuỗi có rỗng hay không
     * @param mixed $input
     * @return bool
     */
    public function isEmpty($input)
    {
        $check = false;
        if (is_array($input)) {
            foreach ($input as  $i) {
                if ($i == '') {
                    $check = true;
                }
            }
            return $check;
        } else {
            if (empty(trim($input))) {
                $this->isValid = false;
                return true;
            } else {
                return false;
            }
        }
    }

    /**
     * Kiểm tra xem một chuỗi có đúng định dạng email hay không
     * @param mixed $email
     * @return bool
     */
    public function isValidEmail($email)
    {
        $email_pattern = '/^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i';
        if (!preg_match($email_pattern, $email)) {
            $this->isValid = false;
            return false;
        } else {
            return true;
        }
    }

    public function isValidUsername($username)
    {
        $username_pattern = "/^(?=[a-zA-Z0-9._]{8,20}$)(?!.*[_.]{2})[^_.].*[^_.]$/";
        if (!preg_match($username_pattern, $username)) {
            $this->isValid = false;
            return false;
        } else {
            return true;
        }
    }
    public function isValidFullname($fullname)
    {
        $fullname_pattern = "/^[A-Z][a-zA-Z]{3,}(?: [A-Z][a-zA-Z]*){0,2}$/i";
        if (!preg_match($fullname_pattern, $fullname)) {
            $this->isValid = false;
            return false;
        } else {
            return true;
        }
    }

    /**
     * Kiểm tra xem một chuỗi có đúng định dạng số điện thoại hay không
     * @param mixed $phone
     * @return bool
     */
    public function isValidPhoneNumber($phone)
    {
        $phone_pattern = "/^[0-9]{10,11}$/";
        if (!preg_match($phone_pattern, $phone)) {
            $this->isValid = false;
            return false;
        } else {
            return true;
        }
    }

    /**
     * Kiểm tra xem một chuỗi có đúng định dạng mật khẩu hay không
     * @param mixed $password
     * @return bool
     */
    public function isValidPassword($password)
    {
        $password_pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/';
        if (!preg_match($password_pattern, $password)) {
            $this->isValid = false;
            return false;
        } else {
            return true;
        }
    }
    public function matchPassword($password, $confirm)
    {
        if ($password === $confirm) {
            return true;
        } else {
            $this->isValid = false;
            return false;
        }
    }

    /**
     * Kiểm tra xem một chuỗi có độ dài tối đa và tối thiểu nào đó hay không
     * isLengthBetween
     * @param mixed $input
     * @param mixed $min
     * @param mixed $max
     * @return bool
     */
    public function isLengthBetween($input, $min, $max)
    {
        $length = strlen($input);
        if ($length < $min || $length > $max) {
            $this->isValid = false;
            return false;
        } else {
            return true;
        }
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

    public function getSuccessMessage($msg)
    {
        return "<span class='text-green-700 text-center p-2 bg-green-200'>" . $msg . "</span>";
    }
    public function getErrorMessage($msg)
    {
        return "<span class='text-red-500 text-center p-2 bg-red-200'>" . $msg . "</span>";
    }
}


// "." để so khớp bất kỳ ký tự nào, ngoại trừ ký tự xuống dòng (\n).
// "^" để so khớp bắt đầu của chuỗi.
// "$" để so khớp kết thúc của chuỗi. 
// "*" để so khớp với một ký tự hoặc một chuỗi ký tự xuất hiện từ 0 đến nhiều lần.
// "+" để so khớp với một ký tự hoặc một chuỗi ký tự xuất hiện từ 1 đến nhiều lần.
// "?" để so khớp với một ký tự hoặc một chuỗi ký tự xuất hiện từ 0 đến 1 lần.
// "[]" để chỉ định một tập hợp các ký tự cần so khớp.
// "{}" để chỉ định số lượng ký tự cần so khớp.
// "|" để so khớp với một trong các mẫu ký tự được liệt kê.
// "" để thoát ký tự đặc biệt.