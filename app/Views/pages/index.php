<?= $this->extend('layouts/base') ?>

<?= $this->section('content') ?>
  <?= $this->include('partial/preloader') ?>
  <?= $this->include('components/navbar') ?>
  <?= $this->include('components/dropdown_chart') ?>
  <?= $this->include('components/login_modal') ?>
  <?= $this->include('components/register_modal') ?>
  <?= $this->include('components/store_modal') ?>
  <?= $this->include('components/hero') ?>
  <?= $this->include('components/store_card') ?>
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