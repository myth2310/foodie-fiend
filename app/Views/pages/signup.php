<?= $this->extend('layouts/base'); ?>

<?= $this->section('content'); ?>

<?php if (isset($validation)): ?>
  <div style="color: red;">
    <?= $validation->listErrors() ?>
  </div>
<?php endif; ?>

<?= $this->include('partial/preloader'); ?>
<div class="bg-gray mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
  <!-- Form Section Start -->
  <div class="rounded-2xl shadow-2xl bg-white dark:border-strokedark dark:bg-boxdark">
    <div class="flex flex-wrap items-center">
      <div class="hidden w-full xl:block xl:w-1/2">
        <div class="px-26 py-17.5 text-center">
          <a href="#" class="mb-5.5 inline-block">
            <img alt="Logo" class="hidden dark:block"
              src="<?= base_url('./assets/images/logo/logo.svg') ?>">
            <img alt="Logo" class="dark:hidden"
              src="<?= base_url('./assets/images/logo/logo-dark.svg') ?>">
          </a>
          <p class="font-medium 2xl:px-20 dark:text-white">
            Pesan makanan favorit Anda di sini, di web kami. Temukan menu favorit Anda yang sesuai dengan kantong. Banyak menu untuk dicoba.
          </p>
          <span class="mt-15 inline-block">
            <img alt="illustration"
              src="<?= base_url('./assets/images/illustration/illustration-03.svg') ?>">
          </span>
        </div>
      </div>
      <div class="w-fullxl:w-1/2">
        <div class="w-full p-4 sm:p-12.5 xl:p-17.5">
          <!-- <span class="mb-1.5 block font-medium dark:text-white">Start for free</span> -->
          <h2 class="mb-9 text-2xl font-bold text-black dark:text-white sm:text-title-xl2">
            Daftar Foodie Fiend
          </h2>

          <form action="<?= site_url('users/store') ?>" , method="post">
            <?= csrf_field() ?>
            <div class="mb-4">
              <label class="mb-2.5 block font-medium text-black dark:text-white">Nama</label>
              <div class="relative">
                <input
                  type="text"
                  name="name"
                  placeholder="Masukan nama lengkap Anda"
                  class="w-full rounded-lg border border-stroke bg-transparent py-4 pl-6 pr-10 outline-none focus:border-primary focus-visible:shadow-none dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />

                <span class="absolute right-4 top-4">
                  <svg
                    class="fill-current"
                    width="22"
                    height="22"
                    viewBox="0 0 22 22"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <g opacity="0.5">
                      <path
                        d="M11.0008 9.52185C13.5445 9.52185 15.607 7.5281 15.607 5.0531C15.607 2.5781 13.5445 0.584351 11.0008 0.584351C8.45703 0.584351 6.39453 2.5781 6.39453 5.0531C6.39453 7.5281 8.45703 9.52185 11.0008 9.52185ZM11.0008 2.1656C12.6852 2.1656 14.0602 3.47185 14.0602 5.08748C14.0602 6.7031 12.6852 8.00935 11.0008 8.00935C9.31641 8.00935 7.94141 6.7031 7.94141 5.08748C7.94141 3.47185 9.31641 2.1656 11.0008 2.1656Z"
                        fill="" />
                      <path
                        d="M13.2352 11.0687H8.76641C5.08828 11.0687 2.09766 14.0937 2.09766 17.7719V20.625C2.09766 21.0375 2.44141 21.4156 2.88828 21.4156C3.33516 21.4156 3.67891 21.0719 3.67891 20.625V17.7719C3.67891 14.9531 5.98203 12.6156 8.83516 12.6156H13.2695C16.0883 12.6156 18.4258 14.9187 18.4258 17.7719V20.625C18.4258 21.0375 18.7695 21.4156 19.2164 21.4156C19.6633 21.4156 20.007 21.0719 20.007 20.625V17.7719C19.9039 14.0937 16.9133 11.0687 13.2352 11.0687Z"
                        fill="" />
                    </g>
                  </svg>
                </span>
              </div>
            </div>

            <div class="mb-4">
              <label
                class="mb-2.5 block font-medium text-black dark:text-white">Telepon</label>
              <div class="relative">
                <input
                  type="text"
                  name="phone"
                  placeholder="Masukan nomor ponsel Anda"
                  class="w-full rounded-lg border border-stroke bg-transparent py-4 pl-6 pr-10 outline-none focus:border-primary focus-visible:shadow-none dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />

                <span class="absolute right-4 top-4">
                  <svg
                    class="fill-current"
                    width="22"
                    height="22"
                    viewBox="0 0 22 22"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <g opacity="0.5">
                      <path
                        d="M19.2516 3.30005H2.75156C1.58281 3.30005 0.585938 4.26255 0.585938 5.46567V16.6032C0.585938 17.7719 1.54844 18.7688 2.75156 18.7688H19.2516C20.4203 18.7688 21.4172 17.8063 21.4172 16.6032V5.4313C21.4172 4.26255 20.4203 3.30005 19.2516 3.30005ZM19.2516 4.84692C19.2859 4.84692 19.3203 4.84692 19.3547 4.84692L11.0016 10.2094L2.64844 4.84692C2.68281 4.84692 2.71719 4.84692 2.75156 4.84692H19.2516ZM19.2516 17.1532H2.75156C2.40781 17.1532 2.13281 16.8782 2.13281 16.5344V6.35942L10.1766 11.5157C10.4172 11.6875 10.6922 11.7563 10.9672 11.7563C11.2422 11.7563 11.5172 11.6875 11.7578 11.5157L19.8016 6.35942V16.5688C19.8703 16.9125 19.5953 17.1532 19.2516 17.1532Z"
                        fill="" />
                    </g>
                  </svg>
                </span>
              </div>
            </div>

            <div class="mb-4">
              <label
                class="mb-2.5 block font-medium text-black dark:text-white">Email</label>
              <div class="relative">
                <input
                  type="email"
                  name="email"
                  placeholder="Masukan email Anda"
                  class="w-full rounded-lg border border-stroke bg-transparent py-4 pl-6 pr-10 outline-none focus:border-primary focus-visible:shadow-none dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />

                <span class="absolute right-4 top-4">
                  <svg
                    class="fill-current"
                    width="22"
                    height="22"
                    viewBox="0 0 22 22"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <g opacity="0.5">
                      <path
                        d="M19.2516 3.30005H2.75156C1.58281 3.30005 0.585938 4.26255 0.585938 5.46567V16.6032C0.585938 17.7719 1.54844 18.7688 2.75156 18.7688H19.2516C20.4203 18.7688 21.4172 17.8063 21.4172 16.6032V5.4313C21.4172 4.26255 20.4203 3.30005 19.2516 3.30005ZM19.2516 4.84692C19.2859 4.84692 19.3203 4.84692 19.3547 4.84692L11.0016 10.2094L2.64844 4.84692C2.68281 4.84692 2.71719 4.84692 2.75156 4.84692H19.2516ZM19.2516 17.1532H2.75156C2.40781 17.1532 2.13281 16.8782 2.13281 16.5344V6.35942L10.1766 11.5157C10.4172 11.6875 10.6922 11.7563 10.9672 11.7563C11.2422 11.7563 11.5172 11.6875 11.7578 11.5157L19.8016 6.35942V16.5688C19.8703 16.9125 19.5953 17.1532 19.2516 17.1532Z"
                        fill="" />
                    </g>
                  </svg>
                </span>
              </div>
            </div>

            <div class="mb-4">
              <label
                class="mb-2.5 block font-medium text-black dark:text-white">Password</label>
              <div class="relative">
                <input
                  type="password"
                  name="password"
                  placeholder="Masukan password Anda"
                  class="w-full rounded-lg border border-stroke bg-transparent py-4 pl-6 pr-10 outline-none focus:border-primary focus-visible:shadow-none dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />

                <span class="absolute right-4 top-4">
                  <svg
                    class="fill-current"
                    width="22"
                    height="22"
                    viewBox="0 0 22 22"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <g opacity="0.5">
                      <path
                        d="M16.1547 6.80626V5.91251C16.1547 3.16251 14.0922 0.825009 11.4797 0.618759C10.0359 0.481259 8.59219 0.996884 7.52656 1.95938C6.46094 2.92188 5.84219 4.29688 5.84219 5.70626V6.80626C3.84844 7.18438 2.33594 8.93751 2.33594 11.0688V17.2906C2.33594 19.5594 4.19219 21.3813 6.42656 21.3813H15.5016C17.7703 21.3813 19.6266 19.525 19.6266 17.2563V11C19.6609 8.93751 18.1484 7.21876 16.1547 6.80626ZM8.55781 3.09376C9.31406 2.40626 10.3109 2.06251 11.3422 2.16563C13.1641 2.33751 14.6078 3.98751 14.6078 5.91251V6.70313H7.38906V5.67188C7.38906 4.70938 7.80156 3.78126 8.55781 3.09376ZM18.1141 17.2906C18.1141 18.7 16.9453 19.8688 15.5359 19.8688H6.46094C5.05156 19.8688 3.91719 18.7344 3.91719 17.325V11.0688C3.91719 9.52189 5.15469 8.28438 6.70156 8.28438H15.2953C16.8422 8.28438 18.1141 9.52188 18.1141 11V17.2906Z"
                        fill="" />
                      <path
                        d="M10.9977 11.8594C10.5852 11.8594 10.207 12.2031 10.207 12.65V16.2594C10.207 16.6719 10.5508 17.05 10.9977 17.05C11.4102 17.05 11.7883 16.7063 11.7883 16.2594V12.6156C11.7883 12.2031 11.4102 11.8594 10.9977 11.8594Z"
                        fill="" />
                    </g>
                  </svg>
                </span>
              </div>
            </div>

            <div class="mb-5">
              <input
                type="submit"
                value="Buat akun"
                class="w-full cursor-pointer rounded-lg border border-primary bg-primary p-4 font-medium text-white transition hover:bg-opacity-90" />
            </div>

            <div class="mt-6 text-center">
              <p class="font-medium">
                Sudah memiliki akun?
                <a href="<?= base_url('/login'); ?>" class="text-primary">Masuk</a>
              </p>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- Form Section End -->
</div>
<?= $this->endSection(); ?>

<?= $this->section('scripts'); ?>
<script>
  document.addEventListener('DOMContentLoaded', () => {
    const loaded = true;
    const loaderElement = document.getElementById('loader');
    if (loaded) {
      setTimeout(() => {
        loaderElement.style.display = 'none';
      }, 500);
    }
  });
</script>
<?= $this->endSection(); ?>