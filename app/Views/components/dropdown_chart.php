<!-- Dropdown menu -->
<div id="dropdownChart" class="hidden right-10 mt-4 origin-top-right z-20 w-full max-w-sm bg-white divide-y divide-gray-100 rounded-lg shadow" aria-labelledby="dropdownNotificationButton">
  <?php if(!session()->get('email')): ?>
    <div class="block px-4 py-2 font-medium text-center text-gray-700 rounded-t-lg bg-gray-50">
      Keranjang (0)
    </div>
    <div class="px-2 py-4 flex flex-col items-center justify-center rounded-l-lg">
      <p class="mb-4 text-gray-700">Tambah menu pertama kamu  </p>
      <button onclick="openModal('loginModal')" class="text-center font-semibold text-yellow-500 transition-all duration-150 ease-in-out border-2 border-yellow-500 hover:bg-yellow-500 hover:text-white px-2.5 py-1.5 mb-4 rounded-lg">Mulai sekarang</button>
    </div>
  <?php else: ?>
    <div class="block px-4 py-2 font-medium text-center text-gray-700 rounded-t-lg bg-gray-50">
        Keranjang (<?= count($charts) ?>)
    </div>
    <ul class="divide-y divide-gray-100 h-64 overflow-y-auto">
      <?php foreach($charts as $chart): ?>
      <li>
        <!-- TODO: Repair -->
        <a href="<?php echo '/' ?>" class="flex px-4 py-3 hover:bg-gray-10">
          <div class="flex-shrink-0">
            <img class="rounded-full w-11 h-11" src="<?= $chart->menu_img ?>" alt="Jese image">
          </div>
          <div class="w-full ps-3">
            <div class="text-sm font-semibold text-gray-700"><?= $chart->store_name ?></div>
            <div class="flex text-gray-500 text-sm mb-1.5 justify-between">
              <h4><?= $chart->menu_name ?></h4>
              <h4>x<?= $chart->quantity ?></h4>
            </div>
          </div>
        </a>
      </li>
      <?php endforeach ?>
    </ul>
    <a href="/user/dashboard/chart" class="block py-2 text-sm font-medium text-center text-gray-900 rounded-b-lg bg-gray-50 hover:bg-gray-100">
      <div class="inline-flex items-center ">
        <svg class="w-4 h-4 me-2 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 14">
          <path d="M10 0C4.612 0 0 5.336 0 7c0 1.742 3.546 7 10 7 6.454 0 10-5.258 10-7 0-1.664-4.612-7-10-7Zm0 10a3 3 0 1 1 0-6 3 3 0 0 1 0 6Z"/>
        </svg>
          Lihat semua item
      </div>
    </a>
  <?php endif ?>
</div>