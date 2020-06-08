const fs = require('fs');

// Set use the process argument, and then set the callback function
fs.readFile(process.argv[2], function(err, data) {

    // If an error happens, do this
    if(err)
        console.log(err);
    else
        // Now save the file data to a new string.  Notice I'm using the 2nd argument in the callback function
        var str = data.toString();

        // Split the string into an array based on a newline character
        var stringArray = str.split('\n');

        // Now get the count of how many objects there are, and subtract 1 since there will be a \n at the end of the file we don't care about
        var length = stringArray.length - 1;

        console.log(length.toString());
});