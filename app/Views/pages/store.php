<?= $this->extend('layouts/base') ?>

<?= $this->section('content') ?>
  <?= $this->include('partial/preloader') ?>
  <?= $this->include('components/navbar') ?>
  <?= $this->include('components/dropdown_chart') ?>
  <?= $this->include('components/modal') ?>
  <?= $this->include('components/register_modal') ?>
  <div class="px-16 py-6">
      <div id="heroBanner" class="p-40 rounded-xl shadow-gray-800 shadow-lg bg-center bg-cover bg-no-repeat bg-[url('https://images.squarespace-cdn.com/content/v1/61709486e77e1d27c181981c/1695741277156-OMOA8F2CO65CT0X4IGZG/Urbanspace+Pearl_Savory+Selection+2.jpeg?format=1500w')] bg-blend-multiply"></div>
      <!-- Navbar Kategori Start -->
      <section>
        <div id="profile-nav" class="mt-8">
          <nav class="bg-white flex space-x-8 border-b-2 py-4 px-8 rounded-md shadow-md text-base font-semibold">
            <a href="#" class="profile-nav-link" data-target="menu-form">Kategori A</a>
            <a href="#" class="profile-nav-link" data-target="belum-bayar-form">Kategori B</a>
            <a href="#" class="profile-nav-link" data-target="selesai-form">Kategori C</a>
            <a href="#" class="profile-nav-link" data-target="dibatalkan-form">Kategori D</a>
          </nav>
        </div>
      </section>
      <!-- Navbar Kategori End -->

      <?= $this->include('components/item_card') ?>
  </div>

<?= $this->endSection() ?>

<?= $this->section('footer') ?>
  <?= $this->include('components/footer') ?>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
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