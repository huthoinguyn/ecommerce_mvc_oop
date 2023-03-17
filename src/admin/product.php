<?php include "layout/header.php" ?>
<?php include "layout/sidebar.php" ?>
<?php include '../classes/product.php'; ?>
<?php include '../classes/category.php'; ?>
<?php include '../classes/brand.php'; ?>
<?php
$pd = new product();
$fm = new Format();
$cat = new category();
$brand = new brand();
$pdList = $pd->show_product();
if (isset($_GET['prodId'])) {
    $prodId = $_GET['prodId'];
    $delPd = $pd->del_product($prodId);
} ?>

<section>

    <div class="container mx-auto px-4 sm:px-8">
        <div class="py-8">
            <div>
                <h2 class="text-2xl font-semibold leading-tight">Product List</h2>
            </div>
            <?php
            if(isset($delPd)){
                echo $delPd;
            }
            ?>
        </div>
        <div class="flex justify-between">
            <div class="relative w-fit rounded-xl overflow-hidden">
                <svg class="w-6 h-6 text-gray-700 absolute top-3 left-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
                <input type="search" placeholder="Search" class=" outline-none w-full py-3 px-14">
            </div>
            <a href="productadd.php" class="addNewBtn bg-sky-600 hover:bg-sky-700 py-3 px-8 rounded-lg text-sky-100 border-b-4 border-sky-700 hover:border-sky-800 transition duration-300" href="">New Product</a>
        </div>
        <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
            <div class="inline-block min-w-full shadow-md rounded-lg overflow-hidden">
                <table class="min-w-full leading-normal">
                    <thead>
                        <tr>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                ID
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                Product
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                Brand/Category
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                Description
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                Status
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($pdList) {
                            $i = 0;
                            while ($p = $pdList->fetch_assoc()) {
                                $i++;
                        ?>

                                <tr>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm"><?= $i ?></td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        <div class="flex">
                                            <div class="flex-shrink-0 w-20 h-20 rounded-lg">
                                                <img class="w-full h-full object-cover" src="uploads/<?= $p['image'] ?>" alt="" />
                                            </div>
                                            <div class="ml-3">
                                                <p class="text-gray-900 whitespace-no-wrap line-clamp-2">
                                                <div class="flex">
                                                    <span class=""></span>
                                                    <?= $p['prodName'] ?>
                                                    </span>
                                                </div>
                                                </p>
                                                <p class="text-gray-600 whitespace-no-wrap"><?= $p['price'] ?></p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        <p class="text-gray-900 whitespace-no-wrap"><?= $p['catName'] ?></p>
                                        <p class="text-gray-600 whitespace-no-wrap"><?= $p['brandName'] ?></p>
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm line-clamp-6">
                                        <?= $p['description'] ?>
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        <?= $p['type'] == 1 ? "Featured" : "Non-Featured" ?>
                                        
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-right">
                                        <a href="productedit.php?prodId=<?= $p['id'] ?>">Edit</a> || <a onclick="return confirm('Are you sure to delete?')" href="?prodId=<?= $p['id'] ?>">Delete</a>
                                    </td>
                                </tr>
                        <?php
                            }
                        }
                        ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<?php include "layout/footer.php" ?>