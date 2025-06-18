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
                <th class="px-6 py-3 text-center"></th>
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
                      <span class="px-3 py-1 rounded-md capitalize
    <?= $order->status === 'Belum Dibayar' ? 'bg-red-500' : 'bg-green-500' ?> 
    text-white">
                        <?= esc($order->status) ?>
                      </span>
                    </td>
                    <td class="px-6 py-4 text-center">
                      <?php if ($order->delivery_status === 'diantar' && empty($order->bukti_pengiriman)): ?>
                        <!-- Upload Bukti jika belum diupload -->
                        <form action="<?= base_url('dashboard/upload-proof/' . $order->id) ?>" method="post" enctype="multipart/form-data" id="uploadForm_<?= $order->id ?>">
                          <?= csrf_field() ?>
                          <input
                            type="file"
                            name="bukti_pengiriman"
                            accept="image/*"
                            capture="environment"
                            style="display: none"
                            id="cameraInput_<?= $order->id ?>"
                            onchange="document.getElementById('uploadForm_<?= $order->id ?>').submit();">
                          <button type="button"
                            onclick="document.getElementById('cameraInput_<?= $order->id ?>').click();"
                            class="ml-2 bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-2 rounded-md">
                            Ambil Foto & Upload
                          </button>
                        </form>

                      <?php elseif ($order->delivery_status === 'diterima'): ?>
                        <!-- Tampilkan bukti dengan modal -->
                        <div class="flex flex-col items-center">
                          <button
                            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-1 rounded-md"
                            onclick="openModal('<?= esc($order->delivery_proof) ?>', 'modal_<?= $order->id ?>', 'modalImage_<?= $order->id ?>')">
                            Lihat Bukti
                          </button>
                        </div>
                        <!-- Modal Diperkecil -->
                        <div id="modal_<?= $order->id ?>" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex justify-center items-center">
                          <div class="bg-white p-2 rounded-md shadow-lg relative w-72">
                            <img id="modalImage_<?= $order->id ?>" src="" alt="Bukti" class="w-full h-64 object-cover rounded">
                          </div>
                        </div>

                      <?php elseif ($order->delivery_status === 'selesai'): ?>
                        <!-- Status selesai -->
                        <span class="px-3 py-1 rounded-md capitalize bg-green-500 text-white">Pesanan Selesai</span>
                        
                      </span>

                      <?php else: ?>
                        <!-- Pilihan status jika belum diantar -->
                        <form action="<?= base_url('dashboard/update-delivery-status/' . $order->id) ?>" method="post" id="statusForm_<?= $order->id ?>">
                          <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                          <select name="status_pengantaran"
                            class="px-3 py-1 border rounded-md bg-white text-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                            onchange="document.getElementById('statusForm_<?= $order->id ?>').submit();">
                            <option value="">-- Pilih Status Pengiriman --</option>
                            <option value="dimasak" <?= $order->delivery_status === 'dimasak' ? 'selected' : '' ?>>Sedang Dimasak</option>
                            <option value="diantar" <?= $order->delivery_status === 'diantar' ? 'selected' : '' ?>>Sedang Diantar</option>
                          </select>
                        </form>
                      <?php endif; ?>



                    </td>


                    <td>
                      <a href="<?= base_url('dashboard/detail-order/' . $order->id) ?>"
                        class="ml-2 bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-2 rounded-md shadow-lg transform transition duration-200 hover:scale-105 focus:ring-4 focus:ring-yellow-300">
                        <i class="fa-solid fa-circle-info mx-2"></i> Detail Pesanan
                      </a>
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


<script>
  function openModal(imageUrl, modalId, imgTagId) {
    document.getElementById(imgTagId).src = imageUrl;
    document.getElementById(modalId).classList.remove("hidden");
  }

  function closeModal(modalId) {
    document.getElementById(modalId).classList.add("hidden");
  }
</script>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<script>
  document.addEventListener('DOMContentLoaded', function() {
    <?php if (session()->getFlashdata('swal_success')): ?>
      Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: '<?= session()->getFlashdata('swal_success'); ?>',
      });
    <?php endif; ?>

    <?php if (session()->getFlashdata('swal_error')): ?>
      Swal.fire({
        icon: 'error',
        title: 'Gagal!',
        text: '<?= session()->getFlashdata('swal_error'); ?>',
      });
    <?php endif; ?>
  });
</script>


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