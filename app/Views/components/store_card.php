<?php 
  $stores = $items['stores'];
?>

<div id="menuCard" class="container mx-auto px-4 py-6 z-0">
  <div class="flex py-4">
    <h2 class="text-2xl font-semibold">Kumpulan Kuliner</h2>
  </div>
  <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
    <!-- Item Card Start -->
    <?php if(!empty($stores)):?>
      <?php foreach($stores as $store): ?>
      <div class="relative mb-2 flex w-full max-w-xs flex-col overflow-hidden rounded-lg border border-gray-100 bg-white shadow-md">
        <a href="<?= base_url('stores/' . $store->id) ?>" class="relative mx-3 mt-3 flex h-60 overflow-hidden rounded-xl">
          <img class="object-cover" src="<?= $store->image_url ?? "https://cdn.idntimes.com/content-images/community/2022/06/tips-membuat-kuah-bakso-enak-gurih-kaldu-mantap-tips-kuah-bakso-enak-cara-membuat-kuah-bakso-enak-cara-membuat-kuah-bakso-lezat-resep-kuah-bakso-bahan-kuah-bakso-9cde86371d7fc78c91ae80a6ffab250e-e7d5ef4a29a66c036362b3685ee985f6_600x400.jpg" ?>" alt="product image" />
        </a>
        <div class="mt-4 px-5 pb-5 space-y-3">
          <h5 class="text-lg font-semibold tracking-tight text-slate-900"><?= $store->name ?? "" ?></h5>
          <a href="<?= base_url('stores/' . $store->id) ?>" class="flex items-center justify-center rounded-md bg-yellow-500 px-5 py-2.5 text-center font-medium text-white transition-all duration-150 ease-in-out hover:bg-yellow-700 focus:outline-none focus:ring-4 focus:ring-blue-300">
            Lihat
          </a>
        </div>
      </div>
      <?php endforeach ?>
    <?php else:?>
      <p class="text-lg font-semibold text-gray-800">Tidak ada toko</p>
    <?php endif ?>
    <!-- Duplicate the above store card for multiple items -->
  </div>
</div>