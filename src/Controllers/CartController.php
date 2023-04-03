<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Core\Request;
use App\Models\Carts;
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

    public function __construct()
    {
        $this->cart = new Carts();
        $this->pd = new Products();
        $this->_variant = new Variants();
        $this->_request = new Request();
        $this->_checkLogin = BaseController::checkLogin();
        $this->userId = BaseController::get('userId');
    }
    public function index()
    {
        if (isset($this->_checkLogin)) {
            $data = [
                "message" => "<div class='text-red-500 text-center p-2 bg-red-200'>Please login to view your cart!</div>"
            ];
            $this->render("/login", $data);
        } else {
            $userId = BaseController::get('userId');
            $carts = $this->cart->viewAllCart(['*'], ['userId' => $userId], '', 0);
            $data = [
                "cart" => $carts,
            ];
            return $this->render('cart', $data);
        }
    }
    public function addToCart()
    {
        $prodId = $_POST['id'];
        $colorId = $_POST['colorId'];
        $variant = $this->_variant->prodSelectById($prodId);
        $prodDetails = $this->pd->prodSelectById($prodId);
        if (BaseController::get('checkLogin')) {
            $qty = $_POST['quantity'];
            $sId = session_id();
            $variant = $this->_variant->prodSelectByColor($prodId, $colorId)[0];
            $p = $this->pd->prodSelectById($variant['prodId'])[0];
            $checkCart = $this->cart->checkCart($prodId, $this->userId);
            if (empty($checkCart)) {
                $addCart = $this->cart->addCart((int)$prodId, $this->userId, $sId, $p['name'], $variant['price_variant'], $p['image'], $qty);
                if (!empty($addCart)) {
                    $count = $this->cart->cartCount($this->userId);
                    BaseController::set('count', $count);
                    $data = [
                        "cart" => $this->cart->viewAllCart(['*'], ['userId' => $this->userId], '', 0),
                        "message" => "<div class='text-green-700 text-center p-2 bg-green-200'>Add to cart successfully.</div>"
                    ];
                    return $this->render('cart', $data);
                }
            } else {
                $message = "<div class='text-red-500 text-center p-2 bg-red-200'>This product is already exist in your cart!</div>";
            }
        } else {
            $message = "<div class='text-red-500 text-center p-2 bg-red-200'>Please login to add to cart</div>";
        }
        $data = [
            "details" => $prodDetails,
            "variants" => $variant,
            "message" => $message
        ];
        return $this->render('details', $data);
    }

    public function updateCart()
    {
        $quantity = $_POST['quantity'];
        $cartId = (int)$_POST['cartId'];

        if (isset($quantity) && $quantity <= 0) {
            header('Location: /deletecart?id=' . $cartId);
        } else {
            $cartUpdate = $this->cart->updateCart($quantity, $cartId);
            if (!empty($cartUpdate)) {
                $data = [
                    "cart" => $this->cart->viewAllCart(['*'], ['userId' => $this->userId], '', 0),
                    "message" => "<div class='text-green-700 text-center p-2 bg-green-200'>Cart update successfully.</div>"
                ];
                return $this->render('cart', $data);
            }
        }
    }
    public function delCart()
    {
        $id = $this->_request->getParam('id');
        $cartDel = $this->cart->delCart((int)$id);
        if (!empty($cartDel)) {
            $count = $this->cart->cartCount($this->userId);
            BaseController::set('count', $count);
            $data = [
                "cart" => $this->cart->viewAllCart(['*'], ['userId' => $this->userId], '', 0),
                "message" => "<div class='text-green-700 text-center p-2 bg-green-200'>Delete successfully.</div>"
            ];
            return $this->render('cart', $data);
        } else {
            $data = [
                "cart" => $this->cart->viewAllCart(['*'], ['userId' => $this->userId], '', 0),
                "message" => "<div class='text-red-500 text-center p-2 bg-red-200'>Something went wrong!</div>"
            ];
            return $this->render('cart', $data);
        }
    }
}
