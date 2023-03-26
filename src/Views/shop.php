<?php
include __DIR__ . "/inc/header.php";
include __DIR__ . "/inc/navbar.php";
?>

<!-- breadcrumb -->
<div class="container py-4 flex items-center gap-3">
    <a href="../index.php" class="text-primary text-base">
        <i class="fa-solid fa-house"></i>
    </a>
    <span class="text-sm text-gray-400">
        <i class="fa-solid fa-chevron-right"></i>
    </span>
    <p class="text-gray-600 font-medium">Product</p>
</div>
<!-- ./breadcrumb -->

<!-- shop wrapper -->
<div class="container grid grid-cols-4 gap-6 pt-4 pb-16 items-start">
    <!-- sidebar -->
    <div class="col-span-1 bg-white px-4 pb-6 shadow rounded overflow-hidden">
        <div class="divide-y divide-gray-200 space-y-5">
            <div>
                <h3 class="text-xl text-gray-800 mb-3 uppercase font-medium">Categories</h3>
                <div class="space-y-2">
                    <!-- Cat -->

                    <div class="flex items-center">
                        <a href="/shop" class="text-gray-600 ml-3 cusror-pointer">
                            All
                        </a>
                        <div class="ml-auto text-gray-600 text-sm">(15)</div>
                    </div>
                    <?php
                    if ($data['cats']) {
                        foreach ($data['cats'] as $cc) {
                    ?>
                            <div class="flex items-center">
                                <a href="/prodselectbycat/<?= $cc['id'] ?>" class="text-gray-600 ml-3 cusror-pointer">
                                    <?= $cc['name'] ?>
                                </a>
                                <div class="ml-auto text-gray-600 text-sm">(15)</div>
                            </div>
                    <?php
                        }
                    }
                    ?>
                </div>
            </div>

            <div class="pt-4">
                <h3 class="text-xl text-gray-800 mb-3 uppercase font-medium">Brands</h3>
                <div class="space-y-2">
                    <!-- Brand -->
                    <?php
                    if ($data['brands']) {
                        foreach ($data['brands'] as $br) {
                    ?>
                            <div class="flex items-center">
                                <a href="/prodselectbybrand/<?= $br['id'] ?>" class="text-gray-600 ml-3 cusror-pointer"><?= $br['name'] ?></a>
                                <div class="ml-auto text-gray-600 text-sm">(15)</div>
                            </div>
                    <?php
                        }
                    }
                    ?>
                </div>
            </div>

            <div class="pt-4">
                <h3 class="text-xl text-gray-800 mb-3 uppercase font-medium">Price</h3>
                <div class="mt-4 flex items-center">
                    <input type="text" name="min" id="min" class="w-full border-gray-300 focus:border-primary rounded focus:ring-0 px-3 py-1 text-gray-600 shadow-sm" placeholder="min">
                    <span class="mx-3 text-gray-500">-</span>
                    <input type="text" name="max" id="max" class="w-full border-gray-300 focus:border-primary rounded focus:ring-0 px-3 py-1 text-gray-600 shadow-sm" placeholder="max">
                </div>
            </div>

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

            <div class="pt-4">
                <button class="rounded-lg border-red-500">Filter</button>
            </div>

        </div>
    </div>
    <!-- ./sidebar -->

    <!-- products -->
    <div class="col-span-3">
        <div class="flex items-center mb-4">
            <select name="sort" id="sort" class="w-44 text-sm text-gray-600 py-3 px-4 border-gray-300 shadow-sm rounded focus:ring-primary focus:border-primary">
                <option value="">Default sorting</option>
                <option value="price-low-to-high">Price low to high</option>
                <option value="price-high-to-low">Price high to low</option>
                <option value="latest">Latest product</option>
            </select>

            <div class="flex gap-2 ml-auto">
                <div class="border border-primary w-10 h-9 flex items-center justify-center text-white bg-primary rounded cursor-pointer">
                    <i class="fa-solid fa-grip-vertical"></i>
                </div>
                <div class="border border-gray-300 w-10 h-9 flex items-center justify-center text-gray-600 rounded cursor-pointer">
                    <i class="fa-solid fa-list"></i>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-3 gap-6 auto-rows-fr">
            <?php
            if ($data['prods']) {
                foreach ($data['prods'] as $p) {
            ?>
                    <!-- single product -->
                    <div class="group rounded bg-white shadow overflow-hidden flex-shrink-0">
                        <!-- product image -->
                        <div class="relative h-[240px] overflow-hidden z-0">
                            <img src="../src/uploads/<?= $p['image'] ?>" class="w-full h-full object-cover">
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
                            <a href="/details/<?= $p['id'] ?>">
                                <h4 class="uppercase font-medium text-lg mb-2 text-gray-800 hover:text-primary transition line-clamp-2">
                                    <?= $p['name'] ?>
                                </h4>
                            </a>
                            <div class="group-hover:hidden flex items-baseline mb-1 space-x-2">
                                <p class="text-xl text-primary font-roboto font-semibold">$<?= number_format($p['price'], 2) ?></p>
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
                            <a href="/details/<?= $p['id'] ?>" class="view-details">
                                Details
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
    <!-- ./shop wrapper -->

    <?php
    include __DIR__ . "/inc/footer.php";

    ?>