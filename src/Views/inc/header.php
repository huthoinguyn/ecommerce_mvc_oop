<?php

use App\Core\Helpers\SessionHelper;

header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
header("Cache-Control: max-age=2592000");

?>
<?php
if (isset($data['message'])) {
    echo $data['message'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>T-Store</title>
    <link rel="canonical" href="https://tailwinduikit.com/components/E-commerce/Components/shopping%20carts">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../src/assets/css/output.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <div id="container">
        <!-- header -->
        <header class="py-4 shadow-sm bg-pink-100 lg:bg-white">
            <div class="container flex items-center justify-between">
                <!-- logo -->
                <a href="/" class="text-3xl font-bold">
                    <span class="text-red-400">
                        T
                    </span>
                    <span>
                        - Store
                    </span>
                </a>
                <!-- logo end -->

                <!-- searchbar -->
                <div class="w-full xl:max-w-xl lg:max-w-lg lg:flex relative hidden">
                    <span class="absolute left-4 top-3 text-lg text-gray-400">
                        <i class="fas fa-search"></i>
                    </span>
                    <input type="text" class="pl-12 w-full border border-r-0 border-primary py-3 px-3 rounded-l-md focus:ring-primary focus:border-primary" placeholder="search">
                    <button type="submit" class="bg-primary border border-primary text-white px-8 font-medium rounded-r-md hover:bg-transparent hover:text-primary transition">
                        Search
                    </button>
                </div>
                <!-- searchbar end -->

                <!-- navicons -->
                <div class="space-x-4 flex items-center">
                    <a href="wishlist.php" class="block text-center text-gray-700 hover:text-primary transition relative">
                        <span class="absolute -right-0 -top-1 w-5 h-5 rounded-full flex items-center justify-center bg-primary text-white text-xs">5</span>
                        <div class="text-2xl">
                            <i class="far fa-heart"></i>
                        </div>
                        <div class="text-xs leading-3">Wish List</div>
                    </a>
                    <a href="/cart" class="lg:block text-center text-gray-700 hover:text-primary transition hidden relative">
                        <div class="text-2xl">
                            <i class="fas fa-shopping-bag"></i>
                        </div>
                        <div class="text-xs leading-3">Cart</div>
                    </a>
                    <a href="account.php" class="block text-center text-gray-700 hover:text-primary transition">
                        <div class="text-2xl">
                            <i class="far fa-user"></i>
                        </div>
                        <div class="text-xs leading-3">Account</div>
                    </a>
                </div>
                <!-- navicons end -->

            </div>
        </header>
        <!-- header end -->