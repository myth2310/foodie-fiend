<?php
  $menus = $data['menus'];
  $categories = $data['categories'];
  $totalMenu = $data['menus']['totalMenu'];
  $totalCategory = $data['categories']['totalCategory'];
  // dd($totalCategory);
?>
<?= $this->extend('layouts/dashboard') ?>

<?= $this->section('sidebar') ?>
  <?= $this->include('components/sidebar') ?>
<?= $this->endSection() ?>

<?= $this->section('navbar') ?>
  <?= $this->include('components/dashboard_nav') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
  <!-- cards -->
  <div class="w-full px-6 py-6 mx-auto">
    <!-- row 1 -->
    <div class="flex flex-wrap -mx-3">
      <!-- card1 -->
      <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
        <div class="relative flex flex-col min-w-0 break-words bg-white shadow-xl rounded-2xl bg-clip-border">
          <div class="flex-auto p-4">
            <div class="flex flex-row -mx-3">
              <div class="flex-none w-2/3 max-w-full px-3">
                <div>
                  <p class="mb-0 font-sans text-sm font-semibold leading-normal uppercase">Total Menu</p>
                  <h5 class="mb-2 font-bold"><?= $totalMenu ?? 0 ?></h5>
                </div>
              </div>
              <div class="px-3 text-right basis-1/3">
                <div class="inline-block w-12 h-12 text-center rounded-full bg-gradient-to-tl from-blue-500 to-violet-500">
                  <i class="ni leading-none ni-money-coins text-lg relative top-3.5 text-white"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- card2 -->
      <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
        <div class="relative flex flex-col min-w-0 break-words bg-white shadow-xl rounded-2xl bg-clip-border">
          <div class="flex-auto p-4">
            <div class="flex flex-row -mx-3">
              <div class="flex-none w-2/3 max-w-full px-3">
                <div>
                  <p class="mb-0 font-sans text-sm font-semibold leading-normal uppercase">Total Kategori</p>
                  <h5 class="mb-2 font-bold"><?= $totalCategory ?? 0 ?></h5>
                </div>
              </div>
              <div class="px-3 text-right basis-1/3">
                <div class="inline-block w-12 h-12 text-center rounded-full bg-gradient-to-tl from-emerald-500 to-teal-400">
                  <i class="ni leading-none ni-paper-diploma text-lg relative top-3.5 text-white"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- card 3 -->
      <div class="w-full max-w-full px-3 sm:w-1/2 sm:flex-none xl:w-1/4">
        <div class="relative flex flex-col min-w-0 break-words bg-white shadow-xl rounded-2xl bg-clip-border">
          <div class="flex-auto p-4">
            <div class="flex flex-row -mx-3">
              <div class="flex-none w-2/3 max-w-full px-3">
                <div>
                  <p class="mb-0 font-sans text-sm font-semibold leading-normal uppercase">Pesanan</p>
                  <h5 class="mb-2 font-bold"><?= $orderTotal ?? 0 ?></h5>
                </div>
              </div>
              <div class="px-3 text-right basis-1/3">
                <div class="inline-block w-12 h-12 text-center rounded-full bg-gradient-to-tl from-orange-500 to-yellow-500">
                  <i class="ni leading-none ni-cart text-lg relative top-3.5 text-white"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- cards row 3 -->
    <div class="flex flex-wrap mt-6 -mx-3">
      <div class="w-full max-w-full px-3 mt-0 mb-6 lg:mb-0 lg:w-7/12 lg:flex-none">
        <div class="relative flex flex-col min-w-0 break-words bg-white border-0 border-solid shadow-xl border-black-125 rounded-2xl bg-clip-border">
          <div class="p-4 pb-0 mb-0 rounded-t-4">
            <div class="flex justify-between">
              <h6 class="mb-2">Menu</h6>
            </div>
          </div>
          <div class="overflow-x-auto">
            <table class="items-center w-full mb-4 align-top border-collapse border-gray-200">
              <tbody>
                <?php foreach($menus['menus'] as $menu): ?>
                <tr>
                  <td class="p-2 align-middle bg-transparent border-b w-3/10 whitespace-nowrap">
                    <div class="flex items-center px-2 py-1">
                      <div>
                        <img class="h-8 w-8 bg-cover rounded-lg" src="<?= $menu->image_url ?>" alt="Country flag" />
                      </div>
                      <div class="ml-6">
                        <p class="mb-0 text-xs font-semibold leading-tight"><?= $menu->name ?></p>
                        <h6 class="mb-0 text-sm leading-normal"><?= $menu->description ?></h6>
                      </div>
                    </div>
                  </td>
                  <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap">
                    <div class="text-center">
                      <p class="mb-0 text-xs font-semibold leading-tight">Harga:</p>
                      <h6 class="mb-0 text-sm leading-normal"><?= $menu->price ?></h6>
                    </div>
                  </td>
                  <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap">
                    <div class="text-center">
                      <p class="mb-0 text-xs font-semibold leading-tight">Value:</p>
                      <h6 class="mb-0 text-sm leading-normal">$230,900</h6>
                    </div>
                  </td>
                  <td class="p-2 text-sm leading-normal align-middle bg-transparent border-b whitespace-nowrap">
                    <div class="flex-1 text-center">
                      <p class="mb-0 text-xs font-semibold leading-tight">Bounce:</p>
                      <h6 class="mb-0 text-sm leading-normal">29.9%</h6>
                    </div>
                  </td>
                </tr>
                <?php endforeach ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="w-full max-w-full px-3 mt-0 lg:w-5/12 lg:flex-none">
        <div class="border-black/12.5 shadow-xl relative flex min-w-0 flex-col break-words rounded-2xl border-0 border-solid bg-white bg-clip-border">
          <div class="p-4 pb-0 rounded-t-4">
            <h6 class="mb-0">Kategori</h6>
          </div>
          <div class="flex-auto p-4">
            <?php if($totalCategory == 0): ?>
              <p class="text-center">Kategori kosong</p>
            <?php else: ?>
              <ul class="flex flex-col pl-0 mb-0 rounded-lg">
                <?php foreach ($categories['categories'] as $category): ?>
                  <li class="relative flex justify-between py-2 pr-4 mb-2 border-0 rounded-t-lg rounded-xl text-inherit">
                    <div class="flex items-center">
                      <div class="items-center justify-center flex w-8 h-8 mr-4 text-center text-black bg-center shadow-sm fill-current stroke-none bg-gradient-to-tl from-red-500 to-orange-400 rounded-xl">
                        <i class="ni leading-none ni-paper-diploma text-lg relative text-white"></i>
                      </div>
                      <div class="flex flex-col">
                        <h6 class="mb-1 text-sm leading-normal text-slate-700"><?= $category->name ?></h6>
                      </div>
                    </div>
                    <div class="flex">
                      <button class="group ease-in leading-pro text-xs rounded-3.5xl p-1.2 h-6.5 w-6.5 mx-0 my-auto inline-block cursor-pointer border-0 bg-transparent text-center align-middle font-bold text-slate-700 shadow-none transition-all"><i class="ni ease-bounce text-2xs group-hover:translate-x-1.25 ni-bold-right transition-all duration-200" aria-hidden="true"></i></button>
                    </div>
                  </li>
                <?php endforeach; ?>
              </ul>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
<?= $this->endSection() ?>

<?= $this->section('footer') ?>
  <?= $this->include('components/dashboard_foot') ?>
<?= $this->endSection() ?>

<?= $this->section('navbar_configurator') ?>
  <?= $this->include('components/navbar_configurator') ?>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
  <!-- plugin for scrollbar  -->
  <script src="<?= base_url('assets/js/plugins/perfect-scrollbar.min.js') ?>" async></script>
  <!-- main script file  -->
  <script src="<?= base_url('assets/js/argon-dashboard-tailwind.js?v=1.0.1') ?>" async></script>
  <!-- plugin for charts  -->
  <script src="<?= base_url('assets/js/plugins/chartjs.min.js') ?>" async></script>
<?= $this->endSection() ?>