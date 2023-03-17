<?php include "layout/header.php" ?>
<?php include "layout/sidebar.php" ?>
<?php include '../classes/product.php'; ?>
<?php include '../classes/category.php'; ?>
<?php include '../classes/brand.php'; ?>

<?php
$pd = new product();
if (!isset($_GET['prodId']) || $_GET['prodId'] == null) {
    echo "<script>window.location='product.php'</script>";
} else {
    $prodId = $_GET['prodId'];
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $updatePd = $pd->update_product($_POST, $_FILES, $prodId);
}
?>
<section class="">

    <div class="w-full mx-auto p-5">
        <?php
        if (isset($updatePd)) {
            echo $updatePd;
        }
        ?>
        <?php
        $pdSelectById = $pd->select_product_by_id($prodId);
        if ($pdSelectById) {
            while ($p = $pdSelectById->fetch_assoc()) {
        ?>
                <form class="w-full" form action="" method="POST" enctype="multipart/form-data">
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                                Product Name
                            </label>
                            <input name="prodName" value="<?= $p['name'] ?>" class="appearance-none block w-full  text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="grid-first-name" type="text" placeholder="Laptop Thinkpad">
                        </div>
                        <div class="w-full md:w-1/2 px-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                                Price
                            </label>
                            <input name="price" value="<?= $p['price'] ?>" class="appearance-none block w-full  text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name" type="text" placeholder="$12.34">
                        </div>
                    </div>
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                                Category
                            </label>
                            <div class="relative w-full border-none">
                                <select name="category" class=" text-gray-700 appearance-none border-none outline-none inline-block py-3 pl-3 pr-8 rounded leading-tight w-full">
                                    <?php
                                    $cat = new category();
                                    $catList = $cat->show_category();
                                    if ($catList) {
                                        while ($ct = $catList->fetch_assoc()) {
                                    ?>
                                            <option <?= $p['catId'] == $ct['id'] ?? "selected" ?> value="<?= $ct['id'] ?>"><?= $ct['name'] ?></option>

                                    <?php
                                        }
                                    }
                                    ?>
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2">
                                    <i class="fas fa-chevron-down text-gray-700"></i>
                                </div>
                            </div>
                        </div>
                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                                Brand
                            </label>
                            <div class="relative w-full border-none">
                                <select name="brand" class=" text-gray-700 appearance-none border-none outline-none inline-block py-3 pl-3 pr-8 rounded leading-tight w-full">
                                    <?php
                                    $brand = new brand();
                                    $brandList = $brand->show_brand();
                                    if ($brandList) {
                                        while ($br = $brandList->fetch_assoc()) {
                                    ?>
                                            <option <?= $p['brandId'] == $br['id'] ?? "selected" ?> value="<?= $br['id'] ?>"><?= $br['name'] ?></option>

                                    <?php
                                        }
                                    }
                                    ?>
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2">
                                    <i class="fas fa-chevron-down text-gray-700"></i>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                                Description
                            </label>
                            <textarea name="description" id="mytextarea" cols="30" rows="10">
                                <?= $p['description'] ?>
                            </textarea>
                        </div>
                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0 ">
                            <div class="flex items-center justify-center text-gray-500">
                                <div class="w-full">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                                        Image
                                    </label>
                                    <div class="w-full max-w-2xl p-8 mx-auto bg-white rounded-lg">
                                        <div class="" x-data="imageData()">
                                            <div x-show="previewUrl == ''">
                                                <p class="text-center uppercase py-8">
                                                    <label for="thumbnail" class="cursor-pointer">
                                                        Upload a file
                                                    </label>
                                                    <input name="image" type="file" id="thumbnail" class="hidden" @change="updatePreview()">
                                                </p>
                                            </div>
                                            <div x-show="previewUrl !== ''">
                                                <img :src="previewUrl" alt="" class="rounded">
                                                <div class="">
                                                    <button type="button" class="" @click="clearPreview()">change</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                                Featured
                            </label>
                            <select name="type" class=" text-gray-700 appearance-none border-none outline-none inline-block py-3 pl-3 pr-8 rounded leading-tight w-full">
                                <option value="1" <?= $p['type'] == 1 ?? "selected" ?>>Featured</option>
                                <option value="0" <?= $p['type'] == 0 ?? "selected" ?>>Non-featured</option>
                            </select>
                        </div>
                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                            </label>
                            <button name="submit" type="submit" class="rounded-lg px-8 py-3 bg-blue-500 text-blue-100 hover:bg-blue-600 duration-300">Add</button>
                            <!-- Button -->
                        </div>


                    </div>

                </form>
        <?php
            }
        }
        ?>
    </div>
</section>
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.js"></script>
<script>
    function imageData() {
        return {
            previewUrl: "",
            updatePreview() {
                var reader,
                    files = document.getElementById("thumbnail").files;

                reader = new FileReader();

                reader.onload = e => {
                    this.previewUrl = e.target.result;
                };

                reader.readAsDataURL(files[0]);
            },
            clearPreview() {
                document.getElementById("thumbnail").value = null;
                this.previewUrl = "";
            }
        };
    }
</script>
<?php include "layout/footer.php" ?>