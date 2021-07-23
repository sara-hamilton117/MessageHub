// Validation function
function loginValidate() {
    var email = document.getElementById("email").value;
    var password = document.getElementById("password").value;

    // If email validation fails, display error message
    
    if (email == null || email == "") {
        document.getElementById('error-msgLI').innerHTML = "Please enter your email";
        return false;
        
    }

    else if (password == null || password == "") {
        document.getElementById('error-msgLI').innerHTML = "Please enter your password";
        return false;
    }

    else if (emailValidation(email) == false) {
        document.getElementById('error-msgLI').innerHTML = "Invalid email";
        return false;
    }

    // If validation passes, proceed to login.php through form
    else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {

            // Logic for successful answer
            if (this.readyState == 4 && this.status == 200) {
                if (this.responseText == 'Wrong password') {
                    document.getElementById('error-msgLI').innerHTML = "Incorrect email/password";
                    return false;
                }
                else if (this.responseText == 'No email found'){
                    document.getElementById('error-msgLI').innerHTML = "Incorrect email/password";
                    return false;
                }
                else if (this.responseText == 'Empty fields') {
                    document.getElementById('error-msgLI').innerHTML = "Something went wrong, please try again";
                    return false;
                }
                else {
                    window.location.href = 'index.php';
                    return true;
                }
            }
            // Logic if not successful
            else if (this.readyState == 4 && this.status != 200) {
                document.getElementById('error-msgLI').innerHTML = "Something went wrong, please try again";
                return false;
            }
        }

        // Create new header request
        xmlhttp.open("POST", "login.php", true);

        // Creating data variable
        var data = new FormData();
        data.append('email', email);
        data.append('password', password);
        // Sends the request with the data to PHP file
        xmlhttp.send(data);
        return false;
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

