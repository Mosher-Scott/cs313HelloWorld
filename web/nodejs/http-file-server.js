// Create the http object
const http = require('http');

// Need file services
var fs = require('fs');

// Variables to hold the arguments
var portToUse = process.argv[2];
var file = process.argv[3];

// Create the server object
const server = http.createServer(function callback(req, res) {
    // Set the response head
    res.writeHead(200, {
        'content-type': 'text/plain'
    });
    // Create the stream and read the piped file
    fs.createReadStream(file).pipe(res);

}) // end server

// This will run when the file is called
server.listen(portToUse)