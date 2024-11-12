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
  <!-- row 1 -->
  <div class="flex flex-wrap gap-6 -mx-3">
    <!-- card 1 -->
    <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 xl:w-1/4">
      <div class="relative flex flex-col min-w-0 break-words bg-white shadow-xl rounded-2xl bg-clip-border">
        <div class="flex-auto p-4">
          <div class="flex flex-row -mx-3">
            <div class="flex-none w-2/3 max-w-full px-3">
              <p class="mb-0 font-sans text-sm font-semibold leading-normal uppercase">Total Mitra UMKM</p>
              <h5 class="mb-2 font-bold">45</h5>
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
              <h5 class="mb-2 font-bold">45</h5>
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

    <!-- card 3 -->
    <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 xl:w-1/4">
      <div class="relative flex flex-col min-w-0 break-words bg-white shadow-xl rounded-2xl bg-clip-border">
        <div class="flex-auto p-4">
          <div class="flex flex-row -mx-3">
            <div class="flex-none w-2/3 max-w-full px-3">
              <p class="mb-0 font-sans text-sm font-semibold leading-normal uppercase">Total Pendapatan</p>
              <h5 class="mb-2 font-bold">Rp. 100.000</h5>
            </div>
            <div class="px-3 text-right basis-1/3">
              <div class="inline-block w-12 h-12 text-center rounded-full bg-gradient-to-tl from-emerald-500 to-teal-400">
                <i class="ni ni-paper-diploma text-lg relative top-3.5 text-white"></i>
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
              <h5 class="mb-2 font-bold">12</h5>
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


<!-- cards row 3 -->
<!-- <div class="flex flex-wrap mt-6 -mx-3">
      <div class="w-full max-w-full px-3 mt-0 mb-6 lg:mb-0 lg:w-7/12 lg:flex-none">
        <div class="relative flex flex-col min-w-0 break-words bg-white border-0 border-solid shadow-xl border-black-125 rounded-2xl bg-clip-border">
          <div class="p-4 pb-0 mb-0 rounded-t-4">
            <div class="flex justify-between">
              <h6 class="mb-2">Daftar Menu</h6>
            </div>
          </div>
          <div class="overflow-x-auto">
            <table class="items-center w-full mb-4 align-top border-collapse border-gray-200">
              
              </tbody>
            </table>
          </div>
        </div>
      </div>
      
    </div> -->
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