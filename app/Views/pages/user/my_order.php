<?php dd($data) ?>
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
  <!-- Profile Navigation Bar   -->
  <div id="profile-nav" class="mt-4">
    <nav class="bg-white flex space-x-8 border-b-2 py-4 px-8 mx-4 rounded-md shadow-md text-base font-semibold">
      <a id="allOrderButton" href="/user/dashboard/order" class="transition-all duration-150 ease-in-out text-orange-500 hover:text-orange-500" data-target="menu-form">Semua</a>
      <a id="pendingOrderButton" href="/user/dashboard/order?status=ditunda" class="text-gray-500 transition-all duration-150 ease-in-out hover:text-orange-500" data-target="belum-bayar-form">Belum Bayar</a>
      <a id="doneOrderButton" href="/user/dashboard/order?status=selesai" class="text-gray-500 transition-all duration-150 ease-in-out hover:text-orange-500" data-target="selesai-form">Selesai</a>
      <a id="rejectOrderButton" href="/user/dashboard/order?status=dibatalkan" class="text-gray-500 transition-all duration-150 ease-in-out hover:text-orange-500" data-target="dibatalkan-form">Dibatalkan</a>
    </nav>

    <div id="forms" class="mt-4 mx-4">
      <div id="menu-form" class="profile-form">
        <div id="allMenusContainer" class="h-screen overflow-y-auto">
          <!-- Item kedua -->
          <?php foreach($data as $item): ?>
          <div class="mt-4 shadow-sm">
            <div class="flex px-6 py-4 bg-white rounded-md">
              <div class="flex items-center w-full space-x-6">
                <span class="font-semibold text-gray-800"><?= $item->store_name ?></span>
                <a href="/stores/<?= $item->store_id ?>" class="text-gray-500 hover:text-gray-700">
                  <div class="px-4 py-2 hover:bg-gray-100 transition ease-in-out duration-300 rounded-md items-center border">
                    <i class="fas fa-store"></i>
                    <span>Kunjungi Toko</span>
                  </div>
                </a>
              </div>
              <div class="flex justify-end items-center w-1/2 space-x-6">
                <div class="flex items-center space-x-2 text-green-600">
                  <i class="fas fa-shipping-fast"></i>
                  <p>Pesanan telah diterima</p>
                </div>
                <a href="#" class="text-white text-base font-medium">
                  <div class="px-4 py-2 bg-orange-500 transition ease-in-out duration-300 hover:bg-orange-700 rounded-md">
                    <p>Beri Ulasan</p>
                  </div>
                </a> 
              </div>
            </div>
            <hr>
            <div class="flex px-6 py-4 bg-white rounded-md">
              <div class="flex items-center w-full">
                <img class="w-16 h-16 rounded-md" src="<?= $item->menu_img ?>" alt="Item image">
                <div class="ml-4">
                  <h4><?= $item->menu_name ?></h4>
                  <p>x<?= $item->quantity ?></p>
                </div>
              </div>
              <div class="flex font-semibold justify-center items-center space-x-1 text-orange-400">
                <span>Rp.</span>
                <span><?php echo "" . number_format($item->price + 0, 0, ',', '.') ?></span>
              </div>
            </div>
          </div>
          <?php endforeach ?>
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