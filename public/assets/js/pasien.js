let pasienElement = document.getElementById("patient-table-body");
let patients = JSON.parse(pasienElement.getAttribute("data-pasien"));
console.log(patients);

let editIndex = null;
const itemsPerPage = 10;
const baseUrl = "http://localhost/projekfarmasi/public";

function showForm(index = null) {
  const formTitle = document.getElementById("form-title");
  const patientForm = document.getElementById("patient-form");
  const patientId = document.getElementById("patient-id");
  const patientPassword = document.getElementById("patient-password");
  const userPw = document.getElementById("user-pw");

  if (index !== null) {
    formTitle.textContent = `Edit Pasien`;
    patientId.value = patients[index].id;
    fillFormWithPatientData(patients[index]);
    editIndex = index;
    patientPassword.style.display = "none";
    userPw.style.display = "none";
  } else {
    formTitle.textContent = "Tambah Pasien";
    patientForm.reset();
    patientId.value = "";
    editIndex = null;
    patientPassword.style.display = "block";
    userPw.style.display = "block";
  }

  $("#form-modal").modal("show");
}

function fillFormWithPatientData(patient) {
  document.getElementById("patient-name").value = patient.name;
  document.getElementById("patient-gender").value = patient.gender;
  document.getElementById("patient-usia").value = patient.usia;
  document.getElementById("patient-history").value = patient.history;
  document.getElementById("patient-nomor-handphone").value =
    patient.nomorHandphone;
  document.getElementById("patient-email").value = patient.email;
  document.getElementById("patient-username").value = patient.username;
  document.getElementById("patient-job").value = patient.pekerjaan;
}

function savePatient(event) {
  event.preventDefault();
  const patienForm = document.getElementById("patient-form");
  const formData = new FormData(patienForm);

  const newPatient = Object.fromEntries(formData.entries());

  if (editIndex !== null) {
    // Edit existing patient
    const url = `${baseUrl}/admin/update_pasien/${patients[editIndex].id}`;
    fetch(url, {
      method: "POST",
      body: formData,
    })
      .then((response) => response.json())
      .then((data) => {
        if (data.success) {
          patients[editIndex] = newPatient;
          window.location.reload();
          $("#form-modal").modal("hide");
        } else if (data.errors) {
          // Jika ada kesalahan validasi
          const errorMessages = data.errors;
          let errorList = "";
          for (const [field, message] of Object.entries(errorMessages)) {
            errorList += `<li>${message}</li>`;
          }
          document.getElementById("error-container").innerHTML = `
                <ol class="alert alert-danger">${errorList}</ol>
            `;
          $("#form-modal").modal("hide");
        } else {
          alert("Terjadi kesalahan saat memperbarui pasien");
        }
      })
      .catch((error) => console.error("Error:", error));
  } else {
    // Add new patient
    const url = `${baseUrl}/admin/save_pasien`;
    fetch(url, {
      method: "POST",
      body: formData,
    })
      .then((response) => response.json())
      .then((data) => {
        if (data.success) {
          patients.push(newPatient);
          window.location.reload();
          $("#form-modal").modal("hide");
        } else if (data.errors) {
          // Jika ada kesalahan validasi
          const errorMessages = data.errors;
          let errorList = "";
          for (const [field, message] of Object.entries(errorMessages)) {
            errorList += `<li>${message}</li>`;
          }
          document.getElementById("error-container").innerHTML = `
                <ol class="alert alert-danger">${errorList}</ol>
            `;
          $("#form-modal").modal("hide");
        } else {
          alert("Terjadi kesalahan saat menambahkan pasien");
        }
      })
      .catch((error) => console.error("Error:", error));
  }
}

function deletePatient(index) {
  if (confirm("Apakah Anda yakin ingin menghapus pasien ini?")) {
    const url = `${baseUrl}/admin/delete_pasien/${patients[index].id}`;
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
          patients.splice(index, 1);
          updateTable();
        } else {
          alert("Terjadi kesalahan saat menghapus pasien");
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

showCards(currentPage); // Menampilkan card pertama kali saat halaman dimuat
setupPagination(); // Mengatur button pagination pertama kali saat halaman dimuat
updatePaginationButtons(); // Memperbarui tampilan button pagination

const umur = flatpickr("#patient-tanggal-lahir", {
  dateFormat: "Y-m-d",
  onChange: function (selectedDates, dateStr, instance) {
    endDate.set("minDate", dateStr);
    filterCardsByDate();
  },
  static: true,
});
