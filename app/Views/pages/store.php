<?= $this->extend('layouts/base') ?>

<?= $this->section('content') ?>
<?= $this->include('partial/preloader') ?>
<?= $this->include('components/navbar') ?>
<?= $this->include('components/dropdown_chart') ?>
<?= $this->include('components/login_modal') ?>
<?= $this->include('components/register_modal') ?>
<div class="container mx-auto px-10 py-20 mt-5">
  <!-- Hero Banner Start -->
  <div id="heroBanner" class="relative p-40 rounded-xl bg-gray-400 bg-blend-multiply bg-center bg-cover bg-no-repeat bg-[url('https://images.squarespace-cdn.com/content/v1/61709486e77e1d27c181981c/1695741277156-OMOA8F2CO65CT0X4IGZG/Urbanspace+Pearl_Savory+Selection+2.jpeg?format=1500w')] bg-blend-multiply before:absolute before:inset-0 before:bg-black before:opacity-50">
    <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-white md:text-5xl lg:text-6xl capitalize"><?= $title ?></h1>
  </div>
  <!-- Hero Banner End -->

  
  <!-- Menu Section Start -->
  <section class="mt-2 ml-0">
    <?php if (!$menus): ?>
      <div class="flex justify-center items-center">
        <p class="text-2xl text-gray-500 font-medium mt-5">Toko ini belum memiliki daftar menu</p>
      </div>
    <?php else: ?>
      <?= $this->include('components/item_card') ?>
    <?php endif ?>
  </section>
  <!-- Menu Section End -->
</div>

<?= $this->endSection() ?>

<?= $this->section('footer') ?>
<?= $this->include('components/footer') ?>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="<?= base_url('assets/js/shopingChart.js') ?>"></script>
<script src="<?= base_url('assets/js/chartDropDown.js') ?>"></script>
<script src="<?= base_url('assets/js/modalAuthForm.js') ?>"></script>
<script>
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