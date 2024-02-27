// Get the modal
var modalAddD = document.getElementById("myModalAddDenomination");

// Get the button that opens the modal
var  btnAddD= document.getElementById("myBtnAddDenomination");

// Get the <span> element that closes the modal
var spanAddD = document.getElementsByClassName("close-addD")[0];

// When the user clicks the button, open the modal 
btnAddD.onclick = function() {
modalAddD.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
spanAddD.onclick = function() {
modalAddD.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
if (event.target == modalAddD) {
    modalAddD.style.display = "none";
}
}

