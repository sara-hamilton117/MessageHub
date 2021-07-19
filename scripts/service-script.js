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
            }
            else {

            }
        }
        // Logic if not successful
        else {

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

function checkServices(){
    
}

function swapButton(service_id, plus){

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