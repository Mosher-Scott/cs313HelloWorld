const fs = require('fs');
var path = require('path')

// Save arguments
var folder = process.argv[2];
var filter = '.' + process.argv[3]; // Add the . to the extension

// path is the path to search.  list is the list returned by the readdir method
fs.readdir(folder, function (err, list) {
    //console.log(list);

    if (err)
        console.log(err);
    else    
        list.forEach(function(file) {
            if (path.extname(file) === filter) {
                console.log(file)
            }
        }) // end of forEach
}) // end of callback function
