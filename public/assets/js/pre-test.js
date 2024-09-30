// let questions = [
//     {
//         text: "Apa ibukota Indonesia?",
//         options: ["Jakarta", "Surabaya", "Bandung", "Yogyakarta"],
//     },
//     {
//         text: "Siapakah presiden pertama Indonesia?",
//         options: ["Soekarno", "Soeharto", "Habibie", "Megawati"],
//     },
// ];

function showModal(title, message, defaultValue, callback) {
    const modal = new bootstrap.Modal(document.getElementById("customModal"));
    document.getElementById("modalTitle").textContent = title;
    document.getElementById("modalMessage").textContent = message;
    document.getElementById("modalInput").value = defaultValue || "";
    document.getElementById("modalConfirm").onclick = function () {
        modal.hide();
        if (callback)
            callback(true, document.getElementById("modalInput").value);
    };
    modal.show();
}

// function showConfirm(message, callback) {
//     const modal = new bootstrap.Modal(document.getElementById("customModal"));
//     document.getElementById("modalTitle").textContent = "Confirmation";
//     document.getElementById("modalMessage").textContent = message;
//     document.getElementById("modalInput").style.display = "none";
//     document.getElementById("modalConfirm").onclick = function () {
//         modal.hide();
//         if (callback) callback(true);
//     };
//     modal.show();
// }

// function addQuestion() {
//     const questionText = document.getElementById("questionText").value;
//     if (questionText) {
//         const question = {
//             text: questionText,
//             options: [],
//         };
//         questions.push(question);
//         document.getElementById("questionText").value = "";
//         updateQuestionList();
//     } else {
//         alert("Please Input Question");
//     }
// }

function setFormAction(action) {
    let form = document.querySelector("#customModal form");
    
    // Dapatkan base URL (tanpa 'pretest' di akhir)
    let baseUrl = form.action.split('/pretest')[0];
    
    // Pastikan baseUrl diakhiri dengan '/'
    if (!baseUrl.endsWith('/')) {
        baseUrl += '/';
    }
    
    // Set action baru
    form.action = baseUrl + action;
}

function addOption(questionIndex) {
    showModal(
        "Add Option",
        "Enter Option Choices:",
        "",
        function(confirmed) {
            if (confirmed) {
                console.log("Untuk indeks pertanyaan:", questionIndex);
            }
        }
    );
    console.log("Untuk indeks pertanyaan:", questionIndex);
    document.getElementById("questionId").value = questionIndex;
    setFormAction("pretest/add_option");
}

function editOption(questionIndex, ansIndex, optionIndex, optionValue) {
    showModal(
        "Edit Option",
        "Edit Option Choices:",
        optionValue,
        function(confirmed) {
            if (confirmed) {
                console.log("Untuk indeks pertanyaan:", questionIndex);
                console.log("Untuk indeks opsi:", optionIndex);
            }
        }
    );
    console.log("Untuk indeks pertanyaan:", questionIndex);
    console.log("Untuk isi opsi:", optionValue);
    console.log("Untuk indeks opsi:", optionIndex);
    console.log("Untuk indeks jawaban:", ansIndex);
    if (ansIndex == optionIndex) {
        document.getElementById("correctOptionCheck").checked = true;
    } else {
        document.getElementById("correctOptionCheck").checked = false;
    }
    document.getElementById("questionId").value = questionIndex;
    document.getElementById("ansId").value = ansIndex;
    document.getElementById("modalInput").value = optionValue;
    document.getElementById("optionId").value = optionIndex;
    setFormAction("pretest/edit_option");
}

function editQuestion(questionIndex, questionValue) {
    showModal(
        "Edit Question",
        "Edit Question:",
        questionValue,
        function (result) {
            if (result) {
                
            }
        }
        
    );
    console.log("Untuk indeks pertanyaan:", questionIndex);
    console.log("Untuk isi pertanyaan:", questionValue);
    document.getElementById("modalInput").value = questionValue;
    document.getElementById("questionId").value = questionIndex;
    setFormAction("pretest/edit_question");
}


// function deleteQuestion(questionIndex) {
//     showConfirm(
//         "Are you sure you want to delete this question?",
//         function (result) {
//             if (result) {
//                 questions.splice(questionIndex, 1);
//                 updateQuestionList();
//             }
//         }
//     );
// }

// function deleteOption(questionIndex, optionIndex) {
//     showConfirm(
//         "Are you sure you want to delete this answer choice?",
//         function (result) {
//             if (result) {
//                 questions[questionIndex].options.splice(optionIndex, 1);
//                 updateQuestionList();
//             }
//         }
//     );
// }

// function updateQuestionList() {
//     const questionList = document.getElementById("questionList");
//     questionList.innerHTML = "";
//     questions.forEach((question, qIndex) => {
//         const questionDiv = document.createElement("div");
//         questionDiv.className = "question";
//         questionDiv.innerHTML = `
//             <h3 class="question-text mb-3">${qIndex + 1}. ${question.text}</h3>
//             <div class="question-buttons mb-2 d-flex gap-2">
//                 <button onclick="editQuestion(${qIndex})" class="btn btn-sm btn-primary rounded-3">Edit Question</button>
//                 <button onclick="deleteQuestion(${qIndex})" class="btn btn-sm btn-danger rounded-3">Delete Question</button>
//                 <button onclick="addOption(${qIndex})" class="btn btn-sm btn-success rounded-3">Add Option</button>
//             </div>
//             <div class="options">
//                 ${question.options
//                     .map(
//                         (option, oIndex) => `
//                     <div class="option">
//                         <div class="option-text">${String.fromCharCode(
//                             97 + oIndex
//                         )}. ${option}</div>
//                         <div class="option-buttons">
//                             <button onclick="editOption(${qIndex}, ${oIndex})" class="btn btn-sm btn-outline-primary w-auto">Edit</button>
//                             <button onclick="deleteOption(${qIndex}, ${oIndex})" class="btn btn-sm btn-outline-danger w-auto">Delete</button>
//                         </div>
//                     </div>
//                 `
//                     )
//                     .join("")}
//             </div>
//         `;
//         questionList.appendChild(questionDiv);
//     });
// }
// updateQuestionList();
