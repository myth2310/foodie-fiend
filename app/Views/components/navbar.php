<nav class="bg-white shadow-md border-gray-200 fixed top-0 left-0 w-full z-50">
  <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
    <a href="/" class="flex items-center space-x-3 rtl:space-x-reverse focus:ring-4 focus:outline-none focus:ring-yellow-300 rounded-md">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-10 h-10 text-white p-2 bg-yellow-500 rounded-full" viewBox="0 0 24 24">
        <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"></path>
      </svg>
      <span class="self-center text-2xl font-semibold whitespace-nowrap">Foodie Fiend</span>
    </a>

    <div class="flex md:order-2">
      <?php if(session()->get('role') != 'store'): ?>
        <button onclick="onChartClick()" class="flex pl-2 transition duration-150 ease-in-out hover:bg-yellow-500 text-black items-center ml-4 rounded-xl focus:ring-4 focus:ring-yellow-300">
          <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
          </svg>
        </button>
      <?php endif ?>

      <?php if(session()->get('email')): ?>
        <div class="flex items-center ml-4">
          <a href="<?= session()->get('role') == 'store' ? '/dashboard' : '/user/dashboard' ?>" class="cursor-pointer focus:outline-none">
              <img src="<?= session()->get('profile') ?>" alt="Profile Image" class="rounded-xl w-10 h-10">
          </a>
          <p class="ml-4"><?php echo htmlspecialchars(session()->get('name')); ?></p>
        </div>
      <?php else: ?>
        <button onclick="openModal('loginModal')" type="button" class="text-white bg-yellow-500 transition duration-150 ease-in-out hover:bg-yellow-600 ml-4 font-semibold rounded-lg text-sm px-4 py-2 focus:ring-4 focus:ring-yellow-300">Mulai Sekarang</button>
      <?php endif ?>
    </div>

    <div class="hidden w-full md:flex md:w-auto md:order-1" id="navbar-search">
      <ul class="flex flex-col md:flex-row md:space-x-8 p-4 md:p-0 mt-4 md:mt-0 font-medium items-center border md:border-0 rounded-lg bg-gray-50 md:bg-white">
        <li>
          <a href="/" id="homeMenuBtn" class="py-2 px-3 text-yellow-500 text-lg font-semibold hover:text-yellow-500 transition duration-150 focus:ring-4 focus:ring-yellow-300">Beranda</a>
        </li>
        <li>
          <a href="/recommendations" id="recommendationMenuBtn" class="py-2 px-3 text-gray-900 hover:text-yellow-500 font-semibold transition duration-150 focus:ring-4 focus:ring-yellow-300">Rekomendasi Kuliner</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
