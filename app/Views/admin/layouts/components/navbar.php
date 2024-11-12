<nav class="relative flex flex-wrap items-center justify-between px-0 py-2 mx-6 transition-all ease-in shadow-none duration-250 rounded-2xl lg:flex-nowrap lg:justify-start" navbar-main navbar-scroll="false">
  <div class="flex items-center justify-between w-full px-4 py-1 mx-auto flex-wrap-inherit">
    <nav>
      <!-- breadcrumb -->
      <ol class="flex flex-wrap pt-1 mr-12 bg-transparent rounded-lg sm:mr-16">
        <li class="text-sm leading-normal">
          <a class="text-black opacity-75" href="javascript:;">Pages</a>
        </li>
        <li class="text-sm pl-2 capitalize leading-normal text-black before:float-left before:pr-2 before:text-black before:content-['/']" aria-current="page"><?= $page ?? 'Dashboard' ?></li>
      </ol>
      <h6 class="mb-0 font-bold text-black capitalize"><?= $page ?? 'Dashboard' ?></h6>
    </nav>

    <div class="flex items-center mt-2 grow sm:mt-0 sm:mr-6 md:mr-0 lg:flex lg:basis-auto">
      <div class="flex items-center md:ml-auto md:pr-4">
        <div class="relative flex flex-wrap items-stretch w-full transition-all rounded-lg ease">
        </div>
      </div>
      <ul class="flex flex-row justify-end pl-0 mb-0 list-none md-max:w-full">
        <?php if(session()->get('email')): ?>
          <li class="flex items-center">
            <a href="<?= base_url('dashboard/profile') ?>" class="block px-0 py-2 text-sm font-semibold text-black transition-all ease-nav-brand">
              <div class="flex px-2 py-1">
                <div>
                  <img src="<?= session()->get('profile') ?? '' ?>" class="inline-flex items-center justify-center mr-4 text-sm text-black transition-all duration-200 ease-in-out h-9 w-9 rounded-xl" alt="user1" />
                </div>
                <div class="flex flex-col justify-center">
                  <h6 class="mb-0 text-sm text-gray-800 leading-normal text-black"><?= session()->get('name') ?></h6>
                  <p class="mb-0 text-xs leading-tight text-black dark:opacity-80"><?= session()->get('email') ?></p>
                </div>
              </div>
            </a>
          </li>
        <?php else: ?>
          <li class="flex items-center">
            <a href="<?= base_url('/') ?>" class="block px-0 py-2 text-sm font-semibold text-black transition-all ease-nav-brand">
              <i class="fa fa-user sm:mr-1"></i>
              <span class="hidden sm:inline">Sign In</span>
            </a>
          </li>
        <?php endif ?>
        <li class="flex items-center pl-4 xl:hidden">
          <a href="javascript:;" class="block p-0 text-sm text-black transition-all ease-nav-brand" sidenav-trigger>
            <div class="w-4.5 overflow-hidden">
              <i class="ease mb-0.75 relative block h-0.5 rounded-sm bg-black transition-all"></i>
              <i class="ease mb-0.75 relative block h-0.5 rounded-sm bg-black transition-all"></i>
              <i class="ease relative block h-0.5 rounded-sm bg-black transition-all"></i>
            </div>
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>
