// Example would be user request
function placeAnOrder(orderNumber) {
    console.log("Customer order: ", orderNumber);

    // So we've called the function now.  
    cookAndDeliverFood(function () {
    
        console.log("Delivered Food Order:", orderNumber);
    });
};

// Simulate a 5 second operation, such as connecting to a database
// Example when you query the database, the callback is the function letting you know the query is finished
function cookAndDeliverFood(callback) {
    // After 5 seconds, return the callback
    setTimeout(callback, 1000);
};

// Place the orders for the users
placeAnOrder(1);
placeAnOrder(2);
placeAnOrder(3);
placeAnOrder(4);
placeAnOrder(5);
placeAnOrder(6);
placeAnOrder(7);
placeAnOrder(8);
placeAnOrder(9);
placeAnOrder(10);
placeAnOrder(5);
placeAnOrder(6);
placeAnOrder(7);
placeAnOrder(8);
placeAnOrder(9);
placeAnOrder(10);
