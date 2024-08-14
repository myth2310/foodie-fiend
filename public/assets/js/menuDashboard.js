const addMenuBtn = document.getElementById("addMenuBtn");
const menuContent = document.getElementById("menuContent");
const addMenuForm = document.getElementById("addMenuForm");
const tableMenu = document.getElementById("tableMenu");
const closeFormBtn = document.getElementById("closeFormBtn");
const fileInput = document.getElementById("fileInput");
const preview = document.getElementById("imagePreview");

// event untuk tombol tambah menu
addMenuBtn.addEventListener("click", function () {
  addMenuForm.classList.remove("hidden");
  tableMenu.classList.add("hidden");
});

// event untuk menutup form tambah menu
closeFormBtn.addEventListener("click", function () {
  addMenuForm.classList.add("hidden");
  tableMenu.classList.remove("hidden");
});

// event untuk menampilkan preview dari image atau gambar yang dipilih
fileInput.addEventListener("change", function (event) {
  console.log('Image changed');
  const file = event.target.files[0];

  if (file) {
    const reader = new FileReader();
    reader.onload = function (e) {
      console.log(e.target.result);
      preview.src = e.target.result; // Use .src instead of .attr('src')
    };
    reader.readAsDataURL(file);
  } else {
    preview.src = "https://flowbite.com/docs/images/examples/image-1.jpg";
  }
});
