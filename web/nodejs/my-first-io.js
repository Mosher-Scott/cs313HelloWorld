// You need the fs module for this to work
const fs = require('fs');

// Use fs to read a file synchonisly and return it as a buffer object
var contents = fs.readFileSync(process.argv[2], {encoding: 'utf8', flag:'r'});


// Now save the file data to a new string
var str = contents.toString();


// Split the string into an array based on a newline character
var stringArray = str.split('\n');

// Now get the count of how many objects there are, and subtract 1 since there will be a \n at the end of the file we don't care about
var length = stringArray.length - 1;

console.log(length.toString());