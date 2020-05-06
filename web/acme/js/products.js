'use strict'// Follow all rules

// Get the list of products based on the picked category ID
let catList = document.querySelector("#CategoryId");

// Add an event listener, then run the anonymous function
catList.addEventListener("change", function() {

    // Adds the currently chosen value to a variable
    let categoryId = catList.value;
    // console.log(`categoryId is: ${categoryId}`);

    // Create the URL needed to get the info from the database
    let catIdURL = "/acme/products/index.php?action=getInventoryItems&categoryId=" + categoryId;
    
    console.log(catIdURL);

    // Requests the inventory item from the database
    fetch(catIdURL)
  
    

    // .then means this needs to wait until the response is received
    .then(function(response){
        if(response.ok) {
            return response.json();
        }
        throw error("Network response was not OK");
    })
    // If successful, run the function to add the data to the empty table we created
    .then(function (data) {
         console.log(data);
        buildproductList(data);
    })
    .catch(function (error) {
       // console.log(catIdURL.response)
        console.log('There was a problem:', error.message)
    })
})

// Add inventory items to the #productsDisplay table
function buildproductList(data) {

    let productsDisplay = document.getElementById("productsDisplay");

    // Table labels
    let dataTable = '<thead>';
    dataTable += '<tr><th>Product Name</th<td>&nbsp;</td><td>&nbsp;</td></tr>';
    dataTable += '</thead>';

    // Set up table body
    dataTable += '<tbody>';

    // Now add all items to their own row
    data.forEach(function(element) {
        // console.log(element.invId + ', ' + element.invName);
        dataTable += `<tr><td>${element.invName}</td>`;
        dataTable += `<td><a href='/acme/products?action=mod&id=${element.invId}' title='Click to modify'>Modify</a></td>`;
        dataTable += `<td><a href='/acme/products?action=del&id=${element.invId}' title='Click to delete'>Delete</a></td></tr>` 
    })
    dataTable += '</tbody>';

    // Add the table to the screen
    productsDisplay.innerHTML = dataTable;
}