<?= $this->extend('layouts/base') ?>
<?= $this->section('content') ?>
<?= $this->include('partial/preloader') ?>
<?= $this->include('components/navbar') ?>
<?= $this->include('components/dropdown_chart') ?>
<?= $this->include('components/login_modal') ?>
<?= $this->include('components/register_modal') ?>

<section style="padding-top: 100px;">
  <div id="menuCard" class="container mx-auto px-10 mt-0">
    <div class="flex">
      <h2 class="text-2xl font-semibold text-gray-800">Hasil Pencarian Anda</h2>
    </div>
    <?= $this->include('components/menu_card') ?>
  </div>
</section>


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
