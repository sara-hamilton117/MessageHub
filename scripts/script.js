function opensite(url) {
        window.open(url, "_blank");
}

function orderCards(){
        // Reordering the current services
        // Getting all card nodes
        currentCards = document.getElementById('current-services').children;
        // Creating an array to hold them (currentCards is an HTMLCollection object)
        var currentCardsToSort = [];
        // Populate array with objects (node + id as properties)
        for (let i = 0; i < currentCards.length; i++){
                currentCardsToSort.push({node: currentCards[i], id:currentCards[i].id.slice(5)});
        }
        // Sort array by object.id
        currentCardsToSort.sort(function (a, b) { return a.id - b.id });
        // Remove all cards from the DOM
        document.getElementById('current-services').innerHTML = '';
        // Adding all cards (sorted in the correct order) back in the DOM
        for (let i = 0; i < currentCardsToSort.length; i++){
                document.getElementById('current-services').appendChild(currentCardsToSort[i].node);
        }

        // Reordering the available services
        availableCards = document.getElementById('available-services').children;
        var availableCardsToSort = [];
        for (let i = 0; i < availableCards.length; i++) {
                availableCardsToSort.push({ node: availableCards[i], id: availableCards[i].id.slice(5) });
        }
        availableCardsToSort.sort(function (a, b) { return a.id - b.id });
        document.getElementById('available-services').innerHTML = '';
        for (let i = 0; i < availableCardsToSort.length; i++) {
                document.getElementById('available-services').appendChild(availableCardsToSort[i].node);
        }


}