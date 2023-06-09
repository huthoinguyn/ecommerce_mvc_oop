<?php

use App\Core\Helpers\SessionHelper;

include __DIR__ . "/inc/header.php";
include __DIR__ . "/inc/navbar.php";
?>
<?php
echo SessionHelper::getSuccess('cartSuccessMessage');
echo SessionHelper::getSuccess('cartErrorMessage');
?>

<div class="container mx-auto mt-10">
    <div class="flex shadow-md my-10">
        <div class="w-3/4 bg-white px-10 py-10">
            <div class="flex justify-between border-b pb-8">
                <h1 class="font-semibold text-2xl">Shopping Cart</h1>
            </div>
            <div class="flex mt-10 mb-5">
                <h3 class="font-semibold text-gray-600 text-xs uppercase w-2/6">Product Details</h3>
                <h3 class="font-semibold text-gray-600 text-xs uppercase w-1/6 text-center">Color</h3>
                <h3 class="font-semibold text-gray-600 text-xs uppercase w-1/6 text-center">Quantity</h3>
                <h3 class="font-semibold text-gray-600 text-xs uppercase w-1/6 text-center">Price</h3>
                <h3 class="font-semibold text-gray-600 text-xs uppercase w-1/6 text-center">Total</h3>
            </div>
            <?php
            $subTotal = 0;
            if (!empty($data['cart'])) {
                foreach ($data['cart'] as $key => $cs) {
                    $subTotal += $cs['price'] * $cs['quantity'];
            ?>
                    <?php
                    $variantId = null;
                    $colorId = null;
                    foreach ($data['variants'][$key] as $var) {
                        $color = $var['colorName'];
                        $variantId = $var['id'];
                    }
                    ?>
                    <div class="flex items-center hover:bg-gray-100 -mx-8 px-6 py-5">
                        <div class="flex w-2/6"> <!-- product -->
                            <div class="w-1/3 overflow-hidden">
                                <?php
                                if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/' . $cs['image'])) : ?>
                                    <img src="<?= $cs['image'] ?>" class="w-full h-full object-cover">
                                <?php else : ?>
                                    <img src="src/uploads/<?= $cs['image'] ?>" class="w-full h-full object-cover">
                                <?php endif; ?>
                            </div>
                            <div class="flex w-2/3 flex-col justify-between ml-4 flex-grow">
                                <span class="font-bold text-sm">
                                    <a href="/details?id=<?= $cs['prod_id'] ?>">
                                        <?= $cs['prodName'] ?>
                                    </a>
                                </span>
                                <span class="text-red-500 text-xs"></span>
                                <a onclick="return confirm('Are you sure to delete?')" href="/deletecart?id=<?= $cs['id'] ?>" class="font-semibold hover:text-red-500 text-gray-500 text-xs">Remove</a>
                            </div>
                        </div>
                        <form action="/updatecart" method="POST" class='flex w-2/6'>
                            <input type="hidden" name="cartId" value="<?= $cs['id'] ?>">
                            <input type="hidden" name="prodId" value="<?= $cs['prod_id'] ?>">
                            <input type="hidden" name="variantId" value="<?= $variantId ?>">
                            <div class="flex justify-center w-1/2">
                                <input class="mx-2 pl-2 pr-1 py-2 border text-center w-16 outline-none" name="color" type="text" value="<?= @$color ?>" readonly>
                            </div>
                            <div class="flex justify-center w-1/2">
                                <input onchange="this.form.submit()" class="mx-2 pl-2 pr-1 py-2 border text-center w-16" name="quantity" type="number" min="0" value="<?= $cs['quantity'] ?>">
                            </div>
                        </form>
                        <span class="text-center w-1/6 font-semibold text-sm">$<?= number_format($cs['price'], 2) ?></span>
                        <span class="text-center w-1/6 font-semibold text-sm">$<?= number_format($cs['price'] * $cs['quantity'], 2) ?></span>
                    </div>
            <?php
                }
            } else {
                echo "<h3 class='text-4xl font-bold'>Cart Empty</h3>";
            }
            ?>

            <a href="/shop" class="flex font-semibold text-gray-600 text-sm mt-10 transition-all duration-300 hover:translate-x-2">

                <svg class="fill-current mr-2 text-gray-600 w-4" viewBox="0 0 448 512">
                    <path d="M134.059 296H436c6.627 0 12-5.373 12-12v-56c0-6.627-5.373-12-12-12H134.059v-46.059c0-21.382-25.851-32.09-40.971-16.971L7.029 239.029c-9.373 9.373-9.373 24.569 0 33.941l86.059 86.059c15.119 15.119 40.971 4.411 40.971-16.971V296z" />
                </svg>
                Continue Shopping
            </a>
        </div>

        <div id="summary" class="w-1/4 px-8 py-10">
            <h1 class="font-semibold text-2xl border-b pb-8">Order Summary</h1>
            <div class="flex justify-between mt-10 mb-5">
                <span class="font-semibold text-sm uppercase">Subtotal</span>
                <span class="font-semibold text-sm">$<?= number_format($subTotal, 2) ?></span>
            </div>
            <div>
                <label class="font-medium inline-block mb-3 text-sm uppercase">Shipping</label>
                <select class="block p-2 text-gray-600 w-full text-sm">
                    <option>Standard shipping - $10.00</option>
                </select>
            </div>
            <div class="py-10">
                <label for="promo" class="font-semibold inline-block mb-3 text-sm uppercase">Promo Code</label>
                <input type="text" id="promo" placeholder="Enter your code" class="p-2 text-sm w-full">
            </div>
            <button class="bg-gray-700 hover:bg-gray-900 px-5 py-2 text-sm text-white uppercase">Apply</button>
            <div class="border-t mt-8">
                <div class="flex font-semibold justify-between py-6 text-sm uppercase">
                    <span>Total cost</span>
                    <span>$<?= number_format($subTotal != 0 ? $subTotal + 10 : $subTotal, 2) ?></span>
                </div>
                <a href="/checkout" class="bg-primary block text-center font-semibold hover:bg-red-600 py-3 text-sm text-white uppercase w-full">Checkout</a>
            </div>
        </div>

    </div>
</div>
<?php
include __DIR__ . "/inc/footer.php";

?>