<?= $this->extend('layouts/dashboard') ?>
<?= $this->section('sidebar') ?>
<?= $this->include('components/sidebar') ?>
<?= $this->endSection() ?>
<?= $this->section('navbar') ?>
<?= $this->include('components/dashboard_nav') ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>

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

if ($isVerif == 1 && is_null($ktpUrl) && is_null($umkmLetter)) : ?>
  <div class="bg-red-100 border-l-4 border-yellow-500 text-yellow-700 p-4 ml-4 mb-4 rounded-lg">
    <p><strong class="font-bold">Information: </strong> Akun Anda belum diverifikasi. Segera lengkapi data profil UMKM untuk mengakses semua fitur.</p>
    <button type="button" class="bg-green-500 text-white p-2 mt-4 rounded-md" onclick="openModal()">Lengkapi Profil UMKM</button>
  </div>
<?php elseif ($isVerif == 1) : ?>
  <div class="ml-3" style="background-color: #e0e951; border-radius: 10px; padding: 20px; ">
    <p><strong class="font-bold">Information: </strong> Akun Anda belum diverifikasi. Silakan tunggu proses verifikasi.</p>
  </div>
<?php endif; ?>


<!-- Modal Form Profile -->
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
        <!-- Step 1 -->
        <div class="step" id="step1">
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
            <input type="hidden" id="latitude" name="latitude">
            <input type="hidden" id="longitude" name="longitude">
            <textarea id="address" name="address" rows="3" class="w-full mt-1 px-4 py-2 bg-gray-100 rounded-md text-gray-800" readonly required><?= session()->get('address') ?></textarea>
          </div>
        </div>

        <!-- Step 2 -->
        <div class="step" id="step2" style="display:none;">
          <div class="mb-4">
            <label for="ktp" class="block text-gray-700">Upload KTP</label>
            <input type="file" name="ktp_url" accept="image/*" class="mt-2 p-2 w-full border rounded-md" required />
            <p class="text-sm text-gray-500">Upload file dalam bentuk gambar JPG/PNG</p>
          </div>

          <div class="mb-4">
            <label class="block text-gray-700 mb-2">Surat Kesiapan Mitra</label>
            <p class="text-gray-600 text-sm mb-4">
              Dengan ini menyatakan kesiapan kami untuk bergabung sebagai mitra resmi Food Fiend.
              Kami menyatakan bahwa kami adalah mitra asli yang berkomitmen untuk bekerja sama
              dalam memenuhi standar dan ketentuan yang telah ditetapkan oleh Food Fiend, serta
              menjaga kepercayaan dan integritas yang diberikan kepada kami.
              <br><br>
              Demikian surat ketersediaan ini kami buat dengan sebenar-benarnya untuk dipergunakan sebagaimana mestinya.
            </p>

            <canvas id="signatureCanvas" width="400" height="200" class="border border-gray-300 rounded-md"></canvas>
            <p id="signatureError" class="text-red-500 text-sm mt-1 hidden">Tanda tangan wajib diisi.</p>
            <div class="mt-2 flex gap-2 items-center">
              <button type="button" class="px-4 py-2 bg-red-500 text-white rounded" onclick="clearCanvas()">Clear</button>
              <label class="text-gray-700">Tanda Tangan Digital</label>
            </div>
     
            <!-- Hidden input untuk tanda tangan base64 -->
<input type="hidden" name="signature_base64" id="signature_base64">

          </div>

          <div class="mb-4 flex items-center">
            <input type="checkbox" id="confirmData" name="confirmData" class="mr-2" required>
            <label for="confirmData" class="text-gray-700">
              Saya telah memastikan bahwa data yang saya isi sudah benar.
            </label>
          </div>
        </div>

        <div class="flex justify-between pt-6">
          <button type="button" class="bg-blue-500 text-white px-4 py-2 rounded-md" id="prevBtn" style="display:none;">Previous</button>
          <button type="button" class="bg-blue-500 text-white px-4 py-2 rounded-md" id="nextBtn">Next</button>
          <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-md" id="submitBtn" style="display:none;">Simpan Profil</button>
        </div>
      </form>
    </div>
  </div>
</div>

<style>
  #map {
    height: 300px;
    width: 100%;
  }

  #signatureCanvas {
    border: 2px solid #000;
    touch-action: none;
    cursor: crosshair;
  }


  #signatureOutput {
    margin-top: 20px;
    max-width: 100%;
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
                <h5 class="mb-2 font-bold"><?= $data['totalMenu'] ?></h5>
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
    width: 100%;
  }
</style>


<script>
  let map;
  let marker;

  document.getElementById('profileFormModal').addEventListener('click', function() {
    document.getElementById('profileFormModal').style.display = 'flex';
    if (!map) {
      map = L.map('map').setView([-6.8737575, 109.0855475], 13);
      L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
      }).addTo(map);

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
    setTimeout(() => {
      map.invalidateSize();
    }, 300);
  });
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




<script>
  const canvas = document.getElementById("signatureCanvas");
  const ctx = canvas.getContext("2d");
  const errorMsg = document.getElementById("signatureError");
  const signatureFilled = document.getElementById("signatureFilled");

  let drawing = false;
  let hasSigned = false;

  canvas.addEventListener("mousedown", (e) => {
    drawing = true;
    ctx.beginPath();
    ctx.moveTo(e.offsetX, e.offsetY);
  });

  canvas.addEventListener("mousemove", (e) => {
    if (drawing) {
      ctx.lineTo(e.offsetX, e.offsetY);
      ctx.stroke();
      hasSigned = true;
      signatureFilled.value = "1";
      errorMsg.classList.add("hidden");
    }
  });

  canvas.addEventListener("mouseup", () => drawing = false);
  canvas.addEventListener("mouseleave", () => drawing = false);

  function clearCanvas() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    hasSigned = false;
    signatureFilled.value = "";
    errorMsg.classList.add("hidden");
  }

  document.getElementById("profileForm").addEventListener("submit", function(e) {
    if (!hasSigned) {
      e.preventDefault();
      errorMsg.classList.remove("hidden");
      canvas.scrollIntoView({
        behavior: "smooth"
      });
    }
  });
</script>

<script>
  document.getElementById("profileForm").addEventListener("submit", function (e) {
    const dataURL = canvas.toDataURL("image/png");
    document.getElementById("signature_base64").value = dataURL;
  });
</script>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    document.querySelector("form").addEventListener("submit", function() {
      Swal.fire({
        title: 'Sedang diproses...',
        text: 'Mohon tunggu sementara kami menyimpan data Anda',
        allowOutsideClick: false,
        didOpen: () => {
          Swal.showLoading()
        }
      });
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
<!-- plugin for scrollbar  -->
<script src="<?= base_url('assets/js/plugins/perfect-scrollbar.min.js') ?>" async></script>
<!-- main script file  -->
<script src="<?= base_url('assets/js/argon-dashboard-tailwind.js?v=1.0.1') ?>" async></script>
<!-- plugin for charts  -->
<script src="<?= base_url('assets/js/plugins/chartjs.min.js') ?>" async></script>
<?= $this->endSection() ?>