<?php include "layout/sidebar.php" ?>
<?php include "layout/header.php" ?>
<?php include '../classes/brand.php'; ?>

<?php
$cat = new brand();

if (!isset($_GET['brandId']) || $_GET['brandId'] == null) {
    echo "<script>window.location='brand.php'</script>";
} else {
    $brandId = $_GET['brandId'];
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $catName = $_POST['catName'];
    $state = isset($_POST['state']) ? 1 : 0;
    $insertCat = $cat->update_brand($catName, $state, $brandId);
}
?>


<section>
    <?php
    $catSelect = $cat->select_brand_by_id($brandId);
    if ($catSelect) {
        while ($cs = $catSelect->fetch_assoc()) {
    ?>
            <form action="" method="POST" class="flex flex-col px-20 py-4">


                <div class="group w-72 md:w-80 lg:w-96">
                    <label for="10" class="inline-block w-full text-sm font-medium text-gray-500 transition-all duration-200 ease-in-out group-focus-within:text-blue-400">New brand</label>
                    <div class="block">
                        <?php
                        if (isset($insertCat)) {
                            echo $insertCat;
                        }
                        ?>
                    </div>
                    <div class="group relative w-72 md:w-80 lg:w-96">

                        <input id="2" type="text" value="<?= $cs['name'] ?>" name="catName" class="peer h-10 w-full rounded-md bg-gray-50 px-4 font-thin outline-none drop-shadow-sm transition-all duration-200 ease-in-out focus:bg-white focus:ring-2 focus:ring-blue-400" />
                        <span class="absolute block pt-1 text-xs font-semibold text-gray-500 opacity-0 transition-all duration-200 ease-in-out group-focus-within:opacity-100">Note: brand must be less than 255 character</span>
                        <div class="flex items-start space-x-3 pt-6 pb-4">
                            <input type="checkbox" <?= $cs['state'] == 1 ? "checked" : "" ?> name="state" class="border-gray-300 rounded h-5 w-5" />

                            <div class="flex flex-col">
                                <h1 class="text-gray-700 font-medium leading-none">Show on Client</h1>
                            </div>
                        </div>
                    </div>
                    <div class="flex">
                        <button type="submit" class="rounded-lg px-8 py-3 bg-blue-500 text-blue-100 hover:bg-blue-600 duration-300">Update</button>
                    </div>
                </div>
            </form>
    <?php
        }
    }

    ?>


</section>

<?php include "layout/footer.php" ?>