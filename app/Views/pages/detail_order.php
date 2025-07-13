<?= $this->extend('layouts/dashboard') ?>

<?= $this->section('sidebar') ?>
<?= $this->include('components/sidebar') ?>
<?= $this->endSection() ?>

<?= $this->section('navbar') ?>
<?= $this->include('components/dashboard_nav') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>



<div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 shadow-xl rounded-2xl">
    <div class="flex-auto px-0 pt-0 pb-2">
        <div id="menuContent" class="p-0 overflow-x-auto">
            <div class="ml-5 p-4 mb-2 mt-2">

                <h1 class="text-2xl font-bold mb-4">Detail Pesanan</h1>
                <div class="bg-white flex items-start">

                    <div class="w-2/3">
                        <div class="mb-4">
                            <label class="font-medium">Nama Customer:</label>
                            <p class="capitalize"><?= esc($orderDetails->name) ?></p>
                        </div>

                        <div class="mb-4">
                            <label class="font-medium">Email:</label>
                            <p><?= esc($orderDetails->email) ?></p>
                        </div>
                        <div class="mb-4">
                            <label class="font-medium">No Hp:</label>
                            <p><?= esc($orderDetails->phone) ?></p>
                        </div>
                        <div class="mb-8">
                            <label class="font-medium">Alamat:</label>
                            <p><?= esc($orderDetails->address) ?></p>
                        </div>

                        <div class="bg-gray-100 p-4 rounded-md shadow-sm">
                            <h4 class="text-lg font-semibold text-gray-800 mb-2">Informasi Pesanan</h4>
                            <p class="text-gray-600">Menu: <strong><?= esc($orderDetails->menus_name) ?></strong></p>
                            <p class="text-gray-600">Jumlah: <strong><?= esc($orderDetails->quantity) ?></strong></p>
                            <p class="text-gray-600">Total Harga: <strong>Rp <?= number_format($orderDetails->total_price, 0, ',', '.') ?></strong></p>
                            <p class="text-gray-600">Catatan : <strong>Jangan terlalu pedas</p>
                        </div>

                        <div class="bg-gray-100 p-4 rounded-md shadow-sm">
                            <h4 class="text-lg font-semibold text-gray-800 mb-5">Status Pengantaran</h4>

                            <?php if ($orderDetails->delivery_status === 'dimasak'): ?>
                                <p class="text-gray-600">
                                    <span class="px-3 py-1 rounded-md capitalize bg-yellow-500 text-white">
                                        <?= esc($orderDetails->delivery_status) ?>
                                    </span>
                                </p>
                            <?php elseif ($orderDetails->delivery_status === 'diantar'): ?>
                                <p class="text-gray-600">
                                    <span class="px-3 py-1 rounded-md capitalize bg-green-500 text-white">
                                        <?= esc($orderDetails->delivery_status) ?>
                                    </span>
                                </p>
                            <?php elseif ($orderDetails->delivery_status === 'selesai'): ?>
                                <p class="text-gray-600">
                                    <span class="px-3 py-1 rounded-md capitalize bg-green-500 text-white">
                                        <?= esc($orderDetails->delivery_status) ?>
                                    </span>
                                </p>
                            <?php else: ?>
                                <p class="text-gray-600">
                                    <span class="px-3 py-1 rounded-md capitalize bg-yellow-500 text-white">
                                       Menunggu Konfiramasi Penerimaan Pesanan
                                    </span>
                                </p>
                            <?php endif; ?>
                            
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
<script src="<?= base_url('assets/js/plugins/chartjs.min.js') ?>" async></script>
<script src="<?= base_url('assets/js/plugins/perfect-scrollbar.min.js') ?>" async></script>
<script src="<?= base_url('assets/js/argon-dashboard-tailwind.js?v=1.0.1') ?>" async></script>
<?= $this->endSection() ?>