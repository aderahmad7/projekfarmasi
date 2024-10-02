const medicalHistory = document.querySelector(".medical-history");

medicalHistory.addEventListener("click", function () {
  const dropDownContent = document.querySelector(".dropdown-content");
  medicalHistory.classList.toggle("active");
  if (dropDownContent.style.height) {
    dropDownContent.style.height = null;
  } else {
    dropDownContent.style.height = dropDownContent.scrollHeight + "px";
  }
});
