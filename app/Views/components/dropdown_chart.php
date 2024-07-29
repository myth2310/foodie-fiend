<!-- Dropdown menu -->
<div id="dropdownChart" class="hidden right-10 mt-4 origin-top-right z-20 w-full max-w-sm bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-800 dark:divide-gray-700" aria-labelledby="dropdownNotificationButton">
  <?php if(!session()->get('email')): ?>
    <div class="block px-4 py-2 font-medium text-center text-gray-700 rounded-t-lg bg-gray-50 dark:bg-gray-800 dark:text-white">
      Keranjang (0)
    </div>
    <div class="px-2 py-4 flex flex-col items-center justify-center rounded-l-lg">
      <p class="mb-4 text-gray-700 dark:text-white">Tambah menu pertama kamu  </p>
      <button onclick="openModal('loginModal')" class="text-center font-semibold text-yellow-500 transition-all duration-150 ease-in-out border-2 border-yellow-500 hover:bg-yellow-500 hover:text-white px-2.5 py-1.5 mb-4 rounded-lg">Mulai sekarang</button>
    </div>
  <?php else: ?>
    <div class="block px-4 py-2 font-medium text-center text-gray-700 rounded-t-lg bg-gray-50 dark:bg-gray-800 dark:text-white">
        Keranjang (<?= count($charts) ?>)
    </div>
    <ul class="divide-y divide-gray-100 dark:divide-gray-700 h-64 overflow-y-auto">
      <?php foreach($charts as $chart): ?>
      <li>
        <!-- TODO: Repair -->
        <a href="<?php echo '/' ?>" class="flex px-4 py-3 hover:bg-gray-100 dark:hover:bg-gray-700">
          <div class="flex-shrink-0">
            <img class="rounded-full w-11 h-11" src="<?= $chart->menu_img ?>" alt="Jese image">
          </div>
          <div class="w-full ps-3">
              <div class="text-gray-500 text-sm mb-1.5 dark:text-gray-800"><?= $chart->menu_name ?></div>
          </div>
        </a>
      </li>
      <?php endforeach ?>
    </ul>
    <a href="/user/dashboard/chart" class="block py-2 text-sm font-medium text-center text-gray-900 rounded-b-lg bg-gray-50 hover:bg-gray-100 dark:bg-gray-800 dark:hover:bg-gray-700 dark:text-white">
      <div class="inline-flex items-center ">
        <svg class="w-4 h-4 me-2 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 14">
          <path d="M10 0C4.612 0 0 5.336 0 7c0 1.742 3.546 7 10 7 6.454 0 10-5.258 10-7 0-1.664-4.612-7-10-7Zm0 10a3 3 0 1 1 0-6 3 3 0 0 1 0 6Z"/>
        </svg>
          Lihat semua item
      </div>
    </a>
  <?php endif ?>
</div>