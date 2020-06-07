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
     <a href="index.html">Sign Out </a>
     <a href="cart.html"> My Cart </a>
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

        <!-- <div class="column">
        <div class="card">
         <img src="images/denim.webp" alt="Denim Jeans">
         <p>Tailored Jeans</p>
         <p class="price">$19.99</p>
         <p><button>Add to Cart</button></p>
        </div>
      </div>

      <div class="column">
      <div class="card">
       <img src="images/dress.jpg" alt="Dinner Dress" width="100%;">
       <p>Dinner Dress</p>
       <p class="price">$39.99</p>
       <p><button>Add to Cart</button></p>
      </div>
    </div>

    <div class="column">
    <div class="card">
     <img src="images/jacket.webp" alt="Denim Jeans">
     <p>Men Jacket</p>
     <p class="price">$45.00</p>
     <p><button>Add to Cart</button></p>
    </div>
  </div>

  <div class="column">
  <div class="card">
   <img src="images/nike.jpg" alt="Denim Jeans">
   <p>Nike Men Shoes</p>
   <p class="price">$219.99</p>
   <p><button>Add to Cart</button></p>
  </div>
  </div>

  <div class="column">
  <div class="card">
   <img src="images/summer_dress.jpg" alt="Denim Jeans">
   <p>Summer Dress</p>
   <p class="price">$19.99</p>
   <p><button>Add to Cart</button></p>
  </div>
</div>

 -->

 <?php

   $sql = "SELECT * FROM Items";

   $result = $con->query($sql);

   if($result->num_rows > 0){
   //   <div class="column">
   //   <div class="card">
   //    <img src="images/summer_dress.jpg" alt="Denim Jeans">
   //    <p>Summer Dress</p>
   //    <p class="price">$19.99</p>
   //    <p><button>Add to Cart</button></p>
   //   </div>
   // </div>
    while($row = $result->fetch_assoc()){
       echo "<div class='column'>";
       echo "<div class='card'>";
       echo "<img src='".$row['url']."' alt=''>";
       echo "<p>".$row['name']."</p>";
       echo "<p class='price'>".$row['price']."</p>";
       echo "<p><button>Add to Cart</button></p>";
       echo "</div>";
       echo "</div>";

   }}



    ?>
          </div>



        </div>


  </body>

</html>
