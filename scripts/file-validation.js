// Function to validate new service
function validateNewService() {
    var name = document.getElementById('service_name').value;
    var address = document.getElementById('service_address').value;
    var addressPattern = new RegExp('^https:\/\/$');
    var file = document.getElementById('fileupload');

    if (name == null || name == "") {
        document.getElementById('error-msgNS').innerHTML = "Service name cannot be empty";
        return false;
    }

    else if(addressPattern.test(address.trim())){
        document.getElementById('error-msgNS').innerHTML = "Service address cannot be empty";
        return false;
    }else if(file.files[0] == null){
        document.getElementById('error-msgNS').innerHTML = "Please select an image to upload";
        return false;
    }
    else{
        return true;
    }
}