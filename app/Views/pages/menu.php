<?php
// dd($data);
 $menus = $data['menu']['menus'];
 $categories = $data['category']['categories'];
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
      <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-xl rounded-2xl bg-clip-border">
        <div class="flex justify-between items-center p-6 pb-0 mb-4 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
          <h6>Daftar Menu</h6>
          <button id="addMenuBtn" type="button" class="inline-block px-5 py-2.5 font-bold leading-normal text-center text-white align-middle transition-all bg-transparent rounded-lg cursor-pointer text-sm ease-in shadow-md bg-150 bg-gradient-to-tl from-zinc-800 to-zinc-700 hover:shadow-xs active:opacity-85 hover:-translate-y-px tracking-tight-rem bg-x-25" href="javascript:;"> <i class="fas fa-plus" aria-hidden="true"> </i>&nbsp;&nbsp;Tambah Menu</button>
        </div>
        <div class="flex-auto px-0 pt-0 pb-2">
          <div id="menuContent" class="p-0 overflow-x-auto">
            <div id="addMenuForm" class="hidden container grid grid-cols-1 md:grid-cols-2 pb-2">
              <form id="dataFormMenu" action="/data/menu" class="mb-8 w-auto px-6 mr-2" enctype="multipart/form-data" method="post">
                <div class="mb-5">
                  <label for="fileInput" class="block mb-2 text-sm font-medium text-gray-900">Foto Menu</label>
                  <label for="fileInput" class="sr-only">File</label>
                  <input id="fileInput" name="file" type="file" accept=".jpg, .jpeg, .png" name="image" class="block w-full border border-gray-200 shadow-sm rounded-lg text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none
                  file:bg-blue-700 file:text-white file:font-normal file:border-0 text-gray-600 file:me-4 file:py-3 file:px-4 file:m-0" required>
                </div>
                <div class="mb-5">
                  <label for="nama" class="block mb-2 text-sm font-medium text-gray-900">Nama</label>
                  <input type="text" id="nama" name="menu_name" placeholder="Nama menu" class="shadow-sm border border-gray-200 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required />
                </div>
                <div class="mb-5">
                  <label for="description" class="block mb-2 text-sm font-medium text-gray-900">Deskripsi</label>
                  <textarea type="text" id="description" name="menu_description" rows="4" placeholder="Deskripsi menu" class="shadow-sm border border-gray-200 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required></textarea>
                </div>
                <div class="mb-5">
                  <label for="category" class="block mb-2 text-sm font-medium text-gray-900">Pilih kategori</label>
                  <select id="categoryOption" name="menu_category"
                    class="bg-gray-100 border border-gray-200 text-gray-600 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                    <?php foreach($categories as $category): ?>
                      <option><?= $category->name ?></option>
                    <?php endforeach ?>
                  </select>
                </div>
                <div class="mb-5">
                  <label for="price" class="block mb-2 text-sm font-medium text-gray-900">Harga</label>
                  <input type="text" id="price" name="menu_price" placeholder="Harga menu" class="shadow-sm border border-gray-200 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required />
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 items-center gap-2">
                  <button type="submit" class="ml-0 text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Buat Menu</button>
                  <a id="closeFormBtn" class="text-center font-medium rounded-lg cursor-pointer px-5 py-2.5 bg-red-500 hover:bg-red-700 text-white">Close</a>
                </div>
              </form>
              <div class="mt-6 mb-16 pr-4">
                <img id="imagePreview" src="https://flowbite.com/docs/images/examples/image-1.jpg" alt="Thumbnail preview" class="w-full h-full object-cover rounded-lg shadow-lg">
              </div>
            </div>

            <table id="tableMenu" class="items-center w-full mb-0 align-top border-collapse text-slate-500">
              <thead class="align-bottom">
                <tr>
                  <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Nama</th>
                  <th class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Deskripsi</th>
                  <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Harga</th>
                  <th class="px-6 py-3 font-semibold capitalize align-middle bg-transparent border-b border-collapse border-solid shadow-none tracking-none whitespace-nowrap text-slate-400 opacity-70"></th>
                </tr>
              </thead>
              <tbody id="menuTable">
                <?php if(!empty($menus)): ?>
                  <?php foreach($menus as $menu): ?>
                    <tr>
                      <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                        <div class="flex px-2 py-1">
                          <div>
                            <img src="<?= $menu->image_url ?>" class="inline-flex items-center justify-center mr-4 text-sm text-white transition-all duration-200 ease-in-out h-9 w-9 rounded-xl" alt="user1" />
                          </div>
                          <div class="flex flex-col justify-center">
                            <h6 class="mb-0 text-sm leading-normal"><?= $menu->name ?></h6>
                          </div>
                        </div>
                      </td>
                      <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                        <p class="mb-0 leading-tight text-slate-400"><?= $menu->description ?></p>
                      </td>
                      <td class="p-2 text-sm leading-normal text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                        <span class="bg-gradient-to-tl px-2.5 rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-gray-800 text-lg"><?php echo "" . number_format($menu->price + 0, 0, ',', '.') ?></span>
                      </td>
                      <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent space-x-4 items-center">
                        <a href="<?php echo '/dashboard/menu/edit/' . $menu->id ?>" class="font-semibold leading-tight text-white bg-blue-600 px-3.5 py-1.5 rounded-md"> Edit </a>
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
                      <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                        <div class="flex px-2 py-1">
                          <div>
                            <img src="" class="inline-flex items-center justify-center mr-4 text-sm text-white transition-all duration-200 ease-in-out h-9 w-9 rounded-xl" alt="user1" />
                          </div>
                          <div class="flex flex-col justify-center">
                            <h6 class="mb-0 text-sm leading-normal"> - </h6>
                          </div>
                        </div>
                      </td>
                      <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                        <p class="mb-0 leading-tight text-slate-400"> - </p>
                      </td>
                      <td class="p-2 text-sm leading-normal text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                        <span class="px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none"> - </span>
                      </td>
                      <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                        <a href="javascript:;" class="text-xs font-semibold leading-tight text-slate-400"> - </a>
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
<script src="<?= base_url('assets/js/menuDashboard.js')?>" async></script>
<!-- plugin for charts  -->
<script src="<?= base_url('assets/js/plugins/chartjs.min.js') ?>" async></script>
<!-- plugin for scrollbar  -->
<script src="<?= base_url('assets/js/plugins/perfect-scrollbar.min.js') ?>" async></script>
<!-- main script file  -->
<script src="<?= base_url('assets/js/argon-dashboard-tailwind.js?v=1.0.1') ?>" async></script>
<?= $this->endSection() ?>