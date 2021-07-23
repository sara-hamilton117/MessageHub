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
                }else{
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