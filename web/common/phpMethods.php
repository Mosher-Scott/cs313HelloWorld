<?php
    // Method to validate & sanitize the inputted data sent to it
    function validateInput($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    
    function resetSession(){
        unset($_SESSION['orderDetails']);
    }

    function resetCart() {
        unset($_SESSION['cart']);
        unset($_SESSION['total']);
        unset($_SESSION['qty']);
        unset($_SESSION['amounts']);
        unset($_SESSION['price']);
    }
?>