<!-- Login Modal -->
<div id="loginModal" class="z-20 fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center">
  <div class="bg-white p-7 rounded-lg shadow-lg w-96">
    <div class="flex justify-end">
      <button onclick="closeModal('loginModal')" class="text-center text-gray-500 hover:bg-red-200 p-1 rounded-full hover:text-red-500 duration-150 ease-in-out">
        <svg width="30px" height="30x" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M10.0303 8.96965C9.73741 8.67676 9.26253 8.67676 8.96964 8.96965C8.67675 9.26255 8.67675 9.73742 8.96964 10.0303L10.9393 12L8.96966 13.9697C8.67677 14.2625 8.67677 14.7374 8.96966 15.0303C9.26255 15.3232 9.73743 15.3232 10.0303 15.0303L12 13.0607L13.9696 15.0303C14.2625 15.3232 14.7374 15.3232 15.0303 15.0303C15.3232 14.7374 15.3232 14.2625 15.0303 13.9696L13.0606 12L15.0303 10.0303C15.3232 9.73744 15.3232 9.26257 15.0303 8.96968C14.7374 8.67678 14.2625 8.67678 13.9696 8.96968L12 10.9393L10.0303 8.96965Z" fill="currentColor" />
          <path fill-rule="evenodd" clip-rule="evenodd" d="M12 1.25C6.06294 1.25 1.25 6.06294 1.25 12C1.25 17.9371 6.06294 22.75 12 22.75C17.9371 22.75 22.75 17.9371 22.75 12C22.75 6.06294 17.9371 1.25 12 1.25ZM2.75 12C2.75 6.89137 6.89137 2.75 12 2.75C17.1086 2.75 21.25 6.89137 21.25 12C21.25 17.1086 17.1086 21.25 12 21.25C6.89137 21.25 2.75 17.1086 2.75 12Z" fill="currentColor" />
        </svg>
      </button>
    </div>
    <h2 class="text-2xl font-bold mb-4">Login</h2>
    <form action="/login" method="post" class="mb-2">
      <?= csrf_field() ?>
      <div class="mb-4">
        <input placeholder="Email Anda" name="email" type="email" class="w-full p-2 border-2 text-center border-gray-300 rounded mt-1">
      </div>
      <div class="mb-5">
        <input id="password" name="password" placeholder="Password" type="password" class="w-full p-2 border-2 text-center border-gray-300 rounded mt-1" required>
        <label class="flex items-center mt-2">
          <input type="checkbox" onclick="togglePasswordVisibility()" class="mr-2">
          <span>Lihat Password</span>
        </label>
      </div>
      <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 ease-in-out duration-150 text-white font-semibold px-4 py-2 rounded w-full mt-2 mb-6">Masuk</button>
    </form>
    <p class="font-normal">Belum memiliki akun?
      <button onclick="openAndCloseModal('registerModal', 'loginModal')" class="font-semibold text-yellow-600 hover:text-yellow-400 duration-150 ease-in-out">Daftar sekarang</button>
    </p>
    <p class="font-normal">Buka umkm anda sekarang juga.
      <button onclick="openAndCloseModal('registerStoreModal', 'loginModal')" class="font-semibold text-yellow-600 hover:text-yellow-400 duration-150 ease-in-out">Buka toko</button>
    </p>
  </div>
</div>

<script>
  function togglePasswordVisibility() {
    var passwordInput = document.getElementById("password");
    if (passwordInput.type === "password") {
      passwordInput.type = "text";
    } else {
      passwordInput.type = "password";
    }
  }
</script>

