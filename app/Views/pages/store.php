<?= $this->extend('layouts/base') ?>

<?= $this->section('content') ?>
  <?= $this->include('partial/preloader') ?>
  <?= $this->include('components/navbar') ?>
  <?= $this->include('components/dropdown_chart') ?>
  <?= $this->include('components/login_modal') ?>
  <?= $this->include('components/register_modal') ?>
  <div class="px-16 py-6">
      <div id="heroBanner" class="p-40 rounded-xl shadow-gray-800 shadow-lg bg-center bg-cover bg-no-repeat bg-[url('https://images.squarespace-cdn.com/content/v1/61709486e77e1d27c181981c/1695741277156-OMOA8F2CO65CT0X4IGZG/Urbanspace+Pearl_Savory+Selection+2.jpeg?format=1500w')] bg-blend-multiply"></div>
      <!-- Navbar Kategori Start -->
      <section>
        <div id="profile-nav" class="mt-8">
          <nav class="bg-white flex space-x-8 border-b-2 py-4 px-8 rounded-md shadow-md text-base font-semibold">
            <?php if(!$categories): ?>
              <p>Tidak ada kategori</p>
            <?php else: ?>
              <?php foreach($categories as $category): ?>
                <a href="#" class="profile-nav-link" data-target="menu-form"><?= $category->name ?></a>
              <?php endforeach ?>
            <?php endif ?>
          </nav>
        </div>
      </section>
      <!-- Navbar Kategori End -->

      <section>
        <?php if (!$menus): ?>
          <div class="flex justify-center items-center my-5">
            <p class="text-2xl text-gray-500 font-medium">Toko ini belum memiliki daftar menu</p>
          </div>
        <?php else: ?>
          <div id="menuCard" class="container mx-auto py-6 z-0">
            <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
              <?php foreach($menus as $menu): ?>
              <div class="relative mb-2 flex w-full max-w-xs flex-col overflow-hidden rounded-2xl border border-gray-100 bg-white shadow-md">
                <a href="<?= base_url('menus/' . $menu->id) ?>" class="relative mx-3 mt-3 flex h-60 overflow-hidden rounded-xl">
                  <img class="object-cover" src="<?= $menu->image_url ?>" alt="product image" />
                </a>
                <div class="mt-4 px-5 pb-5">
                  <a href="<?= base_url('menus/' . $menu->id) ?>">
                    <h5 class="text-lg font-semibold tracking-tight text-slate-900"><?= $menu->name ?? "menu pertama" ?></h5>
                  </a>
                  <div class="mt-2 mb-1 flex items-center justify-between">
                    <p>
                      <span class="text-md font-bold text-slate-900">Rp. <?= $menu->price?></span>
                    </p>
                  </div>
                  <div class="flex justify-end items-center mb-4">
                    <svg aria-hidden="true" class="h-5 w-5 text-yellow-300" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                      <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                    </svg>
                    <svg aria-hidden="true" class="h-5 w-5 text-yellow-300" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                      <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                    </svg>
                    <svg aria-hidden="true" class="h-5 w-5 text-yellow-300" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                      <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                    </svg>
                    <svg aria-hidden="true" class="h-5 w-5 text-yellow-300" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                      <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                    </svg>
                    <svg aria-hidden="true" class="h-5 w-5 text-yellow-300" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                      <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                    </svg>
                    <span class="mr-2 ml-3 rounded bg-yellow-200 px-2.5 py-0.5 text-xs font-semibold">0</span>
                  </div>
                  <form action="<?= base_url('chart/add/' . $menu->id) ?>" method="post">
                    <button type="submit" id="add-to-shoping-chart-btn" class="w-full mx-auto flex items-center justify-center rounded-md bg-yellow-500 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-yellow-700 focus:outline-none focus:ring-4 focus:ring-yellow-300">
                      <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                      </svg>
                      Tambah ke keranjang
                    </button>
                  </form>
                </div>
              </div>
              <?php endforeach ?>
            </div>
          </div>
        <?php endif ?>
      </section>
  </div>

<?= $this->endSection() ?>

<?= $this->section('footer') ?>
  <?= $this->include('components/footer') ?>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
    <script src="<?= base_url('assets/js/shopingChart.js') ?>"></script>
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