<?= $this->extend('layouts/base') ?>

<?= $this->section('content') ?>
  <?= $this->include('partial/preloader') ?>
  <?= $this->include('components/navbar') ?>
  <div class="max-w-lg mx-auto my-10 text-center bg-white px-4 sm:px-8 py-10 rounded-xl shadow">
    <header class="mb-8">
      <h1 class="text-2xl font-bold mb-1">Verifikasi Kode OTP</h1>
      <p class="text-[15px] text-slate-500">Masukan 6-digit kode verifikasi yang dikirim melalui email anda.</p>
    </header>
    <form id="otp-form" action="<?= base_url('/verification/otp') ?>" method="post">
      <div class="flex items-center justify-center gap-3">
        <input
          type="text"
          class="w-14 h-14 text-center text-2xl font-extrabold text-slate-900 bg-slate-100 border border-transparent hover:border-slate-200 appearance-none rounded p-4 outline-none focus:bg-white focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100"
          pattern="\d*" maxlength="1" />
        <input
          type="text"
          class="w-14 h-14 text-center text-2xl font-extrabold text-slate-900 bg-slate-100 border border-transparent hover:border-slate-200 appearance-none rounded p-4 outline-none focus:bg-white focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100"
          maxlength="1" />
        <input
          type="text"
          class="w-14 h-14 text-center text-2xl font-extrabold text-slate-900 bg-slate-100 border border-transparent hover:border-slate-200 appearance-none rounded p-4 outline-none focus:bg-white focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100"
          maxlength="1" />
        <input
          type="text"
          class="w-14 h-14 text-center text-2xl font-extrabold text-slate-900 bg-slate-100 border border-transparent hover:border-slate-200 appearance-none rounded p-4 outline-none focus:bg-white focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100"
          maxlength="1" />
        <input
          type="text"
          class="w-14 h-14 text-center text-2xl font-extrabold text-slate-900 bg-slate-100 border border-transparent hover:border-slate-200 appearance-none rounded p-4 outline-none focus:bg-white focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100"
          maxlength="1" />
        <input
          type="text"
          class="w-14 h-14 text-center text-2xl font-extrabold text-slate-900 bg-slate-100 border border-transparent hover:border-slate-200 appearance-none rounded p-4 outline-none focus:bg-white focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100"
          maxlength="1" />
        <input id="otp_code" type="number" class="hidden" name="otp_code">
      </div>
      <div class="max-w-[260px] mx-auto mt-4">
        <button type="submit"
          class="w-full inline-flex justify-center whitespace-nowrap rounded-lg bg-yellow-500 px-3.5 py-2.5 font-semibold text-white shadow-sm shadow-indigo-950/10 hover:bg-yellow-600 focus:outline-none focus:ring focus:ring-indigo-300 focus-visible:outline-none focus-visible:ring focus-visible:ring-indigo-300 transition-colors duration-150">Verifikasi Kode OTP</button>
      </div>
    </form>
    <div class="text-sm text-slate-500 mt-4">Tidak menerima kode? <a class="font-medium text-yellow-500 hover:text-yellow-600" href="#0">Kirim ulang</a></div>
  </div>
  <div class="h-1/2"></div>
<?= $this->endSection() ?>

<?= $this->section('footer') ?>
  <?= $this->include('components/footer') ?>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const form = document.getElementById('otp-form')
      const inputs = [...form.querySelectorAll('input[type=text]')]
      const submit = form.querySelector('button[type=submit]')
      const otp_code = [];

      const handleKeyDown = (e) => {
        if (
          !/^[0-9]{1}$/.test(e.key)
          && e.key !== 'Backspace'
          && e.key !== 'Delete'
          && e.key !== 'Tab'
          && !e.metaKey
        ) {
          e.preventDefault()
        }

        if (e.key === 'Delete' || e.key === 'Backspace') {
          const index = inputs.indexOf(e.target);
          if (index > 0) {
            inputs[index - 1].value = '';
            otp_code.pop()
            inputs[index - 1].focus();
          }
        }
      }

      const handleInput = (e) => {
        const { target } = e
        const index = inputs.indexOf(target)
        if (target.value) {
          otp_code.push(target.value);
          if (index < inputs.length - 1) {
            inputs[index + 1].focus()
          } else {
            submit.focus()
          }
        }
      }

      const handleFocus = (e) => {
        e.target.select()
      }

      const handlePaste = (e) => {
        e.preventDefault()
        const text = e.clipboardData.getData('text')
        if (!new RegExp(`^[0-9]{${inputs.length}}$`).test(text)) {
            return
        }
        const digits = text.split('')
        inputs.forEach((input, index) => input.value = digits[index])
        submit.focus()
      }

      inputs.forEach((input) => {
        input.addEventListener('input', handleInput)
        input.addEventListener('keydown', handleKeyDown)
        input.addEventListener('focus', handleFocus)
        input.addEventListener('paste', handlePaste)
      })

      form.addEventListener('submit', function(event) {
        document.getElementById('otp_code').value = otp_code.join('')
        // alert(document.getElementById('otp_code').value);
        this.submit()
      })
    })                        
  </script>
  <script src="<?= base_url('assets/js/navbar.js') ?>"></script>
  <script src="<?= base_url('assets/js/chartDropDown.js') ?>"></script>
  <script src="<?= base_url('assets/js/modalAuthForm.js') ?>"></script>
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
<?= $this->endSection() ?>