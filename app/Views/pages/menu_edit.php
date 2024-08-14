<?php
 $menu = $data['menu'];
 $categories = $data['category']['categories'];
//   dd($menu->image_url);
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
    <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-xl dark:bg-slate-800 dark:shadow-dark-xl rounded-2xl bg-clip-border">
      <div class="flex justify-between items-center p-6 pb-0 mb-2 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
        <h6 class="dark:text-white">Edit Menu</h6>
      </div>
      <div class="flex-auto px-0 pt-0 pb-2">
        <div id="menuContent" class="p-0 overflow-x-auto">
          <div id="addMenuForm" class="container grid grid-cols-1 md:grid-cols-2 pb-2">
            <form id="dataFormMenu" action="<?php echo "/data/menu/update/" . $menu->id ?>" class="mb-8 w-auto px-6 mr-2" enctype="multipart/form-data" method="post">
              <div class="mb-5">
                <label for="fileInput" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Foto Menu</label>
                <label for="fileInput" class="sr-only">File</label>
                <input id="fileInput" name="file" type="file" accept=".jpg, .jpeg, .png" name="image" class="cursor-pointer block w-full border border-gray-200 shadow-sm rounded-lg text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400
                file:bg-blue-700 file:text-white file:font-normal file:border-0 text-gray-600 file:me-4 file:py-3 file:px-4 dark:file:bg-neutral-700 dark:file:text-neutral-400 file:m-0">
              </div>
              <div class="mb-5">
                <label for="nama" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama</label>
                <input type="text" id="nama" name="menu_name" placeholder="Nama menu" value="<?= $menu->name ?>" class="shadow-sm border border-gray-200 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" required />
              </div>
              <div class="mb-5">
                <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deskripsi</label>
                <textarea type="text" id="description" name="menu_description" rows="4" placeholder="Deskripsi menu" class="shadow-sm border border-gray-200 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" required><?=$menu->description ?></textarea>
              </div>
              <div class="mb-5">
                <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pilih kategori</label>
                <select id="categoryOption" name="menu_category"
                  class="bg-gray-100 border border-gray-200 text-gray-600 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                  <?php foreach($categories as $category): ?>
                    <option class="dark:text-white"><?= $category->name ?></option>
                  <?php endforeach ?>
                </select>
              </div>
              <div class="mb-5">
                <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Harga</label>
                <input type="text" id="price" name="menu_price" placeholder="Harga menu" value="<?= $menu->price?>" class="shadow-sm border border-gray-200 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" required />
              </div>
              <div class="grid grid-cols-1 md:grid-cols-2 items-center gap-2">
                <button type="submit" class="ml-0 text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Perbarui Menu</button>
                <a href="/dashboard/menu" class="text-center font-medium rounded-lg cursor-pointer px-5 py-2.5 bg-red-500 hover:bg-red-700 text-white">Close</a>
              </div>
            </form>
            <div class="mt-6 mb-16 pr-4">
              <img id="imagePreview" src="<?= $menu->image_url ?>" alt="Thumbnail preview" class="w-full h-full object-cover rounded-lg shadow-lg">
            </div>
          </div>
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
  <script src="<?= base_url('assets/js/menuDashboard.js') ?>"></script>
  <script src="<?= base_url('assets/js/utils.js') ?>"></script>
  <script src="<?= base_url('assets/js/category.js') ?>" async></script>
  <script src="<?= base_url('assets/js/plugins/perfect-scrollbar.min.js') ?>" async></script>
  <!-- main script file  -->
  <script src="<?= base_url('assets/js/argon-dashboard-tailwind.js?v=1.0.1') ?>" async></script>
  <!-- plugin for charts  -->
  <script src="<?= base_url('assets/js/plugins/chartjs.min.js') ?>" async></script>
<?= $this->endSection() ?>