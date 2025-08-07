<?= $this->extend('layouts/base') ?>

<?= $this->section('content') ?>
<?= $this->include('partial/preloader') ?>
<?= $this->include('components/navbar') ?>
<?= $this->include('components/dropdown_chart') ?>
<?= $this->include('components/login_modal') ?>
<?= $this->include('components/register_modal') ?>

<section>
    <div id="menuCard" class="container mx-auto py-20 mt-10 px-10 mt-0">
        <div class="flex justify-end mb-4">
            <a href="<?= previous_url() ?>" class="inline-flex items-center gap-2 px-4 py-2 bg-gray-100 text-gray-700 rounded-md shadow hover:bg-gray-200 transition">
                Kembali<i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>
        <div class="flex items-center">
            <i class="fa-solid fa-magnifying-glass"></i>
            <div class="ml-2 px-2 py-1 rounded">
                <h2 class="text-2xl font-semibold text-gray-800">
                    Rekomendasi Makanan Rating <?= $rating ?>
                    <?php for ($i = 1; $i <= $rating; $i++): ?>
                        <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                    <?php endfor; ?>
                </h2>
            </div>
        </div>

        <?= $this->include('components/menu_by_rating') ?>
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