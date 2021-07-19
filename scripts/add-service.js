function addservice(service_id) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {

        // Logic for successful answer
        if (this.readyState == 4 && this.status == 200) {
            if (this.responseText == 'Successfully added') {
                var card = document.getElementById("card-"+service_id);
                card.remove();
                var availableServices = document.getElementById('current-services');
                availableServices.appendChild(card);
            }
            else{

            }
        }
        // Logic if not successful
        else {

        }
    }

    // Create new header request
    xmlhttp.open("POST", "add-service.php", true);

    // Creating data variable
    var data = new FormData();
    data.append('service_id', service_id);
    // Sends the request with the data to PHP file
    xmlhttp.send(data);
}