let patients = [
    {
        id: "1",
        gender: "1",
        usia: "30",
        pekerjaan: "Nguli",
        nomorHandphone: "123917",
        username: "hahay",
        password: "kucay",
        name: "Asep",
        history: "Bengek",
        email: "example@gmail.com"
    },
    {
        id: "2",
        gender: "1",
        usia: "30",
        pekerjaan: "Nguli",
        nomorHandphone: "123917",
        username: "hahay",
        password: "kucay",
        name: "Budi",
        history: "Asma",
        email: "example@gmail.com"
    },
    {
        id: "3",
        gender: "1",
        usia: "30",
        pekerjaan: "Nguli",
        nomorHandphone: "123917",
        username: "hahay",
        password: "kucay",
        name: "Citra",
        history: "Maag",
        email: "example@gmail.com"
    },
    {
        id: "4",
        gender: "1",
        usia: "30",
        pekerjaan: "Nguli",
        nomorHandphone: "123917",
        username: "hahay",
        password: "kucay",
        name: "Dewi",
        history: "Sembelit",
        email: "example@gmail.com"
    },
    {
        id: "5",
        gender: "1",
        usia: "30",
        pekerjaan: "Nguli",
        nomorHandphone: "123917",
        username: "hahay",
        password: "kucay",
        name: "Eko",
        history: "Ginekologi",
        email: "example@gmail.com"
    },
    {
        id: "6",
        gender: "1",
        usia: "30",
        pekerjaan: "Nguli",
        nomorHandphone: "123917",
        username: "hahay",
        password: "kucay",
        name: "Fajar",
        history: "Onkologi",
        email: "example@gmail.com"
    },
    {
        id: "7",
        gender: "1",
        usia: "30",
        pekerjaan: "Nguli",
        nomorHandphone: "123917",
        username: "hahay",
        password: "kucay",
        name: "Gita",
        history: "Gastroenterologi",
        email: "example@gmail.com"
    },
    {
        id: "8",
        gender: "1",
        usia: "30",
        pekerjaan: "Nguli",
        nomorHandphone: "123917",
        username: "hahay",
        password: "kucay",
        name: "Hadi",
        history: "Pulmonologi",
        email: "example@gmail.com"
    },
    {
        id: "9",
        gender: "1",
        usia: "30",
        pekerjaan: "Nguli",
        nomorHandphone: "123917",
        username: "hahay",
        password: "kucay",
        name: "Indra",
        history: "Endokrinologi",
        email: "example@gmail.com"
    },
    {
        id: "10",
        gender: "1",
        usia: "30",
        pekerjaan: "Nguli",
        nomorHandphone: "123917",
        username: "hahay",
        password: "kucay",
        name: "Joko",
        history: "Hematologi",
        email: "example@gmail.com"
    },
    {
        id: "11",
        gender: "1",
        usia: "30",
        pekerjaan: "Nguli",
        nomorHandphone: "123917",
        username: "hahay",
        password: "kucay",
        name: "Asep",
        history: "Kardiologi",
        email: "example@gmail.com"
    },
    {
        id: "12",
        gender: "1",
        usia: "30",
        pekerjaan: "Nguli",
        nomorHandphone: "123917",
        username: "hahay",
        password: "kucay",
        name: "Budi",
        history: "Neurologi",
        email: "example@gmail.com"
    },
    {
        id: "13",
        gender: "1",
        usia: "30",
        pekerjaan: "Nguli",
        nomorHandphone: "123917",
        username: "hahay",
        password: "kucay",
        name: "Citra",
        history: "Maag",
        email: "example@gmail.com"
    },
    {
        id: "14",
        gender: "1",
        usia: "30",
        pekerjaan: "Nguli",
        nomorHandphone: "123917",
        username: "hahay",
        password: "kucay",
        name: "Dewi",
        history: "Sembelit",
        email: "example@gmail.com"
    },
    {
        id: "Nguli",
        gender: "1",
        usia: "30",
        pekerjaan: "Nguli",
        nomorHandphone: "123917",
        username: "hahay",
        password: "kucay",
        name: "Eko",
        history: "Ginekologi",
        email: "example@gmail.com"
    },
    {
        id: "16",
        gender: "1",
        usia: "30",
        pekerjaan: "Nguli",
        nomorHandphone: "123917",
        username: "hahay",
        password: "kucay",
        name: "Fajar",
        history: "Onkologi",
        email: "example@gmail.com"
    },
    {
        id: "17",
        gender: "1",
        usia: "30",
        pekerjaan: "Nguli",
        nomorHandphone: "123917",
        username: "hahay",
        password: "kucay",
        name: "Gita",
        history: "Gastroenterologi",
        email: "example@gmail.com"
    },
    {
        id: "18",
        gender: "1",
        usia: "30",
        pekerjaan: "Nguli",
        nomorHandphone: "123917",
        username: "hahay",
        password: "kucay",
        name: "Hadi",
        history: "Pulmonologi",
        email: "example@gmail.com"
    },
    {
        id: "19",
        gender: "1",
        usia: "30",
        pekerjaan: "Nguli",
        nomorHandphone: "123917",
        username: "hahay",
        password: "kucay",
        name: "Indra",
        history: "Endokrinologi",
        email: "example@gmail.com"
    },
    {
        id: "20",
        gender: "1",
        usia: "30",
        pekerjaan: "Nguli",
        nomorHandphone: "123917",
        username: "hahay",
        password: "kucay",
        name: "Joko",
        history: "Hematologi",
        email: "example@gmail.com"
    },
];

let editIndex = null;
let currentPage = 1;
const itemsPerPage = 10;

function showForm(index = null) {
    const formTitle = document.getElementById("form-title");
    const patientForm = document.getElementById("patient-form");
    const patientId = document.getElementById("patient-id");
    const patientName = document.getElementById("patient-name");
    const patientGender = document.getElementById('patient-gender');
    const patientAge = document.getElementById("patient-usia");
    const patientJob = document.getElementById(
        "patient-job"
    );
    const patientHistory = document.getElementById("patient-history");
    const patientPhoneNumber = document.getElementById(
        "patient-nomor-handphone"
    );
    const patientEmail = document.getElementById('patient-email');
    const patientUsername = document.getElementById("patient-username");
    const patientPassword = document.getElementById("patient-password");

    if (index !== null) {
        formTitle.textContent = "Edit patient";
        patientId.value = patients[index].id;
        patientName.value = patients[index].name;
        patientHistory.value = patients[index].history;
        patientAge.value = patients[index].usia;
        patientGender.value = patients[index].gender;
        patientGender.options[patientGender.selectedIndex].text;
        patientJob.value = patients[index].pekerjaan;
        patientPhoneNumber.value = patients[index].nomorHandphone;
        patientEmail.value = patients[index].email;
        patientUsername.value = patients[index].username;
        patientPassword.value = patients[index].password;
        editIndex = index;
    } else {
        formTitle.textContent = "Add patient";
        patientForm.reset();
        patientId.value = "";
        editIndex = null;
    }

    $("#form-modal").modal("show");
}

function savepatient(event) {
    event.preventDefault();
    const patientId = document.getElementById("patient-id").value;
    const patientName = document.getElementById("patient-name").value;
    const patientAge = document.getElementById("patient-usia").value;
    const patientGender = document.getElementById('patient-gender').value;
    const patientJob = document.getElementById(
        "patient-job"
    ).value;
    const patientPhoneNumber = document.getElementById(
        "patient-nomor-handphone"
    ).value;
    const patientEmail = document.getElementById('patient-email').value;
    const patientUsername = document.getElementById("patient-username").value;
    const patientPassword = document.getElementById("patient-password").value;
    const patientHistory = document.getElementById("patient-history").value;

    const newpatient = {
        id: patientId || patients.length + 1,
        name: patientName,
        history: patientHistory,
        usia: patientAge,
        pekerjaan: patientJob,
        nomorHandphone: patientPhoneNumber,
        email: patientEmail,
        username: patientUsername,
        password: patientPassword,
        gender: patientGender,
    };

    if (editIndex !== null) {
        patients[editIndex] = newpatient;
    } else {
        patients.push(newpatient);
    }

    updateTable();
    $("#form-modal").modal("hide");
}

function editpatient(index) {
    showForm(index);
}

function deletepatient(index) {
    patients.splice(index, 1);
    updateTable();
}

function updateTable() {
    const tbody = document.getElementById("patient-table-body");
    tbody.innerHTML = "";

    const start = (currentPage - 1) * itemsPerPage;
    const end = start + itemsPerPage;
    const paginatedpatients = patients.slice(start, end);

    paginatedpatients.forEach((patient, index) => {
        const row = document.createElement("tr");
        row.innerHTML = `
            <td>${patient.id}</td>
            <td>${patient.name}</td>
            <td>${patient.gender === "1" ? "Male" : "Female"}</td>
            <td>${patient.usia}</td>
            <td>${patient.history}</td>
            <td>${patient.pekerjaan}</td>
            <td>${patient.nomorHandphone}</td>
            <td>${patient.email}</td>
            <td>${patient.username}</td> 
            <td>${patient.password}</td>
            <td>
                <button class="btn btn-secondary btn-sm mb-2" onclick="editpatient(${
                    start + index
                })">Edit</button>
                <button class="btn btn-danger btn-sm" onclick="deletepatient(${
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
