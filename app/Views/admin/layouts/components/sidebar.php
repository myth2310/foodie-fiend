<aside class="fixed inset-y-0 flex-wrap items-center justify-between block w-full p-0 my-4 overflow-y-auto antialiased transition-transform duration-200 -translate-x-full bg-white border-0 shadow-xl max-w-64 ease-nav-brand z-990 xl:ml-6 rounded-2xl xl:left-0 xl:translate-x-0" aria-expanded="false">
  <div class="h-19">
    <i class="absolute top-0 right-0 p-4 opacity-50 cursor-pointer fas fa-times text-slate-400 xl:hidden" sidenav-close></i>
    <a class="block px-8 py-6 m-0 text-sm whitespace-nowrap text-slate-700" href="<?= base_url('dashboard') ?>" target="_blank">
      <span class="ml-1 font-semibold transition-all duration-200 ease-nav-brand">Foodie Mitra</span>
    </a>
  </div>

  <hr class="h-px mt-0 bg-transparent bg-gradient-to-r from-transparent via-black/40 to-transparent" />

    <div class="items-center block w-auto max-h-screen overflow-auto grow basis-full">
      <ul class="flex flex-col pl-0 mb-0">
        <li class="mt-1.5 w-full">
          <a class="py-1.5 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap rounded-lg px-4 hover:font-semibold hover:bg-blue-500/13 hover:text-slate-700 transition-colors" href="<?= base_url('admin/dashboard') ?>">
            <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
              <i class="relative top-0 text-sm leading-normal text-blue-500 ni ni-tv-2"></i>
            </div>
            <span class="ml-1 duration-300 opacity-100  pointer-events-none ease">Dashboard</span>
          </a>
        </li>

        <li class="mt-1.5 w-full">
          <a class="py-1.5 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 rounded-lg hover:font-semibold hover:bg-blue-500/13 hover:text-slate-700 transition-colors" href="<?= base_url('admin/dashboard/mitra') ?>">
            <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
              <i class="relative top-0 text-sm leading-normal text-orange-500 ni ni-calendar-grid-58"></i>
            </div>
            <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Mitra UMKM </span>
          </a>
        </li>

        <li class="mt-1.5 w-full">
        <a class="py-1.5 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 rounded-lg hover:font-semibold hover:bg-blue-500/13 hover:text-slate-700 transition-colors" href="#">
          <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center fill-current stroke-0 text-center xl:p-2.5">
            <i class="relative top-0 text-sm leading-normal text-emerald-500 ni ni-credit-card"></i>
          </div>
          <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Transaksi</span>
        </a>
      </li>

        
      
        <li class="w-full mt-4">
          <h6 class="pl-6 ml-2 text-xs font-bold leading-tight uppercase opacity-60">Halaman Profile</h6>
        </li>

        <!-- <li class="mt-1.5 w-full">
          <a class="py-1.5 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 rounded-lg hover:font-semibold hover:bg-blue-500/13 hover:text-slate-700 transition-colors" href="<?= base_url('dashboard/profile') ?>">
            <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
              <i class="relative top-0 text-sm leading-normal text-slate-700 ni ni-single-02"></i>
            </div>
            <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Profile</span>
          </a>
        </li> -->

        <li class="mt-1.5 w-full">
          <a class="py-1.5 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 rounded-lg hover:font-semibold hover:bg-blue-500/13 hover:text-slate-700 transition-colors" href="<?= base_url('logout') ?>">
            <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
              <i class="relative top-0 text-sm leading-normal text-orange-500 ni ni-single-copy-04"></i>
            </div>
            <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Keluar</span>
          </a>
        </li>
      </ul>
    </div>
</aside>