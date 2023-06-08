var passwordField = document.getElementById("password");
var showPasswordButton = document.getElementById("show-password");
showPasswordButton.addEventListener("click", function () {
    if (passwordField.type === "password") {
        passwordField.type = "text";

    } else {
        passwordField.type = "password";

    }
});