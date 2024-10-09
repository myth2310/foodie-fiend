<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Foodie | Dashboard User</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous"/>
  <link rel="stylesheet" href="<?= base_url('assets/css/styles.css'); ?>">
  <style>
    @media (max-width: 768px) {
      .sidebar {
        transform: translateX(-100%);
        transition: transform 0.3s ease;
      }
      .sidebar.active {
        transform: translateX(0);
      }
    }
    .profile-nav-link.active {
      color: #F97316; /* Tailwind's blue-700 */
      font-weight: bold;
      /* border-bottom: 2px solid #F97316; */
    }
    .profile-nav-link {
      color: #6B7280; /* Tailwind's gray-600 */
      transition: color 0.3s, border-bottom 0.3s;
    }
    .profile-nav-link:hover {
      color: #F97316; /* Tailwind's blue-700 */
      /* border-bottom: 2px solid #F97316; */
    }
  </style>
</head>
<body class="bg-gray-100">
  <div class="flex">
    <!-- Sidebar -->
    <div class="sidebar h-screen w-80 space-y-6 py-7 px-2 absolute inset-y-0 left-0 transform md:relative md:translate-x-0 transition duration-200 ease-in-out">
      <!-- User Image -->
      <div class="flex items-center space-x-4 px-4">
        <img src="<?= session()->get('profile') ?>" alt="User Image" class="w-10 h-10 rounded-full">
        <div class="overflow-hidden">
          <h1 class="text-xl font-semibold text-gray-700"><?= session()->get('name') ?></h1>
          <p class="text-sm text-gray-400"><?= session()->get('email') ?></p>
        </div>
      </div>

      <!-- Menu Items -->
      <?= $this->renderSection('navbar', true) ?>
    </div>

    <!-- Main Content Start -->
    <div class="w-screen">
      <button class="md:hidden mb-4 bg-blue-600 text-white py-2 px-4 rounded" id="menu-button">☰</button>      
      <!-- Main Section Start -->
      <section>
        <?= $this->renderSection('content', true) ?>
      </section>
      <!-- Main Section End -->
    </div>
    <!-- Main Content End -->
  </div>
  <?= $this->renderSection('scripts') ?>

  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    <?php if (session()->getFlashdata('success')): ?>
      swal({
        title: "Sukses!",
        text: "<?= session()->getFlashdata('success') ?>",
        icon: "success",
        content: {
          element: "p",
          attributes: {
            style: "text-align: center;"
          }
        }
      });
    <?php elseif (session()->getFlashdata('error')): ?>
      swal({
        title: "Error!",
        html: true,
        text: "<?= session()->getFlashdata('error') ?>",
        icon: "error",
        content: {
          element: "p",
          attributes: {
            style: "text-align: center;"
          }
        }
      });
    <?php endif; ?>
  });
</script>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
</body>
</html>

