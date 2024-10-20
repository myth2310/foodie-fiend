<nav aria-label="Page navigation">
    <ul class="flex space-x-2 mt-4">
        <!-- Tombol Previous -->
        <?php if ($pager->hasPrevious()): ?>
            <li>
                <a href="<?= $pager->getPrevious() ?>" 
                   class="px-4 py-2 border rounded-md bg-gray-200 hover:bg-gray-300 text-gray-800">
                    Previous
                </a>
            </li>
        <?php endif ?>

        <!-- Links Number -->
        <?php foreach ($pager->links() as $link): ?>
            <li>
                <a href="<?= $link['uri'] ?>" 
                   class="px-4 py-2 border rounded-md 
                          <?= $link['active'] ? 'bg-blue-500 text-white' : 'bg-gray-200 text-gray-800 hover:bg-gray-300' ?>">
                    <?= $link['title'] ?>
                </a>
            </li>
        <?php endforeach ?>

        <!-- Tombol Next -->
        <?php if ($pager->hasNext()): ?>
            <li>
                <a href="<?= $pager->getNext() ?>" 
                   class="px-4 py-2 border rounded-md bg-gray-200 hover:bg-gray-300 text-gray-800">
                    Next
                </a>
            </li>
        <?php endif ?>
    </ul>
</nav>
