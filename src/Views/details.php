<?php
include __DIR__ . "/inc/header.php";
include __DIR__ . "/inc/navbar.php";
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
// $catId = null;

$prodSelectById = $data['details'];
if ($prodSelectById) {
    foreach ($prodSelectById as $ps) {
        // $catId = $ps['catId'];
?>
        <!-- product-detail -->
        <div class="container grid grid-cols-2 gap-6 auto-rows-fr">
            <div>
                <img src="../src/uploads/<?= $ps['image'] ?>" alt="product" class="w-full">
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
                        <span class="text-green-600">In Stock</span>
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
                                <span class="font-bold text-primary text-3xl"><?= number_format($ps['price'], 2) ?></span>
                            </div>
                        </div>
                        <!-- <div class="flex-1">
                            <p class="text-green-500 text-xl font-semibold">Save 12%</p>
                            <p class="text-gray-400 text-sm">Inclusive of all Taxes.</p>
                        </div> -->
                    </div>
                </div>

                <p class="text-gray-600 line-clamp-4">
                    <?php //$ps['description'] 
                    ?>
                </p>

                <div class="pt-4">
                    <h3 class="text-xl text-gray-800 mb-3 uppercase font-medium">Color</h3>
                    <div class="flex items-center gap-2">
                        <div class="color-selector">
                            <input type="radio" name="color" id="red" class="hidden">
                            <label for="red" class="border border-gray-200 rounded-sm h-6 w-6  cursor-pointer shadow-sm block" style="background-color: #fc3d57;"></label>
                        </div>
                        <div class="color-selector">
                            <input type="radio" name="color" id="black" class="hidden">
                            <label for="black" class="border border-gray-200 rounded-sm h-6 w-6  cursor-pointer shadow-sm block" style="background-color: #000;"></label>
                        </div>
                        <div class="color-selector">
                            <input type="radio" name="color" id="white" class="hidden">
                            <label for="white" class="border border-gray-200 rounded-sm h-6 w-6  cursor-pointer shadow-sm block" style="background-color: #fff;"></label>
                        </div>

                    </div>
                </div>
                <form action="/addtocart" method="POST">
                    <input type="hidden" name="id" value="<?= $ps['id'] ?>">
                    <div class="mt-4">
                        <h3 class="text-sm text-gray-800 uppercase mb-1">Quantity</h3>
                        <div class="flex border border-gray-300 text-gray-600 divide-x divide-gray-300 w-max">
                            <input class="py-2 px-4" type="number" name="quantity" value="1" min="1">
                        </div>
                    </div>
                    <?php
                    // if (isset($data['message'])) {
                    //     echo $data['message'];
                    // }
                    ?>
                    <div class="mt-4 flex gap-3 border-b border-gray-200 pb-5">
                        <button type="submit" name="submit" class="bg-primary border border-primary text-white px-8 py-2 font-medium rounded uppercase flex items-center gap-2 hover:bg-transparent hover:text-primary transition">
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


<?php
include __DIR__ . "/inc/footer.php";

?>