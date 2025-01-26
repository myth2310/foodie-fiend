<div class="container mx-auto px-10 py-20">
    <h2 class="text-2xl font-semibold text-gray-800 mb-4">Hasil Pencarian</h2>

    <?php if (empty($menus)): ?>
        <p>Tidak ada menu yang cocok dengan pencarian Anda.</p>
    <?php else: ?>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4">
            <?php foreach ($menus as $menu): ?>
                <div class="bg-white shadow-xl rounded-2xl overflow-hidden">
                    <img src="<?= $menu['image'] ?>" alt="<?= $menu['name'] ?>" class="h-48 w-full object-cover">
                    <div class="p-4">
                        <h3 class="font-semibold text-lg"><?= $menu['name'] ?></h3>
                        <p class="text-gray-600"><?= $menu['description'] ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>
