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
      <div class="flex-auto px-0 pt-0 pb-2 px-6">
        <div id="menuContent" class="p-0 overflow-x-auto">

          <table id="tableMenu" class="w-full mb-10 mt-10 text-sm text-left text-gray-500">
            <thead class="bg-gradient-to-r from-indigo-500 to-purple-500 text-dark uppercase text-xs tracking-wider">
              <tr>
                <th class="px-6 py-3">Customer</th>
                <th class="px-6 py-3">Menu</th>
                <th class="px-6 py-3 text-center">Jumlah</th>
                <th class="px-6 py-3 text-center">Total Harga</th>
                <th class="px-6 py-3 text-center">Status Pembayaran</th>
                <th class="px-6 py-3 text-center">Status Pengantaran</th>
              </tr>
            </thead>
            <tbody id="menuTable" class="divide-y divide-gray-200 bg-white">
              <?php if (!empty($orders)): ?>
                <?php foreach ($orders as $order): ?>
                  <tr class="hover:bg-gray-100 transition">
                    <td class="px-6 py-4 text-gray-700">
                      <?= esc($order->customer_name) ?>
                    </td>
                    <td class="px-6 py-4 text-gray-700">
                      <?= esc($order->menu_name) ?>
                    </td>
                    <td class="px-6 py-4 text-center text-gray-700">
                      <?= esc($order->quantity) ?>
                    </td>
                    <td class="px-6 py-4 text-center text-gray-700 font-semibold">
                      Rp <?= number_format($order->total_price, 0, ',', '.') ?>
                    </td>
                    <td class="px-6 py-4 text-center">
                      <span class="px-3 py-1 rounded-md 
              <?= $order->status === 'Belum Dibayar' ? 'bg-red-500' : 'bg-green-500' ?> 
              text-white">
                        <?= esc($order->status) ?>
                      </span>
                    </td>
                    <td class="px-6 py-4 text-center">
                      <form action="<?= base_url('orders/update-status/' . $order->id) ?>" method="post">
                        <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                        <select name="status_pengantaran"
                          class="px-3 py-1 border rounded-md bg-white text-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                          <option value="">-- Pilih Status Pengiriman --</option>
                          <option value="Sedang Dimasak" <?= $order->status_pengantaran === 'Sedang Dimasak' ? 'selected' : '' ?>>Sedang Dimasak</option>
                          <option value="Sedang Diantar" <?= $order->status_pengantaran === 'Sedang Diantar' ? 'selected' : '' ?>>Sedang Diantar</option>
                          <option value="Selesai" <?= $order->status_pengantaran === 'Selesai' ? 'selected' : '' ?>>Selesai</option>
                        </select>
                        <button type="submit"
                          class="ml-2 bg-indigo-600 hover:bg-indigo-700 text-white px-3 py-1 rounded-md">
                          Ubah
                        </button>
                      </form>
                    </td>
                  </tr>
                <?php endforeach ?>
              <?php else: ?>
                <tr>
                  <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                    Tidak ada pesanan tersedia
                  </td>
                </tr>
              <?php endif ?>
            </tbody>
          </table>
          <div style="float: right" class="mb-10">
          <?= $pager->links('default', 'custom_pager') ?>
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
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>


<script src="<?= base_url('assets/js/menuDashboard.js') ?>" async></script>
<script src="<?= base_url('assets/js/plugins/chartjs.min.js') ?>" async></script>
<script src="<?= base_url('assets/js/plugins/perfect-scrollbar.min.js') ?>" async></script>
<script src="<?= base_url('assets/js/argon-dashboard-tailwind.js?v=1.0.1') ?>" async></script>
<?= $this->endSection() ?>