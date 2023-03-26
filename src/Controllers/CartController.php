<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Carts;
use App\Models\Products;

class CartController extends BaseController
{

    private $cart;
    private $pd;
    private $_checkLogin;

    private $cartShowAll;

    private $userId;

    public function __construct()
    {
        $this->cart = new Carts();
        $this->pd = new Products();
        $this->_checkLogin = BaseController::checkLogin();
        $this->userId = BaseController::get('userId');
        $this->cartShowAll = $this->cart->viewAllCart(['*'], ['userId' => $this->userId], '', 0);
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
        $prodDetails = $this->pd->viewProducts(['*'], ['id' => $prodId], '', 1);
        if (BaseController::get('checkLogin')) {
            $qty = $this->validation($_POST['quantity']);
            $sId = session_id();
            $p = $this->pd->prodSelectById($prodId)[0];

            $checkCart = $this->cart->checkCart($prodId, $this->userId);
            if (empty($checkCart)) {
                $addCart = $this->cart->addCart($prodId, $this->userId, $sId, $p['name'], $p['price'], $p['image'], $qty);
                if (!empty($addCart)) {
                    $data = [
                        "cart" => $this->cartShowAll,
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
            "message" => $message
        ];
        return $this->render('details', $data);
    }

    public function updateCart()
    {
        $quantity = $_POST['quantity'];
        $cartId = (int)$_POST['cartId'];

        if (isset($quantity) && $quantity <= 0) {
            $this->delCart($cartId);
        } else {
            $cartUpdate = $this->cart->updateCart($quantity, $cartId);
            if (!empty($cartUpdate)) {
                $data = [
                    "cart" => $this->cartShowAll,
                    "message" => "<div class='text-green-700 text-center p-2 bg-green-200'>Cart update successfully.</div>"
                ];
                return $this->render('cart', $data);
            }
        }
    }
    public function delCart($id)
    {
        $cartDel = $this->cart->delCart((int)(isset($id['id']) ? $id['id'] : $id));
        if (!empty($cartDel)) {
            $data = [
                "cart" => $this->cartShowAll,
                "message" => "<div class='text-green-700 text-center p-2 bg-green-200'>Delete successfully.</div>"
            ];
            return $this->render('cart', $data);
        } else {
            $data = [
                "cart" => $this->cartShowAll,
                "message" => "<div class='text-red-500 text-center p-2 bg-red-200'>Something went wrong!</div>"
            ];
            return $this->render('cart', $data);
        }
    }
}
