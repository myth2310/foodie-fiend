<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="apple-touch-icon" sizes="76x76" href="<?= base_url('assets/img/apple-icon.png') ?>" />
    <link rel="icon" type="image/png" href="<?= base_url('assets/img/favicon.png') ?>" />
    <title>Foodie Dashboard | <?= $title ?? '' ?></title>
    <!-- Fonts and icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Nucleo Icons -->
    <link href="<?= base_url('assets/css/nucleo-icons.css') ?>" rel="stylesheet" />
    <link href="<?= base_url('assets/css/nucleo-svg.css') ?>" rel="stylesheet" />
    <!-- Popper -->
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Main Styling -->
    <link href="<?= base_url('assets/css/styles.css') ?>" rel="stylesheet" />
  </head>

  <body class="dark:bg-slate-900">
    <?= $this->renderSection('modal', true) ?>
    <div class="m-0 font-sans text-base antialiased font-normal dark:bg-slate-900 leading-default bg-gray-50 text-slate-500">
      <div class="absolute w-full bg-orange-500 dark:hidden min-h-72"></div>

      <!-- Sidebar Section -->
      <?= $this->renderSection('sidebar', true) ?>

      <main class="relative h-full max-h-screen transition-all duration-200 ease-in-out xl:ml-72 rounded-xl">
        <!-- Navbar -->
        <?= $this->renderSection('navbar', true) ?>

        <div class="w-full px-6 py-6 mx-auto">
        <!-- Content Section -->
        <?= $this->renderSection('content', true) ?>

          <!-- Footer Section -->
          <?= $this->renderSection('footer', true) ?>
        </div>
      </main>
      <!-- Navbar Configurator Section -->
      <?= $this->renderSection('navbar_configurator', true) ?>
    </div>
  </body>
  <!-- Script Section -->
  <?= $this->renderSection('scripts', true) ?>
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
</html>