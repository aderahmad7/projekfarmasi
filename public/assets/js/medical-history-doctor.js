///////////////////////////////////////////
// PAGINATION
//////////////////////////////////////////

const cardsPerPage = 2;
let currentPage = 1;
let filteredCards = [];

/**
 * Fungsi untuk memfilter kartu berdasarkan rentang tanggal.
 */
function filterCardsByDate() {
  const startDateStr = document.getElementById("startDate").value;
  const endDateStr = document.getElementById("endDate").value;
  const cards = document.querySelectorAll(".medical-history-data");

  if (!startDateStr && !endDateStr) {
    filteredCards = Array.from(cards);
  } else {
    const startDate = startDateStr
      ? new Date(startDateStr.split("/").reverse().join("-"))
      : new Date(0);
    const endDate = endDateStr
      ? new Date(endDateStr.split("/").reverse().join("-"))
      : new Date("9999-12-31");

    filteredCards = Array.from(cards).filter((card) => {
      const cardDate = new Date(card.getAttribute("data-tanggal"));
      return cardDate >= startDate && cardDate <= endDate;
    });
  }

  currentPage = 1;
  showCards(currentPage);
  setupPagination();
}

/**
 * Fungsi untuk menampilkan kartu pada halaman yang dipilih.
 * @param {number} page - Nomor halaman yang akan ditampilkan.
 */
function showCards(page) {
  const startIndex = (page - 1) * cardsPerPage;
  const endIndex = startIndex + cardsPerPage;
  const cards = document.querySelectorAll(".medical-history-data");

  cards.forEach((card) => card.classList.add("hidden"));

  filteredCards.slice(startIndex, endIndex).forEach((card) => {
    card.classList.remove("hidden");
  });
}

/**
 * Fungsi untuk mengatur tombol paginasi.
 */
function setupPagination() {
  const paginationContainer = document.getElementById("pagination");
  paginationContainer.innerHTML = "";

  const totalPages = Math.ceil(filteredCards.length / cardsPerPage);

  for (let i = 1; i <= totalPages; i++) {
    const button = document.createElement("button");
    button.innerText = i;
    button.addEventListener("click", () => {
      currentPage = i;
      showCards(currentPage);
      updatePaginationButtons();
    });
    paginationContainer.appendChild(button);
  }

  updatePaginationButtons();
}

/**
 * Fungsi untuk memperbarui tampilan tombol paginasi.
 */
function updatePaginationButtons() {
  const buttons = document.querySelectorAll(".pagination button");
  buttons.forEach((button, index) => {
    button.classList.toggle("active", index + 1 === currentPage);
  });
}

///////////////////////////////////////////
// DATE PICKER
//////////////////////////////////////////
const startDate = flatpickr("#startDate", {
  dateFormat: "d/m/Y",
  onChange: function (selectedDates, dateStr, instance) {
    endDate.set("minDate", dateStr);
    filterCardsByDate();
  },
});

const endDate = flatpickr("#endDate", {
  dateFormat: "d/m/Y",
  onChange: function (selectedDates, dateStr, instance) {
    startDate.set("maxDate", dateStr);
    filterCardsByDate();
  },
});

// Fungsi untuk menampilkan riwayat pasien
function tampilkanRiwayatPasien(idPasien) {
  const containerRiwayat = document.querySelector(
    ".medical-history-data-container"
  );
  containerRiwayat.innerHTML = "";

  const pasien = pasienData.find((p) => p.id === idPasien);

  if (!pasien || pasien.riwayat.length === 0) {
    containerRiwayat.innerHTML =
      '<p class="text-center">Tidak ada riwayat medis untuk pasien ini.</p>';
    return;
  }

  pasien.riwayat.forEach((r) => {
    const riwayat = r.riwayat;
    const dosis = r.dosis;

    const tanggal = new Date(riwayat.tanggal);
    const formattedTanggal = `${tanggal
      .getDate()
      .toString()
      .padStart(2, "0")}/${(tanggal.getMonth() + 1)
      .toString()
      .padStart(2, "0")}/${tanggal.getFullYear()}`;

    let htmlRiwayat = `
      <div class="medical-history-data" data-tanggal="${riwayat.tanggal}">
        <div class="card ps-2 pe-2">
          <div class="card p-2 border-top-0 border-start-0 border-end-0">
            <h4 class="text-center">${formattedTanggal}</h4>
          </div>
          <div class="card border-0 p-2">
            <h4 class="mb-1">Keluhan</h4>
            <p class="mb-4">${riwayat.keluhan}</p>
            <h4 class="mb-2 text-center">Gula Darah</h4>
            <div class="card mb-3 border-start-0 border-end-0 border-bottom-0">
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col" class="text-center">Puasa</th>
                    <th scope="col" class="text-center">Sewaktu</th>
                    <th scope="col" class="text-center">2 Jam</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td class="text-center">${riwayat.guldar_puasa}</td>
                    <td class="text-center">${riwayat.guldar_sewaktu}</td>
                    <td class="text-center">${riwayat.guldar_2jam}</td>
                  </tr>
                </tbody>
              </table>
            </div>
            <h4 class="mb-2 text-center">Konsumsi Obat</h4>
            <div class="card border-start-0 border-end-0 border-bottom-0">
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col" class="text-center">Nama Obat</th>
                    <th scope="col" class="text-center">Aturan Pakai</th>
                  </tr>
                </thead>
                <tbody>
                  ${dosis
                    .map(
                      (d) => `
                    <tr>
                      <td class="text-center">${d.nama_obat}</td>
                      <td class="text-center">${d.aturan_pakai}</td>
                    </tr>
                  `
                    )
                    .join("")}
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    `;

    containerRiwayat.innerHTML += htmlRiwayat;
  });

  filteredCards = Array.from(
    document.querySelectorAll(".medical-history-data")
  );
  filterCardsByDate(); // Terapkan filter tanggal jika ada
}

// Event listener untuk dropdown
document.getElementById("dropdown").addEventListener("change", function () {
  const idPasien = this.value;
  if (idPasien !== "#") {
    tampilkanRiwayatPasien(idPasien);
    startDate.clear();
    endDate.clear();
  }
});

// Inisialisasi paginasi saat halaman dimuat
document.addEventListener("DOMContentLoaded", () => {
  filteredCards = Array.from(
    document.querySelectorAll(".medical-history-data")
  );
  showCards(currentPage);
  setupPagination();
});
