document.addEventListener("DOMContentLoaded", function () {

    const form = document.getElementById("loginForm");
    const username = document.getElementById("username");
    const password = document.getElementById("password");

    form.addEventListener("submit", function (e) {

        // Validasi input kosong
        if (username.value.trim() === "") {
            e.preventDefault();
            alert("Username harus diisi!");
            username.focus();
            return;
        }

        if (password.value.trim() === "") {
            e.preventDefault();
            alert("Password harus diisi!");
            password.focus();
            return;
        }

    });

});