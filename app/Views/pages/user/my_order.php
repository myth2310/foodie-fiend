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
<!-- Profile Navigation Bar   -->
<div id="profile-nav" class="mt-4">
  <nav class="bg-white flex space-x-8 border-b-2 py-4 px-8 mx-4 rounded-md shadow-md text-base font-semibold">
    <a id="allOrderButton" href="/user/dashboard/order" class="transition-all duration-150 ease-in-out text-orange-500 hover:text-orange-500" data-target="menu-form">Semua</a>
    <a id="pendingOrderButton" href="/user/dashboard/order?status=ditunda" class="text-gray-500 transition-all duration-150 ease-in-out hover:text-orange-500" data-target="belum-bayar-form">Belum Bayar</a>
    <a id="doneOrderButton" href="/user/dashboard/order?status=selesai" class="text-gray-500 transition-all duration-150 ease-in-out hover:text-orange-500" data-target="selesai-form">Selesai</a>
    <a id="rejectOrderButton" href="/user/dashboard/order?status=dibatalkan" class="text-gray-500 transition-all duration-150 ease-in-out hover:text-orange-500" data-target="dibatalkan-form">Dibatalkan</a>
  </nav>

  <div class="mt-4 mx-4">
    <div class="space-y-6">
      <?php foreach ($data as $item): ?>
        <div class="bg-white rounded-xl shadow-md p-4 border border-gray-100">
          <!-- Header -->
          <div class="flex justify-between items-center mb-4">
            <div class="text-base font-semibold text-gray-800"><?= $item->store_name ?></div>
            <a href="/stores/<?= $item->store_id ?>" class="text-sm text-blue-500 hover:underline">
              <i class="fas fa-store mr-1"></i> Kunjungi Toko
            </a>
          </div>

          <!-- Status -->
          <div class="flex justify-between text-xs text-gray-500 mb-3">
            <span class="mb-2">Tanggal Pesanan: <?= date('d F Y', strtotime($item->created_at)); ?></span>
          </div>

          <!-- Item List -->
          <?php
          $menu_imgs = explode(',', $item->menu_imgs);
          $menu_names = explode(',', $item->menu_names);
          $prices = explode(',', $item->price);
          $total_prices = explode(',', $item->total_price);
          $quantities = explode(',', $item->quantity);
          $grand_total = 0;
          ?>

          <?php for ($i = 0; $i < count($menu_names); $i++): ?>
            <div class="flex items-center mb-3">
              <img src="<?= $menu_imgs[$i] ?>" class="w-14 h-14 rounded-lg object-cover border" alt="Menu">
              <div class="ml-3 flex-1">
                <p class="text-sm font-medium text-gray-700"><?= $menu_names[$i] ?></p>
                <p class="text-xs text-gray-500">x<?= $quantities[$i] ?? 1 ?></p>
              </div>
              <div class="text-sm font-semibold text-orange-500">
                Rp <?= number_format((float)$total_prices[$i], 0, ',', '.') ?>
              </div>
            </div>
            <?php $grand_total += (float)$total_prices[$i]; ?>
          <?php endfor; ?>

          <!-- Biaya -->
          <div class="mt-3 text-sm text-gray-600 space-y-1 border-t pt-3">
            <div class="flex justify-between"><span>Biaya Pengiriman</span><span>Rp <?= number_format($item->shipping_cost, 0, ',', '.') ?></span></div>
            <div class="flex justify-between"><span>Biaya Aplikasi</span><span>Rp <?= number_format($item->application_fee, 0, ',', '.') ?></span></div>
            <div class="flex justify-between font-semibold text-base text-gray-800">
              <span>Total</span>
              <span>Rp <?= number_format($grand_total + $item->shipping_cost + $item->application_fee, 0, ',', '.') ?></span>
            </div>
          </div>

          <!-- Status Pengiriman -->
          <div class="mt-3 flex items-start text-sm space-x-3">
            <?php if ($item->delivery_status === null): ?>
              <i class="fa-solid fa-person text-yellow-500 mt-1"></i>
              <span class="text-yellow-600">Menunggu Konfirmasi</span>

            <?php elseif ($item->delivery_status === 'selesai'): ?>
              <i class="fa-solid fa-check text-green-600 mt-1"></i>
              <span class="text-green-600">Pesanan Diterima</span>

            <?php elseif ($item->delivery_status === 'diantar'): ?>
              <i class="fa-solid fa-truck-fast text-orange-500 mt-1"></i>
              <span class="text-orange-500">Sedang Diantar</span>

            <?php elseif ($item->delivery_status === 'diterima'): ?>
              <div class="flex flex-col">
                <div class="flex items-center space-x-2">
                  <form action="/user/order/selesai/<?= $item->order_id ?>" method="POST" class="inline">
                    <?= csrf_field() ?>
                    <button type="submit"
                      class="inline-block bg-orange-500 hover:bg-orange-600 text-white text-sm px-4 py-2 rounded-md transition">
                      Pesanan Selesai
                    </button>
                  </form>


                </div>

                <div class="mt-2">
                  <img src="<?= $item->delivery_proof ?>"
                    alt="Bukti Pengiriman" width="200px"
                    class="object-cover rounded border border-gray-300">
                </div>

              </div>
            <?php elseif ($item->delivery_status === 'dimasak'): ?>
              <i class="fa-solid fa-bowl-rice text-blue-500 mt-1"></i>
              <span class="text-blue-500">Sedang Dimasak</span>
            <?php endif; ?>
          </div>


          <!-- Tombol Ulasan -->
          <?php if ($item->delivery_status === 'selesai' && $item->has_review == 0): ?>
            <div class="mt-4">
              <a href="/ratings/<?= $item->menu_id ?>?order_id=<?= $item->order_id ?>"
                class="inline-block bg-orange-500 hover:bg-orange-600 text-white text-sm px-4 py-2 rounded-md transition">
                Beri Ulasan
              </a>
            </div>
          <?php endif; ?>
        </div>
      <?php endforeach; ?>

      <!-- Pagination -->
      <div class="flex justify-end pt-4">
        <?= $pager->links('default', 'custom_pager') ?>
      </div>
    </div>
  </div>

</div>
</div>
<?= $this->endSection() ?>
<?= $this->section('scripts') ?>
<script>
  const params = new URLSearchParams(window.location.search);
  const buttons = {
    all: document.getElementById('allOrderButton'),
    pending: document.getElementById('pendingOrderButton'),
    done: document.getElementById('doneOrderButton'),
    reject: document.getElementById('rejectOrderButton')
  };

  const statusMap = {
    ditunda: 'pending',
    selesai: 'done',
    dibatalkan: 'reject',
    default: 'all'
  };

  const currentStatus = params.get('status') || 'default';
  const activeButton = buttons[statusMap[currentStatus]];

  function updateButtonClasses(activeBtn) {
    for (const key in buttons) {
      const button = buttons[key];
      if (button === activeBtn) {
        button.classList.replace('text-gray-500', 'text-orange-500');
      } else {
        button.classList.replace('text-orange-500', 'text-gray-500');
      }
    }
  }

  updateButtonClasses(activeButton);
</script>

<?= $this->endSection() ?>