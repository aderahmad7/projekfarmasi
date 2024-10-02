document.getElementById("add-obat-btn").addEventListener("click", function () {
  // Ambil template
  const template = document
    .getElementById("obat-template")
    .content.cloneNode(true);

  // Tambahkan template ke container
  document.getElementById("obat-container").appendChild(template);
});

// Event delegation untuk menghapus form obat
document
  .getElementById("obat-container")
  .addEventListener("click", function (event) {
    if (event.target.classList.contains("remove-obat")) {
        console.log('ada');
      // Hapus parent dari button remove (yaitu div .obat-item)
      event.target.closest(".obat-item").remove();
    } else {
        console.log(event);
    }
  });
