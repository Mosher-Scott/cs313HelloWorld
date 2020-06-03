// The script that runs when a user changes the password -->

function checkPassword()
{

    // Element ID holding the original password
    var passwordElement = 'passwordInput';

    // Element ID holding the 2nd password
     var confirmationpasswordElement = 'passwordConfirmationInput';


    // Element ID to hold the message about passwords not matching
    var passwordMessageElement = 'passwordCheck';

    // Currently entered password
    var userPassword = document.getElementById(passwordElement).value;

    var secondPassword = document.getElementById(confirmationpasswordElement).value;

    // If the passwords don't match, display the text. If they match, hide the message
    if (userPassword != secondPassword) {
        document.getElementById('errorThing').innerHTML = '******** Passwords do not match';
        
        document.getElementById('errorThing').classList = 'display: inline';
        document.getElementById('errorThing').classList = 'text-danger';
    } else {
        document.getElementById('errorThing').classList = 'display: hidden';
    }

    
}        