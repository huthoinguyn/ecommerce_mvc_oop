<?php include __DIR__ . "/inc/header.php" ?>
<?php include __DIR__ . "/inc/sidebar.php" ?>
<section class="">
    <div class="w-full mx-auto p-5">
        <?php
        if (isset($data['message'])) {
            echo $data['message'];
        }
        ?>
        <form class="w-full" action="/admin/addprod" method="POST" enctype="multipart/form-data">
            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                        Product Name
                    </label>
                    <input name="prodName" class="appearance-none block w-full  text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="grid-first-name" type="text" placeholder="Laptop Thinkpad">
                </div>
                <div class="w-full md:w-1/2 px-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                        Price
                    </label>
                    <input name="price" class="currencyVal appearance-none block w-full  text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name" type="text" placeholder="$12.34">
                </div>
                <div class="w-full md:w-1/2 px-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                        Price Sale
                    </label>
                    <input name="price_sale" class="currencyVal appearance-none block w-full  text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name" type="text" placeholder="$12.34">
                </div>
                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                        Featured
                    </label>
                    <select name="type" class=" text-gray-700 appearance-none border-none outline-none inline-block py-3 pl-3 pr-8 rounded leading-tight w-full">
                        <option value="1">Featured</option>
                        <option value="0">Non-featured</option>
                    </select>
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
                            if (isset($data['cats'])) {
                                foreach ($data['cats'] as $ct) {
                            ?>
                                    <option value="<?= $ct['id'] ?>"><?= $ct['name'] ?></option>

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
                            if (isset($data['brands'])) {
                                foreach ($data['brands'] as $br) {
                            ?>
                                    <option value="<?= $br['id'] ?>"><?= $br['name'] ?></option>

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
                    <textarea name="description" id="mytextarea" cols="30" rows="10"></textarea>
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




            </div>
            <div class="flex flex-wrap -mx-3 mb-6" id="contributes_box">
                <div id="attribute_item" class="attribute_item w-full flex flex-wrap -mx-3 mb-6">
                    <div class="w-1/2 md:w-1/5 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-500 text-xs font-bold mb-2" for="grid-first-name">
                            Price
                        </label>
                        <input name="price_variant[]" class="currencyVal appearance-none block w-full  text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="grid-first-name" type="text" placeholder="">
                    </div>
                    <div class="w-1/2 md:w-1/5 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-500 text-xs font-bold mb-2" for="grid-first-name">
                            Price Sale
                        </label>
                        <input name="price_sale[]" class="currencyVal appearance-none block w-full  text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="grid-first-name" type="text" placeholder="">
                    </div>
                    <div class="w-1/2 md:w-1/5 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-500 text-xs font-bold mb-2" for="grid-first-name">
                            Colors
                        </label>
                        <div class="relative w-full border-none">
                            <select name="color[]" class=" text-gray-700 appearance-none border-none outline-none inline-block py-3 pl-3 pr-8 rounded leading-tight w-full">
                                <?php
                                if (isset($data['colors'])) {
                                    foreach ($data['colors'] as $br) {
                                ?>
                                        <option value="<?= $br['id'] ?>"><?= $br['color'] ?></option>
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
                    <div class="w-1/2 md:w-1/5 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-500 text-xs font-bold mb-2" for="grid-first-name">
                            Quantity
                        </label>
                        <input name="quantity[]" class="appearance-none block w-full  text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="grid-first-name" type="number" min="0" placeholder="">
                    </div>
                    <div class="w-full md:w-1/5 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs py-2 font-bold mb-2" for="grid-first-name">
                        </label>
                        <div onclick="addAttibute()" class="rounded-lg cursor-pointer px-4 text-center py-1 bg-blue-500 text-white hover:bg-blue-600 duration-300">Add Attributes</div>
                    </div>
                </div>
            </div>
            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                    </label>
                    <button name="submit" type="submit" class="rounded-lg px-8 py-3 bg-blue-500 text-blue-100 hover:bg-blue-600 duration-300">Add</button>
                    <!-- Button -->
                </div>
            </div>
        </form>
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

    let attr_count = 0;

    function addAttibute() {
        attr_count++
        const template = `
        <div id='attribute_item_${attr_count}' class="attribute_item w-full flex flex-wrap -mx-3 mb-6"> <div class="w-1/2 md:w-1/5 px-3 mb-6 md:mb-0"> <label class="block uppercase tracking-wide text-gray-500 text-xs font-bold mb-2" for="grid-first-name"> Price </label> <input name="price_variant[]" class="currencyVal appearance-none block w-full text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="grid-first-name" type="text" placeholder=""> </div> <div class="w-1/2 md:w-1/5 px-3 mb-6 md:mb-0"> <label class="block uppercase tracking-wide text-gray-500 text-xs font-bold mb-2" for="grid-first-name"> Price Sale</label> <input name="price_sale[]" class="currencyVal appearance-none block w-full text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="grid-first-name" type="text" placeholder=""> </div> <div class="w-1/2 md:w-1/5 px-3 mb-6 md:mb-0"> <label class="block uppercase tracking-wide text-gray-500 text-xs font-bold mb-2" for="grid-first-name"> Colors </label> <div class="relative w-full border-none"> <select name="color[]" class=" text-gray-700 appearance-none border-none outline-none inline-block py-3 pl-3 pr-8 rounded leading-tight w-full"> <?php if (isset($data['colors'])) { foreach ($data['colors'] as $br) { ?> <option value="<?= $br['id'] ?>"><?= $br['color'] ?></option> <?php } } ?> </select> <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2"> <i class="fas fa-chevron-down text-gray-700"></i> </div> </div> </div> <div class="w-1/2 md:w-1/5 px-3 mb-6 md:mb-0"> <label class="block uppercase tracking-wide text-gray-500 text-xs font-bold mb-2" for="grid-first-name"> Quantity </label> <input name="quantity[]" class="appearance-none block w-full text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="grid-first-name" type="text" placeholder=""> </div> <div class="w-full md:w-1/5 px-3 mb-6 md:mb-0"> <label class="block uppercase tracking-wide text-gray-700 text-xs py-2 font-bold mb-2" for="grid-first-name"> </label> <div onclick="removeAttibute(${attr_count})" class="rounded-lg cursor-pointer text-center px-4 py-1 bg-red-400 text-white hover:bg-red-600 duration-300">Remove</div> </div> </div>
        `;
        document.querySelector('#contributes_box').insertAdjacentHTML('beforeend', template)
    }

    function removeAttibute(attr_count) {
        document.querySelector(`#attribute_item_${attr_count}`).remove()
    }

    document.querySelectorAll('.currencyVal').forEach(f => {
        f.oninput= (e) => {
            e.target.value = e.target.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');
        }
    })
</script>
<?php include __DIR__ . "/inc/footer.php" ?>