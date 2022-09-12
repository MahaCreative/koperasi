// Hamburger Fixed

window.onscroll = function() {
    const headerNav = document.querySelector("header");
    const fixNav = headerNav.offsetTop; //Mengambil Jarak tag header dari atas saat dicsroll

    if (window.pageYOffset > fixNav) {
        headerNav.classList.add("navbar-fixed");
    } else {
        headerNav.classList.remove("navbar-fixed");
    }
};

// Hamburger

const hamburger = document.querySelector("#hamburger");
const navMenu = document.querySelector("#nav-menu");
hamburger.addEventListener("click", function() {
    hamburger.classList.toggle("hamburger-active");
    navMenu.classList.toggle("hidden");
});