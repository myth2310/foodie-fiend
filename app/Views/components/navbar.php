<nav class="bg-white shadow-md border-gray-200 dark:bg-gray-900">
  <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
  <a href="/" class="flex items-center space-x-3 rtl:space-x-reverse focus:ring-4 focus:outline-none focus:ring-yellow-300 focus:rounded-md">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-10 h-10 text-white p-2 bg-yellow-500 rounded-full" viewBox="0 0 24 24">
      <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"></path>
    </svg>
    <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Foodie Fiend</span>
  </a>
  <div class="flex md:order-2">
    <button type="button" data-collapse-toggle="navbar-search" aria-controls="navbar-search" aria-expanded="false" class="md:hidden text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5 me-1">
      <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
      </svg>
      <span class="sr-only">Search</span>
    </button>
    <div class="relative hidden md:block">
      <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
        </svg>
        <span class="sr-only">Search icon</span>
      </div>
      <input type="text" id="search-navbar" class="block w-full p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:outline-none focus:ring-2 focus:ring-yellow-300 focus:border-yellow-400 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="Cari...">
    </div>

    <?php if(session()->get('role') != 'store'): ?>
    <button onclick="onChartClick()" class="flex pl-2 transition duration-150 ease-in-out focus:ring-4 focus:outline-none focus:ring-yellow-300 focus:bg-yellow-500 focus:text-white hover:bg-yellow-500 hover:text-white text-black dark:text-white items-center justify-between ml-4 rounded-xl">
      <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
      </svg>
    </button>
    <?php endif ?>

    <button data-collapse-toggle="navbar-search" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-search" aria-expanded="false">
      <span class="sr-only">Open main menu</span>
      <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
      </svg>
    </button>
    <?php if(session()->get('email')): ?>
      <div class="ml-4">
        <a href="<?= session()->get('role') == 'store' ? '/dashboard' : '/user/dashboard' ?>" class="cursor-pointer focus:outline">
          <img src="<?= session()->get('profile') ?>" alt="profil" class="rounded-xl w-10 h-10">
        </a>
      </div>
    <?php else: ?>
      <button onclick="openModal('loginModal')" type="button" class="text-white bg-yellow-500 transition-all duration-150 ease-in-out hover:bg-yellow-600 ml-4 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-semibold rounded-lg text-sm px-4 py-2 text-center">Mulai Sekarang</button>
    <?php endif ?>
  </div>
    <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-search">
      <div class="relative mt-3 md:hidden">
        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
          <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
          </svg>
        </div>
        <input type="text" id="search-navbar" class="block w-full p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Cari...">
      </div>
      <ul class="flex flex-col p-4 md:p-0 mt-4 font-medium border items-center border-gray-100 rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
        <li>
          <a href="/" id="homeMenuBtn" class="block py-2 px-3 text-yellow-500 text-lg md:text-lg hover:text-yellow-500 dark:text-white transition-all ease-in-out duration-150 rounded md:bg-transparent md:p-0 font-semibold focus:ring-4 focus:outline-none focus:ring-yellow-300 focus:text-yellow-500" aria-current="page">Beranda</a>
        </li>
        <li>
          <a href="/recommendations" id="recommendationMenuBtn" class="block py-2 px-3 text-gray-900 hover:text-yellow-500 rounded hover:bg-gray-100 md:hover:bg-transparent md:p-0 dark:text-white dark:hover:bg-gray-700 md:dark:hover:bg-transparent dark:border-gray-700 font-semibold transition-all duration-150 ease-in-out focus:ring-4 focus:outline-none focus:ring-yellow-300 focus:text-yellow-500">Rekomendasi Kuliner</a>
        </li>
        <li>
          <a href="/orders" id="myOrderMenuBtn" class="block py-2 px-3 text-gray-900 hover:text-yellow-500 transition-all duration-150 rounded hover:bg-gray-100 md:hover:bg-transparent md:p-0 dark:text-white dark:hover:bg-gray-700 md:dark:hover:bg-transparent dark:border-gray-700 font-semibold ease-in-out focus:ring-4 focus:outline-none focus:ring-yellow-300 focus:text-yellow-500">Pesanan Saya</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
