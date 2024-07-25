/*===================
    Dark js
=======================*/
const darkSwitch = document.querySelector("#dark-switch");
const htmlDom = document.querySelector("html");
const darkLink = document.querySelector("#change-link");
const initialCheck = localStorage.getItem("class");
if (darkSwitch) {
  if (initialCheck === "dark") darkSwitch.checked = true;
}
darkSwitch?.addEventListener("change", (e) => {
  const checkbox = e.target;
  console.log(checkbox.checked);
  if (checkbox.checked) {
    htmlDom.setAttribute("class", "dark");
    darkLink.href = "../assets/css/dark.css";
    localStorage.setItem("darkcss", "../assets/css/dark.css");
    localStorage.setItem("class", "dark");
  }

  if (!checkbox.checked) {
    htmlDom.setAttribute("class", "light");
    darkLink.href = "../assets/css/style.css";
    localStorage.setItem("darkcss", "../assets/css/style.css");
    localStorage.setItem("class", "light");
  }
});
// Dark
htmlDom.setAttribute("class", localStorage.getItem("class")?localStorage.getItem("class") : "light");
darkLink.href = localStorage.getItem("darkcss")?localStorage.getItem("darkcss") : "../assets/css/style.css";

/*====================
  RTL js
======================*/
const dirSwitch = document.querySelector("#dir-switch");
const htmlDom1 = document.querySelector("html");
const rtlLink = document.querySelector("#rtl-link");
const initialCheck1 = localStorage.getItem("dir");
if (dirSwitch) {
  if (initialCheck1 === "rtl") dirSwitch.checked = true;
}
dirSwitch?.addEventListener("change", (e) => {
  const checkbox = e.target;
  console.log(checkbox.checked);
  if (checkbox.checked) {
    htmlDom1.setAttribute("dir", "rtl");
    rtlLink.href = "../assets/css/vendors/bootstrap.rtl.css";
    localStorage.setItem("rtlcss", "../assets/css/vendors/bootstrap.rtl.css");
    localStorage.setItem("dir", "rtl");
  }

  if (!checkbox.checked) {
    htmlDom1.setAttribute("dir", "ltr");
    rtlLink.href = "../assets/css/vendors/bootstrap.css";
    localStorage.setItem("rtlcss", "../assets/css/vendors/bootstrap.css");
    localStorage.setItem("dir", "ltr");
  }
});
// Rtl
htmlDom1.setAttribute("dir", localStorage.getItem("dir") ? localStorage.getItem("dir") : "ltr");
rtlLink.href = localStorage.getItem("rtlcss") ? localStorage.getItem("rtlcss") : "../assets/css/vendors/bootstrap.css";