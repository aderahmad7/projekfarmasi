/*=====================
    Hide Show js
==========================*/
function showhide() {
    var moreText = document.getElementById("more");
    var btnText = document.querySelector("#toggle i");

    if (dots.style.display === "none") {
        dots.style.display = "block";
        moreText.style.display = "none";
        btnText.classList.add('ri-arrow-down-s-line');
        btnText.classList.remove('ri-arrow-up-s-line');
    } else {
        dots.style.display = "none";
        moreText.style.display = "block";
        btnText.classList.add('ri-arrow-up-s-line');
        btnText.classList.remove('ri-arrow-down-s-line');
    }
}