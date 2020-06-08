<?php
      session_start();
      require('database.php');

      $orderid = (int)$_GET["id"];

      $sql1 = "DELETE FROM Cart WHERE CART.orderID = $orderid";
      $result = $con->query($sql1);

 	    if ($result  === TRUE ) {
           echo "Successfully added to your cart";
       }
 	   else{
 		  echo mysqli_error($con);
 	       }
?>
