document
  .getElementById("confirmPassword")
  .addEventListener("input", function () {
    var password = document.getElementById("password").value;
    var confirmPassword = this.value;
    var passwordError = document.getElementById("passwordError");

    if (password === confirmPassword) {
      passwordError.style.display = "none";
    } else {
      passwordError.style.display = "block";
    }
  });
