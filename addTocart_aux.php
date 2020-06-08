<?php
      session_start();
      require('database.php');
	  
	  //$userId = $_SESSION['userId'];
	  $productid = $_GET["id"];
	  $price = $_GET["price"];
	  
	  $sql1 = "SELECT MAX(o.orderID),o.isCompleted FROM Orders o";
      $result = $con->query($sql1);
	  $row = $result->fetch_assoc();
	  $id = $row["MAX(o.orderID)"];
	  echo "my id ".$id;
	  
      if($id == 0){
		 $sql2 ="INSERT INTO Orders(orderID,isCompleted,isShipped,isDelivered) VALUES ('$id',0,0,0)";
		 $added = $con->query($sql2);
       }
	   else{
		 if($row["o.isCompleted"] == 0){
			 $id = $row['orderID'];
			 
		 }  
		 else{
			 $id = $id + 1;
			 $sql2 ="INSERT INTO Orders(orderID,isCompleted,isShipped,isDelivered) VALUES ('$id',0,0,0)";
			 $added = $con->query($sql2);
		 }
	   }
	  
      $sql3 = "INSERT INTO Cart(orderID,productID,qty,price)
       VALUES ('$id','$productid',1,'$price')";

      if ($con->query($sql3) === TRUE ) {
          echo "Successfully added to your cart";
      }
	  else{
		  echo mysqli_error($con);
	  }
?>