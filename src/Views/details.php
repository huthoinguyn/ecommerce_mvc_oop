<?php

use App\Core\Helpers\SessionHelper;

include __DIR__ . "/inc/header.php";
include __DIR__ . "/inc/navbar.php";
?>
<?php
echo SessionHelper::getError('cartErrorMessage');
?>

<!-- breadcrumb -->
<div class="container py-4 flex items-center gap-3">
    <a href="index.php" class="text-primary text-base">
        <i class="fa-solid fa-house"></i>
    </a>
    <span class="text-sm text-gray-400">
        <i class="fa-solid fa-chevron-right"></i>
    </span>
    <p class="text-gray-600 font-medium">Product</p>
</div>
<!-- ./breadcrumb -->

<?php
$price_arr = [];
$stock = 0;
if (isset($data['variants'])) {
    foreach ($data['variants'] as $var) {
        $price_arr[] = $var['price_variant'];
        $stock += $var['qty_variant'];
    }
}
?>

<?php
if (isset($data['details'])) {
    foreach ($data['details'] as $ps) {
?>
        <!-- product-detail -->
        <div class="container grid grid-cols-2 gap-6 auto-rows-fr">
            <div>
                <?php
                if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/' . $ps['image'])) : ?>
                    <img src="<?= $ps['image'] ?>" class="w-full">
                <?php else : ?>
                    <img src="src/uploads/<?= $ps['image'] ?>" class="w-full">
                <?php endif; ?>
            </div>

            <div>
                <h2 class="text-3xl font-medium uppercase mb-2"><?= $ps['name'] ?></h2>
                <div class="flex items-center mb-4">
                    <div class="flex gap-1 text-sm text-yellow-400">
                        <span><i class="fa-solid fa-star"></i></span>
                        <span><i class="fa-solid fa-star"></i></span>
                        <span><i class="fa-solid fa-star"></i></span>
                        <span><i class="fa-solid fa-star"></i></span>
                        <span><i class="fa-solid fa-star"></i></span>
                    </div>
                    <div class="text-xs text-gray-500 ml-3">(150 Reviews)</div>
                </div>
                <div class="space-y-2">
                    <p class="text-gray-800 font-semibold space-x-2">
                        <span>Availability: </span>
                        <span class='qty_variant'><?= $stock ?></span>
                        <?php
                        if ($stock > 0) {
                            echo '<span id="stock" class="stock text-green-600">In Stock</span>';
                        } else {
                            echo '<span id="stock" class="stock text-red-600">Out Stock</span>';
                        }
                        ?>

                    </p>
                    <p class="space-x-2">
                        <span class="text-gray-800 font-semibold">
                            Brand:
                        </span>
                        <span class="text-gray-600 font-semibold bg-gray-100 px-2 py-1 rounded">
                            <?= $ps['brandName'] ?>
                        </span>
                    </p>
                    <p class="space-x-2">
                        <span class="text-gray-800 font-semibold">
                            Category:
                        </span>
                        <span class="text-gray-600 font-semibold bg-gray-100 px-2 py-1 rounded">
                            <?= $ps['catName'] ?>
                        </span>
                    </p>
                    <p class="space-x-2">
                        <span class="text-gray-800 font-semibold">SKU: </span>
                        <span class="text-gray-600">BE45VGRT</span>
                    </p>
                </div>
                <div class="flex items-baseline mt-1">
                    <div class="flex items-center">
                        <div>
                            <div class="rounded-lg bg-gray-100 flex py-2 px-3">
                                <span class="text-red-400 mr-1 mt-1 text-lg">$</span>
                                <span class="price_variant font-bold text-primary text-3xl">
                                    <?php
                                    if (!empty($price_arr) && count($price_arr) >= 2) {
                                        echo number_format(min($price_arr), 2) . ' - ' . number_format(max($price_arr), 2);
                                    } else if (!empty($price_arr)) {
                                        echo number_format(min($price_arr), 2);
                                    } else {
                                        echo number_format($ps['price'], 2);
                                    }
                                    ?>

                                </span>
                            </div>
                        </div>
                        <!-- <div class="flex-1">
                            <p class="text-green-500 text-xl font-semibold">Save 12%</p>
                            <p class="text-gray-400 text-sm">Inclusive of all Taxes.</p>
                        </div> -->
                        <div class=""></div>
                    </div>
                </div>

                <p class="text-gray-600 line-clamp-4">
                    <?php //$ps['description'] 
                    ?>
                </p>

                <div class="pt-4">
                    <h3 class="text-gray-800 mb-3 uppercase font-semibold">Color:</h3>
                    <div class="flex items-center gap-2">
                        <?php
                        if (isset($data['variants'])) {
                            foreach ($data['variants'] as $var) {
                        ?>
                                <div data-color-id="<?= $var['colorId'] ?>" class="color-selector p-2 border cursor-pointer uppercase text-sm">
                                    <?= $var['colorName'] ?>
                                </div>
                        <?php
                            }
                        }
                        ?>

                    </div>
                </div>
                <form action="/addtocart" method="POST">
                    <input class="prodId" type="hidden" name="prodId" value="<?= $ps['prodId'] ?>">
                    <input class="variantId" type="hidden" name="variantId" value="">
                    <!-- <input class="variantPrice" type="hidden" name="price" value=""> -->
                    <div class="qtyBox mt-4 hidden">
                        <h3 class="text-sm text-gray-800 uppercase mb-1">Quantity</h3>
                        <div class="flex border border-gray-300 text-gray-600 divide-x divide-gray-300 w-max">
                            <input id='qty' class="py-2 px-4" type="number" name="quantity" value="1" min="1" max='<?= $stock ?>'>
                        </div>
                    </div>
                    <?php
                    // if (isset($data['message'])) {
                    //     echo $data['message'];
                    // }
                    ?>
                    <div class="mt-4 flex gap-3 border-b border-gray-200 pb-5">
                        <button type="submit" name="submit" class="addToCartBtn disable bg-primary border border-primary text-white px-8 py-2 font-medium rounded uppercase flex items-center gap-2 hover:bg-transparent hover:text-primary transition">
                            <i class="fa-solid fa-bag-shopping"></i> Add to cart
                        </button>
                        <a href="#" class="border border-gray-300 text-gray-600 px-8 py-2 font-medium rounded uppercase flex items-center gap-2 hover:text-primary transition">
                            <i class="fa-solid fa-heart"></i> Wishlist
                        </a>
                    </div>
                </form>

                <div class="flex gap-3 mt-4">
                    <a href="#" class="text-gray-400 hover:text-gray-500 h-8 w-8 rounded-full border border-gray-300 flex items-center justify-center">
                        <i class="fa-brands fa-facebook-f"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-gray-500 h-8 w-8 rounded-full border border-gray-300 flex items-center justify-center">
                        <i class="fa-brands fa-twitter"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-gray-500 h-8 w-8 rounded-full border border-gray-300 flex items-center justify-center">
                        <i class="fa-brands fa-instagram"></i>
                    </a>
                </div>
            </div>
        </div>
        <!-- ./product-detail -->

        <!-- description -->
        <div class="container pb-16">
            <h3 class="border-b border-gray-200 font-roboto text-gray-800 pb-3 font-medium">Product details</h3>
            <div class="w-3/5 pt-6">
                <div class="text-gray-600">
                    <?= $ps['description'] ?>
                </div>
            </div>
        </div>
        <!-- ./description -->

<?php
    }
}
?>

<script>
    let prodId = document.querySelector('.prodId').value

    const colorItems = document.querySelectorAll('.color-selector')
    colorItems.forEach(color => {
        color.onclick = () => {
            let prodState = true;
            // document.querySelector('.colorId').value = color.dataset.colorId
            document.querySelector('#qty').value = 1;
            [...colorItems].map(color => color.classList.remove('active'))
            color.classList.add('active');
            const xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = async function() {
                if (this.readyState == 4 && this.status == 200) {
                    let data = await JSON.parse(this.response)
                    qty = +data[0].qty_variant
                    document.querySelector('.price_variant').textContent = +data[0].price_variant
                    document.querySelector('.qty_variant').textContent = qty
                    document.querySelector('.variantId').value = data[0].id
                    
                    if (data[0].qty_variant <= 0) {
                        prodState = false;
                    }
                    document.querySelector('#qty').onchange = (e) => {
                        if (e.target.value >= qty) {
                            document.querySelector('#qty').value = qty
                        }
                    }
                    if (prodState) {
                        document.querySelector('#stock').className = 'text-green-600'
                        document.querySelector('#stock').textContent = 'In Stock'
                        document.querySelector('.addToCartBtn').classList.remove('disable')
                        document.querySelector('.qtyBox').classList.remove('hidden')
                    } else {
                        document.querySelector('#stock').className = 'text-red-600'
                        document.querySelector('#stock').textContent = 'Out Stock'
                        document.querySelector('.addToCartBtn').classList.add('disable')
                        document.querySelector('.qtyBox').classList.add('hidden')
                        
                    }
                }
            };
            xhttp.open("GET", `/color_variant?prod_id=${prodId}&color_id=${color.dataset.colorId}`);
            xhttp.send();
        }
    })
</script>

<?php
include __DIR__ . "/inc/footer.php";

?>