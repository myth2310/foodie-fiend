<?= $this->extend('layouts/dashboard') ?>

<?= $this->section('sidebar') ?>
<?= $this->include('admin/layouts/components/sidebar') ?>
<?= $this->endSection() ?>

<?= $this->section('navbar') ?>
<?= $this->include('admin/layouts/components/navbar') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

<div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 shadow-xl rounded-2xl">
    <div class="flex-auto px-0 pt-0 pb-2">
        <div id="menuContent" class="p-0 overflow-x-auto">
            <div class="ml-5 p-4 mb-2 mt-2">

                <h1 class="text-2xl font-bold mb-4">Detail UMKM</h1>
                <div class="bg-white flex items-start">

                    <div class="w-2/3">
                        <div class="mb-4">
                            <label class="font-medium">Nama UMKM:</label>
                            <p class="capitalize"><?= htmlspecialchars($umkm->name); ?></p>
                        </div>

                        <div class="mb-4">
                            <label class="font-medium">Email:</label>
                            <p><?= htmlspecialchars($umkm->email); ?></p>

                        </div>

                        <div class="mb-4">
                            <label class="font-medium">Status:</label>
                            <?php if (htmlspecialchars($umkm->is_verif) == 2): ?>
                                <p class="text-green-600">
                                    Sudah Terkonfirmasi
                                </p>
                            <?php elseif (htmlspecialchars($umkm->is_verif) == 1): ?>
                                <span class="text-yellow-500">Menunggu Konfirmasi Admin</span>
                            <?php else: ?>
                                <p class="text-red-600">
                                    Belum Terkonfirmasi
                                </p>
                            <?php endif; ?>

                        </div>

                        <div class="mb-4">
                            <label class="font-medium">Alamat:</label>
                            <p><?= htmlspecialchars($umkm->address); ?></p>
                        </div>

                        <div class="mb-4">
                            <label class="font-medium">Telepon:</label>
                            <p><?= htmlspecialchars($umkm->phone); ?></p>
                        </div>
                        <div class="mb-4">
                            <label class="font-medium">KTP:</label>
                            <a href="#" class="text-blue-500 mt-2 inline-block" onclick="openModalKTP()">
                                Lihat KTP
                            </a>
                        </div>
                        <div class="mb-4">
                            <label class="font-medium">UMKM Letter:</label>
                            <a href="#" onclick="openUmkmModal()" class="text-blue-500 mt-2 inline-block">
                                Lihat Surat UMKM
                            </a>
                            <div id="umkmModal" class="bg-white w-full max-w-md rounded shadow-lg px-4 py-6 relative font-serif border border-gray-300">
                                <div class="bg-white w-full max-w-md rounded shadow-lg px-4 py-6 relative font-serif border border-gray-300">
                                    <button onclick="closeUmkmModal()" class="absolute top-2 right-4 text-gray-500 hover:text-red-500 text-xl font-bold">&times;</button>
                                    <div class="text-center mb-6">
                                        <h1 class="text-xl font-bold underline">SURAT KETERSEDIAAN MENJADI MITRA UMKM FOOD FIEND</h1>
                                    </div>
                                    <div class="text-justify leading-relaxed text-gray-800 text-sm space-y-4">
                                        <p>Yang bertanda tangan di bawah ini:</p>
                                        <ul class="ml-6 list-disc">
                                            <li>Nama UMKM : <strong><?= $umkm->name; ?></strong></li>
                                            <li>Alamat : <?= $umkm->address; ?></li>
                                            <li>Kontak : <?= $umkm->phone; ?></li>
                                        </ul>

                                        <p>Dengan ini menyatakan kesiapan kami untuk bergabung sebagai mitra resmi Food Fiend.
                                            Kami menyatakan bahwa kami adalah mitra asli yang berkomitmen untuk bekerja sama
                                            dalam memenuhi standar dan ketentuan yang telah ditetapkan oleh Food Fiend, serta
                                            menjaga kepercayaan dan integritas yang diberikan kepada kami.
                                        </p>

                                        <p>Demikian surat ketersediaan ini kami buat dengan sebenar-benarnya untuk
                                            dipergunakan sebagaimana mestinya</p>
                                        <div class="mt-8 flex justify-start text-sm">
                                            <div class="text-left">
                                                <?php if (!empty($umkm->umkm_letter)) : ?>
                                                    <img src="<?= $umkm->umkm_letter; ?>" alt="Tanda Tangan" class="h-20 mb-2 object-contain ml-auto">
                                                <?php endif; ?>
                                                <p><?= date('d F Y', strtotime($umkm->updated_at)); ?></p>
                                                <p class="mt-12 font-bold underline"><?= $umkm->user_name; ?></p>
                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="w-1/3">
                        <?php if (!empty($umkm->image_url)): ?>
                            <img src="<?= htmlspecialchars($umkm->image_url); ?>" alt="Foto UMKM" class="w-full h-auto object-cover" style="width: 200px; height: 200px;">
                        <?php else: ?>
                            <p class="text-gray-500">Foto tidak tersedia</p>
                        <?php endif; ?>
                    </div>
                </div>
                <div id="mapContainer" style="display:block;">
                    <h2 class="text-xl font-semibold mb-2">Lokasi UMKM</h2>
                    <div id="map" style="width: 100%; height: 400px;"></div>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- Modal Structure -->
<div class="fixed inset-0 flex items-center justify-center z-50" id="KTPModal" style="display:none;">
    <div class="modal-overlay absolute inset-0 bg-gray-600 opacity-50"></div>
    <div class="modal-container bg-white w-11/12 md:w-1/3 lg:w-1/4 rounded-lg z-10 p-4">
        <div class="modal-header flex justify-between items-center pb-4">
            <h5 class="text-lg font-semibold text-gray-800">Informasi KTP Owner/Pemilik UMKM</h5>
            <button type="button" class="text-gray-500" id="closeModalKTP">&times;</button>
        </div>
        <div class="modal-body flex justify-center items-center" id="modalBody">
            <div id="loadingSpinner" class="flex items-center justify-center h-32">
                <svg class="animate-spin h-8 w-8 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.952 7.952 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
            </div>
            <img id="ktpImage" class="hidden max-w-full h-auto rounded mt-3" src="" alt="KTP Owner/Pemilik UMKM">
        </div>
    </div>
</div>

<script>
    const mapContainer = document.getElementById('mapContainer');
    const loadingSpinner = document.getElementById('loadingSpinner');
    const ktpImage = document.getElementById('ktpImage');

    function openModalKTP() {
        document.getElementById('KTPModal').style.display = 'flex';
        mapContainer.style.display = 'none';

        loadingSpinner.style.display = 'flex';
        ktpImage.style.display = 'none';

        setTimeout(() => {
            ktpImage.src = "<?= htmlspecialchars($umkm->ktp_url); ?>";
            ktpImage.onload = () => {
                loadingSpinner.style.display = 'none';
                ktpImage.style.display = 'block';
            };
        }, 1000);
    }

    document.getElementById('closeModalKTP').addEventListener('click', function() {
        document.getElementById('KTPModal').style.display = 'none';
        mapContainer.style.display = 'block';
    });
</script>



<script>
    const map = L.map('map').setView([<?= htmlspecialchars($umkm->lat); ?>, <?= htmlspecialchars($umkm->long); ?>], 13);

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);

    L.marker([<?= htmlspecialchars($umkm->lat); ?>, <?= htmlspecialchars($umkm->long); ?>]).addTo(map)
        .bindPopup('<b><?= htmlspecialchars($umkm->name); ?></b><br /><?= htmlspecialchars($umkm->address); ?>')
        .openPopup();
</script>


<script>
    function openUmkmModal() {
        document.getElementById('umkmModal').classList.remove('hidden');
    }

    function closeUmkmModal() {
        document.getElementById('umkmModal').classList.add('hidden');
    }
</script>


<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="<?= base_url('assets/js/menuDashboard.js') ?>" async></script>
<script src="<?= base_url('assets/js/plugins/chartjs.min.js') ?>" async></script>
<script src="<?= base_url('assets/js/plugins/perfect-scrollbar.min.js') ?>" async></script>
<script src="<?= base_url('assets/js/argon-dashboard-tailwind.js?v=1.0.1') ?>" async></script>
<?= $this->endSection() ?>