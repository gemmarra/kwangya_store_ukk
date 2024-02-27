// Get the modal
var modalwpp = document.getElementById("myModalWallpaper");

// Get the button that opens the modal
var btnwpp = document.getElementById("myBtnWallpaper");

// Get the <span> element that closes the modal
var spanwpp = document.getElementsByClassName("close-wpp")[0];

// When the user clicks the button, open the modal
btnwpp.onclick = function () {
  modalwpp.style.display = "block";
};

// When the user clicks on <span> (x), close the modal
spanwpp.onclick = function () {
  modalwpp.style.display = "none";
};

// When the user clicks anywhere outside of the modal, close it
window.onclick = function (event) {
  if (event.target == modalwpp) {
    modalwpp.style.display = "none";
  }
};
