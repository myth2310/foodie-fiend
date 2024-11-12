<?php
$menus = $data['menus'];
$totalMenu = $data['menus']['totalMenu'];

?>

<?= $this->extend('layouts/dashboard') ?>
<?= $this->section('sidebar') ?>
<?= $this->include('components/sidebar') ?>
<?= $this->endSection() ?>
<?= $this->section('navbar') ?>
<?= $this->include('components/dashboard_nav') ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    <?php if (session()->getFlashdata('swal_success')): ?>
      Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: '<?= session()->getFlashdata('swal_success'); ?>',
      });
    <?php endif; ?>

    <?php if (session()->getFlashdata('swal_error')): ?>
      Swal.fire({
        icon: 'error',
        title: 'Gagal!',
        text: '<?= session()->getFlashdata('swal_error'); ?>',
      });
    <?php endif; ?>
  });
</script>


<?php
$isVerif = $data['store']['is_verif'];

$ktpUrl = $data['store']['ktp_url'];
$umkmLetter = $data['store']['umkm_letter'];

if ($isVerif == 0 && is_null($ktpUrl) && is_null($umkmLetter)) : ?>
  <div class="bg-red-100 border-l-4 border-yellow-500 text-yellow-700 p-4 ml-4 mb-4 rounded-lg">
    <p><strong class="font-bold">Information: </strong> Akun Anda belum diverifikasi. Segera lengkapi data profil UMKM untuk mengakses semua fitur.</p>
    <button type="button" class="bg-green-500 text-white p-2 mt-4 rounded-md" onclick="openModal()">Lengkapi Profil UMKM</button>
  </div>
<?php elseif ($isVerif == 0) : ?>
  <div class="ml-3" style="background-color: #e0e951; border-radius: 10px; padding: 20px; ">
    <p><strong class="font-bold">Information: </strong> Akun Anda belum diverifikasi. Silakan tunggu proses verifikasi.</p>
  </div>
<?php endif; ?>

<!-- Modal Structure -->
<div class="fixed inset-0 flex items-center justify-center z-50" id="profileFormModal" style="display:none;">
  <div class="modal-overlay absolute inset-0 bg-gray-600 opacity-50"></div>
  <div class="modal-container bg-white w-11/12 md:w-1/2 rounded-lg z-10 p-8">
    <div class="modal-header flex justify-between items-center pb-4">
      <h5 class="text-xl font-semibold text-gray-800">Lengkapi Informasi Profil UMKM Anda</h5>
      <button type="button" class="text-gray-500" id="closeModal">&times;</button>
    </div>
    <div class="modal-body">
      <form id="profileForm" method="POST" enctype="multipart/form-data" action="<?= base_url('dashboard/update/store/' . session()->get('user_id')) ?>">
        <?= csrf_field() ?>
        <div class="step mt-2" id="step1">
          <div class="mb-4">
            <label for="name" class="block text-gray-700">Nama Pemilik/Owner</label>
            <input type="text" name="name" value="<?= session()->get('name') ?>" class="mt-2 p-2 w-full border rounded-md" required />
          </div>
          <div class="mb-4">
            <label for="email" class="block text-gray-700">Alamat Email</label>
            <input type="email" name="email" value="<?= session()->get('email') ?>" class="mt-2 p-2 w-full border rounded-md" readonly />
          </div>
          <div class="mb-4">
            <label for="address" class="block text-gray-700">Alamat</label>
            <input type="text" name="address" value="<?= session()->get('address') ?>" class="mt-2 p-2 w-full border rounded-md" readonly />
          </div>
        </div>

        <!-- Step 2 -->
        <div class="step mt-2" id="step2" style="display:none;">
          <div class="mb-4">
            <label for="ktp" class="block text-gray-700">Upload KTP</label>
            <input type="file" name="ktp_url" accept="image/*,application/pdf" class="mt-2 p-2 w-full border rounded-md" required />
          </div>
          <div class="mb-4">
            <label for="umkm_letter" class="block text-gray-700">Surat Mitra UMKM</label>
            <input type="file" name="umkm_letter" accept="image/*,application/pdf" class="mt-2 p-2 w-full border rounded-md" required />
            <a href="<?= base_url('dashboard/download-template-surat') ?>"
              class="text-blue-500 mt-2 inline-block">
              Unduh Template Surat Ketersediaan Mitra UMKM
            </a>
          </div>
          <div class="mb-4 flex items-center">
            <input type="checkbox" id="confirmData" name="confirmData" class="mr-2" required>
            <label for="confirmData" class="text-gray-700">
              Saya telah memastikan bahwa data yang saya isi sudah benar.
            </label>
          </div>
        </div>

        <!-- Navigation buttons -->
        <div class="flex justify-between pt-6">
          <button type="button" class="btn-prev text-gray-500 bg-green-200 px-4 py-2 rounded-md" id="prevBtn" style="display:none;">Previous</button>
          <button type="button" class="btn-next bg-blue-500 text-white px-4 py-2 rounded-md" id="nextBtn">Next</button>
          <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-md" id="submitBtn" style="display:none;">Simpan Profil</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="w-full px-6 py-6 mx-auto">
  <div class="flex flex-wrap -mx-3">
    <div class="w-full max-w-full px mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
      <div class="relative flex flex-col min-w-0 break-words bg-white shadow-xl rounded-2xl bg-clip-border">
        <div class="flex-auto p-4">
          <div class="flex flex-row -mx-3">
            <div class="flex-none w-2/3 max-w-full px-3">
              <div>
                <p class="mb-0 font-sans text-sm font-semibold leading-normal uppercase">Total Menu</p>
                <h5 class="mb-2 font-bold"><?= $totalMenu ?? 0 ?></h5>
              </div>
            </div>
            <div class="px-3 text-right basis-1/3">
              <div class="inline-block w-12 h-12 text-center rounded-full bg-gradient-to-tl from-blue-500 to-violet-500">
                <i class="ni leading-none ni-money-coins text-lg relative top-3.5 text-white"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- card2 -->
    <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
      <div class="relative flex flex-col min-w-0 break-words bg-white shadow-xl rounded-2xl bg-clip-border">
        <div class="flex-auto p-4">
          <div class="flex flex-row -mx-3">
            <div class="flex-none w-2/3 max-w-full px-3">
              <div>
                <p class="mb-0 font-sans text-sm font-semibold leading-normal uppercase">Total Kategori</p>
                <h5 class="mb-2 font-bold"><?= $totalCategory ?? 0 ?></h5>
              </div>
            </div>
            <div class="px-3 text-right basis-1/3">
              <div class="inline-block w-12 h-12 text-center rounded-full bg-gradient-to-tl from-emerald-500 to-teal-400">
                <i class="ni leading-none ni-paper-diploma text-lg relative top-3.5 text-white"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- card 3 -->
    <div class="w-full max-w-full px-3 sm:w-1/2 sm:flex-none xl:w-1/4">
      <div class="relative flex flex-col min-w-0 break-words bg-white shadow-xl rounded-2xl bg-clip-border">
        <div class="flex-auto p-4">
          <div class="flex flex-row -mx-3">
            <div class="flex-none w-2/3 max-w-full px-3">
              <div>
                <p class="mb-0 font-sans text-sm font-semibold leading-normal uppercase">Pesanan</p>
                <h5 class="mb-2 font-bold"><?= $orderTotal ?? 0 ?></h5>
              </div>
            </div>
            <div class="px-3 text-right basis-1/3">
              <div class="inline-block w-12 h-12 text-center rounded-full bg-gradient-to-tl from-orange-500 to-yellow-500">
                <i class="ni leading-none ni-cart text-lg relative top-3.5 text-white"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- cards row 3 -->
  <!-- <div class="flex flex-wrap mt-6 -mx-3">
    <div class="w-full max-w-full px-3 mt-0 mb-6 lg:mb-0 lg:w-7/12 lg:flex-none">
      <div class="relative flex flex-col min-w-0 break-words bg-white border-0 border-solid shadow-xl border-black-125 rounded-2xl bg-clip-border">
        <div class="p-4 pb-0 mb-0 rounded-t-4">
          <div class="flex justify-between">
            <h6 class="mb-2">Daftar Menu</h6>
          </div>
        </div>
        <div class="overflow-x-auto">
          <table class="items-center w-full mb-4 align-top border-collapse border-gray-200">
            <tbody>
              <?php foreach ($menus['menus'] as $menu): ?>
                <tr>
                  <td class="p-2 align-middle bg-transparent border-b w-3/10 whitespace-nowrap">
                    <div class="flex items-center px-2 py-1">
                      <div>
                        <img class="h-8 w-8 bg-cover rounded-lg" src="<?= $menu->image_url ?>" alt="Country flag" />
                      </div>
                      <div class="ml-6">
                        <p class="mb-0 text-xs font-semibold leading-tight"><?= $menu->name ?></p>
                        <h6 class="mb-0 text-sm leading-normal"><?= $menu->description ?></h6>
                      </div>
                    </div>
                  </td>
                  <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap">
                    <div class="text-center">
                      <p class="mb-0 text-xs font-semibold leading-tight">Harga:</p>
                      <h6 class="mb-0 text-sm leading-normal"><?= $menu->price ?></h6>
                    </div>
                  </td>

                </tr>
              <?php endforeach ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>


  </div> -->
</div>


<script>
  let currentStep = 1;

  function showStep(step) {
    const steps = document.querySelectorAll('.step');
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');
    const submitBtn = document.getElementById('submitBtn');
    steps.forEach((stepDiv) => {
      stepDiv.style.display = 'none';
    });

    document.getElementById('step' + step).style.display = 'block';
    if (step === steps.length) {
      nextBtn.style.display = 'none';
      submitBtn.style.display = 'block';
    } else {
      nextBtn.style.display = 'block';
      submitBtn.style.display = 'none';
    }
    if (step === 1) {
      prevBtn.style.display = 'none';
    } else {
      prevBtn.style.display = 'block';
    }
  }

  document.getElementById('nextBtn').addEventListener('click', function() {
    if (currentStep < 3) {
      currentStep++;
      showStep(currentStep);
    }
  });
  document.getElementById('prevBtn').addEventListener('click', function() {
    if (currentStep > 1) {
      currentStep--;
      showStep(currentStep);
    }
  });

  function openModal() {
    document.getElementById('profileFormModal').style.display = 'flex';
    showStep(currentStep);
  }
  document.getElementById('closeModal').addEventListener('click', function() {
    document.getElementById('profileFormModal').style.display = 'none';
  });

  showStep(currentStep);
</script>

<?= $this->endSection() ?>

<?= $this->section('footer') ?>
<?= $this->include('components/dashboard_foot') ?>
<?= $this->endSection() ?>

<?= $this->section('navbar_configurator') ?>
<?= $this->include('components/navbar_configurator') ?>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<!-- plugin for scrollbar  -->
<script src="<?= base_url('assets/js/plugins/perfect-scrollbar.min.js') ?>" async></script>
<!-- main script file  -->
<script src="<?= base_url('assets/js/argon-dashboard-tailwind.js?v=1.0.1') ?>" async></script>
<!-- plugin for charts  -->
<script src="<?= base_url('assets/js/plugins/chartjs.min.js') ?>" async></script>
<?= $this->endSection() ?>