<?= $this->extend('layouts/dashboard_user') ?>

<?= $this->section('navbar') ?>
  <nav class="text-gray-500 space-y-1">
    <a href="/user/dashboard" class="flex items-center py-2.5 px-4 rounded-lg transition duration-200 font-semibold bg-white shadow-lg text-gray-500" id="profile-link">
      <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center text-white bg-orange-500 stroke-0 text-center xl:p-2.5">
        <i class="fas fa-user"></i>
      </div>
      Akun Saya
    </a>
    <a href="/user/dashboard/chart" class="flex items-center py-2.5 px-4 rounded-lg transition duration-200 hover:font-semibold hover:bg-white hover:shadow-lg hover:text-gray-500" id="shop-chart-link">
      <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center text-white bg-yellow-500 stroke-0 text-center xl:p-2.5">
      <i class="fas fa-shopping-cart"></i>
      </div>
      Keranjang Saya
    </a>
    <a href="/user/dashboard/order" class="flex items-center py-2.5 px-4 rounded-lg transition duration-200 hover:font-semibold hover:bg-white hover:shadow-lg hover:text-gray-500" id="shop-chart-link">
      <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center text-white bg-green-500 stroke-0 text-center xl:p-2.5">
        <i class="fas fa-clipboard-list"></i>
      </div>
      Pesanan Saya
    </a>
    <a href="/recommendations" class="flex items-center py-2.5 px-4 rounded-lg transition duration-200 hover:font-semibold hover:bg-white hover:shadow-lg hover:text-gray-500" id="setting-link">
      <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center text-white bg-gray-500 stroke-0 text-center xl:p-2.5">
      <i class="fa-solid fa-bowl-food"></i>
      </div>
      Jelajah UMKM
    </a>
    <a href="/logout" class="flex items-center py-2.5 px-4 rounded-lg transition duration-200 hover:font-semibold hover:bg-white hover:shadow-lg hover:text-gray-500" id="logout-link">
      <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center text-white bg-red-500 stroke-0 text-center xl:p-2.5">
        <i class="fas fa-sign-out-alt"></i>
      </div>
      Keluar
    </a>
  </nav>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
  <div id="user-form-detail" class="p-8 bg-white shadow-xl rounded-lg m-6">
    <div class="mb-8">
      <span class="font-semibold text-xl text-gray-800">Profil Saya</span>
      <p class="text-gray-600">Kelola informasi profil Anda untuk mengontrol, melindungi dan mengamankan akun</p>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2">
      <form class="p-4" action="/user/update">
        <?= csrf_field() ?>
        <table class="w-full">
          <tbody class="space-y-4 items-center mx-auto">
            <tr>
              <td>
                <div class="mb-4">
                  <label for="name" class="text-gray-900">Name</label>
                </div>
              </td>
              <td>
                <div class="mb-4 w-full">
                  <input name="name" type="text" value="<?= session()->get('name') ?>" class="px-4 py-1.5 bg-gray-100 rounded-md items-center text-gray-800">
                </div>
              </td>
            </tr>
            <tr>
              <td>
                <div class="mb-4">
                  <label for="email" class="text-gray-900">Email</label>
                </div>
              </td>
              <td>
                <div class="mb-4">
                  <input name="email" type="text" value="<?= session()->get('email') ?>" disabled class="px-4 py-1.5 bg-gray-100 rounded-md items-center text-gray-400">
                </div>
              </td>
            </tr>
            <tr>
              <td>
                <div class="mb-4">
                  <label for="phone" class="text-gray-900">Telepon</label>
                </div>
              </td>
              <td>
                <div class="mb-4">
                  <input type="text" value="<?= session()->get('phone') ?>" disabled class="px-4 py-1.5 bg-gray-100 rounded-md items-center text-gray-400">
                </div>
              </td>
            </tr>
            <tr>
              <td></td>
              <td>
                <button type="submit" class="text-white bg-orange-500 px-4 p-2 rounded-md">Simpan</button>
              </td>
            </tr>
          </tbody>
        </table>
      </form>
      <div class="flex flex-col bg-gray-50 rounded-md shadow-md p-6 mx-auto items-center justify-center">
        <div class="p-2 mb-4">
          <img src="<?= session()->get('profile') ?>" alt="Profile Image" class="rounded-full h-24 w-24">
        </div>
        <input type="file" accept=".jpg,.jpeg,.png" class="hidden">
        <button type="button" class="bg-gray-300 transition ease-in-out duration-300 hover:bg-gray-400 px-4 py-2 rounded-md text-white">Pilih Gambar</button>
        <div class="flex flex-col mt-4 text-gray-700 items-center">
          <p>Ukuran gambar: maks. 1 MB</p>
          <p>Format Gambart: .JPEG,.PNG</p>
        </div>
      </div>
    </div>
  </div>
<?= $this->endSection() ?>