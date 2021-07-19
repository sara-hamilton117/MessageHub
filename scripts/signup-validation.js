// Validation function
function validate() {
    var name = document.getElementById("nameSU").value;
    var email = document.getElementById("emailSU").value;
    var password = document.getElementById("passwordSU").value;
    var repassword = document.getElementById("repasswordSU").value;
    
    // If name validation fails, display error message
    if (nameValidation(name) == false) {
        document.getElementById("error-msgSU").innerHTML = "Name must only contain alphabets";
        return false;
        
    }

    // If password validation fails, display error message
    else if (passwordValidation(password, repassword) == false) {
        document.getElementById('error-msgSU').innerHTML = "Passwords must match and be atleast 4 characters long";
        return false;
    }

    // If email validation fails, display error message
    else if (emailValidation(email) == false) {
        document.getElementById('error-msgSU').innerHTML = "Invalid email";
        return false;
    }

    // If all validations pass, proceed to signup.php through form
    else {
        return true;
    }
}

// Name validation
function nameValidation(name) {

    // Using Regex to only allow letters and spaces
    if (/^[a-zA-Z\s]+$/.test(name) == false) {
        return false;
    }
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

// Password validation
function passwordValidation(password, repassword) {
    var passwordLength = password.length;

    // Checking if password is atleast 4 characters long and that both passowrds match
    if (passwordLength >= 4 && password == repassword) {
        return true;
    }
    else {
        return false;
    }
}