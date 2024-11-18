
    // Function to toggle password visibility
    function togglePassword() {
        var passwordField = document.getElementById("password");
        var icon = document.querySelector(".toggle-password");

        if (passwordField.type === "password") {
            passwordField.type = "text";
            icon.classList.remove("fa-eye-slash");
            icon.classList.add("fa-eye");
        } else {
            passwordField.type = "password";
            icon.classList.remove("fa-eye");
            icon.classList.add("fa-eye-slash");
        }
    }

    // Add event listener to eye icon
    document.querySelector(".toggle-password").addEventListener("click", togglePassword);
