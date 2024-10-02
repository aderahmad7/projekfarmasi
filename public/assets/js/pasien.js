let pasienElement = document.getElementById('patient-table-body');
let patients = JSON.parse(pasienElement.getAttribute('data-pasien'));
console.log(patients);

let editIndex = null;
let currentPage = 1;
const itemsPerPage = 10;
const baseUrl = 'http://localhost/projekfarmasi/public';

function showForm(index = null) {
    const formTitle = document.getElementById("form-title");
    const patientForm = document.getElementById("patient-form");
    const patientId = document.getElementById("patient-id");
    const patientPassword = document.getElementById("patient-password");

    if (index !== null) {
        formTitle.textContent = "Edit Pasien";
        patientId.value = patients[index].id;
        fillFormWithPatientData(patients[index]);
        editIndex = index;
        patientPassword.style.display = 'none';
    } else {
        formTitle.textContent = "Tambah Pasien";
        patientForm.reset();
        patientId.value = "";
        editIndex = null;
        patientPassword.style.display = 'block';
    }

    $("#form-modal").modal("show");
}

function fillFormWithPatientData(patient) {
    document.getElementById("patient-name").value = patient.name;
    document.getElementById("patient-gender").value = patient.gender;
    document.getElementById("patient-usia").value = patient.usia;
    document.getElementById("patient-history").value = patient.history;
    document.getElementById("patient-nomor-handphone").value = patient.nomorHandphone;
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
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                patients[editIndex] = newPatient;
                window.location.reload();
                $("#form-modal").modal("hide");
            } else {
                alert('Terjadi kesalahan saat memperbarui pasien');
            }
        })
        .catch(error => console.error('Error:', error));
    } else {
        // Add new patient
        const url = `${baseUrl}/admin/save_pasien`;
        fetch(url, {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                patients.push(newPatient);
                window.location.reload();
                $("#form-modal").modal("hide");
            } else {
                alert('Terjadi kesalahan saat menambahkan pasien');
            }
        })
        .catch(error => console.error('Error:', error));
    }
}

function deletePatient(index) {
    if (confirm('Apakah Anda yakin ingin menghapus pasien ini?')) {
        const url = `${baseUrl}/admin/delete_pasien/${patients[index].id}`;
        const csrfToken = document.querySelector('meta[name="X-CSRF-TOKEN"]').getAttribute('content');
        
        fetch(url, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                patients.splice(index, 1);
                updateTable();
            } else {
                alert('Terjadi kesalahan saat menghapus pasien');
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }
}

function updateTable() {
    const tbody = document.getElementById("patient-table-body");
    tbody.innerHTML = "";

    const start = (currentPage - 1) * itemsPerPage;
    const end = start + itemsPerPage;
    const paginatedpatients = patients.slice(start, end);
    let no = 1;
    paginatedpatients.forEach((patient, index) => {
        const row = document.createElement("tr");
        row.innerHTML = `
            <td>${no++}</td>
            <td>${patient.name}</td>
            <td>${patient.gender === "Laki-laki" ? "Laki-laki" : "Perempuan"}</td>
            <td>${patient.usia}</td>
            <td>${patient.history}</td>
            <td>${patient.pekerjaan}</td>
            <td>${patient.nomorHandphone}</td>
            <td>${patient.email}</td>
            <td>${patient.username}</td> 
            <td>
                <button class="btn btn-secondary btn-sm mb-2" onclick="showForm(${start + index})">Edit</button>
                <button class="btn btn-danger btn-sm" onclick="deletePatient(${start + index})">Hapus</button>
            </td>
        `;
        tbody.appendChild(row);
    });

    updatePagination();
}

function updatePagination() {
    const pagination = document.getElementById("pagination");
    pagination.innerHTML = "";

    const totalPages = Math.ceil(patients.length / itemsPerPage);

    for (let i = 1; i <= totalPages; i++) {
        const li = document.createElement("li");
        li.classList.add("page-item");
        if (i === currentPage) {
            li.classList.add("active");
        }
        li.innerHTML = `<a class="page-link" href="#" onclick="goToPage(${i})">${i}</a>`;
        pagination.appendChild(li);
    }
}

function goToPage(page) {
    currentPage = page;
    updateTable();
}

// Initialize table and pagination
updateTable();
