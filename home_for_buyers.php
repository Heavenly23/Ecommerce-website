<?php session_start();?>
<!doctype html>
<html>

<head>

  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

  <!-- jQuery library -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

  <!-- Latest compiled JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

  <link rel="stylesheet" href="CSS/index.css">

</head>

<body>

  <?php
     require('database.php');
   ?>

   <div class="top_nav_bar">
     <a style="color:white;float:left;"> Hi! <?php echo $_SESSION['username']; ?></a>
     <a href="index.php">Sign Out </a>
     <a href="cart.php"> My Cart </a>
     <a> Profile </a>

     </div>

     <div class = "top_second_nav_bar">
          <a id="logo"> <b> OUR STORE </b></a>
          <input id="search" type="text" placeholder="Search ...">
       </div>

    <div class= "pane">

      <ul>
      <li style="background-color:black;margin-top:0%;">  <a id="paneName"> ALL CATAGORIES </a></li>
       <li><a> Clothing </a></li>
       <li><a> Accessories/Shoes </a></li>
       <li><a> Food </a></li>
       <li><a> Beauty/Hair </a></li>
       <li><a> Computer </a></li>
       <li><a> Home Appliances </a></li>
       <li><a> Health/Diet </a></li>
       <li><a> Motors/Tools </a></li>
       <li><a> Sport </a></li>
       <li><a> Electronics </a></li>
         </ul>

      </div>

      <div class="products" >

 <?php

   $sql = "SELECT * FROM Items";

   $result = $con->query($sql);

   if($result->num_rows > 0){

    while($row = $result->fetch_assoc()){
       echo "<div class='column'>";
       echo "<div class='card'>";
       echo "<img src='".$row['url']."' alt=''>";
       echo "<p>".$row['name']."</p>";
       echo "<p class='price'>".$row['price']."$</p>";
       echo "<p><button onClick ='return goToMyCart(".$row['productID'].",".$row['price'].");' >Add to Cart</button></p>";
       echo "</div>";
       echo "</div>";
   }
 }



    ?>
          </div>



        </div>

        <script type="text/javascript">
          function goToMyCart(productId,price){
            
            var request = $.ajax({
                url: 'addTocart_aux.php',
                type: 'GET',
                data: { id: productId, price: price}
            });

            request.done(function(data) {
                  alert("Successfully added to your cart!");
            });

            request.fail(function(jqXHR, textStatus) {
                  alert("Connection Error! report!");
            });

          }
        </script>
  </body>

</html>
