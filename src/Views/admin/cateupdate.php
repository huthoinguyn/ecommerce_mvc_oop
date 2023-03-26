<?php include __DIR__ . "/inc/header.php" ?>
<?php include __DIR__ . "/inc/sidebar.php" ?>


<section>
    <?php
    if (isset($data)) {
        foreach ($data as $cat) {
    ?>


            <form action="/admin/updatecat" method="POST" class="flex flex-col px-20 py-4">


                <div class="group w-72 md:w-80 lg:w-96">
                    <label for="10" class="inline-block w-full text-sm font-medium text-gray-500 transition-all duration-200 ease-in-out group-focus-within:text-blue-400">New Category</label>
                    <div class="block">
                    </div>
                    <div class="group relative w-72 md:w-80 lg:w-96">
                        <input type="hidden" name="id" value="<?= $cat['id'] ?>">
                        <input id="2" type="text" value="<?= $cat['name'] ?>" name="catName" class="peer h-10 w-full rounded-md bg-gray-50 px-4 font-thin outline-none drop-shadow-sm transition-all duration-200 ease-in-out focus:bg-white focus:ring-2 focus:ring-blue-400" />
                        <span class="absolute block pt-1 text-xs font-semibold text-gray-500 opacity-0 transition-all duration-200 ease-in-out group-focus-within:opacity-100">Note: Category must be less than 255 character</span>
                        <div class="flex items-start space-x-3 pt-6 pb-4">
                            <input type="checkbox" <?= $cat['state'] == 1 ? "checked" : "" ?> name="state" class="border-gray-300 rounded h-5 w-5" />

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

<?php include __DIR__ . "/inc/footer.php" ?>