<?php include "layout/sidebar.php" ?>
<?php include "layout/header.php" ?>
<?php include '../classes/category.php'; ?>

<?php
$cat = new category();

if (!isset($_GET['catId']) || $_GET['catId'] == null) {
    echo "<script>window.location='category.php'</script>";
} else {
    $catId = $_GET['catId'];
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $catName = $_POST['catName'];
    $state = isset($_POST['state']) ? 1 : 0;
    $insertCat = $cat->update_category($catName, $state, $catId);
}
?>


<section>
    <?php
    $catSelect = $cat->select_cat_by_id($catId);
    if ($catSelect) {
        while ($cs = $catSelect->fetch_assoc()) {
    ?>
            <form action="" method="POST" class="flex flex-col px-20 py-4">


                <div class="group w-72 md:w-80 lg:w-96">
                    <label for="10" class="inline-block w-full text-sm font-medium text-gray-500 transition-all duration-200 ease-in-out group-focus-within:text-blue-400">New Category</label>
                    <div class="block">
                        <?php
                        if (isset($insertCat)) {
                            echo $insertCat;
                        }
                        ?>
                    </div>
                    <div class="group relative w-72 md:w-80 lg:w-96">

                        <input id="2" type="text" value="<?= $cs['name'] ?>" name="catName" class="peer h-10 w-full rounded-md bg-gray-50 px-4 font-thin outline-none drop-shadow-sm transition-all duration-200 ease-in-out focus:bg-white focus:ring-2 focus:ring-blue-400" />
                        <span class="absolute block pt-1 text-xs font-semibold text-gray-500 opacity-0 transition-all duration-200 ease-in-out group-focus-within:opacity-100">Note: Category must be less than 255 character</span>
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