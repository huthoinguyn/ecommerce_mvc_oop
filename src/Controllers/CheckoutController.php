<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Core\Helpers\SessionHelper;
use App\Controllers\Checkout\QRMomo;
use App\Core\Helpers\MailerHelper;
use App\Core\ValidateInput;
use App\Models\Carts;
use App\Models\OrderDetails;
use App\Models\Orders;
use App\Models\Products;
use App\Models\Variants;

class CheckoutController extends BaseController
{

    private $_userId;
    private $_cart;
    private $_variant;
    private $_order;
    private $_validate;
    private $_orderdetails;
    private $_mail;

    public function __construct()
    {
        $this->_userId = SessionHelper::get('userId');
        $this->_cart = new Carts();
        $this->_variant = new Variants();
        $this->_order = new Orders();
        $this->_validate = new ValidateInput();
        $this->_orderdetails = new OrderDetails();
        $this->_mail = new MailerHelper();
    }
    public function index()
    {
        $carts = $this->_cart->viewAllCart($this->_userId);
        $variants = [];
        foreach ($carts as $cart) {
            $variants[] = $this->_variant->VariantSelectById((int)$cart['variant_id']);
        }
        $data = [
            "cart" => $carts,
            "variants" => $variants,
        ];
        return $this->render('checkout', $data);
    }

    public function checkOut()
    {
        $fullname = $_POST['fullname'];
        $email = $_POST['email'];
        $address = $_POST['billing-address'] . ', ' . $_POST['billing-city'];
        $phone = $_POST['phone'];
        $note = $_POST['billing-note'] ?? '';
        $total = $_POST['total'];
        $carts = $this->_cart->viewAllCart($this->_userId);
        if (!$this->_validate->isEmpty($phone)) {
            if (!$this->_validate->isValidPhoneNumber($phone)) {
                SessionHelper::setError('phone', "Phone number is unvalid!");
            }
        } else {
            SessionHelper::setError('phone', "Phone number is required!");
        }
        if (!$this->_validate->isEmpty($_POST['billing-address'])) {
            if (!$this->_validate->isLengthBetween($_POST['billing-address'], 12, 400)) {
                SessionHelper::setError('address', 'Address is not valid!');
            }
        } else {
            SessionHelper::setError('address', 'Address is required!');
        }
        if ($this->_validate->isValid) {
            $addOrder = $this->_order->addOrder($this->_userId, $address, $phone, $note, $total);
            if (!empty($addOrder)) {
                $order_id = $this->_order->last_insert_id();
                foreach ($carts as $cart) {
                    $addOrdDetails = $this->_orderdetails->addOrderDetails((int)$order_id, $cart['prod_id'], $cart['variant_id'], $cart['quantity']);
                    if (!empty($addOrdDetails)) {
                        $this->_cart->cartDeleteAll($this->_userId);
                        $this->_mail->recipients([], [$email => $fullname]);
                        $this->_mail->content('You have new order in T-Store', 'You have a new order at T-Store. View now <a href="'.$_SERVER['HTTP_HOST'].'/my-order">T-Store</a>');
                        $this->_mail->send();
                        SessionHelper::setSuccess('order', "<div class='text-green-700 text-center p-2 bg-green-200'>Add to cart successfully.</div>");
                        header('Location: /cart');
                    }
                }
            }
        }
        else{
            header('location: /checkout');
        }
    }
}

// prodName image