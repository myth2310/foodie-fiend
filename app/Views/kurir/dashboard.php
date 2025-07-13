<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Kurir - <?= esc($umkm ?? 'UMKM') ?></title>
    <link rel="icon" href="https://i.ibb.co/Qr5K0Y4/foodfiend-kurir-icon.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/css/kurir.css'); ?>">
</head>

<body>

    <!-- Header -->
    <div class="header d-flex justify-content-between align-items-center py-2 bg-light">
        <div class="container d-flex justify-content-between align-items-center">
            <img src="<?= base_url('assets/img/icon-kurir.png'); ?>" alt="Food Fiend Kurir" class="logo-img" style="height: 40px;">
            <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" alt="Kurir" class="profile-img" style="height: 40px;">
        </div>
    </div>

    <div class="container mt-3 mb-5">
        <div class="hero mb-3">
            <h5>Halo, Kurir <?= esc($username ?? '-') ?></h5>
            <p class="text-muted mb-0"><?= esc($umkm ?? 'Belum terhubung ke UMKM') ?></p>
        </div>

        <!-- Tips Kurir -->
        <div class="card shadow-sm mb-3 p-3">
            <h6><i class="fa-solid fa-lightbulb text-warning"></i> Tips Kurir Hari Ini</h6>
            <ul class="mb-0 small">
                <li>Periksa pesanan sebelum pickup.</li>
                <li>Pastikan alamat pelanggan sesuai.</li>
                <li>Jaga keselamatan berkendara.</li>
            </ul>
        </div>


        <!-- Daftar Pesanan -->
        <h6 class="mb-2">Pesanan Aktif</h6>

        <?php if (!empty($orders)): ?>
            <?php foreach ($orders as $order): ?>
                <div class="card shadow-sm mb-2 p-3">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="mb-1"><?= esc($order['customer_name']) ?></h6>
                            <small class="text-muted">UMKM: <?= esc($umkm ?? '-') ?></small>
                        </div>

                        <?php
                        $badgeClass = 'bg-secondary';
                        $badgeText = ucfirst($order['delivery_status'] ?? 'Unknown');

                        if ($order['delivery_status'] === 'diantar') {
                            $badgeClass = 'bg-info text-dark';
                            $badgeText = 'Dalam Perjalanan';
                        } elseif ($order['delivery_status'] === 'selesai') {
                            $badgeClass = 'bg-success';
                            $badgeText = 'Selesai';
                        } elseif ($order['delivery_status'] === 'dimasak') {
                            $badgeClass = 'bg-warning text-dark';
                            $badgeText = 'Menunggu Pickup';
                        }
                        ?>
                        <span class="badge <?= $badgeClass ?> align-self-start"><?= $badgeText ?></span>
                    </div>

                    <?php
                    $total_price = $order['total_price'] ?? 0;
                    $shipping_cost = $order['shipping_cost'] ?? 0;
                    $application_fee = $order['application_fee'] ?? 0;
                    $grand_total = $total_price + $shipping_cost + $application_fee;
                    ?>

                    <div class="mt-2 mb-2">
                        <p class="mb-0 small text-muted">
                            Subtotal: Rp <?= number_format($total_price, 0, ',', '.') ?><br>
                            Ongkir: Rp <?= number_format($shipping_cost, 0, ',', '.') ?><br>
                            Biaya Aplikasi: Rp <?= number_format($application_fee, 0, ',', '.') ?>
                        </p>
                        <p class="mt-1 mb-0">
                            <strong>Total: Rp <?= number_format($grand_total, 0, ',', '.') ?></strong>
                        </p>
                    </div>

                    <?php if (!empty($order['delivery_proof'])): ?>
                        <div class="mt-2">
                            <p class="small mb-1 text-muted">Bukti Pengiriman:</p>
                            <a href="<?= esc($order['delivery_proof']) ?>" target="_blank">
                                <img src="<?= esc($order['delivery_proof']) ?>" alt="Bukti Pengiriman" class="img-fluid rounded shadow-sm mb-2" style="max-height: 150px;">
                            </a>
                            <p class="small text-muted">Status: <strong><?= ucfirst($order['delivery_status']) ?></strong></p>
                        </div>
                    <?php else: ?>
                        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                            <!-- Tombol Navigasi -->
                            <a href="#"
                                id="routeButton_<?= $order['order_id'] ?>"
                                target="_blank"
                                class="btn btn-sm btn-success">
                                <i class="fa-solid fa-location-arrow"></i> Navigasi
                            </a>

                            <!-- Tombol Upload Bukti -->
                            <form action="<?= base_url('upload-proof/kurir/' . $order['id']) ?>" method="post" enctype="multipart/form-data">
                                <?= csrf_field() ?>
                                <div class="input-group input-group-sm">
                                    <input type="file" name="bukti_pengiriman" accept="image/*" class="form-control" required>
                                    <button type="submit" class="btn btn-sm btn-primary">
                                        <i class="fa-solid fa-upload"></i> Upload Bukti
                                    </button>
                                </div>
                            </form>
                        </div>

                        <p class="mt-2 mb-0 small text-muted">
                            Klik tombol "Navigasi" untuk membuka rute ke lokasi pelanggan di Google Maps. Upload foto bukti pengantaran setelah pesanan selesai.
                        </p>
                    <?php endif; ?>

                    <script>
                        document.addEventListener("DOMContentLoaded", function() {
                            const routeBtn = document.getElementById('routeButton_<?= $order['order_id'] ?>');
                            const latUser = <?= json_encode($umkm_lat ?? '') ?>;
                            const longUser = <?= json_encode($umkm_long ?? '') ?>;
                            const latCustomer = <?= json_encode($order['customer_latitude'] ?? '') ?>;
                            const longCustomer = <?= json_encode($order['customer_longitude'] ?? '') ?>;

                            if (latUser && longUser && latCustomer && longCustomer) {
                                routeBtn.href = `https://www.google.com/maps/dir/?api=1&origin=${latUser},${longUser}&destination=${latCustomer},${longCustomer}&travelmode=driving`;
                            } else {
                                routeBtn.href = "#";
                                routeBtn.classList.add('disabled');
                                routeBtn.innerHTML = "<i class='fa-solid fa-exclamation-triangle'></i> Lokasi Tidak Lengkap";
                            }
                        });
                    </script>

                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-center text-muted">Belum ada pesanan yang ditugaskan kepada Anda.</p>
        <?php endif; ?>


    </div>


    <div class="nav-bottom shadow-sm bg-light p-2 d-flex justify-content-around fixed-bottom">
        <a href="/kurir/dashboard" class="text-center text-decoration-none text-dark">
            <i class="fa-solid fa-house"></i><br>Beranda
        </a>
        <a href="/logout" class="text-center text-decoration-none text-danger">
            <i class="fa-solid fa-right-from-bracket"></i><br>Logout
        </a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <?php if (session()->getFlashdata('swal_success')): ?>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '<?= session()->getFlashdata('swal_success') ?>',
                timer: 2000,
                showConfirmButton: false
            });
        </script>
    <?php elseif (session()->getFlashdata('swal_error')): ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: '<?= session()->getFlashdata('swal_error') ?>',
            });
        </script>
    <?php endif; ?>


</body>

</html>