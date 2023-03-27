<!-- navbar -->
<nav class="bg-gray-800 hidden lg:block">
    <div class="container">
        <div class="flex">

            <!-- all category -->
            <div class="px-8 py-4 bg-primary flex items-center cursor-pointer group relative">
                <span class="text-white">
                    <i class="fas fa-bars"></i>
                </span>
                <span class="capitalize ml-2 text-white">All categories</span>
                <div class="absolute left-0 top-full w-full bg-white shadow-md py-3 invisible opacity-0 group-hover:opacity-100 group-hover:visible transition duration-300 z-50 divide-y divide-gray-300 divide-dashed">
                </div>
            </div>
            <!-- all category end -->

            <!-- nav menu -->
            <div class="flex items-center justify-between flex-grow pl-12">
                <div class="flex items-center space-x-6 text-base capitalize">
                    <a href="/" class="text-gray-200 hover:text-white transition">Home</a>
                    <a href="/shop" class="text-gray-200 hover:text-white transition">Shop</a>
                    <a href="/" class="text-gray-200 hover:text-white transition">About us</a>
                    <a href="/" class="text-gray-200 hover:text-white transition">Contact us</a>
                </div>
                <div class="flex gap-4">
                    <?php
                    if (isset($_SESSION['user'])) {
                        foreach ($_SESSION['user'] as $user) {
                            if ($user['position'] == 1) {
                                echo "  <a  href='/admin' class='text-white'>  Go to Admin </a>";
                            }
                            echo "  <span class='text-white'> " . $user['name'] . " </span>";
                            echo "  <a onclick=" . "return confirm('Are you sure to log out?')" . " href='/logout' class='text-white'>  Log out  </a>";
                        }
                    } else {
                    ?>
                        <a href="/login" class="ml-auto justify-self-end text-gray-200 hover:text-white transition">
                            Login/Register
                        </a>

                    <?php
                    }
                    ?>

                </div>
            </div>
            <!-- nav menu end -->

        </div>
    </div>
</nav>
<!-- navbar end -->