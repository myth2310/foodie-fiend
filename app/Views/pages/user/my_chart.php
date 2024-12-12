<?= $this->extend('layouts/dashboard_user') ?>

<?= $this->section('navbar') ?>
<nav class="text-gray-500 space-y-1">
  <a href="/user/dashboard" class="flex items-center py-2.5 px-4 rounded-lg transition duration-200 hover:font-semibold hover:bg-white hover:shadow-lg hover:text-gray-500" id="profile-link">
    <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center text-white bg-orange-500 stroke-0 text-center xl:p-2.5">
      <i class="fas fa-user"></i>
    </div>
    Akun Saya
  </a>
  <a href="/user/dashboard/chart" class="flex items-center py-2.5 px-4 rounded-lg transition duration-200 font-semibold bg-white shadow-lg text-gray-500" id="shop-chart-link">
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
<?php
$groupedItems = [];
foreach ($data as $item) {
  if (isset($item->store_id)) {
    $groupedItems[$item->store_id]['store_name'] = $item->store_name;
    $groupedItems[$item->store_id]['items'][] = $item;
    if (!isset($groupedItems[$item->store_id]['total_price'])) {
      $groupedItems[$item->store_id]['total_price'] = 0;
    }
    $groupedItems[$item->store_id]['total_price'] += $item->menu_price * $item->quantity;
  } else {
    echo "store_id tidak ditemukan untuk item ini.";
  }
}
?>

<div id="profile-nav" class="mt-4">
  <div class="bg-white flex space-x-8 border-b-2 py-4 px-8 mx-4 rounded-md shadow-md text-base font-semibold">
    <p class="text-orange-500 text-lg">Keranjang Saya</p>
  </div>

  <div id="forms" class="mt-4 mx-4">
    <div id="menu-form" class="profile-form">
      <div id="chartContainer" class="h-screen overflow-y-auto">
        <?php if (empty($groupedItems)): ?>
          <div class="text-center mt-8">
            <p class="text-lg font-semibold text-gray-500">Tidak ada keranjang pesanan.</p>
          </div>
        <?php else: ?>
          <?php foreach ($groupedItems as $store_id => $storeData): ?>
            <div class="mt-4 shadow-sm">
              <div class="flex px-6 py-4 bg-white rounded-md">
                <div class="flex items-center w-full space-x-6">
                  <span class="font-semibold text-gray-800 capitalize"><?= $storeData['store_name'] ?></span>
                  <a href="<?= base_url('/stores/' . $store_id) ?>" class="text-gray-500 hover:text-gray-700">
                    <div class="px-4 py-2 hover:bg-gray-100 transition ease-in-out duration-300 rounded-md items-center border">
                      <i class="fas fa-store"></i>
                      <span>Kunjungi Toko</span>
                    </div>
                  </a>
                </div>
              </div>

              <?php foreach ($storeData['items'] as $item): ?>
                <div class="flex px-6 py-4 bg-white rounded-md">
                  <div class="flex items-center w-full">
                    <img class="w-20 h-20 rounded-md" src="<?= $item->menu_img ?>" alt="Item image">
                    <div class="ml-4">
                      <h4 class="capitalize"><?= $item->menu_name ?></h4>
                      <!-- <p>x <?= $item->quantity ?></p> -->
                      <div class="flex items-center mt-3">
                        <button type="button" class="decrement-btn px-4 mr-2 bg-red-500 text-white rounded-l-md hover:bg-red-700 focus:outline-none transition duration-300 ease-in-out transform hover:scale-105 shadow-md active:scale-95" data-item-id="<?= $item->id ?>">-</button>
                        <input type="number" class="quantity-input w-16 border-t border-b text-center focus:outline-none" min="1" value="<?= $item->quantity ?>" data-item-id="<?= $item->id ?>">
                        <button type="button" class="increment-btn px-4 ml-2  bg-green-500 text-white rounded-r-md hover:bg-green-700 focus:outline-none transition duration-300 ease-in-out transform hover:scale-105 shadow-md active:scale-95" data-item-id="<?= $item->id ?>">+</button>
                      </div>
                      <div class="relative mt-4">
                        <label for="order-note" class="block mb-2 text-sm font-medium text-gray-700">Catatan Pesanan</label>
                        <textarea id="order-note" name="order_note" rows="2" class="w-full px-3 py-2 text-sm border rounded-md border-gray-300 bg-gray-50 focus:ring-yellow-500 focus:border-yellow-500 resize-none" placeholder="Tambahkan catatan untuk pesanan..." style="width: 450px;" require></textarea>
                      </div>
                    </div>
                  </div>
                  <div class="flex font-semibold justify-center items-center space-x-1 text-orange-400">
                    <span>Rp.</span>
                    <span><?php echo number_format($item->menu_price * $item->quantity, 0, ',', '.') ?></span>
                  </div>
                </div>
              <?php endforeach; ?>

              <div class="flex justify-between items-center w-full mt-4">
                <div class="flex items-center space-x-2">
                  <span class="text-base font-medium text-gray-800">Total Pesanan:</span>
                  <span class="text-lg font-semibold text-orange-500">Rp. <?= number_format($storeData['total_price'], 0, ',', '.') ?></span>
                </div>

                <!-- Form Checkout -->
                <form action="<?= base_url('/checkout') ?>" method="post" class="checkout-form">
                  <input type="hidden" name="store_id" value="<?= $store_id ?>">
                  <input type="hidden" name="stores_id" value="<?= $item->stores_id ?>">
                  <?php foreach ($storeData['items'] as $item): ?>
                    <input type="hidden" name="menu_id[]" value="<?= $item->menu_id ?>">
                    <input type="hidden" name="quantity[]" value="<?= $item->quantity ?>">
                    <input type="hidden" name="charts_id[]" value="<?= $item->id ?>">
                    <input type="hidden" name="price[]" value="<?= $item->menu_price ?>">
                    <input type="hidden" name="menu_name[]" value="<?= $item->menu_name ?>">
                    <input type="hidden" name="menu_description[]" value="<?= $item->menu_description ?>">
                    <input type="hidden" name="image_url[]" value="<?= $item->menu_img ?>">
                  <?php endforeach; ?>

                  <button type="button" class="px-4 py-2 bg-blue-500 transition ease-in-out duration-300 hover:bg-blue-700 rounded-md text-white text-base font-medium checkout-button">
                    Checkout Keranjang
                  </button>
                </form>
              </div>
              <hr class="mt-4">
            </div>
          <?php endforeach; ?>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  $(document).ready(function() {
    $('.checkout-button').on('click', function(e) {
      e.preventDefault();

      const userAddress = "<?= session()->get('address') ?>";
      const form = $(this).closest('form');
      if (!userAddress) {
        Swal.fire({
          icon: 'warning',
          title: 'Lengkapi Profil',
          text: 'Lengkapi profil Anda terlebih dahulu untuk melakukan pemesanan.',
          confirmButtonText: 'OK',
          confirmButtonColor: '#fbbf24'
        });
      } else {
        Swal.fire({
          title: 'Konfirmasi Checkout',
          text: "Apakah Anda yakin ingin melanjutkan checkout?",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Ya, Checkout!',
          cancelButtonText: 'Batal'
        }).then((result) => {
          if (result.isConfirmed) {
            form.submit();
          }
        });
      }
    });
  });
</script>

<script>
  $(document).ready(function() {
    $('.increment-btn').on('click', function() {
      const quantityInput = $(this).siblings('.quantity-input');
      const currentQuantity = parseInt(quantityInput.val());
      const itemId = quantityInput.data('item-id');

      const newQuantity = currentQuantity + 1;
      quantityInput.val(newQuantity);

      updateQuantity(itemId, newQuantity);
    });

    $('.decrement-btn').on('click', function() {
      const quantityInput = $(this).siblings('.quantity-input');
      const currentQuantity = parseInt(quantityInput.val());
      const itemId = quantityInput.data('item-id');

      const newQuantity = Math.max(1, currentQuantity - 1);
      quantityInput.val(newQuantity);

      updateQuantity(itemId, newQuantity);
    });

    function updateQuantity(itemId, newQuantity) {
      $.ajax({
        url: '<?= base_url('chart/update') ?>',
        method: 'POST',
        data: {
          item_id: itemId,
          quantity: newQuantity
        },
        success: function(response) {
          console.log(response);
          if (response.success) {
            const itemTotalPrice = response.item_price * newQuantity;
            $(`[data-item-id="${itemId}"]`).closest('.cart-item').find('.item-total-price').text(new Intl.NumberFormat('id-ID').format(itemTotalPrice));

            $('#total-price').text(new Intl.NumberFormat('id-ID').format(response.new_total_price));
            location.reload();
          }
        },
        error: function(error) {
          console.log("Error updating quantity:", error);
        }
      });
    }
  });
</script>

<?= $this->endSection() ?>