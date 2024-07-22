<?php
 $menus = $data['menus'];
?>

<?= $this->extend('layouts/dashboard') ?>

<?= $this->section('sidebar') ?>
  <?= $this->include('components/sidebar') ?>
<?= $this->endSection() ?>

<?= $this->section('navbar') ?>
  <?= $this->include('components/dashboard_nav') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
  <div class="flex flex-wrap -mx-3">
    <div class="flex-none w-full max-w-full px-3">
      <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
        <div class="flex justify-between items-center p-6 pb-0 mb-4 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
          <h6 class="dark:text-white">Daftar Menu</h6>
          <button id="addMenuBtn" type="button" class="inline-block px-5 py-2.5 font-bold leading-normal text-center text-white align-middle transition-all bg-transparent rounded-lg cursor-pointer text-sm ease-in shadow-md bg-150 bg-gradient-to-tl from-zinc-800 to-zinc-700 dark:bg-gradient-to-tl dark:from-slate-750 dark:to-gray-850 hover:shadow-xs active:opacity-85 hover:-translate-y-px tracking-tight-rem bg-x-25" href="javascript:;"> <i class="fas fa-plus" aria-hidden="true"> </i>&nbsp;&nbsp;Tambah Menu</button>
        </div>
        <div class="flex-auto px-0 pt-0 pb-2">
          <div id="menuContent" class="p-0 overflow-x-auto">

            <table class="items-center w-full mb-0 align-top border-collapse dark:border-white/40 text-slate-500">
              <thead class="align-bottom">
                <tr>
                  <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Nama</th>
                  <th class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Deskripsi</th>
                  <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Harga</th>
                  <th class="px-6 py-3 font-semibold capitalize align-middle bg-transparent border-b border-collapse border-solid shadow-none dark:border-white/40 dark:text-white tracking-none whitespace-nowrap text-slate-400 opacity-70"></th>
                </tr>
              </thead>
              <tbody id="menuTable">
                <?php if(!empty($menus)): ?>
                  <?php foreach($menus as $menu): ?>
                    <tr>
                      <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                        <div class="flex px-2 py-1">
                          <div>
                            <img src="<?= $menu->image_url ?>" class="inline-flex items-center justify-center mr-4 text-sm text-white transition-all duration-200 ease-in-out h-9 w-9 rounded-xl" alt="user1" />
                          </div>
                          <div class="flex flex-col justify-center">
                            <h6 class="mb-0 text-sm leading-normal dark:text-white"><?= $menu->name ?></h6>
                          </div>
                        </div>
                      </td>
                      <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                        <p class="mb-0 leading-tight dark:text-white dark:opacity-80 text-slate-400"><?= $menu->description ?></p>
                      </td>
                      <td class="p-2 text-sm leading-normal text-center align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                        <span class="bg-gradient-to-tl from-emerald-500 to-teal-400 px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white"><?= $menu->price ?></span>
                      </td>
                      <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent space-x-4 items-center">
                        <a href="javascript:;" class="font-semibold leading-tight dark:text-white dark:opacity-80 text-white bg-blue-600 px-3.5 py-1.5 rounded-md"> Edit </a>
                        <form action="<?php echo '/data/menu/delete/' . $menu->id ?>" method="post" style="display:inline;">
                          <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                          <button class="font-semibold text-white bg-red-600 px-2 py-1 rounded-md"
                            type="submit" onclick="return confirm('Anda yakin akan menghapus kategori <?= $menu->name ?>?');">Delete</button>
                        </form>
                      </td>
                    </tr>
                  <?php endforeach ?>
                <?php else: ?>
                  <tr>
                      <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                        <div class="flex px-2 py-1">
                          <div>
                            <img src="" class="inline-flex items-center justify-center mr-4 text-sm text-white transition-all duration-200 ease-in-out h-9 w-9 rounded-xl" alt="user1" />
                          </div>
                          <div class="flex flex-col justify-center">
                            <h6 class="mb-0 text-sm leading-normal dark:text-white"> - </h6>
                          </div>
                        </div>
                      </td>
                      <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                        <p class="mb-0 leading-tight dark:text-white dark:opacity-80 text-slate-400"> - </p>
                      </td>
                      <td class="p-2 text-sm leading-normal text-center align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                        <span class="px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none"> - </span>
                      </td>
                      <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                        <a href="javascript:;" class="text-xs font-semibold leading-tight dark:text-white dark:opacity-80 text-slate-400"> - </a>
                      </td>
                    </tr>
                <?php endif ?>
              </tbody>
            </table>
            
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
<!-- plugin for charts  -->
<script src="<?= base_url('assets/js/plugins/chartjs.min.js') ?>" async></script>
<!-- plugin for scrollbar  -->
<script src="<?= base_url('assets/js/plugins/perfect-scrollbar.min.js') ?>" async></script>
<!-- main script file  -->
<script src="<?= base_url('assets/js/argon-dashboard-tailwind.js?v=1.0.1') ?>" async></script>
<script src="<?= base_url('assets/js/main.js') ?>" async></script>
<?= $this->endSection() ?>