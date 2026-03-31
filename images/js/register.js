// Wait for the HTML page to load completely before running this code
$(document).ready(function () {
    console.log("Bootstrap Register Validation Loaded");

    // Listen for the 'submit' action on the registration form
    $("#registerForm").on("submit", function (event) {

        // 1. Prevent form from submitting immediately.
        event.preventDefault();

        // Assume the form is valid to start with
        let isValid = true;

        // --- HELPER FUNCTIONS FOR BOOTSTRAP ---
        function showError(selector, message) {
            $(selector).addClass("is-invalid");
            // Find the invalid-feedback div that is a sibling of the input
            // Or if inside a input-group, it might be slightly differently placed, but here structure is simple
            $(selector).siblings(".invalid-feedback").text(message);
            isValid = false;
        }

        function showSuccess(selector) {
            $(selector).removeClass("is-invalid");
            $(selector).addClass("is-valid");
        }

        // --- RESET STATE ---
        $(".form-control").removeClass("is-invalid is-valid");
        $(".invalid-feedback").text("");

        // Get values
        let name = $("#name").val() || "";
        let email = $("#email").val() || "";
        let dob = $("#dob").val() || "";
        let state = $("#state").val() || "";
        let password = $("#password").val() || "";
        let cpassword = $("#cpassword").val() || "";

        name = name.trim();
        email = email.trim();

        // --- VALIDATE NAME ---
        if (name === "") {
            showError("#name", "Please enter your full name.");
        } else if (name.length < 2) {
            showError("#name", "Name is too short (min 2 letters).");
        } else {
            showSuccess("#name");
        }

        // --- VALIDATE EMAIL ---
        let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (email === "") {
            showError("#email", "Please enter your email address.");
        } else if (!emailPattern.test(email)) {
            showError("#email", "This doesn't look like a valid email.");
        } else {
            showSuccess("#email");
        }

        // --- VALIDATE DATE OF BIRTH (18+) ---
        if (dob === "") {
            showError("#dob", "Please enter your date of birth.");
        } else {
            let birthDate = new Date(dob);
            let today = new Date();
            let age = today.getFullYear() - birthDate.getFullYear();
            let monthDiff = today.getMonth() - birthDate.getMonth();
            if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
                age--;
            }

            if (age < 18) {
                showError("#dob", "You must be at least 18 years old.");
            } else {
                showSuccess("#dob");
            }
        }

        // --- VALIDATE STATE ---
        if (!state || state === "") {
            showError("#state", "Please select your state.");
        } else {
            showSuccess("#state");
        }

        // --- VALIDATE PASSWORD ---
        if (password === "") {
            showError("#password", "Create a password.");
        } else if (password.length < 6) {
            showError("#password", "Password must be at least 6 characters.");
        } else {
            showSuccess("#password");
        }

        // --- VALIDATE CONFIRM PASSWORD ---
        if (cpassword === "") {
            showError("#cpassword", "Please confirm your password.");
        } else if (password !== cpassword) {
            showError("#cpassword", "Passwords do not match.");
        } else {
            showSuccess("#cpassword");
        }

        // If everything is valid, submit the form programmatically
        if (isValid === true) {
            this.submit();
        }

    });

});
