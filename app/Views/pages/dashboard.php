
<?= $this->extend('layouts/dashboard') ?>
<?= $this->section('sidebar') ?>
<?= $this->include('components/sidebar') ?>
<?= $this->endSection() ?>
<?= $this->section('navbar') ?>
<?= $this->include('components/dashboard_nav') ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

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


<?php
$isVerif = $data['store']['is_verif'];

$ktpUrl = $data['store']['ktp_url'];
$umkmLetter = $data['store']['umkm_letter'];

if ($isVerif == 0 && is_null($ktpUrl) && is_null($umkmLetter)) : ?>
  <div class="bg-red-100 border-l-4 border-yellow-500 text-yellow-700 p-4 ml-4 mb-4 rounded-lg">
    <p><strong class="font-bold">Information: </strong> Akun Anda belum diverifikasi. Segera lengkapi data profil UMKM untuk mengakses semua fitur.</p>
    <button type="button" class="bg-green-500 text-white p-2 mt-4 rounded-md" onclick="openModal()">Lengkapi Profil UMKM</button>
  </div>
<?php elseif ($isVerif == 0) : ?>
  <div class="ml-3" style="background-color: #e0e951; border-radius: 10px; padding: 20px; ">
    <p><strong class="font-bold">Information: </strong> Akun Anda belum diverifikasi. Silakan tunggu proses verifikasi.</p>
  </div>
<?php endif; ?>

<!-- Modal Structure -->
<!-- Modal -->
<div class="fixed inset-0 flex items-center justify-center z-50" id="profileFormModal" style="display:none;">
  <div class="modal-overlay absolute inset-0 bg-gray-600 opacity-50"></div>
  <div class="modal-container bg-white w-11/12 md:w-1/2 rounded-lg z-10 p-8">
    <div class="modal-header flex justify-between items-center pb-4">
      <h5 class="text-xl font-semibold text-gray-800">Lengkapi Informasi Profil UMKM Anda</h5>
      <button type="button" class="text-gray-500" id="closeModal">&times;</button>
    </div>
    <div class="modal-body">
      <form id="profileForm" method="POST" enctype="multipart/form-data" action="<?= base_url('dashboard/update/store/' . session()->get('user_id')) ?>">
        <?= csrf_field() ?>
        <div class="step mt-2" id="step1">
          <div class="mb-4">
            <label for="name" class="block text-gray-700">Nama Pemilik/Owner</label>
            <input type="text" name="name" value="<?= session()->get('name') ?>" class="mt-2 p-2 w-full border rounded-md" required />
          </div>
          <div class="mb-4">
            <label for="email" class="block text-gray-700">Alamat Email</label>
            <input type="email" name="email" value="<?= session()->get('email') ?>" class="mt-2 p-2 w-full border rounded-md" readonly />
          </div>
          <div class="mb-4">
            <label for="address" class="block text-gray-700">Alamat</label>
            <p class="text-sm text-gray-600 mb-2">Klik pada peta untuk memilih lokasi UMKM Anda. Lokasi dan alamat akan terisi secara otomatis.</p>
            <div id="map" class="w-full h-64 rounded-lg mb-4"></div>
            <input style="display: none;" id="latitude" name="latitude" type="text" readonly class="w-full p-2 border-2 text-center border-gray-300 rounded mt-1">
            <input style="display: none;" id="longitude" name="longitude" type="text" readonly class="w-full p-2 border-2 text-center border-gray-300 rounded mt-1">
            <textarea id="address" placeholder="Masukan Alamat" name="address" rows="3" class="w-full mt-1 px-4 py-2 bg-gray-100 rounded-md text-gray-800" readonly required><?= session()->get('address') ?></textarea>
          </div>
        </div>

        <!-- Step 2 -->
        <div class="step mt-2" id="step2" style="display:none;">
          <div class="mb-4">
            <label for="ktp" class="block text-gray-700">Upload KTP</label>
            <input type="file" name="ktp_url" accept="image/*,application/pdf" class="mt-2 p-2 w-full border rounded-md" required />
          </div>
          <div class="mb-4">
            <label for="umkm_letter" class="block text-gray-700">Surat Mitra UMKM</label>
            <input type="file" name="umkm_letter" accept="image/*,application/pdf" class="mt-2 p-2 w-full border rounded-md" required />
            <a href="<?= base_url('dashboard/download-template-surat') ?>"
              class="text-blue-500 mt-2 inline-block">
              Unduh Template Surat Ketersediaan Mitra UMKM
            </a>
          </div>
          <div class="mb-4 flex items-center">
            <input type="checkbox" id="confirmData" name="confirmData" class="mr-2" required>
            <label for="confirmData" class="text-gray-700">
              Saya telah memastikan bahwa data yang saya isi sudah benar.
            </label>
          </div>
        </div>

        <!-- Navigation buttons -->
        <div class="flex justify-between pt-6">
          <button type="button" class="btn-prev text-gray-500 bg-green-200 px-4 py-2 rounded-md" id="prevBtn" style="display:none;">Previous</button>
          <button type="button" class="btn-next bg-blue-500 text-white px-4 py-2 rounded-md" id="nextBtn">Next</button>
          <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-md" id="submitBtn" style="display:none;">Simpan Profil</button>
        </div>
      </form>
    </div>
  </div>
</div>

<style>
  #map {
    height: 300px;
    /* Tinggi peta */
    width: 100%;
  }
</style>

<div class="w-full px-6 py-6 mx-auto">

<div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-6  mb-6 rounded-lg shadow-lg">
    <p class="text-3xl font-bold mb-2">Total Pendapatan</p>
       <p class="text-4xl font-extrabold">Rp. <?= number_format($data['totalPendapatan'], 0, ',', '.') ?></p>
</div>



  <div class="flex flex-wrap -mx-3">
    <div class="w-full max-w-full px mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
      <div class="relative flex flex-col min-w-0 break-words bg-white shadow-xl rounded-2xl bg-clip-border">
        <div class="flex-auto p-4">
          <div class="flex flex-row -mx-3">
            <div class="flex-none w-2/3 max-w-full px-3">
              <div>
                <p class="mb-0 font-sans text-sm font-semibold leading-normal uppercase">Total Menu</p>
                <h5 class="mb-2 font-bold"><?=$data['totalMenu'] ?></h5>
              </div>
            </div>
            <div class="px-3 text-right basis-1/3">
              <div class="inline-block w-12 h-12 text-center rounded-full bg-gradient-to-tl from-blue-500 to-violet-500">
                <i class="ni leading-none ni-money-coins text-lg relative top-3.5 text-white"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- card 3 -->
    <div class="w-full max-w-full px-3 sm:w-1/2 sm:flex-none xl:w-1/4">
      <div class="relative flex flex-col min-w-0 break-words bg-white shadow-xl rounded-2xl bg-clip-border">
        <div class="flex-auto p-4">
          <div class="flex flex-row -mx-3">
            <div class="flex-none w-2/3 max-w-full px-3">
              <div>
                <p class="mb-0 font-sans text-sm font-semibold leading-normal uppercase">Pesanan</p>
                <h5 class="mb-2 font-bold"><?= $data['totalTransaksi'] ?></h5>
              </div>
            </div>
            <div class="px-3 text-right basis-1/3">
              <div class="inline-block w-12 h-12 text-center rounded-full bg-gradient-to-tl from-orange-500 to-yellow-500">
                <i class="ni leading-none ni-cart text-lg relative top-3.5 text-white"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>


<style>
  #map {
    height: 300px;
    /* atau sesuai kebutuhan */
    width: 100%;
  }
</style>


<script>
  let map;
  let marker;

  document.getElementById('profileFormModal').addEventListener('click', function() {
    // Tampilkan modal
    document.getElementById('profileFormModal').style.display = 'flex';

    // Inisialisasi peta setelah modal terbuka
    if (!map) {
      map = L.map('map').setView([-6.8737575, 109.0855475], 13);
      L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
      }).addTo(map);

      // Pindahkan kode event klik di sini agar peta hanya terinisialisasi satu kali
      map.on('click', function(e) {
        const {
          lat,
          lng
        } = e.latlng;
        document.getElementById('latitude').value = lat;
        document.getElementById('longitude').value = lng;
        fetch(`https://nominatim.openstreetmap.org/reverse?lat=${lat}&lon=${lng}&format=json`)
          .then(response => response.json())
          .then(data => {
            const address = data.display_name || "Alamat tidak ditemukan";
            document.getElementById('address').value = address;
            if (marker) {
              marker.setLatLng([lat, lng]).bindPopup(address).openPopup();
            } else {
              marker = L.marker([lat, lng]).addTo(map).bindPopup(address).openPopup();
            }
          })
          .catch(error => console.error('Error fetching address:', error));
      });
    }

    // Perbarui ukuran peta setelah modal benar-benar terbuka
    setTimeout(() => {
      map.invalidateSize();
    }, 300);
  });

  // Tutup modal
  document.getElementById('closeModal').addEventListener('click', function() {
    document.getElementById('profileFormModal').style.display = 'none';
  });
</script>


<script>
  let currentStep = 1;

  function showStep(step) {
    const steps = document.querySelectorAll('.step');
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');
    const submitBtn = document.getElementById('submitBtn');
    steps.forEach((stepDiv) => {
      stepDiv.style.display = 'none';
    });

    document.getElementById('step' + step).style.display = 'block';
    if (step === steps.length) {
      nextBtn.style.display = 'none';
      submitBtn.style.display = 'block';
    } else {
      nextBtn.style.display = 'block';
      submitBtn.style.display = 'none';
    }
    if (step === 1) {
      prevBtn.style.display = 'none';
    } else {
      prevBtn.style.display = 'block';
    }
  }

  document.getElementById('nextBtn').addEventListener('click', function() {
    if (currentStep < 3) {
      currentStep++;
      showStep(currentStep);
    }
  });
  document.getElementById('prevBtn').addEventListener('click', function() {
    if (currentStep > 1) {
      currentStep--;
      showStep(currentStep);
    }
  });

  function openModal() {
    document.getElementById('profileFormModal').style.display = 'flex';
    showStep(currentStep);
  }
  document.getElementById('closeModal').addEventListener('click', function() {
    document.getElementById('profileFormModal').style.display = 'none';
  });

  showStep(currentStep);
</script>

<?= $this->endSection() ?>

<?= $this->section('footer') ?>
<?= $this->include('components/dashboard_foot') ?>
<?= $this->endSection() ?>

<?= $this->section('navbar_configurator') ?>
<?= $this->include('components/navbar_configurator') ?>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<!-- plugin for scrollbar  -->
<script src="<?= base_url('assets/js/plugins/perfect-scrollbar.min.js') ?>" async></script>
<!-- main script file  -->
<script src="<?= base_url('assets/js/argon-dashboard-tailwind.js?v=1.0.1') ?>" async></script>
<!-- plugin for charts  -->
<script src="<?= base_url('assets/js/plugins/chartjs.min.js') ?>" async></script>
<?= $this->endSection() ?>