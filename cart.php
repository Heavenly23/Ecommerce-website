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
     <div id='usernameAndId'></div>
     <a> Sign Out </a>
     <a> My Products </a>
     <a> Add Product </a>
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

      <div class="myCart" >
        <h3> My Cart </h3>

        <!-- <p> Product Name </p>
        <p> Product Price </p>

        <input type="button" id="addProduct" class="cartButton"
        value="Delete" name="addProduct" style="background-color:red;color:white;font-size:22;padding:1%;margin-left:60%;"><br>
        <hr> -->
        <?php

          $sql = "SELECT c.price,I.name,c.productID FROM Cart c,Items I
                  Where c.productID = I.productID";

          $result = $con->query($sql);
          $total_price = 0;
          if($result->num_rows > 0){

           while($row = $result->fetch_assoc()){

              echo "<h2>".$row["name"]."</h2>";
              echo "<h2>".$row["price"]."$</h2>";
              echo "<hr>";
              echo "<input type='button' id='addProduct'onClick='deleteFromMyCart(".$row['productID'].")' class='cartButton' value='Delete' name='addProduct' style='background-color:red;color:white;font-size:22;padding:1%;margin-left:60%;margin-bottom:2%;'><br>";

              $total_price = $total_price + $row['price'];

          }}



         echo "<hr>";
        echo "<h2 style='margin:2%;background-color:'black';color:'white';>TOTAL PRICE :".$total_price."$</h2>";
        echo "<input type='button' id='addProduct' class='cartButton' style='background-color:green;color:white;font-size:22;padding:1%;margin-left:60%;' value='Checkout Product' name='addProduct'/>";

        ?>

</div>
      <script type="text/javascript">
      
        function deleteFromMyCart(productId){
          var request = $.ajax({
              url: 'deleteFromCart.php',
              type: 'GET',
              data: { id: productId}
          });

          request.done(function(data) {
                alert(data);
          });

          request.fail(function(jqXHR, textStatus) {
                alert(jqXHR);
          });

        }
      </script>
</body>
</html>
