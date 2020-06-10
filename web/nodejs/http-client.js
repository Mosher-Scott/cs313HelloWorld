var http = require('http');

// Get the URL and save it
var urlToGet = process.argv[2];

// Now create the request and handle it
http.get(urlToGet, function(response) {
    // Set the encoding you are expecting to get
    response.setEncoding('utf-8')

    // What do to when you get 
    response.on('data', console.log)
    
    // What to do on an error
    response.on('error', console.error)

    // end of the get
    }).on('error', console.error)