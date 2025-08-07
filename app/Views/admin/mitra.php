<?= $this->extend('layouts/dashboard') ?>

<?= $this->section('sidebar') ?>
<?= $this->include('admin/layouts/components/sidebar') ?>
<?= $this->endSection() ?>

<?= $this->section('navbar') ?>
<?= $this->include('admin/layouts/components/navbar') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-xl rounded-2xl bg-clip-border">
    <div class="flex justify-between items-center p-6 pb-0 mb-4 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
        <h6>Daftar Mitra UMKM</h6>
    </div>
    <div class="flex-auto px-0 pt-0 pb-2">
        <div id="menuContent" class="p-0 overflow-x-auto">
            <table id="tableMenu" class="items-center w-full mb-0 align-top border-collapse text-slate-500">
                <thead class="align-bottom">
                    <tr>
                        <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Nama</th>
                        <th class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Alamat</th>
                        <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Status</th>
                        <th class="px-6 py-3 font-semibold capitalize align-middle bg-transparent border-b border-collapse border-solid shadow-none tracking-none whitespace-nowrap text-slate-400 opacity-70"></th>
                    </tr>
                </thead>
                <tbody id="menuTable">
                    <?php foreach ($store as $item): ?>
                        <tr>
                            <td class="px-6 py-3 text-left align-middle bg-transparent border-b text-sm text-slate-700 capitalize">
                                <?= htmlspecialchars($item->name); ?>
                            </td>
                            <td class="px-6 py-3 text-left align-middle bg-transparent border-b text-sm text-slate-700">
                                <?= htmlspecialchars($item->address) ? htmlspecialchars($item->address) : ' <span class="text-yellow-500">Data belum ditambahkan</span>'; ?>

                            </td>
                            <td class="px-6 py-3 text-left align-middle bg-transparent border-b text-sm">
                                <?php if ($item->is_verif == 2): ?>
                                    <span class="text-green-500">Sudah Terkonfirmasi</span>
                                <?php elseif ($item->is_verif == 1): ?>
                                    <span class="text-yellow-500">Menunggu Konfirmasi Admin</span>
                                <?php else: ?>
                                    <span class="text-yellow-500">Menunggu Verifikasi Email</span>
                                <?php endif; ?>
                            </td>

                            <td class="px-6 py-3 text-center align-middle bg-transparent border-b text-sm text-slate-700">
                                <a href="<?= base_url('admin/dashboard/umkm/detail/' . $item->store_id); ?>" class="inline-block px-5 py-2.5 text-white bg-black rounded-lg hover:bg-gray-800">
                                    <i class="fa-solid fa-circle-exclamation"></i>&nbsp;&nbsp;Detail UMKM
                                </a>

                                <?php if (
                                    $item->is_verif == 1 &&
                                    $item->is_review == 1 &&
                                    !empty($item->ktp_url) &&
                                    !empty($item->umkm_letter)
                                ): ?>
                                    <button type="button" onclick="confirmVerification('<?= $item->store_id; ?>', '<?= htmlspecialchars($item->name); ?>')" class="inline-block px-5 py-2.5 text-white bg-gradient-to-tl from-green-600 to-green-400 rounded-lg hover:-translate-y-px">
                                        <i class="fas fa-check"></i>
                                    </button>
                                <?php endif; ?>


                                <button type="button" onclick="deleteStore('<?= $item->store_id; ?>', '<?= htmlspecialchars($item->name); ?>')" class="inline-block px-5 py-2.5 text-white bg-gradient-to-tl from-red-600 to-red-400 rounded-lg hover:-translate-y-px">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>

            </table>
            <!-- Pagination -->
            <div class="mt-4 flex justify-start ml-5 mt-5 mb-10">
                <?= $pager->links('default', 'custom_pager') ?>
            </div>
        </div>
    </div>
</div>
</div>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmVerification(storeId, storeName) {
        Swal.fire({
            title: `Verifikasi ${storeName}?`,
            text: "Anda yakin ingin memverifikasi UMKM ini?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Ya, verifikasi!",
            cancelButtonText: "Batal",
        }).then((result) => {
            if (result.isConfirmed) {

                Swal.fire({
                    title: 'Sedang diproses...',
                    text: 'Mohon tunggu sementara kami memverifikasi data',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                fetch(`<?= base_url('admin/dashboard/umkm/verify'); ?>/${storeId}`, {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                        },
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire("Berhasil", data.message, "success").then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire("Gagal", data.message, "error");
                        }
                    })
                    .catch(error => {
                        Swal.fire("Error", "Terjadi kesalahan dalam memverifikasi UMKM", "error");
                    });
            }
        });
    }
</script>


<script>
    function deleteStore(storeId, storeName) {
        Swal.fire({
            title: `Hapus ${storeName}?`,
            text: "Anda yakin ingin menghapus UMKM ini?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Ya, hapus!",
            cancelButtonText: "Batal",
        }).then((result) => {
            if (result.isConfirmed) {
                fetch(`<?= base_url('admin/dashboard/umkm/delete'); ?>/${storeId}`, {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                        },
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire("Berhasil", data.message, "success").then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire("Gagal", data.message, "error");
                        }
                    })
                    .catch(error => {
                        Swal.fire("Error", "Terjadi kesalahan dalam menghapus UMKM", "error");
                    });
            }
        });
    }
</script>


<?= $this->endSection() ?>



<?= $this->section('scripts') ?>
<script src="<?= base_url('assets/js/menuDashboard.js') ?>" async></script>
<!-- plugin for charts  -->
<script src="<?= base_url('assets/js/plugins/chartjs.min.js') ?>" async></script>
<!-- plugin for scrollbar  -->
<script src="<?= base_url('assets/js/plugins/perfect-scrollbar.min.js') ?>" async></script>
<!-- main script file  -->
<script src="<?= base_url('assets/js/argon-dashboard-tailwind.js?v=1.0.1') ?>" async></script>
<?= $this->endSection() ?>