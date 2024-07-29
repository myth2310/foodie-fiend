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
        <h6 class="dark:text-white">Edit Kategori</h6>
      </div>
      <div class="flex-auto px-0 pt-0 pb-2">
        <div id="categoryContent" class="p-0 overflow-x-auto">
          <div class="pb-2">
            <form id="dataFormCategory" action="<?php echo "/data/category/update/" . $data->id ?>" class="mb-8 w-auto px-6 mr-2" method="post">
              <div class="mb-5">
                <label for="nama" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama</label>
                <input type="text" name="name" id="name" value="<?= $data->name ?>" placeholder="Nama kategori" class="shadow-sm border border-gray-200 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" required/>
              </div>
              <div class="mb-5">
                <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kategori</label>
                <input type="text" name="description" id="description" value="<?= $data->description ?>" placeholder="Deskripsi kategori" class="shadow-sm border border-gray-200 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" required/>
              </div>
              <div class="grid grid-cols-1 md:grid-cols-2 items-center gap-2">
                <button type="submit" class="ml-0 text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Perbarui Kategori</button>
                <a id="closeFormBtn" href="/dashboard/category" class="text-center font-medium rounded-lg cursor-pointer px-5 py-2.5 bg-red-500 hover:bg-red-700 text-white">Close</a>
              </div>
            </form>
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
  <script src="<?= base_url('assets/js/utils.js') ?>"></script>
  <script src="<?= base_url('assets/js/category.js') ?>" async></script>
  <script src="<?= base_url('assets/js/plugins/perfect-scrollbar.min.js') ?>" async></script>
  <!-- main script file  -->
  <script src="<?= base_url('assets/js/argon-dashboard-tailwind.js?v=1.0.1') ?>" async></script>
  <!-- plugin for charts  -->
  <script src="<?= base_url('assets/js/plugins/chartjs.min.js') ?>" async></script>
<?= $this->endSection() ?>