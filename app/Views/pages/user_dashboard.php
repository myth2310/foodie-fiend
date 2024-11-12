<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Foodie | Dashboard User</title>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous" />
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
      color: #F97316;
      font-weight: bold;
    }

    .profile-nav-link {
      color: #6B7280;
      transition: color 0.3s, border-bottom 0.3s;
    }

    .profile-nav-link:hover {
      color: #F97316;

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
        <div>
          <h1 class="text-xl font-semibold text-gray-700"><?= session()->get('name') ?></h1>
          <p class="text-sm text-gray-400"><?= session()->get('email') ?></p>
        </div>
      </div>

      <!-- Menu Items -->
      <nav class="text-gray-500 space-y-1">
        <a href="#" class="flex items-center py-2.5 px-4 rounded-lg transition duration-200 hover:font-semibold hover:bg-white hover:shadow-lg hover:text-gray-500" id="profile-link">
          <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center text-white bg-orange-500 stroke-0 text-center xl:p-2.5">
            <i class="fas fa-user"></i>
          </div>
          Akun Saya
        </a>
        <a href="#order" class="flex items-center py-2.5 px-4 rounded-lg transition duration-200 hover:font-semibold hover:bg-white hover:shadow-lg hover:text-gray-500" id="shop-chart-link">
          <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center text-white bg-green-500 stroke-0 text-center xl:p-2.5">
            <i class="fas fa-clipboard-list"></i>
          </div>
          Pesanan Saya
        </a>
        <a href="#" class="flex items-center py-2.5 px-4 rounded-lg transition duration-200 hover:font-semibold hover:bg-white hover:shadow-lg hover:text-gray-500" id="setting-link">
          <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center text-white bg-gray-400 stroke-0 text-center xl:p-2.5">
            <i class="fas fa-cog"></i>
          </div>
          Pengaturan
        </a>
        <a href="/logout" class="flex items-center py-2.5 px-4 rounded-lg transition duration-200 hover:font-semibold hover:bg-white hover:shadow-lg hover:text-gray-500" id="logout-link">
          <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center text-white bg-red-500 stroke-0 text-center xl:p-2.5">
            <i class="fas fa-sign-out-alt"></i>
          </div>
          Keluar
        </a>
      </nav>
    </div>

    <!-- Main Content -->
    <div class="w-screen">
      <button class="md:hidden mb-4 bg-blue-600 text-white py-2 px-4 rounded" id="menu-button">☰</button>

      <!-- <nav class="flex justify-between bg-gray-400 py-6 text-base px-10">
        <a href="#" class="profile-nav-link" data-target="menu-form">Menu</a>
        <a href="#" class="profile-nav-link" data-target="belum-bayar-form">Belum Bayar</a>
        <a href="#" class="profile-nav-link" data-target="selesai-form">Selesai</a>
        <a href="#" class="profile-nav-link" data-target="dibatalkan-form">Dibatalkan</a>
      </nav> -->

      <!-- Main section -->
      <section>
        <!-- Profile Navigation Bar   -->
        <div id="profile-nav" class="hidden mt-4">
          <nav class="bg-white flex space-x-8 border-b-2 py-4 px-8 mx-4 rounded-md shadow-md text-base font-semibold">
            <a href="#" class="profile-nav-link" data-target="menu-form">Semua</a>
            <a href="#" class="profile-nav-link" data-target="belum-bayar-form">Belum Bayar</a>
            <a href="#" class="profile-nav-link" data-target="selesai-form">Selesai</a>
            <a href="#" class="profile-nav-link" data-target="dibatalkan-form">Dibatalkan</a>
          </nav>

          <!-- Forms -->
          <div id="forms" class="mt-4 mx-4">
            <div id="dashboard-form" class="hidden">
              <h2 class="text-xl font-semibold">Update User Information</h2>
              <form class="mt-4 space-y-4" enctype="multipart/form-data">
                <label class="block">
                  <span class="text-gray-700">Full Name</span>
                  <input type="text" class="form-input mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                </label>
                <label class="block">
                  <span class="text-gray-700">Email</span>
                  <input type="email" class="form-input mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                </label>
                <label class="block">
                  <span class="text-gray-700">Profile Picture</span>
                  <input type="file" class="form-input mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                </label>
                <button type="submit" class="mt-4 bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700">Update</button>
              </form>
            </div>

            <div id="menu-form" class="profile-form hidden">
              <div id="allMenusContainer" class="h-screen overflow-y-auto">
                <!-- Item kedua -->
                <div class="mt-4 shadow-sm">
                  <div class="flex px-6 py-4 bg-white rounded-md">
                    <div class="flex items-center w-full space-x-6">
                      <span class="font-semibold text-gray-800">Nama Toko</span>
                      <a href="#" class="text-gray-500 hover:text-gray-700">
                        <div class="px-4 py-2 hover:bg-gray-100 transition ease-in-out duration-300 rounded-md items-center border">
                          <i class="fas fa-store"></i>
                          <span>Kunjungi Toko</span>
                        </div>
                      </a>
                    </div>
                    <div class="flex justify-end items-center w-1/2 space-x-6">
                      <div class="flex items-center space-x-2 text-green-600">
                        <i class="fas fa-shipping-fast"></i>
                        <p>Pesanan telah sampai</p>
                      </div>
                      <a href="#" class="text-white text-base font-medium">
                        <div class="px-4 py-2 bg-orange-500 transition ease-in-out duration-300 hover:bg-orange-700 rounded-md">
                          <p>Beri Ulasan</p>
                        </div>
                      </a>
                    </div>
                  </div>
                  <hr>
                  <div class="flex px-6 py-4 bg-white rounded-md">
                    <div class="flex items-center w-full">
                      <img class="w-16 h-16 rounded-md" src="https://down-id.img.susercontent.com/file/id-11134207-7r98p-lplzfppfo8a6ff_tn" alt="Item image">
                      <div class="ml-4">
                        <h4>[NEW!] itel P55 5G RAM 6+128GB - 5G Network - 50M Dual Clear Cam - 18W Fast Charging - 5000mAh Battery</h4>
                        <p>x1</p>
                      </div>
                    </div>
                    <div class="flex font-semibold justify-center items-center space-x-1 text-orange-400">
                      <span>Rp.</span>
                      <span>1.600.000</span>
                    </div>
                  </div>
                </div>

                <div class="mt-4 shadow-sm">
                  <div class="flex px-6 py-4 bg-white rounded-md">
                    <div class="flex items-center w-full space-x-6">
                      <span class="font-semibold text-gray-800">Nama Toko</span>
                      <a href="#" class="text-gray-500 hover:text-gray-700">
                        <div class="px-4 py-2 hover:bg-gray-100 transition ease-in-out duration-300 rounded-md items-center border">
                          <i class="fas fa-store"></i>
                          <span>Kunjungi Toko</span>
                        </div>
                      </a>
                    </div>
                    <div class="flex justify-end items-center w-1/2 space-x-6">
                      <div class="flex items-center space-x-2 text-green-600">
                        <i class="fas fa-shipping-fast"></i>
                        <p>Pesanan telah sampai</p>
                      </div>
                      <a href="#" class="text-white text-base font-medium">
                        <div class="px-4 py-2 bg-orange-500 transition ease-in-out duration-300 hover:bg-orange-700 rounded-md">
                          <p>Beri Ulasan</p>
                        </div>
                      </a>
                    </div>
                  </div>
                  <hr>
                  <div class="flex px-6 py-4 bg-white rounded-md">
                    <div class="flex items-center w-full">
                      <img class="w-16 h-16 rounded-md" src="https://down-id.img.susercontent.com/file/id-11134207-7r98p-lplzfppfo8a6ff_tn" alt="Item image">
                      <div class="ml-4">
                        <h4>[NEW!] itel P55 5G RAM 6+128GB - 5G Network - 50M Dual Clear Cam - 18W Fast Charging - 5000mAh Battery</h4>
                        <p>x1</p>
                      </div>
                    </div>
                    <div class="flex font-semibold justify-center items-center space-x-1 text-orange-400">
                      <span>Rp.</span>
                      <span>1.600.000</span>
                    </div>
                  </div>
                </div>

                <div class="mt-4 shadow-sm">
                  <div class="flex px-6 py-4 bg-white rounded-md">
                    <div class="flex items-center w-full space-x-6">
                      <span class="font-semibold text-gray-800">Nama Toko</span>
                      <a href="#" class="text-gray-500 hover:text-gray-700">
                        <div class="px-4 py-2 hover:bg-gray-100 transition ease-in-out duration-300 rounded-md items-center border">
                          <i class="fas fa-store"></i>
                          <span>Kunjungi Toko</span>
                        </div>
                      </a>
                    </div>
                    <div class="flex justify-end items-center w-1/2 space-x-6">
                      <div class="flex items-center space-x-2 text-green-600">
                        <i class="fas fa-shipping-fast"></i>
                        <p>Pesanan telah sampai</p>
                      </div>
                      <a href="#" class="text-white text-base font-medium">
                        <div class="px-4 py-2 bg-orange-500 transition ease-in-out duration-300 hover:bg-orange-700 rounded-md">
                          <p>Beri Ulasan</p>
                        </div>
                      </a>
                    </div>
                  </div>
                  <hr>
                  <div class="flex px-6 py-4 bg-white rounded-md">
                    <div class="flex items-center w-full">
                      <img class="w-16 h-16 rounded-md" src="https://down-id.img.susercontent.com/file/id-11134207-7r98p-lplzfppfo8a6ff_tn" alt="Item image">
                      <div class="ml-4">
                        <h4>[NEW!] itel P55 5G RAM 6+128GB - 5G Network - 50M Dual Clear Cam - 18W Fast Charging - 5000mAh Battery</h4>
                        <p>x1</p>
                      </div>
                    </div>
                    <div class="flex font-semibold justify-center items-center space-x-1 text-orange-400">
                      <span>Rp.</span>
                      <span>1.600.000</span>
                    </div>
                  </div>
                </div>

                <div class="mt-4 shadow-sm">
                  <div class="flex px-6 py-4 bg-white rounded-md">
                    <div class="flex items-center w-full space-x-6">
                      <span class="font-semibold text-gray-800">Nama Toko</span>
                      <a href="#" class="text-gray-500 hover:text-gray-700">
                        <div class="px-4 py-2 hover:bg-gray-100 transition ease-in-out duration-300 rounded-md items-center border">
                          <i class="fas fa-store"></i>
                          <span>Kunjungi Toko</span>
                        </div>
                      </a>
                    </div>
                    <div class="flex justify-end items-center w-1/2 space-x-6">
                      <div class="flex items-center space-x-2 text-green-600">
                        <i class="fas fa-shipping-fast"></i>
                        <p>Pesanan telah sampai</p>
                      </div>
                      <a href="#" class="text-white text-base font-medium">
                        <div class="px-4 py-2 bg-orange-500 transition ease-in-out duration-300 hover:bg-orange-700 rounded-md">
                          <p>Beri Ulasan</p>
                        </div>
                      </a>
                    </div>
                  </div>
                  <hr>
                  <div class="flex px-6 py-4 bg-white rounded-md">
                    <div class="flex items-center w-full">
                      <img class="w-16 h-16 rounded-md" src="https://down-id.img.susercontent.com/file/id-11134207-7r98p-lplzfppfo8a6ff_tn" alt="Item image">
                      <div class="ml-4">
                        <h4>[NEW!] itel P55 5G RAM 6+128GB - 5G Network - 50M Dual Clear Cam - 18W Fast Charging - 5000mAh Battery</h4>
                        <p>x1</p>
                      </div>
                    </div>
                    <div class="flex font-semibold justify-center items-center space-x-1 text-orange-400">
                      <span>Rp.</span>
                      <span>1.600.000</span>
                    </div>
                  </div>
                </div>

                <div class="mt-4 shadow-sm">
                  <div class="flex px-6 py-4 bg-white rounded-md">
                    <div class="flex items-center w-full space-x-6">
                      <span class="font-semibold text-gray-800">Nama Toko</span>
                      <a href="#" class="text-gray-500 hover:text-gray-700">
                        <div class="px-4 py-2 hover:bg-gray-100 transition ease-in-out duration-300 rounded-md items-center border">
                          <i class="fas fa-store"></i>
                          <span>Kunjungi Toko</span>
                        </div>
                      </a>
                    </div>
                    <div class="flex justify-end items-center w-1/2 space-x-6">
                      <div class="flex items-center space-x-2 text-green-600">
                        <i class="fas fa-shipping-fast"></i>
                        <p>Pesanan telah sampai</p>
                      </div>
                      <a href="#" class="text-white text-base font-medium">
                        <div class="px-4 py-2 bg-orange-500 transition ease-in-out duration-300 hover:bg-orange-700 rounded-md">
                          <p>Beri Ulasan</p>
                        </div>
                      </a>
                    </div>
                  </div>
                  <hr>
                  <div class="flex px-6 py-4 bg-white rounded-md">
                    <div class="flex items-center w-full">
                      <img class="w-16 h-16 rounded-md" src="https://down-id.img.susercontent.com/file/id-11134207-7r98p-lplzfppfo8a6ff_tn" alt="Item image">
                      <div class="ml-4">
                        <h4>[NEW!] itel P55 5G RAM 6+128GB - 5G Network - 50M Dual Clear Cam - 18W Fast Charging - 5000mAh Battery</h4>
                        <p>x1</p>
                      </div>
                    </div>
                    <div class="flex font-semibold justify-center items-center space-x-1 text-orange-400">
                      <span>Rp.</span>
                      <span>1.600.000</span>
                    </div>
                  </div>
                </div>

                <div class="mt-4 shadow-sm">
                  <div class="flex px-6 py-4 bg-white rounded-md">
                    <div class="flex items-center w-full space-x-6">
                      <span class="font-semibold text-gray-800">Nama Toko</span>
                      <a href="#" class="text-gray-500 hover:text-gray-700">
                        <div class="px-4 py-2 hover:bg-gray-100 transition ease-in-out duration-300 rounded-md items-center border">
                          <i class="fas fa-store"></i>
                          <span>Kunjungi Toko</span>
                        </div>
                      </a>
                    </div>
                    <div class="flex justify-end items-center w-1/2 space-x-6">
                      <div class="flex items-center space-x-2 text-green-600">
                        <i class="fas fa-shipping-fast"></i>
                        <p>Pesanan telah sampai</p>
                      </div>
                      <a href="#" class="text-white text-base font-medium">
                        <div class="px-4 py-2 bg-orange-500 transition ease-in-out duration-300 hover:bg-orange-700 rounded-md">
                          <p>Beri Ulasan</p>
                        </div>
                      </a>
                    </div>
                  </div>
                  <hr>
                  <div class="flex px-6 py-4 bg-white rounded-md">
                    <div class="flex items-center w-full">
                      <img class="w-16 h-16 rounded-md" src="https://down-id.img.susercontent.com/file/id-11134207-7r98p-lplzfppfo8a6ff_tn" alt="Item image">
                      <div class="ml-4">
                        <h4>[NEW!] itel P55 5G RAM 6+128GB - 5G Network - 50M Dual Clear Cam - 18W Fast Charging - 5000mAh Battery</h4>
                        <p>x1</p>
                      </div>
                    </div>
                    <div class="flex font-semibold justify-center items-center space-x-1 text-orange-400">
                      <span>Rp.</span>
                      <span>1.600.000</span>
                    </div>
                  </div>
                </div>

              </div>
            </div>

            <div id="belum-bayar-form" class="profile-form hidden">
              <div class="h-screen overflow-y-auto">
                <!-- Item kedua -->
                <div class="mt-4 shadow-sm">
                  <div class="flex px-6 py-4 bg-white rounded-md">
                    <div class="flex items-center w-full space-x-6">
                      <span class="font-semibold text-gray-800">Nama Toko</span>
                      <a href="#" class="text-gray-500 hover:text-gray-700">
                        <div class="px-4 py-2 hover:bg-gray-100 transition ease-in-out duration-300 rounded-md items-center border">
                          <i class="fas fa-store"></i>
                          <span>Kunjungi Toko</span>
                        </div>
                      </a>
                    </div>
                    <div class="flex justify-end items-center w-1/2 space-x-6">
                      <div class="flex items-center space-x-2 text-green-600">
                        <i class="fas fa-shipping-fast"></i>
                        <p>Pesanan telah sampai</p>
                      </div>
                      <a href="#" class="text-white text-base font-medium">
                        <div class="px-4 py-2 bg-orange-500 transition ease-in-out duration-300 hover:bg-orange-700 rounded-md">
                          <p>Beri Ulasan</p>
                        </div>
                      </a>
                    </div>
                  </div>
                  <hr>
                  <div class="flex px-6 py-4 bg-white rounded-md">
                    <div class="flex items-center w-full">
                      <img class="w-16 h-16 rounded-md" src="https://down-id.img.susercontent.com/file/id-11134207-7r98p-lplzfppfo8a6ff_tn" alt="Item image">
                      <div class="ml-4">
                        <h4>[NEW!] itel P55 5G RAM 6+128GB - 5G Network - 50M Dual Clear Cam - 18W Fast Charging - 5000mAh Battery</h4>
                        <p>x1</p>
                      </div>
                    </div>
                    <div class="flex font-semibold justify-center items-center space-x-1 text-orange-400">
                      <span>Rp.</span>
                      <span>1.600.000</span>
                    </div>
                  </div>
                </div>

                <div class="mt-4 shadow-sm">
                  <div class="flex px-6 py-4 bg-white rounded-md">
                    <div class="flex items-center w-full space-x-6">
                      <span class="font-semibold text-gray-800">Nama Toko</span>
                      <a href="#" class="text-gray-500 hover:text-gray-700">
                        <div class="px-4 py-2 hover:bg-gray-100 transition ease-in-out duration-300 rounded-md items-center border">
                          <i class="fas fa-store"></i>
                          <span>Kunjungi Toko</span>
                        </div>
                      </a>
                    </div>
                    <div class="flex justify-end items-center w-1/2 space-x-6">
                      <div class="flex items-center space-x-2 text-green-600">
                        <i class="fas fa-shipping-fast"></i>
                        <p>Pesanan telah sampai</p>
                      </div>
                      <a href="#" class="text-white text-base font-medium">
                        <div class="px-4 py-2 bg-orange-500 transition ease-in-out duration-300 hover:bg-orange-700 rounded-md">
                          <p>Beri Ulasan</p>
                        </div>
                      </a>
                    </div>
                  </div>
                  <hr>
                  <div class="flex px-6 py-4 bg-white rounded-md">
                    <div class="flex items-center w-full">
                      <img class="w-16 h-16 rounded-md" src="https://down-id.img.susercontent.com/file/id-11134207-7r98p-lplzfppfo8a6ff_tn" alt="Item image">
                      <div class="ml-4">
                        <h4>[NEW!] itel P55 5G RAM 6+128GB - 5G Network - 50M Dual Clear Cam - 18W Fast Charging - 5000mAh Battery</h4>
                        <p>x1</p>
                      </div>
                    </div>
                    <div class="flex font-semibold justify-center items-center space-x-1 text-orange-400">
                      <span>Rp.</span>
                      <span>1.600.000</span>
                    </div>
                  </div>
                </div>

                <div class="mt-4 shadow-sm">
                  <div class="flex px-6 py-4 bg-white rounded-md">
                    <div class="flex items-center w-full space-x-6">
                      <span class="font-semibold text-gray-800">Nama Toko</span>
                      <a href="#" class="text-gray-500 hover:text-gray-700">
                        <div class="px-4 py-2 hover:bg-gray-100 transition ease-in-out duration-300 rounded-md items-center border">
                          <i class="fas fa-store"></i>
                          <span>Kunjungi Toko</span>
                        </div>
                      </a>
                    </div>
                    <div class="flex justify-end items-center w-1/2 space-x-6">
                      <div class="flex items-center space-x-2 text-green-600">
                        <i class="fas fa-shipping-fast"></i>
                        <p>Pesanan telah sampai</p>
                      </div>
                      <a href="#" class="text-white text-base font-medium">
                        <div class="px-4 py-2 bg-orange-500 transition ease-in-out duration-300 hover:bg-orange-700 rounded-md">
                          <p>Beri Ulasan</p>
                        </div>
                      </a>
                    </div>
                  </div>
                  <hr>
                  <div class="flex px-6 py-4 bg-white rounded-md">
                    <div class="flex items-center w-full">
                      <img class="w-16 h-16 rounded-md" src="https://down-id.img.susercontent.com/file/id-11134207-7r98p-lplzfppfo8a6ff_tn" alt="Item image">
                      <div class="ml-4">
                        <h4>[NEW!] itel P55 5G RAM 6+128GB - 5G Network - 50M Dual Clear Cam - 18W Fast Charging - 5000mAh Battery</h4>
                        <p>x1</p>
                      </div>
                    </div>
                    <div class="flex font-semibold justify-center items-center space-x-1 text-orange-400">
                      <span>Rp.</span>
                      <span>1.600.000</span>
                    </div>
                  </div>
                </div>

              </div>
            </div>

            <div id="selesai-form" class="profile-form hidden">
              <div class="h-screen overflow-y-auto">
                <!-- Item kedua -->
                <div class="mt-4 shadow-sm">
                  <div class="flex px-6 py-4 bg-white rounded-md">
                    <div class="flex items-center w-full space-x-6">
                      <span class="font-semibold text-gray-800">Nama Toko</span>
                      <a href="#" class="text-gray-500 hover:text-gray-700">
                        <div class="px-4 py-2 hover:bg-gray-100 transition ease-in-out duration-300 rounded-md items-center border">
                          <i class="fas fa-store"></i>
                          <span>Kunjungi Toko</span>
                        </div>
                      </a>
                    </div>
                    <div class="flex justify-end items-center w-1/2 space-x-6">
                      <div class="flex items-center space-x-2 text-green-600">
                        <i class="fas fa-shipping-fast"></i>
                        <p>Pesanan telah sampai</p>
                      </div>
                      <a href="#" class="text-white text-base font-medium">
                        <div class="px-4 py-2 bg-orange-500 transition ease-in-out duration-300 hover:bg-orange-700 rounded-md">
                          <p>Beri Ulasan</p>
                        </div>
                      </a>
                    </div>
                  </div>
                  <hr>
                  <div class="flex px-6 py-4 bg-white rounded-md">
                    <div class="flex items-center w-full">
                      <img class="w-16 h-16 rounded-md" src="https://down-id.img.susercontent.com/file/id-11134207-7r98p-lplzfppfo8a6ff_tn" alt="Item image">
                      <div class="ml-4">
                        <h4>[NEW!] itel P55 5G RAM 6+128GB - 5G Network - 50M Dual Clear Cam - 18W Fast Charging - 5000mAh Battery</h4>
                        <p>x1</p>
                      </div>
                    </div>
                    <div class="flex font-semibold justify-center items-center space-x-1 text-orange-400">
                      <span>Rp.</span>
                      <span>1.600.000</span>
                    </div>
                  </div>
                </div>

                <div class="mt-4 shadow-sm">
                  <div class="flex px-6 py-4 bg-white rounded-md">
                    <div class="flex items-center w-full space-x-6">
                      <span class="font-semibold text-gray-800">Nama Toko</span>
                      <a href="#" class="text-gray-500 hover:text-gray-700">
                        <div class="px-4 py-2 hover:bg-gray-100 transition ease-in-out duration-300 rounded-md items-center border">
                          <i class="fas fa-store"></i>
                          <span>Kunjungi Toko</span>
                        </div>
                      </a>
                    </div>
                    <div class="flex justify-end items-center w-1/2 space-x-6">
                      <div class="flex items-center space-x-2 text-green-600">
                        <i class="fas fa-shipping-fast"></i>
                        <p>Pesanan telah sampai</p>
                      </div>
                      <a href="#" class="text-white text-base font-medium">
                        <div class="px-4 py-2 bg-orange-500 transition ease-in-out duration-300 hover:bg-orange-700 rounded-md">
                          <p>Beri Ulasan</p>
                        </div>
                      </a>
                    </div>
                  </div>
                  <hr>
                  <div class="flex px-6 py-4 bg-white rounded-md">
                    <div class="flex items-center w-full">
                      <img class="w-16 h-16 rounded-md" src="https://down-id.img.susercontent.com/file/id-11134207-7r98p-lplzfppfo8a6ff_tn" alt="Item image">
                      <div class="ml-4">
                        <h4>[NEW!] itel P55 5G RAM 6+128GB - 5G Network - 50M Dual Clear Cam - 18W Fast Charging - 5000mAh Battery</h4>
                        <p>x1</p>
                      </div>
                    </div>
                    <div class="flex font-semibold justify-center items-center space-x-1 text-orange-400">
                      <span>Rp.</span>
                      <span>1.600.000</span>
                    </div>
                  </div>
                </div>

              </div>
            </div>

            <div id="dibatalkan-form" class="profile-form hidden">
              <div class="h-screen overflow-y-auto">
                <!-- Item kedua -->
                <div class="mt-4 shadow-sm">
                  <div class="flex px-6 py-4 bg-white rounded-md">
                    <div class="flex items-center w-full space-x-6">
                      <span class="font-semibold text-gray-800">Nama Toko</span>
                      <a href="#" class="text-gray-500 hover:text-gray-700">
                        <div class="px-4 py-2 hover:bg-gray-100 transition ease-in-out duration-300 rounded-md items-center border">
                          <i class="fas fa-store"></i>
                          <span>Kunjungi Toko</span>
                        </div>
                      </a>
                    </div>
                    <div class="flex justify-end items-center w-1/2 space-x-6">
                      <div class="flex items-center space-x-2 text-green-600">
                        <i class="fas fa-shipping-fast"></i>
                        <p>Pesanan telah sampai</p>
                      </div>
                      <a href="#" class="text-white text-base font-medium">
                        <div class="px-4 py-2 bg-orange-500 transition ease-in-out duration-300 hover:bg-orange-700 rounded-md">
                          <p>Beri Ulasan</p>
                        </div>
                      </a>
                    </div>
                  </div>
                  <hr>
                  <div class="flex px-6 py-4 bg-white rounded-md">
                    <div class="flex items-center w-full">
                      <img class="w-16 h-16 rounded-md" src="https://down-id.img.susercontent.com/file/id-11134207-7r98p-lplzfppfo8a6ff_tn" alt="Item image">
                      <div class="ml-4">
                        <h4>[NEW!] itel P55 5G RAM 6+128GB - 5G Network - 50M Dual Clear Cam - 18W Fast Charging - 5000mAh Battery</h4>
                        <p>x1</p>
                      </div>
                    </div>
                    <div class="flex font-semibold justify-center items-center space-x-1 text-orange-400">
                      <span>Rp.</span>
                      <span>1.600.000</span>
                    </div>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>

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
                        <input name="name" type="text" value="<?= session()->get('name') ?>" class="px-4 py-1.5 bg-gray-100 rounded-md items-center text-gray-700">
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
                        <input name="email" type="text" value="<?= session()->get('email') ?>" disabled class="px-4 py-1.5 bg-gray-100 rounded-md items-center text-gray-700">
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
                        <input type="text" value="<?= session()->get('phone') ?>" disabled class="px-4 py-1.5 bg-gray-100 rounded-md items-center text-gray-700">
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
      </section>
    </div>
  </div>

  <script>
    const imageUrl = "https://down-id.img.susercontent.com/file/id-11134207-7r98p-lplzfppfo8a6ff_tn";
    const data = [{
        id: "asdasd-asdasdasd-asdasdasd",
        storeName: "Pondok Bakso",
        menuName: "Bakso Iga",
        imageUrl,
        price: 15000,
        quantity: 10,
        totalPrice: 150000
      },
      {
        id: "asdasd-asdasdasd-asdasdasd",
        storeName: "Pondok Bakso",
        menuName: "Bakso Iga",
        imageUrl,
        price: 15000,
        quantity: 10,
        totalPrice: 150000
      },
      {
        id: "asdasd-asdasdasd-asdasdasd",
        storeName: "Pondok Bakso",
        menuName: "Bakso Iga",
        imageUrl,
        price: 15000,
        quantity: 10,
        totalPrice: 150000
      },
      {
        id: "asdasd-asdasdasd-asdasdasd",
        storeName: "Pondok Bakso",
        menuName: "Bakso Iga",
        imageUrl,
        price: 15000,
        quantity: 10,
        totalPrice: 150000
      },
      {
        id: "asdasd-asdasdasd-asdasdasd",
        storeName: "Pondok Bakso",
        menuName: "Bakso Iga",
        imageUrl,
        price: 15000,
        quantity: 10,
        totalPrice: 150000
      },
    ];
    const userDetailForm = document.getElementById('user-form-detail');
    const menuButton = document.getElementById('menu-button');
    const sidebar = document.querySelector('.sidebar');
    const profileLink = document.getElementById('profile-link');
    const orderLink = document.getElementById('shop-chart-link');
    const profileNav = document.getElementById('profile-nav');
    const profileNavLinks = document.querySelectorAll('.profile-nav-link');
    const forms = document.querySelectorAll('.profile-form');
    const dashboardForm = document.getElementById('dashboard-form');
    const allMenusContainer = document.getElementById('allMenusContainer')

    const allMenus = data.map(item => `
        <div class="mt-4 shadow-sm">
          <div class="flex px-6 py-4 bg-white rounded-md">
            <div class="flex items-center w-full space-x-6">
              <span class="font-semibold text-gray-800">${item.storeName}</span>
              <a href="#${item.id}" class="text-gray-500 hover:text-gray-700">
                <div class="px-4 py-2 hover:bg-gray-100 transition ease-in-out duration-300 rounded-md items-center border">
                  <i class="fas fa-store"></i>
                  <span>Kunjungi Toko</span>
                </div>
              </a>
            </div>
            <div class="flex justify-end items-center w-1/2 space-x-6">
              <div class="flex items-center space-x-2 text-green-600">
                <i class="fas fa-shipping-fast"></i>
                <p>Pesanan telah sampai</p>
              </div>
              <a href="#" class="text-white text-base font-medium">
                <div class="px-4 py-2 bg-orange-500 transition ease-in-out duration-300 hover:bg-orange-700 rounded-md">
                  <p>Beri Ulasan</p>
                </div>
              </a> 
            </div>
          </div>
          <hr>
          <div class="flex px-6 py-4 bg-white rounded-md">
            <div class="flex items-center w-full">
              <img class="w-16 h-16 rounded-md" src="${item.imageUrl}" alt="Item image">
              <div class="ml-4">
                <h4>${item.menuName}</h4>
                <p>x${item.quantity}</p>
              </div>
            </div>
            <div class="flex font-semibold justify-center items-center space-x-1 text-orange-400">
              <span>Rp.</span>
              <span>${item.price}</span>
            </div>
          </div>
        </div>
    `).join('');

    allMenusContainer.innerHTML = allMenus;

    menuButton.addEventListener('click', () => {
      sidebar.classList.toggle('active');
    });

    orderLink.addEventListener('click', (event) => {
      userDetailForm.classList.add('hidden');
      event.preventDefault();
      profileNav.classList.toggle('hidden');
    });

    profileLink.addEventListener('click', (event) => {
      event.preventDefault();
      // Hide all forms
      forms.forEach(form => form.classList.add('hidden'));
      // Show the dashboard form
      dashboardForm.classList.remove('hidden');
    });

    profileNavLinks.forEach(link => {
      link.addEventListener('click', (event) => {
        event.preventDefault();

        // Remove active class from all links
        profileNavLinks.forEach(link => link.classList.remove('active'));

        // Hide all forms
        forms.forEach(form => form.classList.add('hidden'));
        console.log(link.getAttribute('data-target'));

        // Add active class to clicked link and show corresponding form
        link.classList.add('active');
        const targetForm = document.getElementById(link.getAttribute('data-target'));
        targetForm.classList.remove('hidden');
      });
    });
  </script>

</body>

</html>