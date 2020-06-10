var scott = {
    favFood: "bacon",
    favMovie: "Airplane!"
};

// Everything is a reference
// THis is not creating a copy of scott. It is referencing scott.  So when you change person, you change scott
var person = scott;

scott.favFood = "ice cream";

console.log(person.favFood);

// == or === equal sign?
// Only compares values
console.log(19 == '19');

// This compares values AND type
console.log(19 === '19');