<?= $this->extend('layouts/base') ?>
<?= $this->section('content') ?>
<?= $this->include('partial/preloader') ?>
<?= $this->include('components/navbar') ?>
<?= $this->include('components/dropdown_chart') ?>
<?= $this->include('components/login_modal') ?>
<?= $this->include('components/register_modal') ?>

<!-- Main Content Staert -->
<section>
  <div class="container mx-auto px-10 py-20 mt-10 mb-0">
    <div class="flex justify-between items-center mb-4">
      <h2 class="text-2xl font-semibold text-gray-800">Rekomendasi Menu Rating</h2>
      <!-- Input Pencarian
      <form method="get" action="/recommendations/search" class="mb-6">
        <div class="flex">
            <input 
                type="text" 
                name="query" 
                placeholder="Cari menu..." 
                value="<?= isset($_GET['query']) ? esc($_GET['query']) : '' ?>" 
                class="w-full px-4 py-2 border rounded-lg"
            >
            <button type="submit" class="ml-2 px-4 py-2 bg-blue-500 text-white rounded-lg">
                Cari
            </button>
        </div>
    </form> -->
    </div>
    <div class="flex flex-wrap">
      <!-- Card Rating  -->
      <div 
        id="menu-container" 
        class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4 p-4">
        <?php foreach ($menus_ratings as $rating_key => $rating_data): ?>
          <div 
            class="menu-item bg-white shadow-xl dark:shadow-dark-xl rounded-2xl overflow-hidden" 
            data-menu-name="menu rating <?= substr($rating_key, -1) ?>">
            <a href="<?= base_url('recommendations/rating/' . substr($rating_key, -1)) ?>">
              <div class="h-48 w-full">
                <img src="<?= !empty($rating_data['image']) ? $rating_data['image'] : 'https://images.squarespace-cdn.com/content/v1/61709486e77e1d27c181981c/1695741276685-XWI9NVDGPAOSWY1U4C3Q/Urbanspace+Pearl_Sweets+and+Savory.jpg' ?>"
                  alt="foto kumpulan menu"
                  class="h-full w-full object-cover">
              </div>
              <div class="p-4">
                <p class="font-sans text-sm font-semibold uppercase mb-2 dark:text-gray-900 dark:opacity-60">
                  Menu rating <?= substr($rating_key, -1) ?>
                </p>
                <div class="flex items-center mb-2">
                  <?php for ($i = 0; $i < substr($rating_key, -1); $i++): ?>
                    <svg aria-hidden="true" class="h-5 w-5 text-yellow-300" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                      <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                    </svg>
                  <?php endfor; ?>
                  <span class="ml-3 bg-yellow-200 px-2.5 py-0.5 text-xs font-semibold rounded">
                    <?= $rating_data['count'] ?>
                  </span>
                </div>
              </div>
            </a>
          </div>
        <?php endforeach; ?>
      </div>

    </div>
  </div>
</section>

<!-- Main Content End -->
<!-- Recommendation Start -->
<section>
  <div id="menuCard" class="container mx-auto px-10 mt-0">
    <div class="flex">
      <h2 class="text-2xl font-semibold text-gray-800">Rekomendasi menu untuk Anda</h2>
    </div>
    <?= $this->include('components/menu_card') ?>
  </div>
</section>
<!-- Recommendation End -->
<?= $this->endSection() ?>

<?= $this->section('footer') ?>
<?= $this->include('components/footer') ?>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="<?= base_url('assets/js/recommendation.js') ?>"></script>
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