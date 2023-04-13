<?php

use App\Core\Helpers\SessionHelper;

include __DIR__ . "/inc/header.php";
include __DIR__ . "/inc/navbar.php";
if (SessionHelper::get('checkLogin')) {
    header('location: /notfound');
}
?>

<style>
    .rotate-45 {
        --transform-rotate: 45deg;
        transform: rotate(45deg);
    }

    .group:hover .group-hover\:flex {
        display: flex;
    }
</style>

<div class="contain py-16">
    <div class="max-w-lg mx-auto shadow px-6 py-7 rounded overflow-hidden">
        <h2 class="text-2xl uppercase font-medium mb-1">Create an account</h2>
        <p class="text-gray-600 mb-6 text-sm">
            Register for new cosutumer
        </p>

        <form action="/register" method="post" autocomplete="off">
            <div class="space-y-2">
                <div class="">
                    <label for="username" class="text-gray-600 mb-2 relative flex flex-wrap items-center group">Username
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
                        </svg>
                        <div class="absolute left-[25%] items-center hidden group-hover:flex">
                            <div class="w-3 h-3 -mr-2 rotate-45 bg-black"></div>
                            <span class="relative z-10 p-2 text-xs leading-none text-white whitespace-no-wrap bg-black shadow-lg">Username is 8-20 characters long</span>
                        </div>
                    </label>
                    <input type="text" name="username" id="username" value="<?= isset($data['values']) ? $data['values']['username'] : '' ?>" class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-primary placeholder-gray-400" placeholder="Username">
                    <small class='text-primary'><?= SessionHelper::getError('username') ?></small>
                </div>
                <div>
                    <label for="name" class="text-gray-600 mb-2 relative flex flex-wrap items-center group">Full Name
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
                        </svg>
                        <div class="absolute left-[25%] items-center hidden group-hover:flex">
                            <div class="w-3 h-3 -mr-2 rotate-45 bg-black"></div>
                            <span class="relative z-10 p-2 text-xs leading-none text-white whitespace-no-wrap bg-black shadow-lg">Note: Nguyen Van A</span>
                        </div>
                    </label>
                    <input type="text" name="name" id="name" value="<?= isset($data['values']) ? $data['values']['name'] : '' ?>" class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-primary placeholder-gray-400" placeholder="Full Name">
                    <small class='text-primary'><?= SessionHelper::getError('fullname') ?></small>
                </div>
                <div>
                    <label for="email" class="text-gray-600 mb-2 relative flex flex-wrap items-center group">Email address
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
                        </svg>
                        <div class="absolute left-[30%] items-center hidden group-hover:flex">
                            <div class="w-3 h-3 -mr-2 rotate-45 bg-black"></div>
                            <span class="relative z-10 p-2 text-xs leading-none text-white whitespace-no-wrap bg-black shadow-lg">Note: user@gmail.com</span>
                        </div>
                    </label>
                    <input type="email" name="email" id="email" value="<?= isset($data['values']) ? $data['values']['email'] : '' ?>" class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-primary placeholder-gray-400" placeholder="user@mail.com">
                    <small class='text-primary'><?= SessionHelper::getError('email') ?></small>
                </div>
                <div>
                    <label for="password" class="text-gray-600 mb-2 relative flex flex-wrap items-center group">Password
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
                        </svg>
                        <div class="absolute left-[25%] items-center hidden group-hover:flex">
                            <div class="w-3 h-3 -mr-2 rotate-45 bg-black"></div>
                            <span class="relative z-10 p-2 text-xs leading-none text-white whitespace-no-wrap bg-black shadow-lg">Minimum 8 characters, at least one uppercase letter, one lowercase letter and one number:</span>
                        </div>
                    </label>
                    <input type="password" name="password" id="password" value="<?= isset($data['values']) ? $data['values']['password'] : '' ?>" class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-primary placeholder-gray-400" placeholder="*******">
                    <small class='text-primary'><?= SessionHelper::getError('password') ?></small>
                </div>
                <div>
                    <label for="confirm" class="text-gray-600 mb-2 block">Confirm password</label>
                    <input type="password" name="confirm" id="confirm" value="<?= isset($data['values']) ? $data['values']['confirm'] : '' ?>" class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-primary placeholder-gray-400" placeholder="*******">
                    <small class='text-primary'><?= SessionHelper::getError('cfpassword') ?></small>
                </div>
            </div>
            <div class="mt-6">
                <div class="flex items-center">
                    <input type="checkbox" name="aggrement" id="aggrement" class="text-primary focus:ring-0 rounded-sm cursor-pointer">
                    <label for="aggrement" class="text-gray-600 ml-3 cursor-pointer">I have read and agree to the <a href="#" class="text-primary">terms & conditions</a></label>
                </div>
            </div>
            <div class="mt-4">
                <button type="submit" class="block w-full py-2 text-center text-white bg-primary border border-primary rounded hover:bg-transparent hover:text-primary transition uppercase font-roboto font-medium">create
                    account</button>
            </div>
        </form>

        <!-- login with -->
        <div class="mt-6 flex justify-center relative">
            <div class="text-gray-600 uppercase px-3 bg-white z-10 relative">Or signup with</div>
            <div class="absolute left-0 top-3 w-full border-b-2 border-gray-200"></div>
        </div>
        <div class="mt-4 flex gap-4">
            <a href="#" class="w-1/2 py-2 text-center text-white bg-blue-800 rounded uppercase font-roboto font-medium text-sm hover:bg-blue-700">facebook</a>
            <a href="#" class="w-1/2 py-2 text-center text-white bg-red-600 rounded uppercase font-roboto font-medium text-sm hover:bg-red-500">google</a>
        </div>
        <!-- ./login with -->

        <p class="mt-4 text-center text-gray-600">Already have account? <a href="/login" class="text-primary">Login now</a></p>
    </div>
</div>

<?php
include __DIR__ . "/inc/footer.php";

?>