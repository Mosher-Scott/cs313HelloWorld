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

    function buildProductDisplay($products) {

        $itemsPerRow = 0;
        
        foreach($products as $item) {
            if($itemsPerRow / 3 == 1) {
              echo "</div>";
              echo "</div>";
              $itemsPerRow = 0;
            }

            // Start of a new row of products
            if ($itemsPerRow == 0) {
              echo "<div class='container centered'>";
              // Start a new row of 4 products
              echo "<div class='row'>";
            }

              // Now setup individual products
              // Product div start
              echo "<div class='col-sm'>";

              echo "<h4>{$item['name']}</h4>"; // Title
              echo "<img class='product-thumbnail' src='images/{$item['image_name']}' alt='Mountain Bike Image'>"; // Image
              echo "<p>$ {$item['price']}</p>"; // Price
              echo "<p><a href='?add={$item['id']}' class='btn btn-primary'>Add to Cart</a></p>"; // Add to cart button
              
              echo "</div>"; // Product div end
              $itemsPerRow++;
          }

    }
?>