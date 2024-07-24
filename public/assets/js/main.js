$(document).ready(function() {
    console.log('loading the script')
    const initialize = () => {
        $('#fileInput').on('change', function(event) {
            console.log('onchange');
            const file = event.target.files[0];
            const preview = $('#imagePreview');
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    console.log(e.target.result);
                    preview.attr('src', e.target.result);
                }
                reader.readAsDataURL(file);
            } else {
                preview.attr('src', 'https://flowbite.com/docs/images/examples/image-1.jpg');
            }
        });

        // $('#dataFormMenu').submit(function(e) {
        //   e.preventDefault();
        //   const formData = $(this).serialize();
        //   const url = '/data/menu';
    
        //   $.ajax({
        //     url,
        //     type: 'POST',
        //     data: formData,
        //     success: function(response) {
        //         if (response.status === 'success') {
        //             alert('Berhasil tambah data');
        //             $('#dataFormMenu')[0].reset();
        //         }
        //     },
        //     error: function(err) {
        //         console.log(err);
        //         alert('Error adding data');
        //     }
        //   });
        // });

        $('#dataFormCategory').submit(function(e) {
          e.preventDefault();
          const formData = $(this).serialize();
          const url = '/data/category';
    
          $.ajax({
            url,
            type: 'POST',
            data: formData,
            success: function(response) {
                if (response.status === 'success') {
                    alert('Berhasil tambah data');
                    $('#dataFormCategory')[0].reset();
                }
            },
            error: function(err) {
                console.log(err);
                alert('Error adding data');
            }
          });
        });
    }

    $('#addMenuBtn').click(function() {
        const formMenu = `
            <div class="container grid grid-cols-1 md:grid-cols-2 pb-2">
              <form id="dataFormMenu" action="/data/menu" class="mb-8 w-auto px-6 mr-2" enctype="multipart/form-data" method="post">
                <div class="mb-5">
                  <label for="fileInput" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Foto Menu</label>
                  <label for="fileInput" class="sr-only">File</label>
                  <input id="fileInput" name="file" type="file" accept=".jpg, .jpeg, .png" name="image" class="block w-full border border-gray-200 shadow-sm rounded-lg text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400
                  file:bg-blue-700 file:text-white file:font-normal file:border-0 text-gray-600 file:me-4 file:py-3 file:px-4 dark:file:bg-neutral-700 dark:file:text-neutral-400 file:m-0" required>
                </div>
                <div class="mb-5">
                  <label for="nama" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama</label>
                  <input type="text" id="nama" name="menu_name" placeholder="Nama menu" class="shadow-sm border border-gray-200 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" required />
                </div>
                <div class="mb-5">
                  <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deskripsi</label>
                  <textarea type="text" id="description" name="menu_description" rows="4" placeholder="Deskripsi menu" class="shadow-sm border border-gray-200 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" required></textarea>
                </div>
                <div class="mb-5">
                  <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pilih kategori</label>
                  <select id="categoryOption" name="menu_category"
                    class="bg-gray-100 border border-gray-200 text-gray-600 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                  </select>
                </div>
                <div class="mb-5">
                  <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Harga</label>
                  <input type="text" id="price" name="menu_price" placeholder="Harga menu" class="shadow-sm border border-gray-200 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" required />
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 items-center gap-2">
                  <button type="submit" class="ml-0 text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Buat Menu</button>
                  <a id="closeFormBtn" class="text-center font-medium rounded-lg cursor-pointer px-5 py-2.5 bg-red-500 hover:bg-red-700 text-white">Close</a>
                </div>
              </form>
              <div class="mt-6 mb-16 pr-4">
                <img id="imagePreview" src="https://flowbite.com/docs/images/examples/image-1.jpg" alt="Thumbnail preview" class="w-full h-full object-cover rounded-lg shadow-lg">
              </div>
            </div>`;

        $('#menuContent').html(formMenu);
        $('#addMenuBtn').removeClass('inline-block').addClass('hidden');

        loadData('category', '#categoryOption');
        initialize();
        closeHandle('#addMenuBtn', '#menuContent');
    });

    // Handle close button
    const closeHandle = (idButton, idContent) => {
        $('#closeFormBtn').click(function() {
        const tableMenu = `
            <table class="items-center w-full mb-0 align-top border-collapse dark:border-white/40 text-slate-500">
            <thead class="align-bottom">
              <tr>
                <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Nama Kategori</th>
                <th class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Deskripsi</th>
                <th class="px-6 py-3 font-semibold capitalize align-middle bg-transparent border-b border-collapse border-solid shadow-none dark:border-white/40 dark:text-white tracking-none whitespace-nowrap text-slate-400 opacity-70"></th>
              </tr>
            </thead>
            <tbody id="menuTable">
            </tbody>
            </table>`;

            $(idContent).html(tableMenu);
            loadData('category', '#categoryTable');
            $(idButton).removeClass('hidden').addClass('inline-block');
        });
    }

    // Category Clicked
    $('#addCategoryBtn').click(function() {
        const formCategory = `
            <div class="pb-2">
              <form id="dataFormCategory" class="mb-8 w-auto px-6 mr-2">
                <div class="mb-5">
                  <label for="nama" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama</label>
                  <input type="text" name="name" id="name" placeholder="Nama kategori" class="shadow-sm border border-gray-200 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" required/>
                </div>
                <div class="mb-5">
                  <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kategori</label>
                  <input type="text" name="description" id="description" placeholder="Deskripsi kategori" class="shadow-sm border border-gray-200 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" required/>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 items-center gap-2">
                  <button type="submit" class="ml-0 text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Buat Kategori</button>
                  <a id="closeFormBtn" class="text-center font-medium rounded-lg cursor-pointer px-5 py-2.5 bg-red-500 hover:bg-red-700 text-white">Close</a>
                </div>
              </form>
            </div>`;

        $('#categoryContent').html(formCategory);
        $('#addCategoryBtn').removeClass('inline-block').addClass('hidden');

        initialize();
        closeHandle('#addCategoryBtn', '#categoryContent');
    });

    function loadData(url, targetId) {
      $.ajax({
        url: '/data/'+url, // Ubah URL sesuai dengan rute yang telah ditentukan
        type: 'GET',
        success: function(response) {
          const dataList = $(targetId);
          console.log(response);
          dataList.empty(); // Clear the data list
          
          if (url.includes('category') && targetId === '#categoryOption') {
            if (response.data.length == 0) {
              dataList.attr('disabled', 'disabled');
              dataList.append('<option>Tidak ada kategori</option>');
              return
            }
          }

          response.data.forEach(function(item) {
            if (url.includes('category') && targetId === '#categoryOption') {
              dataList.append(`<option>${item.name}</option>`);
            }

            if (url.includes('category')) {
              dataList.append(
                `<tr>
                  <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                    <div class="flex px-2 py-1">
                      <div class="flex flex-col justify-center">
                        <h6 class="mb-0 text-sm leading-normal dark:text-white">${item.name}</h6>
                      </div>
                    </div>
                  </td>
                  <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                    <p class="mb-0 text-xs leading-tight dark:text-white dark:opacity-80 text-slate-400">${item.description}</p>
                  </td>
                  <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent space-x-4 items-center">
                    <a href="javascript:;" class="font-semibold leading-tight dark:text-white dark:opacity-80 text-white bg-blue-600 px-3.5 py-1.5 rounded-md"> Edit </a>
                    <form action="/data/${url}/delete/${item.id}" method="post" style="display:inline;">
                      <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                      <button class="font-semibold text-white bg-red-600 px-2 py-1 rounded-md"
                        type="submit" onclick="return confirm('Anda yakin akan menghapus kategori ${item.name}');">Delete</button>
                    </form>
                  </td>
                </tr>`
              );
            }

            if (url.includes('menu')) {
              dataList.append(
                `<tr>
                  <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                    <div class="flex px-2 py-1">
                      <div class="flex justify-center">
                        <h6 class="mb-0 text-sm leading-normal dark:text-white">John Michael</h6>
                      </div>
                    </div>
                  </td>
                  <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                    <p class="mb-0 text-xs leading-tight dark:text-white dark:opacity-80 text-slate-400">Organization</p>
                  </td>
                  <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent space-x-4 items-center">
                    <a href="javascript:;" class="font-semibold leading-tight dark:text-white dark:opacity-80 text-white bg-blue-600 px-3.5 py-1.5 rounded-md"> Edit </a>
                    <form action="/data/${url}/delete/${item.id}" method="post" style="display:inline;">
                      <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                      <button class="font-semibold text-white bg-red-600 px-2 py-1 rounded-md"
                        type="submit" onclick="return confirm('Anda yakin akan menghapus kategori ${item.name}');">Delete</button>
                    </form>
                  </td>
                </tr>`
              );
            }
          });

          console.log(dataList);
        },
        error: function(err) {
            alert('Error loading data ', err);
            console.log(err);
        }
      });
    }
});