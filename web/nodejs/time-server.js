// Use net module
var net = require('net');
var port = process.argv[2];

var server = net.createServer(function(socket) {
    socket.end(getTime() + "\n");
})

server.listen(port);

// Function to get the current time & format it the way we want
function getTime() {

    // Create a new date object
    var now = new Date();

    // Year we don't care about, but the rest we need to pad it with 0's
    var formattedDate = [now.getFullYear(), formatNumbers(now.getMonth() + 1), formatNumbers(now.getDate())].join("-") + " " + [formatNumbers(now.getHours()), formatNumbers(now.getMinutes())].join(":");

    return formattedDate;
}

// Adds a padding to the number if needed
function formatNumbers(numberToFormat) {
    var formattedNumber = 0

    // If number is less than 10, we need to add a 0 to the number
    if (numberToFormat < 10) {
        formattedNumber = "0" + numberToFormat;
    } else {
        formattedNumber = numberToFormat;
    }

    return formattedNumber;
}