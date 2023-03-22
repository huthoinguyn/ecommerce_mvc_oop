<?php include __DIR__ . "/inc/header.php" ?>
<?php include __DIR__ . "/inc/sidebar.php" ?>

<section>
    <form action="brand.php" method="POST" class="flex flex-col px-20 py-4">


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

                <input id="2" type="text" name="brandName" class="peer h-10 w-full rounded-md bg-gray-50 px-4 font-thin outline-none drop-shadow-sm transition-all duration-200 ease-in-out focus:bg-white focus:ring-2 focus:ring-blue-400" />
                <span class="absolute block pt-1 text-xs font-semibold text-gray-500 opacity-0 transition-all duration-200 ease-in-out group-focus-within:opacity-100">Note: brand must be less than 255 character</span>
                <div class="flex items-start space-x-3 pt-6 pb-4">
                    <input type="checkbox" name="state" class="border-gray-300 rounded h-5 w-5" />

                    <div class="flex flex-col">
                        <h1 class="text-gray-700 font-medium leading-none">Show on Client</h1>
                    </div>
                </div>
            </div>
            <div class="flex">
                <button type="submit" class="rounded-lg px-8 py-3 bg-blue-500 text-blue-100 hover:bg-blue-600 duration-300">Add</button>
            </div>
        </div>
    </form>
    <div class="container mx-auto px-4 sm:px-8">
        <div class="py-8">
            <div>
                <h2 class="text-2xl font-semibold leading-tight">Brand List</h2>
            </div>
            <?php
            if (isset($delCat)) {
                echo $delCat;
            }
            ?>
            <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
                <div class="inline-block min-w-full shadow-md rounded-lg overflow-hidden">
                    <table class="min-w-full leading-normal">
                        <thead>
                            <tr>
                                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                    ID
                                </th>
                                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                    brand
                                </th>
                                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                    Status
                                </th>
                                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                    Action
                                </th>
                                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($data) {
                                $i = 0;
                                foreach ($data as $br) {
                                    $i++;
                            ?>
                                    <tr>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            <span><?= $i ?></span>
                                        </td>
                                        <td class="px-5 py-5 border-b flex-1 border-gray-200 bg-white text-sm">
                                            <div class="flex">
                                                <span><?= $br['name'] ?></span>
                                            </div>
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">

                                            <?php if ($br['state'] == 1) {

                                            ?>
                                                <span class="relative cursor-pointer inline-block px-3 py-1 font-semibold text-green-900 leading-tight">
                                                    <span aria-hidden class="absolute inset-0 bg-green-200 opacity-50 rounded-full"></span>
                                                    <span class="relative">Show</span>
                                                </span>
                                            <?php
                                            } else {

                                            ?>
                                                <span class="relative cursor-pointer inline-block px-3 py-1 font-semibold text-red-500 leading-tight">
                                                    <span aria-hidden class="absolute inset-0 bg-red-200 opacity-50 rounded-full"></span>
                                                    <span class="relative">Hide</span>
                                                </span>

                                            <?php
                                            } ?>



                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            <a href="brandedit.php?brandId=<?= $br['id'] ?>">Edit</a> || <a onclick="return confirm('Are you sure to delete?')" href="?brandId=<?= $br['id'] ?>">Delete</a>
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-right">
                                            <button type="button" class="inline-block text-gray-500 hover:text-gray-700">
                                                <svg class="inline-block h-6 w-6 fill-current" viewBox="0 0 24 24">
                                                    <path d="M12 6a2 2 0 110-4 2 2 0 010 4zm0 8a2 2 0 110-4 2 2 0 010 4zm-2 6a2 2 0 104 0 2 2 0 00-4 0z" />
                                                </svg>
                                            </button>
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
    </div>

</section>

<?php include __DIR__ . "/inc/footer.php" ?>