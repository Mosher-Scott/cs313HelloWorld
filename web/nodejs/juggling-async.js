// Http request
var http = require('http');

// Try using the bl method this time
var bl = require('bl');

// Use an array to hold the responses
var responses = [];

// This will hold a count of all the requests
var count = 0;

// Use a function to print the results
function printRequestResults() {
    for (var i = 0; i <= 3; i++) {

        if (responses[i] == undefined) {
            console.log("");
        } else {
                    // Print out each response
        console.log(responses[i]);
        }

    }
}

// This function will make the request & save the responses
function makeHttpRequest(requestNumber) {
    // Use [2 + requestNumber] to get the actual argument number, since we'll be getting 3
    http.get(process.argv[2 + requestNumber], function(response) {
        // Pipe the results using the bl method
        response.pipe(bl(function(err, data) {

            // Check for errors
            if (err) {
                return console.error(err)
            }

            // Process the results. Save it to the responses array as a string
            responses[requestNumber] = data.toString();
            count++

            // Now if count is 3, we've processed them all, so print the results
            if(count == 3) {
                printRequestResults();
            }
        })) // End of pipe
    }) // End of get request
}

// This is what we'll use to run everything
for (var i = 0; i < 3; i++) {
    makeHttpRequest(i);
}