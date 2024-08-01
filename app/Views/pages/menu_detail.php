<?= $this->extend('layouts/base') ?>

<?= $this->section('content') ?>
  <?= $this->include('partial/preloader') ?>
  <?= $this->include('components/navbar') ?>
  <?= $this->include('components/dropdown_chart') ?>
  <?= $this->include('components/login_modal') ?>
  <?= $this->include('components/register_modal') ?>
  <?= $this->include('components/store_modal') ?>

  <!-- Detail Menu Section Start -->
  <section class="text-gray-400 dark:bg-gray-800 body-font overflow-hidden">
    <div class="container px-5 py-20 mx-auto">
      <div class="lg:w-4/5 mx-auto flex flex-wrap">
        <img alt="ecommerce" class="lg:w-1/2 w-full lg:h-auto h-64 object-cover object-center rounded" src="<?= $data->image_url ?>">
        <div class="lg:w-1/2 w-full lg:pl-10 lg:py-6 mt-6 lg:mt-0">
          <h2 class="text-sm title-font text-gray-500 tracking-widest"><?= $data->store_name ?></h2>
          <h1 class="text-gray-800 dark:text-white text-3xl title-font font-medium mb-1"><?= $data->name ?></h1>
          <div class="flex mb-4">
            <span class="flex items-center">
              <svg fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 text-yellow-300" viewBox="0 0 24 24">
                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path>
              </svg>
              <svg fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 text-yellow-300" viewBox="0 0 24 24">
                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path>
              </svg>
              <svg fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 text-yellow-300" viewBox="0 0 24 24">
                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path>
              </svg>
              <svg fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 text-yellow-300" viewBox="0 0 24 24">
                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path>
              </svg>
              <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 text-yellow-300" viewBox="0 0 24 24">
                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path>
              </svg>
              <span class="ml-3">4 Reviews</span>
            </span>
          </div>
          <p class="leading-relaxed"><?= $data->description ?></p>
          <div class="flex mt-6 items-center pb-5 border-b-2 border-gray-700 mb-5">

            <form id="formOrder" class="max-w-xs mx-auto" method="post" action="<?php echo '/chart/add/' . $data->id ?>">
              <input type="text" name="menu_id" value="<?= $data->id ?>" class="hidden">
              <input type="text" name="price" value="<?= $data->price ?>" class="hidden" >
              <input type="text" name="menu_name" value="<?= $data->name ?>" class="hidden">
              <input type="text" name="menu_description" value="<?= $data->description ?>" class="hidden">
              <label for="quantity-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Atur jumlah pesan:</label>
              <div class="relative flex items-center max-w-[8rem]">
                <button type="button" id="decrement-button" class="bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:border-gray-600 hover:bg-gray-200 border border-gray-300 rounded-s-lg p-3 h-11 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none">
                  <svg class="w-3 h-3 text-gray-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h16"/>
                  </svg>
                </button>
                <input type="text" name="quantity" id="quantity-input" aria-describedby="helper-text-explanation" class="bg-gray-50 border-x-0 border-gray-300 h-11 text-center text-gray-900 text-sm focus:ring-yellow-500 focus:border-yellow-500 block w-full py-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-yellow-500 dark:focus:border-yellow-500" placeholder="100" value="1" required />
                <button type="button" id="increment-button" class="bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:border-gray-600 hover:bg-gray-200 border border-gray-300 rounded-e-lg p-3 h-11 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none">
                  <svg class="w-3 h-3 text-gray-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
                  </svg>
                </button>
              </div>
              <button type="submit" id="hiddenSubmit" class="hidden"></button>
            </form>

          </div>
          <div class="flex">
            <span class="title-font font-medium text-2xl text-gray-800 dark:text-white">Rp <?php echo "" . number_format($data->price + 0, 0, ',', '.') ?></span>
            <button id="checkoutSubmit" type="button" class="flex ml-auto text-white bg-yellow-500 border-0 py-2 px-6 focus:outline-none transition-all duration-150 ease-in-out hover:bg-yellow-600 rounded-lg">Pesan sekarang</button>
            <button id="addToChartSubmit" class="pl-2 item-center rounded-full w-10 h-10 bg-yellow-500 p-0 transition-all duration-150 ease-in-out hover:bg-yellow-600 outline-2 outline-yellow-700 border-0 inline-flex items-center justify-center text-white ml-4">
              <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
              </svg>
            </button>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Detail Menu Section Stop -->

  <!-- Review Section Start -->
  <section class="px-20 pb-24 dark:bg-gray-800">
    <div class="container px-10 mx-auto bg-white dark:bg-gray-700 rounded-lg">
      <div class="flex items-center pt-8">
       <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Semua ulasan</h2>
      </div>
      <div class="py-8">
        <ul id="listReview">
          <li class="mb-5">
            <div class="flex mb-1.5">
              <!-- Rating -->
              <span class="flex items-center">
                <svg fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 text-yellow-300" viewBox="0 0 24 24">
                  <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path>
                </svg>
                <svg fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 text-yellow-300" viewBox="0 0 24 24">
                  <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path>
                </svg>
                <svg fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 text-yellow-300" viewBox="0 0 24 24">
                  <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path>
                </svg>
                <svg fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 text-yellow-300" viewBox="0 0 24 24">
                  <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path>
                </svg>
              </span>
              <!-- Waktu review (Optional) -->
              <span class="ml-3 text-gray-600 dark:text-gray-200">1 menit yang lalu</span>
            </div>
            <div class="flex mb-1.5 items-center space-x-2">
              <!-- Image profile user -->
              <img src="https://accounts.tokopedia.com/image/v1/u/2776918/user_thumbnail/desktop?ect=4g" alt="User Profile" class="rounded-full h-10 w-10">
              <!-- Nama user -->
              <span class="text-xl text-gray-800 dark:text-gray-100 font-semibold">John Doe</span>
            </div>
            <div class="flex mb-4 dark:text-gray-100">
              <!-- Ulasan user -->
              <p>Mesin berfungsi sebagaimana mestinya. Awalnya ada sedikit masalah namun dgn segera dpt diselesaikan setelah berkomunikasi dgn admin Otten. Overall puas dgn mesinnya dan juga layanannya.</p>
            </div>
            <hr>
          </li>

          <li class="mb-5">
            <div class="flex mb-1.5">
              <!-- Rating -->
              <span class="flex items-center">
                <svg fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 text-yellow-300" viewBox="0 0 24 24">
                  <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path>
                </svg>
                <svg fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 text-yellow-300" viewBox="0 0 24 24">
                  <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path>
                </svg>
                <svg fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 text-yellow-300" viewBox="0 0 24 24">
                  <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path>
                </svg>
                <svg fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 text-yellow-300" viewBox="0 0 24 24">
                  <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path>
                </svg>
              </span>
              <!-- Waktu review (Optional) -->
              <span class="ml-3 text-gray-600 dark:text-gray-200">1 menit yang lalu</span>
            </div>
            <div class="flex mb-1.5 items-center space-x-2">
              <!-- Image profile user -->
              <img src="https://accounts.tokopedia.com/image/v1/u/2776918/user_thumbnail/desktop?ect=4g" alt="User Profile" class="rounded-full h-10 w-10">
              <!-- Nama user -->
              <span class="text-xl text-gray-800 dark:text-gray-100 font-semibold">John Doe</span>
            </div>
            <div class="flex mb-4 dark:text-gray-100">
              <!-- Ulasan user -->
              <p>Mesin berfungsi sebagaimana mestinya. Awalnya ada sedikit masalah namun dgn segera dpt diselesaikan setelah berkomunikasi dgn admin Otten. Overall puas dgn mesinnya dan juga layanannya.</p>
            </div>
            <hr>
          </li>

          <li class="mb-5">
            <div class="flex mb-1.5">
              <!-- Rating -->
              <span class="flex items-center">
                <svg fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 text-yellow-300" viewBox="0 0 24 24">
                  <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path>
                </svg>
                <svg fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 text-yellow-300" viewBox="0 0 24 24">
                  <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path>
                </svg>
                <svg fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 text-yellow-300" viewBox="0 0 24 24">
                  <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path>
                </svg>
                <svg fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 text-yellow-300" viewBox="0 0 24 24">
                  <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path>
                </svg>
              </span>
              <!-- Waktu review (Optional) -->
              <span class="ml-3 text-gray-600 dark:text-gray-200">1 menit yang lalu</span>
            </div>
            <div class="flex mb-1.5 items-center space-x-2">
              <!-- Image profile user -->
              <img src="https://accounts.tokopedia.com/image/v1/u/2776918/user_thumbnail/desktop?ect=4g" alt="User Profile" class="rounded-full h-10 w-10">
              <!-- Nama user -->
              <span class="text-xl text-gray-800 dark:text-gray-100 font-semibold">John Doe</span>
            </div>
            <div class="flex mb-4 dark:text-gray-100">
              <!-- Ulasan user -->
              <p>Mesin berfungsi sebagaimana mestinya. Awalnya ada sedikit masalah namun dgn segera dpt diselesaikan setelah berkomunikasi dgn admin Otten. Overall puas dgn mesinnya dan juga layanannya.</p>
            </div>
            <hr>
          </li>
            
        </ul>
      </div>
    </div>
  </section>
  <!-- Review Section End -->

<?= $this->endSection() ?>

<?= $this->section('footer') ?>
  <?= $this->include('components/footer') ?>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
    <script src="<?= base_url('assets/js/recommendation.js') ?>"></script>
    <script src="<?= base_url('assets/js/menuDetail.js') ?>"></script>
    <script src="<?= base_url('assets/js/chartDropDown.js') ?>"></script>
    <script src="<?= base_url('assets/js/modalAuthForm.js') ?>"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const loaded = true;
            const loaderElement = document.getElementById('loader');
            if (loaded) {
                setTimeout(() => {
                    loaderElement.style.display = 'none';
                }, 500);
            }
        });
    </script>
<?= $this->endSection() ?>