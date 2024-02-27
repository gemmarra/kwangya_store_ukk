// Get the modalAddC
var modalAddC = document.getElementById("myModalAddCategory");

// Get the button that opens the modalAddC
var btnAddC = document.getElementById("myBtnAddCategory");

// Get the <span> element that closes the modalAddC
var spanAddC = document.getElementsByClassName("close-addC")[0];

// When the user clicks the button, open the modalAddC 
btnAddC.onclick = function() {
modalAddC.style.display = "block";
}

// When the user clicks on <span> (x), close the modalAddC
spanAddC.onclick = function() {
modalAddC.style.display = "none";
}

// When the user clicks anywhere outside of the modalAddC, close it
window.onclick = function(event) {
if (event.target == modalAddC) {
    modalAddC.style.display = "none";
}
}

var modalEditC = document.getElementById("myModalEditCategory");

// Get the button that opens the modalEditC
var btnEditC = document.getElementById("myBtnEditCategory");

// Get the <span> element that closes the modalEditC
var spanEditC = document.getElementsByClassName("close-EditC")[0];

// When the user clicks the button, open the modalEditC 
btnEditC.onclick = function() {
modalEditC.style.display = "block";
}

// When the user clicks on <span> (x), close the modalEditC
spanEditC.onclick = function() {
modalEditC.style.display = "none";
}

// When the user clicks anywhere outside of the modalEditC, close it
window.onclick = function(event) {
if (event.target == modalEditC) {
    modalEditC.style.display = "none";
}
}

