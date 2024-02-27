// Get the modal
var modalSellingDetails = document.getElementById("myModalSellingDetails");

// Get the button that opens the modal
var  btnSellingDetails= document.getElementById("myBtnSellingDetails");

// Get the <span> element that closes the modal
var spanSellingDetails = document.getElementsByClassName("close-SellingDetails")[0];

// When the user clicks the button, open the modal 
btnSellingDetails.onclick = function() {
modalSellingDetails.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
spanSellingDetails.onclick = function() {
modalSellingDetails.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
if (event.target == modalSellingDetails) {
    modalSellingDetails.style.display = "none";
}
}

