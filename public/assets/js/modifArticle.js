// Système qui permet de modifier un message

const modifyMessageBtn = document.getElementById("modifyMessage");
const areaText = document.getElementById("areaText");
const displayArea = document.getElementById("displayArea");
const validateArea = document.getElementById("validateArea");
const messageContent = document.querySelector(".listeContent p");

displayArea.style.display = "none"
modifyMessageBtn.addEventListener("click", function (){
    displayArea.style.display = "flex"
    areaText.innerHTML = messageContent.innerHTML;
    messageContent.style.display = 'none'
})

validateArea.addEventListener('click',function (){
    validateArea.style.display = 'none'
})