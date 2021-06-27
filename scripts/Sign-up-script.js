$(function () {
    // Runs when Sign Up button is pressed
    $("#submitSignUp").click(function () {
        // Retrieves user inputs and stores them as variables
        var name = document.getElementById("nameSU").value;
        var email = document.getElementById("emailSU").value;
        var password = document.getElementById("passwordSU").value;
        var repassword = document.getElementById("repasswordSU").value;
    });
});

function letterValidation(name) //validation of letters
{
    if (/^[a-zA-Z]+$/.test(name) == true) {
        return true;
    }
    else {
        if (/^[a-zA-Z]+$/.test(name) == false) {
            document.getElementById("error - msgSU").innerHTML = "Invalid name, please use only letters";
        }
        return false;
    }
}

// Function to validate email
function emailValidation(email)
{
    var checkEmail = /\S+@\S+\.\S+/;
    var test = checkEmail.test(email);

    if (test == true) {
        return true;
    }
    else if (test == false) {
        return false;
    }
}

// Function to validate passwords
function passwordValidationUp(password, repassword) 
{
    var passwordLength = password.length;

    if (passwordLength >= 4 && password == repassword) {
        return true;
    }
    else {
        return false;
    }
}