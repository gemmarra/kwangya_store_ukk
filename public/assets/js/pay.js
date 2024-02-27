// Get the modal
var modalPay = document.getElementById("mymodalPay");

// Get the button that opens the modal
var btnmodalPay = document.getElementById("mybtnmodalPay");

// Get the <span> element that closes the modal
var closemodalPay = document.getElementsByClassName("myclosemodalPay")[0];

// Function to open the modal
function openModal() {
  modalPay.style.display = "block";
}

// Function to close the modal
function closeModal() {
  modalPay.style.display = "none";
}

// When the user clicks the button, open the modal
btnmodalPay.onclick = openModal;

// When the user clicks on <span> (x), close the modal
closemodalPay.onclick = closeModal;

// When the user clicks anywhere outside of the modal, close it
window.onclick = function (event) {
  if (event.target == modalPay) {
    closeModal();
  }
};
