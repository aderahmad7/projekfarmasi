let dokterElement = document.getElementById("doctor-table-body");
let doctors = JSON.parse(dokterElement.getAttribute("data-dokter"));

const inputWaktuAwal = document.getElementById("doctor-jam-mulai");
const inputWaktuAkhir = document.getElementById("doctor-jam-selesai");

let editIndex = null;
const itemsPerPage = 10;
const baseUrl = "http://localhost/projekfarmasi/public";

function showForm(index = null) {
  const formTitle = document.getElementById("form-title");
  const doctorForm = document.getElementById("doctor-form");
  const doctorId = document.getElementById("doctor-id");
  const doctorPassword = document.getElementById("doctor-password");
  const passwordLabel = document.getElementById("password-label");

  if (index !== null) {
    formTitle.textContent = "Edit Tenaga Kesehatan";
    doctorId.value = doctors[index].id;
    fillFormWithDoctorData(doctors[index]);
    editIndex = index;
    doctorPassword.style.display = "none";
    passwordLabel.style.display = "none";
  } else {
    formTitle.textContent = "Tambah Tenaga Kesehatan";
    doctorForm.reset();
    doctorId.value = "";
    editIndex = null;
    doctorPassword.style.display = "block";
    passwordLabel.style.display = "block";
  }

  $("#form-modal").modal("show");
}

function fillFormWithDoctorData(doctor) {
  document.getElementById("doctor-name").value = doctor.name;
  document.getElementById("doctor-gender").value = doctor.gender;
  document.getElementById("doctor-usia").value = doctor.usia;
  document.getElementById("doctor-tahun-pengalaman").value =
    doctor.tahunPengalaman;
  document.getElementById("doctor-nomor-handphone").value =
    doctor.nomorHandphone;
  document.getElementById("doctor-email").value = doctor.email;
  document.getElementById("doctor-username").value = doctor.username;
  document.getElementById("doctor-specialty").value = doctor.specialty;
  document.getElementById("doctor-hari-mulai").value = doctor.hari_mulai;
  document.getElementById("doctor-hari-selesai").value = doctor.hari_selesai;
  document.getElementById("doctor-jam-mulai").value = doctor.jam_mulai;
  document.getElementById("doctor-jam-selesai").value = doctor.jam_selesai;
}

function saveDoctor(event) {
  event.preventDefault();
  const doctorForm = document.getElementById("doctor-form");
  const formData = new FormData(doctorForm);

  const newDoctor = Object.fromEntries(formData.entries());

  // Log form data entries
  for (const pair of formData.entries()) {
    console.log(pair[0] + ": " + pair[1]);
  }

  if (editIndex !== null) {
    // Edit existing doctor
    const url = `${baseUrl}/admin/update_dokter/${doctors[editIndex].id}`;
    fetch(url, {
      method: "POST",
      body: formData,
    })
      .then((response) => response.json())
      .then((data) => {
        if (data.success) {
          doctors[editIndex] = newDoctor;
          window.location.reload();
          $("#form-modal").modal("hide");
        } else {
          alert("Terjadi kesalahan saat memperbarui tenaga kesehatan");
        }
      })
      .catch((error) => console.error("Error:", error));
  } else {
    // Add new doctor
    const url = `${baseUrl}/admin/save_dokter`;
    fetch(url, {
      method: "POST",
      body: formData,
    })
      .then((response) => response.json())
      .then((data) => {
        if (data.success) {
          doctors.push(newDoctor);
          window.location.reload();
          $("#form-modal").modal("hide");
        } else {
          alert("Terjadi kesalahan saat menambahkan tenaga kesehatan");
        }
      })
      .catch((error) => console.error("Error:", error));
  }
}

function deleteDoctor(index) {
  if (confirm("Apakah Anda yakin ingin menghapus tenaga kesehatan ini?")) {
    const url = `${baseUrl}/admin/delete_dokter/${doctors[index].id}`;
    const csrfToken = document
      .querySelector('meta[name="X-CSRF-TOKEN"]')
      .getAttribute("content");

    fetch(url, {
      method: "POST",
      headers: {
        "X-CSRF-TOKEN": csrfToken,
        "X-Requested-With": "XMLHttpRequest",
      },
    })
      .then((response) => response.json())
      .then((data) => {
        if (data.success) {
          doctors.splice(index, 1);
          updateTable();
        } else {
          alert("Kesalahan saat menghapus tenaga kesehatan");
        }
      })
      .catch((error) => {
        console.error("Error:", error);
      });
  }
}

///////////////////////////////////////////
// PAGINATION
//////////////////////////////////////////

const cardsPerPage = 2;
let currentPage = 1;
const cards = document.querySelectorAll(".card-table");
console.log(cards);
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

document.getElementById("simpanButton").addEventListener("click", function (e) {
  const waktuAwal = inputWaktuAwal.value;
  const waktuAkhir = inputWaktuAkhir.value;

  if (!waktuAwal || !waktuAkhir) {
    alert("Harap masukkan waktu awal dan akhir.");
    e.preventDefault();
    return false;
  }

  if (waktuAkhir < waktuAwal) {
    alert("Waktu akhir tidak boleh lebih awal dari waktu awal.");
    e.preventDefault();
    return false;
  }
});

showCards(currentPage); // Menampilkan card pertama kali saat halaman dimuat
setupPagination(); // Mengatur button pagination pertama kali saat halaman dimuat
updatePaginationButtons(); // Memperbarui tampilan button pagination
