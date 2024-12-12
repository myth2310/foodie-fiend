<?= $this->extend('layouts/dashboard') ?>

<?= $this->section('sidebar') ?>
<?= $this->include('admin/layouts/components/sidebar') ?>
<?= $this->endSection() ?>

<?= $this->section('navbar') ?>
<?= $this->include('admin/layouts/components/navbar') ?>
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
                                        <span class="px-3 py-1 rounded-md capitalize
    <?= $order->delivery_status === 'diantar' ? 'bg-red-500' : 'bg-green-500' ?> 
    text-white">
                                                <?= esc($order->delivery_status) ?>
                                            </span>
                                        </td>

                                        <td>
                                            <a href="<?= base_url('admin/dashboard/detail-transaksi/' . $order->id) ?>"
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