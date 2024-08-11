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
      <p class="text-orange-500 text-lg">Keranjang Saya</p>
    </div>

    <div id="forms" class="mt-4 mx-4">
      <div id="menu-form" class="profile-form">
        <div id="chartContainer" class="h-screen overflow-y-auto">
          <!-- Item kedua -->
          <?php foreach($data as $item): ?>
          <div class="mt-4 shadow-sm">
            <div class="flex px-6 py-4 bg-white rounded-md">
              <div class="flex items-center w-full space-x-6">
                <span class="font-semibold text-gray-800"><?= $item->store_name ?></span>
                <a href="<?= base_url('/stores/' . $item->store_id) ?>" class="text-gray-500 hover:text-gray-700">
                  <div class="px-4 py-2 hover:bg-gray-100 transition ease-in-out duration-300 rounded-md items-center border">
                    <i class="fas fa-store"></i>
                    <span>Kunjungi Toko</span>
                  </div>
                </a>
              </div>
              <div class="flex justify-end items-center w-1/2 space-x-3">
                <form action="/chart/remove" method="post">
                  <input type="text" name="chart_id" value="<?= $item->id ?>" class="hidden">
                  <button type="submit" class="px-4 py-2 text-white text-base font-medium bg-red-600 transition ease-in-out duration-300 hover:bg-orange-700 rounded-md">
                    Hapus
                  </button>
                </form>
                <a href="#" class="text-white text-base font-medium">
                  <div class="px-4 py-2 bg-orange-500 transition ease-in-out duration-300 hover:bg-orange-700 rounded-md">
                    <p>Checkout</p>
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
                <span><?php echo "" . number_format($item->menu_price + 0, 0, ',', '.') ?></span>
              </div>
            </div>
          </div>
          <?php endforeach ?>
        </div>
      </div>
    </div>
  </div>
<?= $this->endSection() ?>