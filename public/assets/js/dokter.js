let dokterElement = document.getElementById('doctor-table-body');
let doctors = JSON.parse(dokterElement.getAttribute('data-dokter'));


let editIndex = null;
let currentPage = 1;
const itemsPerPage = 10;
const baseUrl = 'http://localhost/projekfarmasi/public';

function showForm(index = null) {
    const formTitle = document.getElementById("form-title");
    const doctorForm = document.getElementById("doctor-form");
    const doctorId = document.getElementById("doctor-id");
    const doctorPassword = document.getElementById("doctor-password");

    if (index !== null) {
        formTitle.textContent = "Edit Tenaga Kesehatan";
        doctorId.value = doctors[index].id;
        fillFormWithDoctorData(doctors[index]);
        editIndex = index;
        doctorPassword.style.display = 'none';
    } else {
        formTitle.textContent = "Tambah Tenaga Kesehatan";
        doctorForm.reset();
        doctorId.value = "";
        editIndex = null;
        doctorPassword.style.display = 'block';
    }

    $("#form-modal").modal("show");
}

function fillFormWithDoctorData(doctor) {
    document.getElementById("doctor-name").value = doctor.name;
    document.getElementById("doctor-gender").value = doctor.gender;
    document.getElementById("doctor-usia").value = doctor.usia;
    document.getElementById("doctor-tahun-pengalaman").value = doctor.tahunPengalaman;
    document.getElementById("doctor-nomor-handphone").value = doctor.nomorHandphone;
    document.getElementById("doctor-email").value = doctor.email;
    document.getElementById("doctor-username").value = doctor.username;
    document.getElementById("doctor-specialty").value = doctor.specialty;
}

function saveDoctor(event) {
    event.preventDefault();
    const doctorForm = document.getElementById("doctor-form");
    const formData = new FormData(doctorForm);

    const newDoctor = Object.fromEntries(formData.entries());

     // Log form data entries
    for (const pair of formData.entries()) {
        console.log(pair[0]+ ': ' + pair[1]);
    }

    if (editIndex !== null) {
        // Edit existing doctor
        const url = `${baseUrl}/admin/update_dokter/${doctors[editIndex].id}`;
        fetch(url, {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                doctors[editIndex] = newDoctor;
                window.location.reload();
                $("#form-modal").modal("hide");
            } else {
                alert('Terjadi kesalahan saat memperbarui tenaga kesehatan');
            }
        })
        .catch(error => console.error('Error:', error));
    } else {
        // Add new doctor
        const url = `${baseUrl}/admin/save_dokter`;
        fetch(url, {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                doctors.push(newDoctor);
                window.location.reload();
                $("#form-modal").modal("hide");
            } else {
                alert('Terjadi kesalahan saat menambahkan tenaga kesehatan');
            }
        })
        .catch(error => console.error('Error:', error));
    }
}

function deleteDoctor(index) {
    if (confirm('Apakah Anda yakin ingin menghapus tenaga kesehatan ini?')) {
        const url = `${baseUrl}/admin/delete_dokter/${doctors[index].id}`;
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
                doctors.splice(index, 1);
                updateTable();
            } else {
                alert('Kesalahan saat menghapus tenaga kesehatan');
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }
}

function updateTable() {
    const tbody = document.getElementById("doctor-table-body");
    tbody.innerHTML = "";

    const start = (currentPage - 1) * itemsPerPage;
    const end = start + itemsPerPage;
    const paginatedDoctors = doctors.slice(start, end);
    let no = 1;
    paginatedDoctors.forEach((doctor, index) => {
        const row = document.createElement("tr");
        row.innerHTML = `
            <td>${no++}</td>
            <td>${doctor.name}</td>
            <td>${doctor.gender === "Laki-laki" ? "Laki-Laki" : "Perempuan"}</td>
            <td>${doctor.usia}</td>
            <td>${doctor.specialty}</td>
            <td>${doctor.tahunPengalaman}</td>
            <td>${doctor.nomorHandphone}</td>
            <td>${doctor.email}</td>
            <td>${doctor.username}</td> 
            <td>
                <button class="btn btn-secondary btn-sm mb-2" onclick="showForm(${start + index})">Edit</button>
                <button class="btn btn-danger btn-sm" onclick="deleteDoctor(${start + index})">Hapus</button>
            </td>
        `;
        tbody.appendChild(row);
    });

    updatePagination();
}

function updatePagination() {
    const pagination = document.getElementById("pagination");
    pagination.innerHTML = "";

    const totalPages = Math.ceil(doctors.length / itemsPerPage);

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
