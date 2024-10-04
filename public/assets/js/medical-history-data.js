///////////////////////////////////////////
// PAGINATION
//////////////////////////////////////////

const cardsPerPage = 2;
let currentPage = 1;
const cards = document.querySelectorAll(".medical-history-data");
const totalPages = Math.ceil(cards.length / cardsPerPage); // Menghitung jumlah total halaman berdasarkan jumlah card dan jumlah card per halaman

/**
 * Fungsi untuk menampilkan card pada halaman yang dipilih.
 * Hanya card dalam rentang indeks yang sesuai dengan halaman yang aktif akan ditampilkan.
 *
 * @param {number} page - Nomor halaman yang akan ditampilkan.
 */
function showCards(page) {
  // Menghitung indeks awal dan akhir card yang akan ditampilkan pada halaman tertentu
  const startIndex = (page - 1) * cardsPerPage;
  const endIndex = startIndex + cardsPerPage;

  // Melakukan iterasi pada semua card dan menentukan mana yang akan ditampilkan atau disembunyikan
  cards.forEach((card, index) => {
    if (index >= startIndex && index < endIndex) {
      card.classList.remove("hidden");
    } else {
      card.classList.add("hidden");
    }
  });
}

/**
 * Fungsi untuk mengatur button pagination.
 * Membuat button navigasi berdasarkan jumlah halaman dan menambahkan ellipsis untuk halaman yang terlalu jauh.
 */
function setupPagination() {
  // Mengambil elemen kontainer untuk pagination dan membersihkannya
  const paginationContainer = document.getElementById("pagination");
  paginationContainer.innerHTML = "";

  /**
   * Fungsi untuk membuat button halaman.
   *
   * @param {number} page - Nomor halaman yang akan diwakili oleh button.
   * @returns {HTMLElement} - Elemen button HTML untuk pagination.
   */
  const createPageButton = (page) => {
    const button = document.createElement("button"); // Membuat elemen button
    button.innerText = page; // Menyisipkan nomor halaman pada button
    button.addEventListener("click", () => {
      // Mengubah halaman saat button diklik
      currentPage = page; // Menampilkan card pada halaman yang dipilih
      showCards(currentPage); // Menampilkan card pada halaman yang dipilih
      setupPagination(); // Mengatur ulang pagination setelah klik
    });
    if (page === currentPage) {
      button.classList.add("active");
    }
    return button;
  };

  /**
   * Fungsi untuk membuat ellipsis (titik-titik) jika ada banyak halaman yang tidak ditampilkan.
   *
   * @returns {HTMLElement} - Elemen span HTML untuk ellipsis.
   */

  const createEllipsis = () => {
    const span = document.createElement("span");
    span.className = "ellipsis"; // Menetapkan kelas 'ellipsis'
    span.innerText = "..."; // Mengisi elemen dengan teks titik-titik
    return span; // Mengembalikan elemen span
  };

  // Menambahkan button untuk halaman pertama
  paginationContainer.appendChild(createPageButton(1));

  // Menambahkan ellipsis jika halaman saat ini lebih besar dari 3
  if (currentPage > 3) {
    paginationContainer.appendChild(createEllipsis());
  }

  // Menambahkan button untuk halaman-halaman di sekitar halaman saat ini
  for (
    let i = Math.max(2, currentPage - 1); // Mengatur agar button di dekat halaman saat ini dibuat
    i <= Math.min(totalPages - 1, currentPage + 1); // Membatasi agar tidak melampaui halaman terakhir
    i++
  ) {
    paginationContainer.appendChild(createPageButton(i));
  }

  // Menambahkan ellipsis jika halaman saat ini lebih kecil dari total halaman - 2
  if (currentPage < totalPages - 2) {
    paginationContainer.appendChild(createEllipsis());
  }

  // Menambahkan button untuk halaman terakhir
  if (totalPages > 1) {
    paginationContainer.appendChild(createPageButton(totalPages));
  }
}

/**
 * Fungsi untuk memperbarui tampilan button pagination.
 * button halaman yang aktif akan memiliki kelas 'active'.
 */
function updatePaginationButtons() {
  const buttons = document.querySelectorAll(".pagination button");
  buttons.forEach((button, index) => {
    button.classList.toggle("active", index + 1 === currentPage);
  });
}

showCards(currentPage); // Menampilkan card pertama kali saat halaman dimuat
setupPagination(); // Mengatur button pagination pertama kali saat halaman dimuat
updatePaginationButtons(); // Memperbarui tampilan button pagination

///////////////////////////////////////////
// DATE PICKER
//////////////////////////////////////////
const startDate = flatpickr("#startDate", {
  dateFormat: "Y-m-d",
  onChange: function (selectedDates, dateStr, instance) {
    // Set the minDate for endDate after startDate is selected
    endDate.set("minDate", dateStr);
    console.log("Start date selected:", dateStr);
  },
});

// Initialize flatpickr for endDate
const endDate = flatpickr("#endDate", {
  dateFormat: "Y-m-d",
  onChange: function (selectedDates, dateStr, instance) {
    // Set the maxDate for startDate after endDate is selected
    startDate.set("maxDate", dateStr);
    console.log("End date selected:", dateStr);
  },
});
