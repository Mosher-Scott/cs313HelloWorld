const fs = require('fs');
var path = require('path')


module.exports = function(folder, filter, callback) {
    // Create an array to hold the values of everything we found
    var foundFiles = [];

    // path is the path to search.  list is the list returned by the readdir method
    fs.readdir(folder, function (err, list) {
        //console.log(list);

        // If an error happens, return it
        if (err)
            return callback(err);

        list.forEach(function (file) {
            if (path.extname(file) === '.' + filter) {
                foundFiles.push(file);
            }
        });

        callback(null, foundFiles);
    }) // end of callback function

}