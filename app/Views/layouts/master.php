<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url('assets/css/styles.css'); ?>">
    <title><?= $title; ?></title>
</head>
<body>
    <header>
        <p>Header Section</p>
    </header>
    <?= $this->section('loader'); ?>
    <main>
        <p>Main Section</p>
        <?= $this->section('content'); ?>
    </main>
    <footer>
        <p>Footer Section</p>
    </footer>
    <!-- Script section -->
    <?= $this->section('scripts'); ?>
</body>
</html>