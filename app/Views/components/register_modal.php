<!-- Register Modal -->

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

<div id="registerModal" class="z-20 fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center">
  <div class="bg-white p-7 rounded-lg shadow-lg w-96">
    <div class="flex justify-end">
      <button onclick="closeModal('registerModal')" class="text-center text-gray-500 hover:bg-red-200 p-1 rounded-full hover:text-red-500 duration-150 ease-in-out">
        <svg width="30px" height="30x" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M10.0303 8.96965C9.73741 8.67676 9.26253 8.67676 8.96964 8.96965C8.67675 9.26255 8.67675 9.73742 8.96964 10.0303L10.9393 12L8.96966 13.9697C8.67677 14.2625 8.67677 14.7374 8.96966 15.0303C9.26255 15.3232 9.73743 15.3232 10.0303 15.0303L12 13.0607L13.9696 15.0303C14.2625 15.3232 14.7374 15.3232 15.0303 15.0303C15.3232 14.7374 15.3232 14.2625 15.0303 13.9696L13.0606 12L15.0303 10.0303C15.3232 9.73744 15.3232 9.26257 15.0303 8.96968C14.7374 8.67678 14.2625 8.67678 13.9696 8.96968L12 10.9393L10.0303 8.96965Z" fill="currentColor" />
          <path fill-rule="evenodd" clip-rule="evenodd" d="M12 1.25C6.06294 1.25 1.25 6.06294 1.25 12C1.25 17.9371 6.06294 22.75 12 22.75C17.9371 22.75 22.75 17.9371 22.75 12C22.75 6.06294 17.9371 1.25 12 1.25ZM2.75 12C2.75 6.89137 6.89137 2.75 12 2.75C17.1086 2.75 21.25 6.89137 21.25 12C21.25 17.1086 17.1086 21.25 12 21.25C6.89137 21.25 2.75 17.1086 2.75 12Z" fill="currentColor" />
        </svg>
      </button>
    </div>
    <h2 class="text-2xl font-bold mb-4">Buat Akun</h2>
    <form action="/register" class="mb-2" method="post">
      <?= csrf_field() ?>
      <div class="mb-4">
        <input name="name" placeholder="Nama Lengkap" type="text" class="w-full p-2 border-2 text-center border-gray-300 rounded mt-1">
      </div>
      <div class="mb-4">
        <input name="email" placeholder="Email" type="email" class="w-full p-2 border-2 text-center border-gray-300 rounded mt-1">
      </div>
      <div class="mb-4">
        <input name="phone" placeholder="Nomor telepon" type="text" class="w-full p-2 border-2 text-center border-gray-300 rounded mt-1">
      </div>
      <div class="mb-5">
        <input name="password" placeholder="Password" type="password" class="w-full p-2 border-2 text-center border-gray-300 rounded mt-1">
      </div>



      <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 ease-in-out duration-150 text-white font-semibold px-4 py-2 rounded w-full mt-2 mb-6">Register</button>
    </form>
    <p class="font-normal">Sudah punya akun?
      <button onclick="openAndCloseModal('loginModal', 'registerModal');" class="font-semibold text-yellow-600 hover:text-yellow-400 duration-150 ease-in-out">Masuk</button>
    </p>

  </div>
</div>



<!-- Input untuk Latitude dan Longitude -->
<!-- <div class="mb-4">
  <input id="latitude" name="latitude" type="text" readonly class="w-full p-2 border-2 text-center border-gray-300 rounded mt-1">
</div>
<div class="mb-4">
  <input id="longitude" name="longitude" type="text" readonly class="w-full p-2 border-2 text-center border-gray-300 rounded mt-1">
</div>
<div class="mb-4">
  <label>Alamat:</label>
  <input id="address" name="address" type="text" readonly class="w-full p-2 border-2 text-center border-gray-300 rounded mt-1">
</div>
<div id="map" class="w-full h-64 rounded-lg mb-4"></div>

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
      .catch(error => {
        console.error('Error fetching address:', error);
      });
  });
</script> -->