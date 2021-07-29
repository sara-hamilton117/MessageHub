refreshTab();


var options = { backdrop: true, keyboard: true, focus: true };
var deleteModal = new bootstrap.Modal(document.getElementById('removeCustomService'), options);
var serviceModal = new bootstrap.Modal(document.getElementById('serviceModal'), options);

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
    deleteModal.toggle();
}

// Function to delete custom service
function deleteService(service_id) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {

        // Logic for successful answer
        if (this.readyState == 4 && this.status == 200) {
            if (this.responseText == 'Successfully deleted') {
                var card = document.getElementById("card-" + service_id);
                card.remove();
                orderCards();
                refreshTab();
                checkServicesCount();
                deleteModal.hide();
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

// Function to add New Custom Service
function newService() {

    // If JS validation passes
    if (validateNewService()){

        // Creating variable
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {

            // If the response is ready
            if (this.readyState == 4 && this.status == 200) {

                // Creating variable for JSON response to be recieved
                var response = JSON.parse(this.responseText);

                // If the responce recieved is 'success'
                if (response['success'] == true) {

                    // Add the new service in the form of a card
                    document.getElementById('current-services').appendChild(createCard(response['card']));

                    // Order cards
                    orderCards();

                    // Order the left panel
                    refreshTab();
                    checkServicesCount();
                    serviceModal.hide();
                }
                else {
                    document.getElementById('error-msgNS').innerHTML = response['errorMessage'];
                }
            }
            // If the response is not ready
            else if (this.readyState == 4 && this.status != 200) {

                //Show error message
                showAlert('An error occured. Please try again.');
                serviceModal.hide();
            }
        }

        // Create new header request
        xmlhttp.open("POST", "new-service.php", true);

        // Creating data variable
        var fileupload = document.getElementById('fileupload');
        var service_name = document.getElementById('service_name').value;
        var service_address = document.getElementById('service_address').value;

        var data = new FormData();
        data.append('file', fileupload.files[0]);
        data.append('name', service_name);
        data.append('address', service_address);
        // Sends the request with the data to PHP file
        xmlhttp.send(data);
    }
    return false;
}

// Function to create a new Bootsrap card
function createCard(cardContent){
    var template = document.createElement('template');
    template.innerHTML = cardContent;
    return template.content.firstChild;
}

// Function to display banner alert message
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

// Function to refresh left panel and reorder tabs
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

// Function to swap plus and minus buttons
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

// Reordering the current services
function orderCards() {
    // Getting all card nodes
    currentCards = document.getElementById('current-services').children;
    // Creating an array to hold them (currentCards is an HTMLCollection object)
    var currentCardsToSort = [];
    // Populate array with objects (node + id as properties)
    for (let i = 0; i < currentCards.length; i++) {
        currentCardsToSort.push({ node: currentCards[i], id: currentCards[i].id.slice(5)});
    }
    // Sort array by object.id
    currentCardsToSort.sort(function (a, b) { return a.id - b.id });
    // Remove all cards from the DOM
    document.getElementById('current-services').innerHTML = '';
    // Adding all cards (sorted in the correct order) back in the DOM
    for (let i = 0; i < currentCardsToSort.length; i++) {
        document.getElementById('current-services').appendChild(currentCardsToSort[i].node);
    }

    // Reordering the available services
    availableCards = document.getElementById('available-services').children;
    var availableCardsToSort = [];
    for (let i = 0; i < availableCards.length; i++) {
        availableCardsToSort.push({ node: availableCards[i], id: availableCards[i].id.slice(5)});
    }
    availableCardsToSort.sort(function (a, b) { return a.id - b.id });
    document.getElementById('available-services').innerHTML = '';
    for (let i = 0; i < availableCardsToSort.length; i++) {
        document.getElementById('available-services').appendChild(availableCardsToSort[i].node);
    }
}