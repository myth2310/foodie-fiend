<?= $this->extend('layouts/dashboard_user') ?>

<?= $this->section('navbar') ?>

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

<nav class="text-gray-500 space-y-1">
  <a href="/user/dashboard" class="flex items-center py-2.5 px-4 rounded-lg transition duration-200 font-semibold bg-white shadow-lg text-gray-500" id="profile-link">
    <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center text-white bg-orange-500 stroke-0 text-center xl:p-2.5">
      <i class="fas fa-user"></i>
    </div>
    Akun Saya
  </a>
  <a href="/user/dashboard/chart" class="flex items-center py-2.5 px-4 rounded-lg transition duration-200 hover:font-semibold hover:bg-white hover:shadow-lg hover:text-gray-500" id="shop-chart-link">
    <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center text-white bg-yellow-500 stroke-0 text-center xl:p-2.5">
      <i class="fas fa-shopping-cart"></i>
    </div>
    Keranjang Saya
  </a>
  <a href="/user/dashboard/order" class="flex items-center py-2.5 px-4 rounded-lg transition duration-200 hover:font-semibold hover:bg-white hover:shadow-lg hover:text-gray-500" id="shop-chart-link">
    <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center text-white bg-green-500 stroke-0 text-center xl:p-2.5">
      <i class="fas fa-clipboard-list"></i>
    </div>
    Pesanan Saya
  </a>
  <a href="/recommendations" class="flex items-center py-2.5 px-4 rounded-lg transition duration-200 hover:font-semibold hover:bg-white hover:shadow-lg hover:text-gray-500" id="setting-link">
    <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center text-white bg-gray-500 stroke-0 text-center xl:p-2.5">
      <i class="fa-solid fa-bowl-food"></i>
    </div>
    Jelajah UMKM
  </a>
  <a href="/logout" class="flex items-center py-2.5 px-4 rounded-lg transition duration-200 hover:font-semibold hover:bg-white hover:shadow-lg hover:text-gray-500" id="logout-link">
    <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center text-white bg-red-500 stroke-0 text-center xl:p-2.5">
      <i class="fas fa-sign-out-alt"></i>
    </div>
    Keluar
  </a>
</nav>
<?= $this->endSection() ?>
<?= $this->section('content') ?>

<div id="user-form-detail" class="p-8 bg-white shadow-xl rounded-lg m-6">
  <div class="mb-8">
    <h1 class="font-semibold text-2xl text-gray-900">Selamat Datang di Food Fiend</h1>
    <p class="text-gray-600 mb-5">Kelola informasi profil Anda untuk melindungi dan mengamankan akun</p>

    <?php if (session()->get('address') == null): ?>
      <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4 rounded-lg">
        <strong class="font-bold">Peringatan: </strong> Lengkapi profil Anda untuk mengakses semua fitur.
      </div>
    <?php endif; ?>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
      <div class="bg-gray-50 rounded-md shadow-md p-6 flex flex-col items-center justify-center">
        <div class="relative mb-4">
          <img src="<?= session()->get('profile') ?>" alt="Profile Image" class="rounded-full h-24 w-24 shadow-lg border-4 border-gray-200">
        </div>
        <input id="profile-image-input" type="file" accept=".jpg,.jpeg,.png" class="hidden">
        <label for="profile-image-input" class="bg-blue-500 text-white px-4 py-2 rounded-md cursor-pointer hover:bg-blue-600 transition ease-in-out duration-300">
          Pilih Gambar
        </label>
        <div class="mt-4 text-center text-gray-500">
          <p>Ukuran gambar: maks. 1 MB</p>
          <p>Format Gambar: .JPEG, .PNG</p>
        </div>
      </div>
      <div>
      <form action="/user/update/<?= session()->get('user_id') ?>" method="post" class="p-4">
        <?= csrf_field() ?>
        <div class="grid gap-4">
          <div>
            <label for="name" class="block text-gray-700">Name</label>
            <input name="name" type="text" value="<?= session()->get('name') ?>" class="w-full mt-1 px-4 py-2 bg-gray-100 rounded-md text-gray-800">
          </div>
          <div>
            <label for="email" class="block text-gray-700">Email</label>
            <input name="email" type="text" value="<?= session()->get('email') ?>" disabled class="w-full mt-1 px-4 py-2 bg-gray-100 rounded-md text-gray-400">
          </div>
          <div>
            <label for="phone" class="block text-gray-700">Telepon</label>
            <input type="text" value="<?= session()->get('phone') ?>" disabled class="w-full mt-1 px-4 py-2 bg-gray-100 rounded-md text-gray-400">
          </div>
          <div>
            <label for="address" class="block text-gray-700">Alamat</label>
            <input style="display: none;" id="latitude" name="latitude" type="text" readonly class="w-full p-2 border-2 text-center border-gray-300 rounded mt-1">
            <input style="display: none;" id="longitude" name="longitude" type="text" readonly class="w-full p-2 border-2 text-center border-gray-300 rounded mt-1">
            <textarea id="address" placeholder="Masukan Alamat" name="address" rows="3" class="w-full mt-1 px-4 py-2 bg-gray-100 rounded-md text-gray-800" readonly><?= session()->get('address') ?></textarea>
          </div>
          <div>
            <div id="map" class="w-full h-64 rounded-lg mt-4"></div>
          </div>
          <div class="flex justify-end mt-4">
            <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-md">Simpan</button>
          </div>
        </div>
      </form>
      </div>
    </div>
  </div>
  

<script>
  document.getElementById('profile-image-input').addEventListener('change', function(event) {
    const reader = new FileReader();
    reader.onload = function(e) {
      document.querySelector('img[alt="Profile Image"]').src = e.target.result;
    }
    reader.readAsDataURL(event.target.files[0]);
  });
</script>
<script>
  const map = L.map('map').setView([-6.8737575, 109.0855475], 13);
  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '© OpenStreetMap contributors'
  }).addTo(map);

  let marker;

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
</script>

<?= $this->endSection() ?>