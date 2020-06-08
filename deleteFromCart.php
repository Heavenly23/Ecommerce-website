<?php
      session_start();
      require('database.php');
	  
	  //$userId = $_SESSION['userId'];
	  $productid = (int)$_GET["id"];
	  echo $productid;
     
	  $sql1 = "DELETE FROM Cart WHERE CART.productID = $productid";
      $result = $con->query($sql1);
	  if ($result  === TRUE ) {
          echo "Successfully added to your cart";
      }
	  else{
		  echo mysqli_error($con);
	  }
	  
	  
	  
	  
?>