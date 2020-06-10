// Get your packages

// Use the concat-stream method
var concatStream = require('concat-stream');
var http = require('http');
var urlToGet = process.argv[2];

// Create the GET method and handle the response
http.get(urlToGet, function(response) {
    // Set the encoding
    response.setEncoding('utf-8')

    // Take the stream and process it
    response.pipe(concatStream(function(siteData) {

        // First print out the length of the data
        console.log(siteData.length);

        // Now print out the data itself
        console.log(siteData);
    }))
});

// Trial version #2

// Create the GET method and handle the response
// http.get(urlToGet, function(response) {
//     // Set the encoding
//     response.setEncoding('utf-8')

//     response.on('data', function() {
//         // Take the stream and process it
//         response.pipe(concatStream(function(siteData) {

//             // First print out the length of the data
//             console.log(siteData.length);

//             // Now print out the data itself
//             console.log(siteData);
//         })) // End of pipe
//     }) // End of on

    
// });