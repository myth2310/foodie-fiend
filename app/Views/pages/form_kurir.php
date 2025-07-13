<?= $this->extend('layouts/dashboard') ?>

<?= $this->section('sidebar') ?>
<?= $this->include('components/sidebar') ?>
<?= $this->endSection() ?>

<?= $this->section('navbar') ?>
<?= $this->include('components/dashboard_nav') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="flex flex-wrap -mx-3 mt-6">
    <div class="w-full max-w-full px-3">
        <div class="bg-white rounded-xl shadow p-6">
            <h2 class="text-2xl font-semibold mb-4">Tambah Kurir</h2>
            <form action="/dashboard/store/kurir" method="post" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <?= csrf_field() ?>

                <!-- Nama -->
                <div class="col-span-1">
                    <input type="text" value="" >
                    <label for="name" class="block mb-1 text-sm font-medium text-gray-700">Nama Kurir</label>
                    <input type="text" id="name" name="name" required
                        class="w-full border border-gray-300 rounded-lg p-2 text-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:outline-none">
                </div>

                <!-- Phone -->
                <div class="col-span-1">
                    <label for="phone" class="block mb-1 text-sm font-medium text-gray-700">Nomor Telepon</label>
                    <input type="text" id="phone" name="phone" required
                        class="w-full border border-gray-300 rounded-lg p-2 text-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:outline-none">
                </div>

                <!-- Email -->
                <div class="col-span-1">
                    <label for="email" class="block mb-1 text-sm font-medium text-gray-700">Email</label>
                    <input type="email" id="email" name="email" required
                        class="w-full border border-gray-300 rounded-lg p-2 text-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:outline-none">
                </div>

                <!-- Password -->
                <div class="col-span-1">
                    <label for="password" class="block mb-1 text-sm font-medium text-gray-700">Password</label>
                    <input type="password" id="password" name="password" required
                        class="w-full border border-gray-300 rounded-lg p-2 text-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:outline-none">
                </div>

                <!-- Status -->
                <div class="col-span-1 md:col-span-2">
                    <label for="status" class="block mb-1 text-sm font-medium text-gray-700">Status Akun</label>
                    <select id="status" name="status"
                        class="w-full border border-gray-300 rounded-lg p-2 text-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:outline-none" required>
                        <option value="1">Aktif</option>
                        <option value="0">Tidak Aktif</option>
                    </select>
                </div>

                <!-- Tombol -->
                <div class="col-span-1 md:col-span-2 flex justify-between mt-4">
                    <a href="/dashboard/kurir" class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400">
                        Batal
                    </a>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                        Simpan Kurir
                    </button>
                </div>
            </form>
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
