var http = require('http');
var url = require('url');
var fs = require('fs');

var portToUse = 8888;

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

// getData
var getData = function() {
    return {
        name: "Scott",
        class: "CS313"
    }
}

// Serve index.php file
var indexFile = function (url) {
    console.log("reached indexFile");
    fs.readFile("index.php", function(err, data) {
        console.log(__dirname + url);
        if(err) {
            return "<h1>File not found</h1>";
        } else {
            console.log(data);
            return data;
        }
    }) 
}

// Serve index.php file
var index = function () {
    console.log("reached testFile");
    var page = __dirname + url.pathname;
    fs.readFile(page, function (error, pgResp) {
        if (error) {
            response.writeHead(404);
            response.write('Page not found');
        } else {
            response.writeHead(200, { 'Content-Type': 'text/html' });
            response.write(pgResp);
        }
         
        response.end();
    });
}

// Home
var homePage = function() {
    return "<h1>Welcome To the Home Page</h1>";
}

// Create the server instance that runs
http.createServer(function (request, response) {
    // Check the request
    if (request.method === 'GET') {
        
        // set the URL to parse the object
        url = url.parse(request.url, true);
        console.log(url.pathname); 

        switch(url.pathname) {
            case "/home":
                console.log("home requested");
                response.writeHead(200, {'content-type': 'text/html'});
                 response.end(onRequest(url));
                 break;

            case "/index.php":
                var page = __dirname + url.pathname;
                fs.readFile(page, function (error, pgResp) {
                    if (error) {
                        response.writeHead(404);
                        response.write('Page not found');
                    } else {
                        response.writeHead(200, { 'Content-Type': 'text/html' });
                        response.write(pgResp);
                    }
                     
                    response.end();
                });

                break;

            // Testing serving static file
            case "/test.html":
                var page = __dirname + url.pathname;
                fs.readFile(page, function (error, pgResp) {
                    if (error) {
                        response.writeHead(404);
                        response.write('Page not found');
                    } else {
                        response.writeHead(200, { 'Content-Type': 'text/html' });
                        response.write(pgResp);
                    }
                     
                    response.end();
                });
                break;

            case "/getData":
                console.log("getData page requested");
                response.writeHead(200, {'content-type': 'application/json'});
                //response.write("<h2>You've hit home</h2>");
                response.end(JSON.stringify(onRequest(url)));
                break;

            default:
                console.log("Error page reached");
                response.writeHead(404, {'content-type': 'text/html'});
                response.write("<h2>Sorry, page not found</h2>");
                response.end();
        } // end switch statement
    } // End of if statement

}).listen(+portToUse, function() {
    console.log('Now listening on port ' , portToUse);
});
    

var onRequest = function(urlToParse) {
    switch(urlToParse.pathname) {
        case '/home':
            return homePage();
        case '/getData':
            return getData();
    } // end of switch statement
} // end of function

