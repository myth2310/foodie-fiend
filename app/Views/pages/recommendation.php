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
  <div class="flex mb-2">
      <h2 class="text-2xl font-semibold text-gray-800">Rekomendasi Menu Rating</h2>
    </div>
    <div class="flex flex-wrap">
      <!-- Card Rating  -->
      <?php foreach ($menus_ratings as $rating_key => $rating_data): ?>
        <div class="w-full max-w-full p-2 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
          <a href="<?= base_url('recommendations/rating/' . substr($rating_key, -1)) ?>">
            <div class="relative flex flex-col min-w-0 break-words bg-white shadow-xl dark:shadow-dark-xl rounded-2xl bg-clip-border">
            <img src="<?= !empty($rating_data['image']) ? $rating_data['image'] : 'https://images.squarespace-cdn.com/content/v1/61709486e77e1d27c181981c/1695741276685-XWI9NVDGPAOSWY1U4C3Q/Urbanspace+Pearl_Sweets+and+Savory.jpg' ?>" 
                 alt="foto kumpulan menu" 
                 class="rounded-t-2xl">
              <div class="flex-auto p-4">
                <div class="flex flex-row -mx-3">
                  <div class="flex-none w-2/3 max-w-full px-3">
                    <div>
                      <p class="mb-0 font-sans text-sm font-semibold leading-normal uppercase dark:text-gray-900 dark:opacity-60">
                        Menu rating <?= substr($rating_key, -1) ?>
                      </p>
                      <div class="flex items-center my-2">
                        <?php for ($i = 0; $i < substr($rating_key, -1); $i++): ?>
                          <svg aria-hidden="true" class="h-5 w-5 text-yellow-300" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                          </svg>
                        <?php endfor; ?>
                        <span class="mr-2 ml-3 rounded bg-yellow-200 px-2.5 py-0.5 text-xs font-semibold">
                          <?= $rating_data['count'] ?>
                        </span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </a>
        </div>
      <?php endforeach; ?>
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