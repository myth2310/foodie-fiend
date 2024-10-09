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
        <h4>Daftar Pesanan</h4>
      </div>
      <div class="flex-auto px-0 pt-0 pb-2 px-6">
        <div id="menuContent" class="p-0 overflow-x-auto">
          <table id="tableMenu" class="items-center w-full mb-0 align-top border-collapse text-slate-500">
            <thead class="align-bottom">
              <tr>
                <th class="px-6 py-3 font-bold text-left uppercase">Item</th>
                <th class="px-6 py-3 font-bold text-left uppercase">Total Harga</th>
                <th class="px-6 py-3 font-bold text-left uppercase">Status Pesanan</th>
                <th class="px-6 py-3 font-bold text-left uppercase"></th>
              </tr>
            </thead>
            <tbody id="menuTable">
            
            </tbody>
          </table>
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
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

<script>
  $(document).ready(function() {
    $('#tableMenu').DataTable({
      "paging": true,      
      "searching": true,    
      "ordering": true,     
      "info": true,        
      "lengthChange": true, 
      "pageLength": 10     
    });
  });
</script>

<script src="<?= base_url('assets/js/menuDashboard.js') ?>" async></script>
<script src="<?= base_url('assets/js/plugins/chartjs.min.js') ?>" async></script>
<script src="<?= base_url('assets/js/plugins/perfect-scrollbar.min.js') ?>" async></script>
<script src="<?= base_url('assets/js/argon-dashboard-tailwind.js?v=1.0.1') ?>" async></script>
<?= $this->endSection() ?>
