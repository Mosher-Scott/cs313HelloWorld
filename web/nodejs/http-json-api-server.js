var http = require('http');
var url = require('url');

var portToUse = process.argv[2];


// Parses the time into an object with hour, min, and sec properties
var parseTimeValues = function(timeToParse) {
    return {
        hour: timeToParse.getHours(),
        minute: timeToParse.getMinutes(),
        second: timeToParse.getSeconds()
    } // end of return
} // end of method

// Returns the time in Unix format
function getUnixTime(time) {
    return {unixtime: time.getTime()};
};

// Create the server instance
http.createServer(function (request, response) {
    // Check the request
    if (request.method === 'GET') {
        // Set the response head
        response.writeHead(200, {'content-type': 'application/json'});
        // set the URL to parse the object
        url = url.parse(request.url, true);

        // End the response by creating a JSON file based on the values returned from either function
        response.end(JSON.stringify(parsedQuery(url)))
    } 
    // If it can't find the URL, then send a 405 back
    else {
        response.writeHead(405);
        response.end();
    }
}).listen(+portToUse, function() {
    console.log('Now listening on port ' , portToUse);
});
    

var parsedQuery = function(urlToParse) {
    switch(urlToParse.pathname) {
        // If the url is for parsing the time
        case '/api/parsetime':
            return parseTimeValues(new Date(urlToParse.query.iso));
        case '/api/unixtime':
            return getUnixTime(new Date(urlToParse.query.iso));
    } // end of switch statement
} // end of function

