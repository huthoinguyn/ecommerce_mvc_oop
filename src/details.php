<?php
include "inc/header.php";
include "inc/navbar.php";
include "cart.php";
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
$catId = null;
if (!isset($_GET['prodId']) || $_GET['prodId'] == null) {
    echo "<script>window.location='shop.php'</script>";
} else {
    $prodId = $_GET['prodId'];
}
$prodSelectById = $pd->product_details($prodId);
if ($prodSelectById) {
    while ($ps = $prodSelectById->fetch_assoc()) {
        $catId = $ps['catId'];
?>
        <!-- product-detail -->
        <div class="container grid grid-cols-2 gap-6 auto-rows-fr">
            <div>
                <img src="admin/uploads/<?= $ps['image'] ?>" alt="product" class="w-full">
            </div>

            <div>
                <h2 class="text-3xl font-medium uppercase mb-2"><?= $ps['prodName'] ?></h2>
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
                        <span class="text-gray-800 font-semibold">Brand: </span>
                        <span class="text-gray-600"><?= $ps['brandName'] ?></span>
                    </p>
                    <p class="space-x-2">
                        <span class="text-gray-800 font-semibold">Category: </span>
                        <span class="text-gray-600"><?= $ps['catName'] ?></span>
                    </p>
                    <p class="space-x-2">
                        <span class="text-gray-800 font-semibold">SKU: </span>
                        <span class="text-gray-600">BE45VGRT</span>
                    </p>
                </div>
                <div class="flex items-baseline mb-1 space-x-2 font-roboto mt-4">
                    <p class="text-3xl text-primary font-semibold"><?= $ps['price'] ?></p>
                    <!-- <p class="text-base text-gray-400 line-through">$123</p> -->
                </div>

                <p class="mt-4 text-gray-600 line-clamp-4">
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

                <div class="mt-4">
                    <h3 class="text-sm text-gray-800 uppercase mb-1">Quantity</h3>
                    <div class="flex border border-gray-300 text-gray-600 divide-x divide-gray-300 w-max">
                        <div class="h-8 w-8 text-xl flex items-center justify-center cursor-pointer select-none">-</div>
                        <div class="h-8 w-8 text-base flex items-center justify-center">4</div>
                        <div class="h-8 w-8 text-xl flex items-center justify-center cursor-pointer select-none">+</div>
                    </div>
                </div>

                <div class="mt-6 flex gap-3 border-b border-gray-200 pb-5 pt-5">
                    <a href="#" class="bg-primary border border-primary text-white px-8 py-2 font-medium rounded uppercase flex items-center gap-2 hover:bg-transparent hover:text-primary transition">
                        <i class="fa-solid fa-bag-shopping"></i> Add to cart
                    </a>
                    <a href="#" class="border border-gray-300 text-gray-600 px-8 py-2 font-medium rounded uppercase flex items-center gap-2 hover:text-primary transition">
                        <i class="fa-solid fa-heart"></i> Wishlist
                    </a>
                </div>

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
<!-- related product -->
<div class="container pb-16">
    <h2 class="text-2xl font-medium text-gray-800 uppercase mb-6">Related products</h2>
    <div class="grid grid-cols-4 gap-6 auto-rows-fr">
        <?php
        $prodList = $pd->show_product_by_cat($catId);
        if ($prodList) {
            while ($pc = $prodList->fetch_assoc()) {
        ?>
                <div class="group rounded bg-white shadow overflow-hidden">
                    <!-- product image -->
                    <div class="relative h-[240px] overflow-hidden z-0">
                        <img zin src="admin/uploads/<?= $pc['image'] ?>" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center gap-2 opacity-0 group-hover:opacity-100 transition">
                            <a href="details.php" class="text-white text-lg w-9 h-9 rounded-full bg-primary hover:bg-gray-800 transition flex items-center justify-center">
                                <i class="fas fa-search"></i>
                            </a>
                            <a href="#" class="text-white text-lg w-9 h-9 rounded-full bg-primary hover:bg-gray-800 transition flex items-center justify-center">
                                <i class="far fa-heart"></i>
                            </a>
                        </div>
                    </div>
                    <!-- product image end -->
                    <!-- product content -->
                    <div class="pt-4 pb-3 px-4">
                        <a href="details.php?prodId=<?= $pc['id'] ?>">
                            <h4 class="uppercase font-medium text-lg mb-2 text-gray-800 hover:text-primary transition line-clamp-2">
                                <?= $pc['name'] ?>
                            </h4>
                        </a>
                        <div class="group-hover:hidden flex items-baseline mb-1 space-x-2">
                            <p class="text-xl text-primary font-roboto font-semibold"><?= $pc['price'] ?></p>
                            <!-- <p class="text-sm text-gray-400 font-roboto line-through">$55.00</p> -->
                        </div>
                        <div class="group-hover:hidden flex items-center">
                            <div class="flex gap-1 text-sm text-yellow-400">
                                <span><i class="fas fa-star"></i></span>
                                <span><i class="fas fa-star"></i></span>
                                <span><i class="fas fa-star"></i></span>
                                <span><i class="fas fa-star"></i></span>
                                <span><i class="fas fa-star"></i></span>
                            </div>
                            <div class="text-xs text-gray-500 ml-3">(150)</div>
                        </div>
                        <!-- product button -->
                        <a href="details.php?prodId=<?= $pc['id'] ?>" class="hidden group-hover:block group-hover:animate-fadeIn w-full py-1 text-center text-white bg-primary border border-primary rounded-b hover:bg-transparent hover:text-primary transition">
                            Add to Cart
                        </a>
                        <!-- product button end -->
                    </div>
                    <!-- product content end -->

                </div>
                <!-- single product end -->
        <?php
            }
        }
        ?>
    </div>
</div>
<!-- ./related product -->


<?php
include "inc/footer.php";

?>