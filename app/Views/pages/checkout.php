<?php $total_price = $order_data['price'] * $order_data['quantity'] ?>
<?= $this->extend('layouts/base') ?>
<?= $this->section('content') ?>
  <?= $this->include('partial/preloader') ?>
  <div class="flex flex-col items-center border-b bg-white py-4 sm:flex-row sm:px-10 mb-10 lg:px-20">
  <a href="/" class="flex items-center space-x-3 rtl:space-x-reverse focus:ring-4 focus:outline-none focus:ring-yellow-300 focus:rounded-md">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-10 h-10 text-white p-2 bg-yellow-500 rounded-full" viewBox="0 0 24 24">
      <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"></path>
    </svg>
    <span class="self-center text-2xl font-semibold whitespace-nowrap">Foodie Fiend</span>
  </a>
  <div class="mt-4 py-2 text-xs sm:mt-0 sm:ml-auto sm:text-base">
    <div class="relative">
      <ul class="relative flex w-full items-center justify-between space-x-2 sm:space-x-4">
        <li class="flex items-center space-x-3 text-left sm:space-x-4">
          <a class="flex h-6 w-6 items-center justify-center rounded-full bg-emerald-200 text-xs font-semibold text-emerald-700" href="#"
            ><svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" /></svg
          ></a>
          <span class="font-semibold text-gray-900">Shop</span>
        </li>
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
        </svg>
        <li class="flex items-center space-x-3 text-left sm:space-x-4">
          <a class="flex h-6 w-6 items-center justify-center rounded-full bg-gray-600 text-xs font-semibold text-white ring ring-gray-600 ring-offset-2" href="#">2</a>
          <span class="font-semibold text-gray-900">Shipping</span>
        </li>
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
        </svg>
        <li class="flex items-center space-x-3 text-left sm:space-x-4">
          <a class="flex h-6 w-6 items-center justify-center rounded-full bg-gray-400 text-xs font-semibold text-white" href="#">3</a>
          <span class="font-semibold text-gray-500">Payment</span>
        </li>
      </ul>
    </div>
  </div>
</div>
<div class="grid sm:px-10 lg:grid-cols-2 lg:px-20 xl:px-32 mb-10">
  <div class="px-4 pt-8">
    <p class="text-xl font-medium">Ringkasan pemesanan</p>
    <div class="mt-8 space-y-3 rounded-lg border bg-white px-2 py-4 sm:px-6">
      <div class="flex flex-col rounded-lg bg-white sm:flex-row">
        <img class="m-2 h-24 w-28 rounded-md border object-cover object-center" src="<?= $order_data['image_url'] ?>" alt="gambar menu" />
        <div class="flex w-full flex-col px-4 py-4">
          <span class="font-semibold"><?= $order_data['menu_name'] ?></span>
          <span class="float-right text-gray-400"><?= $order_data['menu_description'] ?></span>
          <div class="flex space-x-2 text-lg font-bold">
            <p>Rp. <?php echo "" . number_format($order_data['price'] + 0, 0, ',', '.') ?></p>
            <span class="text-gray-800">x <?= $order_data['quantity'] ?></span>
          </div>
        </div>
      </div>
      <!-- <div class="flex flex-col rounded-lg bg-white sm:flex-row">
        <img class="m-2 h-24 w-28 rounded-md border object-cover object-center" src="https://images.unsplash.com/photo-1600185365483-26d7a4cc7519?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8OHx8c25lYWtlcnxlbnwwfHwwfHw%3D&auto=format&fit=crop&w=500&q=60" alt="" />
        <div class="flex w-full flex-col px-4 py-4">
          <span class="font-semibold">Nike Air Max Pro 8888 - Super Light</span>
          <span class="float-right text-gray-400">42EU - 8.5US</span>
          <p class="mt-auto text-lg font-bold">$238.99</p>
        </div>
      </div> -->
    </div>

    <p class="mt-8 text-lg font-medium">Metode Pembayaran</p>
    <form class="mt-5 grid gap-6 bg-white">
      <!-- <div class="relative">
        <input class="peer hidden" id="radio_1" type="radio" name="radio" checked />
        <span class="peer-checked:border-gray-700 absolute right-4 top-1/2 box-content block h-3 w-3 -translate-y-1/2 rounded-full border-8 border-gray-300 bg-white"></span>
        <label class="peer-checked:border-2 peer-checked:border-gray-700 peer-checked:bg-gray-50 flex cursor-pointer select-none rounded-lg border border-gray-300 p-4" for="radio_1">
          <img class="w-14 object-contain" src="/images/naorrAeygcJzX0SyNI4Y0.png" alt="" />
          <div class="ml-5">
            <span class="mt-2 font-semibold">Fedex Delivery</span>
            <p class="text-slate-500 text-sm leading-6">Delivery: 2-4 Days</p>
          </div>
        </label>
      </div> -->
      <div class="relative">
        <input class="peer hidden" id="radio_2" type="radio" name="radio" checked />
        <span class="peer-checked:border-gray-700 absolute right-4 top-1/2 box-content block h-3 w-3 -translate-y-1/2 rounded-full border-8 border-gray-300 bg-white"></span>
        <label class="peer-checked:border-2 peer-checked:border-gray-700 peer-checked:bg-gray-50 flex cursor-pointer select-none rounded-lg border border-gray-300 p-4" for="radio_2">
          <img class="w-14 object-contain rounded-md" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ4FfmtnViwP1FvkPgDgiWAdi0tm2YMv5Gvfg&s" alt="" />
          <div class="ml-5">
            <span class="mt-2 font-semibold">Midtrans</span>
            <p class="text-slate-500 text-sm leading-6">E-wallet dan Rekening</p>
          </div>
        </label>
      </div>
    </form>
  </div>
  <div class="mt-10 bg-white px-4 pt-8 lg:mt-0 rounded-md">
    <p class="text-xl font-medium">Detail Pembayaran</p>
    <p class="text-gray-400">Lengkapi pesanan kamu pada detail pembayaran.</p>
    <div class="">
      <label for="email" class="mt-4 mb-2 block text-sm font-medium">Email</label>
      <div class="relative">
        <input type="text" id="email" name="email" class="w-full text-gray-500 rounded-md border border-gray-200 px-4 py-3 pl-11 text-sm shadow-sm outline-none focus:z-10 focus:border-blue-500 focus:ring-blue-500" placeholder="email@mail.com" value="<?= session()->get('email') ?>" disabled />
        <div class="pointer-events-none absolute inset-y-0 left-0 inline-flex items-center px-3">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
          </svg>
        </div>
      </div>
      <label for="card-holder" class="mt-4 mb-2 block text-sm font-medium">Name</label>
      <div class="relative">
        <input type="text" id="card-holder" name="card-holder" class="w-full rounded-md border border-gray-200 px-4 py-3 pl-11 text-sm uppercase shadow-sm outline-none focus:z-10 focus:border-blue-500 focus:ring-blue-500" placeholder="Nama lengkap anda" value="<?= session()->get('name') ?>" disabled/>
        <div class="pointer-events-none absolute inset-y-0 left-0 inline-flex items-center px-3">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5zm6-10.125a1.875 1.875 0 11-3.75 0 1.875 1.875 0 013.75 0zm1.294 6.336a6.721 6.721 0 01-3.17.789 6.721 6.721 0 01-3.168-.789 3.376 3.376 0 016.338 0z" />
          </svg>
        </div>
      </div>

      <!-- Total -->
      <div class="mt-6 border-t border-b py-2">
        <div class="flex items-center justify-between">
          <p class="text-sm font-medium text-gray-900">Subtotal</p>
          <div class="flex space-x-1 font-semibold text-gray-900">
            <p>Rp. <?php echo "" . number_format($order_data['price'] + 0, 0, ',', '.') ?></p>
            <span>x<?= $order_data['quantity'] ?></span>
          </div>
        </div>
      </div>
      <div class="mt-6 flex items-center justify-between">
        <p class="text-sm font-medium text-gray-900">Total</p>
        <p class="text-2xl font-semibold text-gray-900">Rp. <?php echo "" . number_format($total_price + 0, 0, ',', '.') ?></p>
      </div>
    </div>
    <button id="pay-button" class="mt-4 mb-8 w-full rounded-md bg-gray-900 px-6 py-3 font-medium text-white">Bayar Sekarang</button>
  </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('footer') ?>
  <?= $this->include('components/footer') ?>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
    <script src="<?= base_url('assets/js/navbar.js') ?>"></script>
    <script src="<?= base_url('assets/js/chartDropDown.js') ?>"></script>
    <script src="<?= base_url('assets/js/modalAuthForm.js') ?>"></script>
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="<?= config('Midtrans')->clientKey ?>"></script>
    <script type="text/javascript">
      document.getElementById('pay-button').onclick = function(){
        snap.pay('<?= $order_data['snapToken'] ?>');
      };
      document.addEventListener('DOMContentLoaded', () => {
        const loaded = true;
        const loaderElement = document.getElementById('loader');
        if (loaded) {
          setTimeout(() => {
            loaderElement.style.display = 'none';
          }, 500);
        }
      });
    </script>
<?= $this->endSection() ?>