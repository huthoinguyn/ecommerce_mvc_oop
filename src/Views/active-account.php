<?php

use App\Core\Helpers\SessionHelper;

include __DIR__ . "/inc/header.php";
include __DIR__ . "/inc/navbar.php";

echo SessionHelper::getSuccess('register');
?>
<div class="contain py-16">
    <div class="max-w-lg mx-auto shadow px-6 py-7 rounded overflow-hidden">
        <h2 class="text-2xl uppercase font-medium mb-1">Active Your Account</h2>
        <small class='text-primary mb-6'><?= SessionHelper::getError('active') ?></small>
        <form action="/active-account" method="POST" autocomplete="off">
            <input type="hidden" name="username" value="<?= SessionHelper::getSuccess('username') ?>">
            <div class="space-y-2">
                <div>
                    <label for="activeCode" class="text-gray-600 mb-2 block">Activation Code</label>
                    <input type="text" name="activeCode" id="username" class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-primary placeholder-gray-400" placeholder="xxxxxx">
                    <small class='text-primary'><?= SessionHelper::getError('activeCode') ?></small>
                </div>
            </div>
            <div class="mt-4">
                <button type="submit" name="submit" class="block w-full py-2 text-center text-white bg-primary border border-primary rounded hover:bg-transparent hover:text-primary transition uppercase font-roboto font-medium">Active</button>
            </div>
        </form>
    </div>
</div>

<?php
include __DIR__ . "/inc/footer.php";

?>