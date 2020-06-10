// Create objects
var person = {
    firstName: "Scott",
    lastName: "Mosher",
    age: 28
};

// Display the object
console.log(person);

function addNumber(a, b) {
    return a + b;
}

// This will log the return value of the function
console.log(addNumber(7, 3));

function pointless() {

}

// This will display undefined because there is no return value
console.log(pointless());

// Create a variable that contains an anonymous function
var printBacon = function() {
    console.log("Bacon!!!");
};

printBacon();

// What setTimeout does, is you specify a function to run, and a time out.  Once the timeout completes, the function will run
setTimeout(printBacon, 5000);