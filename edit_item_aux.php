<?php
          require('database.php');
          $userID = intval($_GET['id']);
          $productID = intval($_GET['productID']);

         
          if(isset($_POST["submit"])) {

            $name = $_POST['productName'];
            $category = $_POST['category'];
            $qty = $_POST['productQuantity'];
            $price = $_POST['price'];
            $description = $_POST['productDescription'];


            $query = "UPDATE Items SET name = '$name', price = '$price', category = '$category', description = '$description'
                    WHERE productID = '$productID';";
            mysqli_query($con, $query);

            $query = "UPDATE Sells SET qty = '$qty' WHERE productID = '$productID';";
            mysqli_query($con, $query);

            
            header("Location: http://localhost/Ecommerce-website/my_product.php?id=$userID"); /* Redirect browser */
            exit();
              
          }
       
?>
