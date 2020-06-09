const fs = require('fs');
var path = require('path')

// Save arguments
var folder = process.argv[2];
var filter = '.' + process.argv[3]; // Add the . to the extension

// Now we're adding this to a function
function getFileList(folder, filter, callback) {
    // path is the path to search.  list is the list returned by the readdir method
    fs.readdir(folder, function (err, list) {
        //console.log(list);

        // If an error happens, return it
        if (err)
            return callback(err);

        list = list.filter(function (file) {
            return path.extname(file) === '.' + filter
        });

        callback(null, list);
    }) // end of callback function
}

getFileList(folder, filter, function (err, fileList) {
    if (err)
        return console.error('Ooops, something happened. It was this: ' , err)

    list.forEach(function (file) {
        console.log(file);
    }) // End of foreach
})
