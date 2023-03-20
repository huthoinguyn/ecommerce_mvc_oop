 <!-- Product Featured -->
 <div class="container pb-16 mt-8">
     <h2 class="flex text-2xl md:text-3xl font-medium text-gray-800 uppercase mb-6">Product Featured</h2>
     <!-- product wrapper -->
     <div class="grid lg:grid-cols-4 sm:grid-cols-2 gap-6 auto-rows-fr">
         <?php
            $featuredProd = $pd->show_feature_product();
            if ($featuredProd) {
                while ($fp = $featuredProd->fetch_assoc()) {
            ?>
                 <!-- single product -->
                 <div class="group rounded bg-white shadow overflow-hidden">
                     <!-- product image -->
                     <div class="relative h-[240px] overflow-hidden">
                         <img src="admin/uploads/<?= $fp['image'] ?>" class="w-full h-full object-cover">
                         <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center gap-2 opacity-0 group-hover:opacity-100 transition">
                             <a href="details.php" class="text-white text-lg w-9 h-9 rounded-full bg-primary hover:bg-gray-800 transition flex items-center justify-center">
                                 <i class="fas fa-search"></i>
                             </a>
                             <a href="#" class="text-white text-lg w-9 h-9 rounded-full bg-primary hover:bg-gray-800 transition flex items-center justify-center">
                                 <i class="far fa-heart"></i>
                             </a>
                         </div>
                     </div>
                     <!-- product image end -->
                     <!-- product content -->
                     <div class="pt-4 pb-3 px-4">
                         <a href="details.php?prodId=<?= $fp['id'] ?>">
                             <h4 class="uppercase font-medium text-xl mb-2 text-gray-800 hover:text-primary transition line-clamp-2">
                                 <?= $fp['name'] ?>
                             </h4>
                         </a>
                         <div class="group-hover:hidden flex items-baseline mb-1 space-x-2">
                             <p class="text-xl text-primary font-roboto font-semibold">$<?= number_format($fp['price'], 2) ?></p>
                             <!-- <p class="text-sm text-gray-400 font-roboto line-through">$55.00</p> -->
                         </div>
                         <div class="group-hover:hidden flex items-center">
                             <div class="flex gap-1 text-sm text-yellow-400">
                                 <span><i class="fas fa-star"></i></span>
                                 <span><i class="fas fa-star"></i></span>
                                 <span><i class="fas fa-star"></i></span>
                                 <span><i class="fas fa-star"></i></span>
                                 <span><i class="fas fa-star"></i></span>
                             </div>
                             <div class="text-xs text-gray-500 ml-3">(150)</div>
                         </div>
                         <!-- product button -->
                         <a href="details.php?prodId=<?= $fp['id'] ?>" class="hidden group-hover:block group-hover:animate-fadeIn w-full py-1 text-center text-white bg-primary border border-primary rounded-b hover:bg-transparent hover:text-primary transition">
                             View Details
                         </a>
                         <!-- product button end -->
                     </div>
                     <!-- product content end -->

                 </div>
                 <!-- single product end -->
         <?php
                }
            }
            ?>
     </div>
     <!-- product wrapper end -->

 </div>
 <!-- top new arrival end -->