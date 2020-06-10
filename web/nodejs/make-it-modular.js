var fileToInclude = require('./mymodule.js');
var folderPath = process.argv[2];
var fileExtension = process.argv[3];

fileToInclude(folderPath, fileExtension, function(err, list){
    if (err) {
   console.log('An error happened when reading ' + dirPath);
   return err;
 }
 
 list.forEach(function(filename) {
   console.log(filename);
 });
})