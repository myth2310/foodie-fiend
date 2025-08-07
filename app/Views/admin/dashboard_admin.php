<?= $this->extend('layouts/dashboard') ?>

<?= $this->section('sidebar') ?>
<?= $this->include('admin/layouts/components/sidebar') ?>
<?= $this->endSection() ?>

<?= $this->section('navbar') ?>
<?= $this->include('admin/layouts/components/navbar') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- cards -->
<div class="w-full px-6 py-6 mx-auto">

  <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-6 ml-4 mb-6 rounded-lg shadow-lg">
    <p class="text-3xl font-bold mb-2">Total Pendapatan</p>
    <p class="text-4xl font-extrabold">Rp. <?= number_format($totalPendapatan, 0, ',', '.') ?></p>
  </div>

  <!-- row 1 -->
  <div class="flex flex-wrap gap-6 -mx-3">
    <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 xl:w-1/4">
      <div class="relative flex flex-col min-w-0 break-words bg-white shadow-xl rounded-2xl bg-clip-border">
        <div class="flex-auto p-4">
          <div class="flex flex-row -mx-3">
            <div class="flex-none w-2/3 max-w-full px-3">
              <p class="mb-0 font-sans text-sm font-semibold leading-normal uppercase">Total Mitra UMKM</p>
              <h5 class="mb-2 font-bold"><?= $totalMitra; ?></h5>
            </div>
            <div class="px-3 text-right basis-1/3">
              <div class="inline-block w-12 h-12 text-center rounded-full bg-gradient-to-tl from-blue-500 to-violet-500">
                <i class="ni ni-money-coins text-lg relative top-3.5 text-white"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- card 2 -->
    <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 xl:w-1/4">
      <div class="relative flex flex-col min-w-0 break-words bg-white shadow-xl rounded-2xl bg-clip-border">
        <div class="flex-auto p-4">
          <div class="flex flex-row -mx-3">
            <div class="flex-none w-2/3 max-w-full px-3">
              <p class="mb-0 font-sans text-sm font-semibold leading-normal uppercase">Pengajuan UMKM</p>
              <h5 class="mb-2 font-bold"><?= $totalPengajuan; ?></h5>
            </div>
            <div class="px-3 text-right basis-1/3">
              <div class="inline-block w-12 h-12 text-center rounded-full bg-gradient-to-tl from-blue-500 to-violet-500">
                <i class="ni ni-money-coins text-lg relative top-3.5 text-white"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- card 4 -->
    <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 xl:w-1/4">
      <div class="relative flex flex-col min-w-0 break-words bg-white shadow-xl rounded-2xl bg-clip-border">
        <div class="flex-auto p-4">
          <div class="flex flex-row -mx-3">
            <div class="flex-none w-2/3 max-w-full px-3">
              <p class="mb-0 font-sans text-sm font-semibold leading-normal uppercase">Total Transaksi</p>
              <h5 class="mb-2 font-bold"><?= $totalTransaksi; ?></h5>
            </div>
            <div class="px-3 text-right basis-1/3">
              <div class="inline-block w-12 h-12 text-center rounded-full bg-gradient-to-tl from-orange-500 to-yellow-500">
                <i class="ni ni-cart text-lg relative top-3.5 text-white"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('footer') ?>
<?= $this->include('admin/layouts/components/footer') ?>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<!-- plugin for scrollbar  -->
<script src="<?= base_url('assets/js/plugins/perfect-scrollbar.min.js') ?>" async></script>
<!-- main script file  -->
<script src="<?= base_url('assets/js/argon-dashboard-tailwind.js?v=1.0.1') ?>" async></script>
<!-- plugin for charts  -->
<script src="<?= base_url('assets/js/plugins/chartjs.min.js') ?>" async></script>
<?= $this->endSection() ?>