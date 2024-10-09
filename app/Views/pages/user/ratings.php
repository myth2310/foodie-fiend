<?= $this->extend('layouts/dashboard_user') ?>
<?= $this->section('navbar') ?>
<nav class="text-gray-500 space-y-1">
  <a href="/user/dashboard" class="flex items-center py-2.5 px-4 rounded-lg transition duration-200 hover:font-semibold hover:bg-white hover:shadow-lg hover:text-gray-500" id="profile-link">
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
  <a href="/user/dashboard/order" class="flex items-center py-2.5 px-4 rounded-lg transition duration-200 font-semibold bg-white shadow-lg text-gray-500" id="shop-chart-link">
    <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center text-white bg-green-500 stroke-0 text-center xl:p-2.5">
      <i class="fas fa-clipboard-list"></i>
    </div>
    Pesanan Saya
  </a>
  <a href="/user/dashboard/setting" class="flex items-center py-2.5 px-4 rounded-lg transition duration-200 hover:font-semibold hover:bg-white hover:shadow-lg hover:text-gray-500" id="setting-link">
    <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center text-white bg-gray-500 stroke-0 text-center xl:p-2.5">
      <i class="fas fa-cog"></i>
    </div>
    Pengaturan
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

<div id="profile-nav" class="mt-4">
  <div class="bg-white flex space-x-8 border-b-2 py-4 px-8 mx-4 rounded-md shadow-md text-base font-semibold">
    <p class="text-orange-500 text-lg">Rating Produk</p>
  </div>
  <div class="mx-4 mt-5">
    <div class="bg-white shadow-lg rounded-lg p-6 w-full">
      <div class="flex items-start mb-4">
        <img src="https://static.uc.ac.id/fikom/2022/12/Pic-1.jpg" alt="Product Image" class="w-full max-w-xs h-auto  object-cover rounded-lg">
        <div class="ml-4">
          <h2 class="text-xl font-semibold text-gray-700">Mie Ayam Barbar</h2>
          <p class="text-gray-500">Gacoan Kota Tegal</p>
        </div>
      </div>

      <form action="/submit-rating" method="POST">
        <!-- Bintang Rating -->
        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2">Bintang Rating</label>
          <div class="flex space-x-1">
            <input type="radio" name="rating" value="1" id="star1" class="hidden">
            <label for="star1" class="cursor-pointer">
              <i class="fas fa-star text-gray-300 hover:text-yellow-400"></i>
            </label>

            <input type="radio" name="rating" value="2" id="star2" class="hidden">
            <label for="star2" class="cursor-pointer">
              <i class="fas fa-star text-gray-300 hover:text-yellow-400"></i>
            </label>

            <input type="radio" name="rating" value="3" id="star3" class="hidden">
            <label for="star3" class="cursor-pointer">
              <i class="fas fa-star text-gray-300 hover:text-yellow-400"></i>
            </label>

            <input type="radio" name="rating" value="4" id="star4" class="hidden">
            <label for="star4" class="cursor-pointer">
              <i class="fas fa-star text-gray-300 hover:text-yellow-400"></i>
            </label>

            <input type="radio" name="rating" value="5" id="star5" class="hidden">
            <label for="star5" class="cursor-pointer">
              <i class="fas fa-star text-gray-300 hover:text-yellow-400"></i>
            </label>
          </div>
        </div>

        <!-- Pilihan Kata Ulasan -->
        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2">Kata-kata Rekomendasi</label>
          <div class="flex space-x-2">
            <span class="p-2 bg-gray-100 rounded cursor-pointer hover:bg-blue-200 add-review-word">Lezat</span>
            <span class="p-2 bg-gray-100 rounded cursor-pointer hover:bg-blue-200 add-review-word">Porsi Banyak</span>
            <span class="p-2 bg-gray-100 rounded cursor-pointer hover:bg-blue-200 add-review-word">Harga Terjangkau</span>
            <span class="p-2 bg-gray-100 rounded cursor-pointer hover:bg-blue-200 add-review-word">Rasa Otentik</span>
          </div>
        </div>
        <!-- Ulasan -->
        <div class="mb-6">
          <label for="ulasan" class="block text-gray-700 text-sm font-bold mb-2">Ulasan</label>
          <textarea id="ulasan" name="ulasan" rows="4" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Tuliskan ulasan Anda..." required></textarea>
        </div>

        <!-- Submit Button -->
        <div class="flex justify-end">
          <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
            Kirim Ulasan
          </button>
        </div>
      </form>
    </div>
  </div>
</div>


<?= $this->endSection() ?>
<?= $this->section('scripts') ?>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const stars = document.querySelectorAll('.fa-star');
    let selectedRating = 0;

    stars.forEach((star, index) => {
      star.addEventListener('click', () => {
        selectedRating = index + 1;
        document.querySelector(`input[id=star${selectedRating}]`).checked = true;
        updateStars(selectedRating);
      });

      star.addEventListener('mouseover', () => {
        updateStars(index + 1);
      });

      star.addEventListener('mouseout', () => {
        updateStars(selectedRating);
      });
    });

    function updateStars(rating) {
      stars.forEach((star, i) => {
        if (i < rating) {
          star.classList.add('text-yellow-400');
          star.classList.remove('text-gray-300');
        } else {
          star.classList.add('text-gray-300');
          star.classList.remove('text-yellow-400');
        }
      });
    }
  });
</script>
<script>
  document.querySelectorAll('.add-review-word').forEach(item => {
    item.addEventListener('click', event => {
      const word = event.target.textContent;
      const textarea = document.getElementById('ulasan');

      textarea.value += (textarea.value ? ' ' + ' ': '') + word;
    });
  });
</script>

<?= $this->endSection() ?>