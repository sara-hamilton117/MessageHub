refreshTab();

function addservice(service_id) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {

        // Logic for successful answer
        if (this.readyState == 4 && this.status == 200) {
            if (this.responseText == 'Successfully added') {
                var card = document.getElementById("card-"+service_id);
                card.remove();
                var currentServices = document.getElementById('current-services');
                currentServices.appendChild(card);
                orderCards();
                swapButton(service_id, false);
                refreshTab();
                checkServicesCount();
            }
            else{
                showAlert('The service could not be added. Please try again.');
                console.log('add service');
            }
        }
        // Logic if not successful
        else if (this.readyState == 4 && this.status != 200){
            showAlert('An error occured. Please try again.');
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

function removeservice(service_id) {
    var xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function () {
        // Logic for successful answer
        if (this.readyState == 4 && this.status == 200) {
            if (this.responseText == 'Successfully removed') {
                var card = document.getElementById("card-" + service_id);
                
                card.remove();
                var availableServices = document.getElementById('available-services');
                availableServices.appendChild(card);
                orderCards();
                swapButton(service_id, true);
                refreshTab();
                checkServicesCount();
            }
            else {
                showAlert('The service could not be removed. Please try again.');
                console.log('remove service');
            }
        }
        else if (this.readyState == 4 && this.status != 200) {
            showAlert('An error occured. Please try again.');
        }
    }

    // Create new header request
    xmlhttp.open("POST", "remove-service.php", true);

    // Creating data variable
    var data = new FormData();
    data.append('service_id', service_id);
    // Sends the request with the data to PHP file
    xmlhttp.send(data);
}

function removecustomservice(service_id) {
    var deleteButton = document.getElementById('delete-service-button');
    deleteButton.setAttribute("onclick", 'deleteService('+service_id+')');
    var options = { backdrop: true, keyboard: true, focus: true };
    var myModal = new bootstrap.Modal(document.getElementById('removeCustomService'), options);
    myModal.toggle();
}

// Function to delete custom service
function deleteService(service_id) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {

        // Logic for successful answer
        if (this.readyState == 4 && this.status == 200) {
            if (this.responseText == 'Successfully deleted') {
                var card = document.getElementById("card-" + service_id);
                card.remove();
                orderCards();
                refreshTab();
                checkServicesCount();
                var options = { backdrop: true, keyboard: true, focus: true };
                var myModal = new bootstrap.Modal(document.getElementById('removeCustomService'), options);
                myModal.hide();
            }
            else {
                showAlert('The service could not be deleted. Please try again.');
            }
        }
        // Logic if not successful
        else if (this.readyState == 4 && this.status != 200) {
            showAlert('An error occured. Please try again.');
        }
    }

    // Create new header request
    xmlhttp.open("POST", "delete-custom-service.php", true);

    // Creating data variable
    var data = new FormData();
    data.append('service_id', service_id);
    // Sends the request with the data to PHP file
    xmlhttp.send(data);
}

function showAlert(message) {
    var alertSection = document.getElementById('alert-section');

    var tempDiv = document.createElement('template');
    tempDiv.innerHTML = `<div class="row alert alert-warning alert-dismissible fade show m-0 p-0 text-center" role="alert" id="alertPopup">
        <p class="m-0 p-0 hiw-para" id="alert-message"> </p>
            <button type="button" class="btn-close alert-close p-0" data-bs-dismiss="alert" aria-label="Close"></button>
        </div> `;
    alertSection.appendChild(tempDiv.content.firstChild);

    document.getElementById('alert-message').innerHTML = message;
}

function refreshTab(){
    var tabs = document.getElementById('services-tab');
    bigPlus = tabs.children[0];
    account = tabs.children[tabs.children.length - 1];
    tabs.innerHTML = '';
    tabs.appendChild(bigPlus);

    var xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function () {
        // Logic for successful answer
        if (this.readyState == 4 && this.status == 200) {
            // Retrieving all the nodes and parsing them
            if (this.responseText != 'no services'){
                var nodes = JSON.parse(this.responseText);
                for (let i=0; i < nodes.length; i++){
                    tempDiv = document.createElement('template');
                    tempDiv.innerHTML = nodes[i];
                    tabs.appendChild(tempDiv.content.firstChild);
                }
            }

            tabs.appendChild(account);
        }
        // Logic if not successful
        else {
            
        }
    }
    // Create new header request
    xmlhttp.open("GET", "current-services-tab.php", true);
    xmlhttp.send();
}

// Function to 
function swapButton(service_id, plus){

    // Creating variable
    var button = document.getElementById('card-' + service_id).children[0].children[0];

    // Turning the button from a + to -
    if(!plus){
        button.classList.remove('fa-plus-circle');
        button.classList.add('fa-minus-circle', 'delete');
        button.setAttribute("onclick", 'removeservice(' + service_id + ')');
    }
    // Turning the button from a - to +
    else {
        button.classList.remove('fa-minus-circle', 'delete');
        button.classList.add('fa-plus-circle');
        button.setAttribute("onclick", 'addservice(' + service_id + ')');
    }
}

// Function that checks if user has services
function checkServicesCount() {

    // Creating variable
    var children = document.getElementById('current-services').children;
    
    // If there are services
    if(children.length > 1 && children[0].tagName == 'H6') {

        // Remove message
        children[0].remove();
    }

    // If there are no services
    else if(children.length == 0) {

        // Creating variable
        var message = document.createElement('H6');

        // Message to be displayed if no services are selected
        message.innerHTML = "Select a service from the Available Services to begin using MessageHub.";
        message.classList.add('dash-text', 'm-0', 'pt-3', 'ps-2');
        document.getElementById('current-services').appendChild(message);
    }
}
