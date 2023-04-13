<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Core\Helpers\MailerHelper;
use App\Core\Helpers\MailTemplate;
use App\Core\Helpers\SessionHelper;
use App\Core\Request;
use App\Models\Carts;
use App\Models\Colors;
use App\Models\Products;
use App\Models\Variants;

class CartController extends BaseController
{

    private $cart;
    private $pd;
    private $_variant;
    private $_checkLogin;
    private $userId;
    private $_request;

    private $_color;

    private $_mail;
    public function __construct()
    {
        $this->cart = new Carts();
        $this->pd = new Products();
        $this->_color = new Colors();
        $this->_variant = new Variants();
        $this->_request = new Request();
        $this->_checkLogin = SessionHelper::checkLogin();
        $this->userId = SessionHelper::get('userId');
        $this->_mail = new MailTemplate();
    }
    public function index()
    {
        if (isset($this->_checkLogin)) {
            $data = [
                "message" => "<div class='text-red-500 text-center p-2 bg-red-200'>Please login to view your cart!</div>"
            ];
            $this->render("/login", $data);
        } else {
            $userId = SessionHelper::get('userId');
            $carts = $this->cart->viewAllCart($userId);
            $variants = [];
            foreach ($carts as $cart) {
                $variants[] = $this->_variant->VariantSelectById((int)$cart['variant_id']);
            }
            $data = [
                "cart" => $carts,
                "variants" => $variants,
            ];
            return $this->render('cart', $data);
        }
    }
    public function addToCart()
    {
        $prodId = $_POST['prodId'];
        $variantId = $_POST['variantId'];
        if (SessionHelper::get('checkLogin')) {
            $qty = $_POST['quantity'];
            $sId = session_id();
            $checkCart = $this->cart->checkCart($prodId, $variantId, $this->userId);
            if (empty($checkCart)) {
                $addCart = $this->cart->addCart((int)$prodId, (int)$variantId, $this->userId, $sId, $qty);
                if (!empty($addCart)) {
                    SessionHelper::setSuccess('cartSuccessMessage', "<div class='text-green-700 text-center p-2 bg-green-200'>Add to cart successfully.</div>");
                    $this->index();
                }
            } else {
                SessionHelper::setError('cartErrorMessage', "<div class='text-red-500 text-center p-2 bg-red-200'>This product is already exist in your cart!</div>");
            }
        } else {
            SessionHelper::setError('cartErrorMessage', "<div class='text-red-500 text-center p-2 bg-red-200'>Please login to add to cart!</div>");
        }
        header('location: /details?id=' . $prodId);
    }

    public function updateCart()
    {
        $quantity = $_POST['quantity'];
        $cartId = $_POST['cartId'];
        $variantId = $_POST['variantId'];
        $stock = $this->_variant->VariantSelectById($variantId)[0]['qty_variant'];
        if (isset($stock) && $quantity <= $stock) {
            if (isset($quantity) && $quantity <= 0) {
                header('Location: /deletecart?id=' . $cartId);
            } else {
                $cartUpdate = $this->cart->updateCart($variantId, $quantity, $cartId);
                if (!empty($cartUpdate)) {
                    SessionHelper::setSuccess('cartSuccessMessage', "<div class='text-green-700 text-center p-2 bg-green-200'>Update cart successfully.</div>");
                }
            }
        } else {
            SessionHelper::setError('cartErrorMessage', "<div class='text-red-500 text-center p-2 bg-red-200'>This product is out of stock!</div>");
        }
        return $this->index();
    }
    public function delCart()
    {
        $id = $this->_request->getParam('id');
        $cartDel = $this->cart->delCart((int)$id);
        if (!empty($cartDel)) {
            SessionHelper::setSuccess('cartSuccessMessage', "<div class='text-green-700 text-center p-2 bg-green-200'>Delete successfully.</div>");
        } else {
            SessionHelper::setError('cartErrorMessage', "<div class='text-red-500 text-center p-2 bg-red-200'>Something went wrong!</div>");
        }
        return $this->index();
    }
}
