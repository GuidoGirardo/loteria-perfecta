// alert("Inicia sesión, y luego compra el/los tícket/s que desees. Buena suerte!");

// login-register
let sectionIS = document.getElementById("sectionIS");
let btnIS = document.getElementById("btnIS");
let btnCloseIS = document.getElementById("btnCloseIS");
btnIS.addEventListener("click", ()=> sectionIS.style.display = "block");
btnCloseIS.addEventListener("click", ()=> sectionIS.style.display = "none");

let sectionR = document.getElementById("sectionR");
let btnR = document.getElementById("btnR");
let btnCloseR = document.getElementById("btnCloseR");
btnR.addEventListener("click", ()=> sectionR.style.display = "block");
btnCloseR.addEventListener("click", ()=> sectionR.style.display = "none");

// pagos
let btnPagos = document.getElementById("btnPagos");
let sectionPagos = document.getElementById("sectionPagos");
btnPagos.addEventListener("click", ()=> sectionPagos.style.display = "block" );

let btnClosePagos = document.getElementById("btnClosePagos");
btnClosePagos.addEventListener("click", ()=> sectionPagos.style.display = "none" );