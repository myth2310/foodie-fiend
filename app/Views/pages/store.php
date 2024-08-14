<?= $this->extend('layouts/base') ?>

<?= $this->section('content') ?>
  <?= $this->include('partial/preloader') ?>
  <?= $this->include('components/navbar') ?>
  <?= $this->include('components/dropdown_chart') ?>
  <?= $this->include('components/login_modal') ?>
  <?= $this->include('components/register_modal') ?>
  <div class="px-16 py-6">
      <div id="heroBanner" class="p-40 rounded-xl shadow-gray-800 shadow-lg bg-center bg-cover bg-no-repeat bg-[url('https://images.squarespace-cdn.com/content/v1/61709486e77e1d27c181981c/1695741277156-OMOA8F2CO65CT0X4IGZG/Urbanspace+Pearl_Savory+Selection+2.jpeg?format=1500w')] bg-blend-multiply"></div>
      <!-- Navbar Kategori Start -->
      <section>
        <div id="profile-nav" class="mt-8">
          <nav class="bg-white flex space-x-8 border-b-2 py-4 px-8 rounded-md shadow-md text-base font-semibold">
            <?php if(!$categories): ?>
              <p>Tidak ada kategori</p>
            <?php else: ?>
              <?php foreach($categories as $category): ?>
                <a href="#" class="profile-nav-link" data-target="menu-form"><?= $category->name ?></a>
              <?php endforeach ?>
            <?php endif ?>
          </nav>
        </div>
      </section>
      <!-- Navbar Kategori End -->

      <section>
        <?php if (!$menus): ?>
          <div class="flex justify-center items-center my-5">
            <p class="text-2xl text-gray-500 font-medium">Toko ini belum memiliki daftar menu</p>
          </div>
        <?php else: ?>
          <?= $this->include('components/item_card') ?>
        <?php endif ?>
      </section>
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