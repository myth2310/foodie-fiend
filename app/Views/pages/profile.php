<?= $this->extend('layouts/dashboard') ?>

<?= $this->section('sidebar') ?>
<?= $this->include('components/sidebar') ?>
<?= $this->endSection() ?>

<?= $this->section('navbar') ?>
<?= $this->include('components/dashboard_nav') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

<div class="flex flex-wrap -mx-3">
  <div class="flex-none w-full max-w-full px-3">
    <div class="relative flex flex-col min-w-0 mb-6 break-words bg-dark border-0 border-transparent border-solid shadow-xl rounded-2xl bg-clip-border">

      <div class="p-6 bg-gray-100 rounded-t-2xl">
        <h2 class="text-2xl font-bold text-slate-700 dark:text-dark">Profil</h2>
        <p class="text-sm text-slate-500 dark:text-slate-300">Lengkapi informasi profil UMKM Anda di bawah ini.</p>
      </div>

      <div class="relative flex flex-col min-w-0 break-words bg-dark border-0 shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
        <div class="flex-auto p-6">
          <p class="leading-normal uppercase dark:text-dark dark:opacity-60 text-sm">User Information</p>
          <div class="flex flex-wrap -mx-3">
            <div class="w-full max-w-full px-3 shrink-0 md:w-6/12 md:flex-0">
              <div class="mb-4">
                <label for="username" class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-dark/80">Nama Pemilik/Owner</label>
                <input type="text" name="name" value="<?= $store['name'] ?>" class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-dark text-sm block w-full rounded-lg border border-gray-300 px-3 py-2" readonly/>
              </div>
            </div>

            <div class="w-full max-w-full px-3 shrink-0 md:w-6/12 md:flex-0">
              <div class="mb-4">
                <label for="email" class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-dark/80">Alamat Email</label>
                <input type="email" readonly name="email" value="<?= $store['email'] ?>"class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-dark text-sm block w-full rounded-lg border border-gray-300 px-3 py-2" />
              </div>
            </div>
            <div class="w-full max-w-full px-3 shrink-0 md:w-6/12 md:flex-0">
              <div class="mb-4">
                <label for="address" class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-dark/80">Nama UMKM</label>
                <input type="text" name="address" value="<?= $store['stores_name'] ?>" class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-dark text-sm block w-full rounded-lg border border-gray-300 px-3 py-2" readonly />
              </div>
            </div>
            <div class="w-full max-w-full px-3 shrink-0 md:w-6/12 md:flex-0">
              <div class="mb-4">
                <label for="address" class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-dark/80">No Telepon</label>
                <input type="text" name="address" value="<?= $store['phone'] ?>" class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-dark text-sm block w-full rounded-lg border border-gray-300 px-3 py-2" readonly />
              </div>
            </div>
            <div class="w-full max-w-full px-3 shrink-0 md:w-6/12 md:flex-0">
              <div class="mb-4">
                <label for="address" class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-dark/80">Alamat</label>
                <input type="text" name="address" value="<?= session()->get('address') ?>" class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-dark text-sm block w-full rounded-lg border border-gray-300 px-3 py-2" readonly />
              </div>
            </div>
    
            <div id="map" class="w-full h-64 rounded-lg mb-4 mt-2 ml-3"></div>

            <script>
              const map = L.map('map').setView([<?= session()->get('lat') ?>, <?= session()->get('long') ?>], 13);

              const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
              }).addTo(map);

              const marker = L.marker([<?= session()->get('lat') ?>, <?= session()->get('long') ?>]).addTo(map)
                .bindPopup('<b><?= session()->get('name') ?></b><br /><?= session()->get('address') ?>').openPopup();


              map.on('click', onMapClick);
            </script>
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
<script src="<?= base_url('assets/js/menuDashboard.js') ?>" async></script>
<script src="<?= base_url('assets/js/plugins/chartjs.min.js') ?>" async></script>
<script src="<?= base_url('assets/js/plugins/perfect-scrollbar.min.js') ?>" async></script>
<script src="<?= base_url('assets/js/argon-dashboard-tailwind.js?v=1.0.1') ?>" async></script>
<?= $this->endSection() ?>