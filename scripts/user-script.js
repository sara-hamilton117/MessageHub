function deleteAccount() {
    
    var password = document.getElementById('deletePassword').value;

    if (password == null || password == "") {
        document.getElementById('error-msgDA').innerHTML = "Please enter your password";
        return false;
    }

    else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function(){
            if (this.readyState == 4 && this.status == 200) {
                if (this.responseText == 'Successfully deleted') {
                    window.location.href = 'logout.php';
                }
                else if (this.responseText == 'Wrong password'){
                    document.getElementById('error-msgDA').innerHTML = "The password provided was incorrect";
                    return false;
                }
                else{
                    document.getElementById('error-msgDA').innerHTML = "An error occured, please try again";
                    return false;
                }
            }
            else if (this.readyState == 4 && this.status != 200) {
                document.getElementById('error-msgDA').innerHTML = "An error occured, please try again";
                return false;
            }
        }

        // Create new header request
        xmlhttp.open("POST", "delete-account.php", true);

        // Creating data variable
        var data = new FormData();
        data.append('password', password);
        // Sends the request with the data to PHP file
        xmlhttp.send(data);

        return false;
    }
}

// Function to update account
function updateAccountSettings() {

    var name = document.getElementById('name').value;
    var email = document.getElementById('email').value;
    var newPassword = document.getElementById('newPassword').value;
    var oldPassword = document.getElementById('oldPassword').value;

    // If current password is not given
    if (oldPassword === null || oldPassword === "") {
        document.getElementById('error-msgAS').innerHTML = "Please enter your current password to make any change(s)";
        return false;
    }

    // If no field is filled in
    else if ((name === null || name === "") && (email === null || email === "") && (newPassword === null || newPassword === "")) {
        document.getElementById('error-msgAS').innerHTML = "Please fill in the field(s) you want to update";
        return false;
    }

    else{

        // If the name field is filled in
        if (name !== null && name !== '') {

            // Validate name to allow only alphabets
            if (nameValidation(name) == false) {
                document.getElementById("error-msgAS").innerHTML = "Name must only contain alphabets";
                return false;
            }
        }

        // If the email field is filled in
        if (email !== null && email !== '') {

            // Validate email to only allow email format
            if (emailValidation(email) == false) {
                document.getElementById('error-msgAS').innerHTML = "Invalid email format";
                return false;
            }
        }

        // If the new password field is filled in
        if (newPassword !== null && newPassword !== '') {

            // Validate password to be a minimum 4 characters
            if (passwordValidation(newPassword) == false) {
                document.getElementById('error-msgAS').innerHTML = "Password must be at least 4 characters long";
                return false;
            }
        }

        // XMLHTTPREQUEST to server
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById('error-msgAS').innerHTML = "";
                console.log(this.responseText);
                if (this.responseText == 'Wrong password') {
                    document.getElementById('error-msgAS').innerHTML = "The password provided is incorrect";
                }
                else if (this.responseText == 'Error updating') {
                    document.getElementById('error-msgAS').innerHTML = "An error occured, please try again";
                }

                else if(this.responseText == "Email exists") {
                    document.getElementById('error-msgAS').innerHTML = "The email provided is already in use";
                }
                else if (this.responseText == "Update successful") {
                    document.getElementById('error-msgAS').innerHTML = "Your details have been updated";

                    // If needed, change name on the page
                    if (name !== null && name !== ""){
                        document.getElementById('nav-user-name').innerHTML = 'Hello ' + name;
                        document.getElementById('name').setAttribute("placeholder", name);
                        document.getElementById('name').value = "";
                    }
                }
                else{
                    document.getElementById('error-msgAS').innerHTML = "An error occured";
                }
            }
            else if (this.readyState == 4 && this.status != 200) {
                document.getElementById('error-msgAS').innerHTML = "An error occured, please try again";
                return false;
            }
        }

        // Create new header request
        xmlhttp.open("POST", "update-account.php", true);

        // Creating data variable
        var data = new FormData();
        data.append('name', name);
        data.append('email', email);
        data.append('newPassword', newPassword);
        data.append('oldPassword', oldPassword);
        // Sends the request with the data to PHP file
        xmlhttp.send(data);

        return false;
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
function passwordValidation(newPassword) {
    var passwordLength = newPassword.length;

    // Checking if password is atleast 4 characters long and that both passowrds match
    if (passwordLength >= 4) {
        return true;
    }
    else {
        return false;
    }
}