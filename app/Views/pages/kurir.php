<?= $this->extend('layouts/dashboard') ?>

<?= $this->section('sidebar') ?>
<?= $this->include('components/sidebar') ?>
<?= $this->endSection() ?>

<?= $this->section('navbar') ?>
<?= $this->include('components/dashboard_nav') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="w-full px-0">
    <div class="bg-white shadow-xl rounded-2xl overflow-hidden">

        <div class="flex justify-between items-center p-4 border-b">
            <h6 class="text-lg font-semibold">Daftar Kurir</h6>
            <a href="/dashboard/create/kurir" type="button"
                class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition duration-200">
                <i class="fas fa-plus"></i> Tambah Kurir
            </a>
        </div>

        <div class="overflow-x-auto w-full">
            <table class="w-full table-auto divide-y divide-gray-200 text-sm">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="p-4 text-left font-medium text-gray-500 uppercase">Foto</th>
                        <th class="p-4 text-left font-medium text-gray-500 uppercase">Nama</th>
                        <th class="p-4 text-left font-medium text-gray-500 uppercase">Kontak</th>
                        <th class="p-4 text-center font-medium text-gray-500 uppercase">Status</th>
                        <th class="p-4 text-center font-medium text-gray-500 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php if (!empty($kurirs)): ?>
                        <?php foreach ($kurirs as $kurir): ?>
                            <tr>
                                <td class="p-4">
                                    <img src="<?= esc($kurir['photo_url'] ?? 'https://via.placeholder.com/50') ?>"
                                        alt="<?= esc($kurir['name']) ?>"
                                        class="w-12 h-12 rounded-full object-cover border">
                                </td>
                                <td class="p-4 text-gray-900"><?= esc($kurir['name']) ?></td>
                                <td class="p-4 text-gray-900"><?= esc($kurir['contact']) ?></td>
                                <td class="p-4 text-center">
                                    <?php if ($kurir['is_active']): ?>
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Aktif</span>
                                        <?php else: ?>
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">Nonaktif</span>
                                            <?php endif; ?>
                                        </td>
                                        

                                <td class="p-4 text-center space-x-2">
                                    <button type="button"
                                        class="btn-delete inline-flex items-center px-3 py-1.5 bg-red-600 text-white text-xs font-medium rounded hover:bg-red-700 transition"
                                        data-url="/dashboard/delete/kurir/<?= esc($kurir['user_id']) ?>">
                                        <i class="fas fa-trash mr-1"></i> Hapus
                                    </button>

                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="p-6 text-center text-gray-500">
                                Belum ada kurir yang ditambahkan.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const deleteButtons = document.querySelectorAll('.btn-delete');

    deleteButtons.forEach(button => {
        button.addEventListener('click', function () {
            const url = this.getAttribute('data-url');

            Swal.fire({
                title: 'Yakin ingin menghapus kurir ini?',
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(url, {
                        method: 'POST',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '<?= csrf_hash() ?>'
                        },
                        body: JSON.stringify({})
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: data.message,
                                timer: 1500,
                                showConfirmButton: false
                            }).then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: data.message,
                            });
                        }
                    })
                    .catch(error => {
                        console.error(error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: 'Terjadi kesalahan saat menghapus data.',
                        });
                    });
                }
            });
        });
    });
});
</script>
<?php if (session()->getFlashdata('swal_success')): ?>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: '<?= session()->getFlashdata('swal_success') ?>',
            timer: 2000,
            showConfirmButton: false
        });
    </script>
<?php elseif (session()->getFlashdata('swal_error')): ?>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: '<?= session()->getFlashdata('swal_error') ?>',
        });
    </script>
<?php endif; ?>

<?= $this->endSection() ?>

<?= $this->section('footer') ?>
<?= $this->include('components/dashboard_foot') ?>
<?= $this->endSection() ?>

<?= $this->section('navbar_configurator') ?>
<?= $this->include('components/navbar_configurator') ?>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="<?= base_url('assets/js/kurirDashboard.js') ?>" async></script>
<?= $this->endSection() ?>