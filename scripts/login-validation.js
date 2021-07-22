// Validation function
function loginValidate() {
    var email = document.getElementById("emailSU").value;

    // If email validation fails, display error message
    if (emailValidation(email) == false) {
        document.getElementById('error-msgLI').innerHTML = "Invalid email";
        return false;
    }

    // If validation passes, proceed to login.php through form
    else {
        return true;
    }
}

// Email validation
function emailValidation(email) {

    // Using Regex to specify email format
    var checkEmail = /\S+@\S+\.\S+/;
    var test = checkEmail.test(email);

    if (test == true) {
        return true;
    }
    else if (test == false) {
        return false;
    }
}