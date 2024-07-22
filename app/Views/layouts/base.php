<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url('assets/css/styles.css'); ?>">
    <title><?= $title ?? 'Home Page'; ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
</head>
<body>
    <?= $this->renderSection('loader', true); ?>
    <main class="bg-gray-100">
        <?= $this->renderSection('content', true); ?>
    </main>
    <?= $this->renderSection('footer', true); ?>
    <?= $this->renderSection('scripts', true); ?>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        <?php if (session()->has('messages')): ?>
            <?php $messages = session('messages') ?>
            <?php foreach ($messages as $key => $message): ?>
                toastr.success('<?php echo $message ?>');
            <?php endforeach ?>
        <?php endif; ?>
        <?php if (session()->has('errors')): ?>
            <?php $errors = session('errors') ?>
            <?php foreach ($errors as $key => $eror): ?>
                toastr.error("<?php echo $eror ?>");
            <?php endforeach ?>
        <?php endif ?>
        <?php if (session()->has('warning')): ?>
            toastr.warning('<?= session('warning') ?>');
        <?php endif ?>
        <?php if (session()->has('info')): ?>
            toastr.info('<?= session('info') ?>');
        <?php endif ?>
    </script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script> -->
</body>
</html>