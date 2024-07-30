const addCategoryBtn = document.getElementById("addCategoryBtn");
const categoryContent = document.getElementById("categoryContent");
const addForm = `
  <div class="pb-2">
    <form action="/data/category" id="dataFormCategory" class="mb-8 w-auto px-6 mr-2" method="post">
      <div class="mb-5">
        <label for="nama" class="block mb-2 text-sm font-medium text-gray-900">Nama</label>
        <input type="text" name="name" id="name" placeholder="Nama kategori" class="shadow-sm border border-gray-200 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required/>
      </div>
      <div class="mb-5">
        <label for="description" class="block mb-2 text-sm font-medium text-gray-900">Kategori</label>
        <input type="text" name="description" id="description" placeholder="Deskripsi kategori" class="shadow-sm border border-gray-200 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required/>
      </div>
      <div class="grid grid-cols-1 md:grid-cols-2 items-center gap-2">
        <button type="submit" class="ml-0 text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Buat Kategori</button>
        <a id="closeFormBtn" href="/dashboard/category" class="text-center font-medium rounded-lg cursor-pointer px-5 py-2.5 bg-red-500 hover:bg-red-700 text-white">Close</a>
      </div>
    </form>
  </div>
`;

const tableMenu = `
  <table class="items-center w-full mb-0 align-top border-collapse text-slate-500">
    <thead class="align-bottom">
      <tr>
        <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Nama Kategori</th>
        <th class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Deskripsi</th>
        <th class="px-6 py-3 font-semibold capitalize align-middle bg-transparent border-b border-collapse border-solid shadow-none tracking-none whitespace-nowrap text-slate-400 opacity-70"></th>
      </tr>
    </thead>
    <tbody id="menuTable">
    </tbody>
  </table>
`;

addCategoryBtn.addEventListener("click", () => {
  addCategoryBtn.classList.replace("inline-block", "hidden");
  categoryContent.innerHTML = addForm;
});