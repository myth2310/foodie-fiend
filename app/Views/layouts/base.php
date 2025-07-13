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
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
  <?= $this->renderSection('loader', true); ?>
  <main class="bg-gray-100 pb-10">
    <?= $this->renderSection('content', true); ?>
  </main>
  <?= $this->renderSection('footer', true); ?>
  <?= $this->renderSection('scripts', true); ?>


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




  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


  <!-- Toastr JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

</body>

</html>