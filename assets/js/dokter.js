let doctors = [
    {
        id: "1",
        gender: "1",
        usia: "30",
        tahunPengalaman: "15",
        nomorHandphone: "123917",
        username: "hahay",
        password: "kucay",
        name: "Dr. Asep",
        specialty: "Kardiologi",
        email: "example@gmail.com"
    },
    {
        id: "2",
        gender: "1",
        usia: "30",
        tahunPengalaman: "15",
        nomorHandphone: "123917",
        username: "hahay",
        password: "kucay",
        name: "Dr. Budi",
        specialty: "Neurologi",
        email: "example@gmail.com"
    },
    {
        id: "3",
        gender: "1",
        usia: "30",
        tahunPengalaman: "15",
        nomorHandphone: "123917",
        username: "hahay",
        password: "kucay",
        name: "Dr. Citra",
        specialty: "Pediatri",
        email: "example@gmail.com"
    },
    {
        id: "4",
        gender: "1",
        usia: "30",
        tahunPengalaman: "15",
        nomorHandphone: "123917",
        username: "hahay",
        password: "kucay",
        name: "Dr. Dewi",
        specialty: "Dermatologi",
        email: "example@gmail.com"
    },
    {
        id: "5",
        gender: "1",
        usia: "30",
        tahunPengalaman: "15",
        nomorHandphone: "123917",
        username: "hahay",
        password: "kucay",
        name: "Dr. Eko",
        specialty: "Ginekologi",
        email: "example@gmail.com"
    },
    {
        id: "6",
        gender: "1",
        usia: "30",
        tahunPengalaman: "15",
        nomorHandphone: "123917",
        username: "hahay",
        password: "kucay",
        name: "Dr. Fajar",
        specialty: "Onkologi",
        email: "example@gmail.com"
    },
    {
        id: "7",
        gender: "1",
        usia: "30",
        tahunPengalaman: "15",
        nomorHandphone: "123917",
        username: "hahay",
        password: "kucay",
        name: "Dr. Gita",
        specialty: "Gastroenterologi",
        email: "example@gmail.com"
    },
    {
        id: "8",
        gender: "1",
        usia: "30",
        tahunPengalaman: "15",
        nomorHandphone: "123917",
        username: "hahay",
        password: "kucay",
        name: "Dr. Hadi",
        specialty: "Pulmonologi",
        email: "example@gmail.com"
    },
    {
        id: "9",
        gender: "1",
        usia: "30",
        tahunPengalaman: "15",
        nomorHandphone: "123917",
        username: "hahay",
        password: "kucay",
        name: "Dr. Indra",
        specialty: "Endokrinologi",
        email: "example@gmail.com"
    },
    {
        id: "10",
        gender: "1",
        usia: "30",
        tahunPengalaman: "15",
        nomorHandphone: "123917",
        username: "hahay",
        password: "kucay",
        name: "Dr. Joko",
        specialty: "Hematologi",
        email: "example@gmail.com"
    },
    {
        id: "11",
        gender: "1",
        usia: "30",
        tahunPengalaman: "15",
        nomorHandphone: "123917",
        username: "hahay",
        password: "kucay",
        name: "Dr. Asep",
        specialty: "Kardiologi",
        email: "example@gmail.com"
    },
    {
        id: "12",
        gender: "1",
        usia: "30",
        tahunPengalaman: "15",
        nomorHandphone: "123917",
        username: "hahay",
        password: "kucay",
        name: "Dr. Budi",
        specialty: "Neurologi",
        email: "example@gmail.com"
    },
    {
        id: "13",
        gender: "1",
        usia: "30",
        tahunPengalaman: "15",
        nomorHandphone: "123917",
        username: "hahay",
        password: "kucay",
        name: "Dr. Citra",
        specialty: "Pediatri",
        email: "example@gmail.com"
    },
    {
        id: "14",
        gender: "1",
        usia: "30",
        tahunPengalaman: "15",
        nomorHandphone: "123917",
        username: "hahay",
        password: "kucay",
        name: "Dr. Dewi",
        specialty: "Dermatologi",
        email: "example@gmail.com"
    },
    {
        id: "15",
        gender: "1",
        usia: "30",
        tahunPengalaman: "15",
        nomorHandphone: "123917",
        username: "hahay",
        password: "kucay",
        name: "Dr. Eko",
        specialty: "Ginekologi",
        email: "example@gmail.com"
    },
    {
        id: "16",
        gender: "1",
        usia: "30",
        tahunPengalaman: "15",
        nomorHandphone: "123917",
        username: "hahay",
        password: "kucay",
        name: "Dr. Fajar",
        specialty: "Onkologi",
        email: "example@gmail.com"
    },
    {
        id: "17",
        gender: "1",
        usia: "30",
        tahunPengalaman: "15",
        nomorHandphone: "123917",
        username: "hahay",
        password: "kucay",
        name: "Dr. Gita",
        specialty: "Gastroenterologi",
        email: "example@gmail.com"
    },
    {
        id: "18",
        gender: "1",
        usia: "30",
        tahunPengalaman: "15",
        nomorHandphone: "123917",
        username: "hahay",
        password: "kucay",
        name: "Dr. Hadi",
        specialty: "Pulmonologi",
        email: "example@gmail.com"
    },
    {
        id: "19",
        gender: "1",
        usia: "30",
        tahunPengalaman: "15",
        nomorHandphone: "123917",
        username: "hahay",
        password: "kucay",
        name: "Dr. Indra",
        specialty: "Endokrinologi",
        email: "example@gmail.com"
    },
    {
        id: "20",
        gender: "1",
        usia: "30",
        tahunPengalaman: "15",
        nomorHandphone: "123917",
        username: "hahay",
        password: "kucay",
        name: "Dr. Joko",
        specialty: "Hematologi",
        email: "example@gmail.com"
    },
];

let editIndex = null;
let currentPage = 1;
const itemsPerPage = 10;

function showForm(index = null) {
    const formTitle = document.getElementById("form-title");
    const doctorForm = document.getElementById("doctor-form");
    const doctorId = document.getElementById("doctor-id");
    const doctorName = document.getElementById("doctor-name");
    const doctorGender = document.getElementById('doctor-gender');
    const doctorAge = document.getElementById("doctor-usia");
    const doctorYearExperience = document.getElementById(
        "doctor-tahun-pengalaman"
    );
    const doctorPhoneNumber = document.getElementById(
        "doctor-nomor-handphone"
    );
    const doctorEmail = document.getElementById("doctor-email");
    const doctorUsername = document.getElementById("doctor-username");
    const doctorPassword = document.getElementById("doctor-password");
    const doctorSpecialty = document.getElementById("doctor-specialty");

    if (index !== null) {
        formTitle.textContent = "Edit Doctor";
        doctorId.value = doctors[index].id;
        doctorName.value = doctors[index].name;
        doctorSpecialty.value = doctors[index].specialty;
        doctorAge.value = doctors[index].usia;
        doctorGender.value = doctors[index].gender;
        doctorGender.options[doctorGender.selectedIndex].text;
        doctorYearExperience.value = doctors[index].tahunPengalaman;
        doctorPhoneNumber.value = doctors[index].nomorHandphone;
        doctorEmail.value = doctors[index].email;
        doctorUsername.value = doctors[index].username;
        doctorPassword.value = doctors[index].password;
        editIndex = index;
    } else {
        formTitle.textContent = "Add Doctor";
        doctorForm.reset();
        doctorId.value = "";
        editIndex = null;
    }

    $("#form-modal").modal("show");
}

function saveDoctor(event) {
    event.preventDefault();
    const doctorId = document.getElementById("doctor-id").value;
    const doctorName = document.getElementById("doctor-name").value;
    const doctorAge = document.getElementById("doctor-usia").value;
    const doctorGender = document.getElementById('doctor-gender').value;
    const doctorYearExperience = document.getElementById(
        "doctor-tahun-pengalaman"
    ).value;
    const doctorPhoneNumber = document.getElementById(
        "doctor-nomor-handphone"
    ).value;
    const doctorEmail = document.getElementById("doctor-email").value;
    const doctorUsername = document.getElementById("doctor-username").value;
    const doctorPassword = document.getElementById("doctor-password").value;
    const doctorSpecialty = document.getElementById("doctor-specialty").value;

    const newDoctor = {
        id: doctorId || doctors.length + 1,
        name: doctorName,
        specialty: doctorSpecialty,
        usia: doctorAge,
        tahunPengalaman: doctorYearExperience,
        nomorHandphone: doctorPhoneNumber,
        email: doctorEmail,
        username: doctorUsername,
        password: doctorPassword,
        gender: doctorGender,
    };

    if (editIndex !== null) {
        doctors[editIndex] = newDoctor;
    } else {
        doctors.push(newDoctor);
    }

    updateTable();
    $("#form-modal").modal("hide");
}

function editDoctor(index) {
    showForm(index);
}

function deleteDoctor(index) {
    doctors.splice(index, 1);
    updateTable();
}

function updateTable() {
    const tbody = document.getElementById("doctor-table-body");
    tbody.innerHTML = "";

    const start = (currentPage - 1) * itemsPerPage;
    const end = start + itemsPerPage;
    const paginatedDoctors = doctors.slice(start, end);

    paginatedDoctors.forEach((doctor, index) => {
        const row = document.createElement("tr");
        row.innerHTML = `
            <td>${doctor.id}</td>
            <td>${doctor.name}</td>
            <td>${doctor.gender === "1" ? "Male" : "Female"}</td>
            <td>${doctor.usia}</td>
            <td>${doctor.specialty}</td>
            <td>${doctor.tahunPengalaman}</td>
            <td>${doctor.nomorHandphone}</td>
            <td>${doctor.email}</td>

            <td>${doctor.username}</td> 
            <td>${doctor.password}</td>
            <td>
                <button class="btn btn-secondary btn-sm mb-2" onclick="editDoctor(${
                    start + index
                })">Edit</button>
                <button class="btn btn-danger btn-sm" onclick="deleteDoctor(${
                    start + index
                })">Delete</button>
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
