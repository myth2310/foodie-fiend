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
<div id="profile-nav" class="mt-4">

  <div class="bg-white flex space-x-8 border-b-2 py-4 px-8 mx-4 rounded-md shadow-md text-base font-semibold">
    <p class="text-orange-500 text-lg">Rating Produk</p>
  </div>

  <div class="mx-4 mt-5">
    <div class="bg-white shadow-lg rounded-lg p-6 w-full">
      <div class="flex items-start mb-4">
        <img src="<?= esc($product->image_url) ?>" alt="Product Image" class="w-full max-w-xs h-auto object-cover rounded-lg">
        <div class="ml-4">
          <h2 class="text-xl font-semibold text-gray-700"><?= esc($product->name) ?></h2>
          <p class="text-gray-500"><?= esc($product->description) ?></p>
        </div>
      </div>

      <form action="/user/dashboard/review" method="POST">
        <input type="hidden" name="menu_id" value="<?= esc($product->id) ?>">
        <div class="mb-4">
          <label class="block text-gray-700">Bintang Rating</label>
          <div class="flex space-x-1">
            <?php for ($i = 1; $i <= 5; $i++): ?>
              <input type="radio" name="rating" value="<?= $i ?>" id="star<?= $i ?>" class="hidden">
              <label for="star<?= $i ?>" class="cursor-pointer">
                <i class="fas fa-star text-gray-300 hover:text-yellow-400"></i>
              </label>
            <?php endfor; ?>
          </div>
        </div>
        <div class="mb-4">
          <label class="block text-gray-700">Kata-kata Rekomendasi</label>
          <div class="flex space-x-2">
            <?php foreach (['Lezat', 'Porsi Banyak', 'Harga Terjangkau', 'Rasa Otentik'] as $word): ?>
              <span class="p-2 bg-gray-100 rounded cursor-pointer add-review-word"><?= $word ?></span>
            <?php endforeach; ?>
          </div>
        </div>
        <div class="mb-6">
          <label for="ulasan" class="block text-gray-700">Ulasan</label>
          <textarea id="ulasan" name="ulasan" rows="4" class="w-full py-2 px-3 border rounded" placeholder="Tuliskan ulasan Anda..." required></textarea>
        </div>
        <div class="flex justify-end">
          <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded">Kirim Ulasan</button>
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
        document.querySelector(`#star${selectedRating}`).checked = true;
        updateStars(selectedRating);
      });

      star.addEventListener('mouseover', () => updateStars(index + 1));
      star.addEventListener('mouseout', () => updateStars(selectedRating));
    });

    function updateStars(rating) {
      stars.forEach((star, i) => {
        star.classList.toggle('text-yellow-400', i < rating);
        star.classList.toggle('text-gray-300', i >= rating);
      });
    }

    document.querySelectorAll('.add-review-word').forEach(item => {
      item.addEventListener('click', event => {
        const word = event.target.textContent;
        const textarea = document.getElementById('ulasan');
        textarea.value += (textarea.value ? ' ' : '') + word;
      });
    });
  });
</script>
<?= $this->endSection() ?>