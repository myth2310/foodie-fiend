<?= $this->extend('layouts/base') ?>
<?= $this->section('content') ?>
<?= $this->include('partial/preloader') ?>
<?= $this->include('components/navbar') ?>
<?= $this->include('components/dropdown_chart') ?>
<?= $this->include('components/login_modal') ?>
<?= $this->include('components/register_modal') ?>

<section style="padding-top: 100px;">
  <div id="menuCard" class="container mx-auto px-10 mt-0">
    <div class="flex mb-4">
      <h2 class="text-2xl font-semibold text-gray-800">Hasil Pencarian Anda</h2>
    </div>

    <?php if (empty($menus)): ?>
      <div class="text-center text-gray-500 text-lg">
        Tidak ada menu yang cocok dengan pencarian Anda.
      </div>
    <?php else: ?>
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
        <?php foreach ($menus as $menu): ?>
          <div class="flex items-center w-full p-6 bg-white border border-gray-200 rounded-lg shadow-sm">
            <a href="<?= base_url('menus/' . $menu['id']) ?>" class="flex-none w-24 h-24 overflow-hidden rounded-xl mr-4">
              <img class="object-cover w-full h-full" src="<?= $menu['image_url'] ?>" alt="<?= esc($menu['name']) ?>" />
            </a>
            <div class="flex flex-col justify-between w-full">
              <a href="<?= base_url('menus/' . $menu['id']) ?>" class="mb-2">
                <p class="text-lg font-semibold text-slate-800 capitalize"><?= esc($menu['name']) ?></p>
                <h5 class="text-base tracking-tight text-slate-500 capitalize"><?= esc($menu['store_name']) ?></h5>
              </a>
              <div class="flex items-center mb-1">
                <?php for ($i = 1; $i <= 5; $i++): ?>
                  <svg aria-hidden="true" class="h-4 w-4 <?= $i <= $menu['average_rating'] ? 'text-yellow-800' : 'text-yellow-200 opacity-50' ?>" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                  </svg>
                <?php endfor ?>
                <span class="ml-2 rounded bg-yellow-200 px-2 py-0.5 text-xs font-semibold"><?= number_format($menu['average_rating'], 1) ?></span>
              </div>
              <p class="text-sm font-bold text-slate-900 mb-1">Rp. <?= number_format($menu['price'], 0, ',', '.') ?></p>
              
              <?php if (session()->get('user_id')): ?>
                <form action="<?= base_url('chart/add/' . $menu['id']) ?>" method="post">
                  <input type="hidden" name="quantity" value="1" />
                  <button type="submit" class="w-full flex items-center justify-center rounded-md bg-yellow-500 px-3 py-1 text-xs font-medium text-white hover:bg-yellow-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="mr-1 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    Masukan Keranjang
                  </button>
                </form>
              <?php else: ?>
                <button onclick="openModal('loginModal')" class="w-full flex items-center justify-center rounded-md bg-yellow-500 px-3 py-1 text-xs font-medium text-white hover:bg-yellow-700">
                  <svg xmlns="http://www.w3.org/2000/svg" class="mr-1 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                  </svg>
                  Masukan Keranjang
                </button>
              <?php endif ?>
            </div>
          </div>
        <?php endforeach ?>
      </div>
    <?php endif ?>
  </div>
</section>


<?= $this->endSection() ?>

<?= $this->section('footer') ?>
<?= $this->include('components/footer') ?>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="<?= base_url('assets/js/recommendation.js') ?>"></script>
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