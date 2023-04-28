AOS.init();

// Système d'ouverture section création d'article

const sectionArticle = document.querySelector(".openSectionArticle");
const btnCreate = document.getElementById("createArticle");
const closeBtn = document.getElementById("closeSectionArticle");

btnCreate.addEventListener('click', function (){
    sectionArticle.style.display = "flex"
})

closeBtn.addEventListener('click', function (){
    sectionArticle.style.display = "none"
})

// Système burger menu

const burgerMenu = document.querySelector(".burgerList");
const openBurgerMenu = document.getElementById("burgerButton");
const closeBurgerMenu = document.getElementById("closeBurger");

openBurgerMenu.addEventListener('click', function (){
    burgerMenu.style.display = "flex"
    openBurgerMenu.style.display = "none"
    burgerMenu.classList.add("active");
})

closeBurgerMenu.addEventListener('click', function (){
    burgerMenu.style.display = "none"
    openBurgerMenu.style.display = "flex"
    burgerMenu.classList.remove("active");
})
