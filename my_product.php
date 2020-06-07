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

   <div class="top_nav_bar">

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
      <li style="background-color:black;margin-top:0%;">  <a id="paneName"> ALL CATEGORIES </a></li>
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

      <div class="myProducts" >
        <h1> <strong>My Products </strong></h1>

        <?php  
          require('database.php');

          $userID = intval($_GET['id']);

          $query = "SELECT productID FROM Sells WHERE userID = $userID";

          $result = mysqli_query($con, $query);

          $posts = mysqli_fetch_all($result, MYSQLI_ASSOC);

          mysqli_free_result($result);

          if (count($posts) < 1){
              echo "You have <strong>No</strong> Products for Sale";
          }
          else{

            foreach ($posts as $post) {
                $query = 'SELECT * FROM Items WHERE productID ='. $post['productID'];

                $result = mysqli_query($con, $query);

                $products = mysqli_fetch_all($result, MYSQLI_ASSOC);
                mysqli_free_result($result);

                foreach($products as $product):  

                  $query = 'SELECT * FROM Sells WHERE productID ='. $post['productID'];

                  $result = mysqli_query($con, $query);

                  $a = mysqli_fetch_assoc($result);
                  mysqli_free_result($result); ?>

                  <div class="column">
                      <div class="card">
                         <img src="<?php echo $product['url'] ?>" >
                         <p><?php echo $product['name'] ?></p>
                         <p class="price">$<?php echo $product['price'] ?></p>
                         <p><button id="<?php echo $product['productID'] ?>" style="background-color:Green" onclick="goToPage(this)">Edit</button>
                           <button style="background-color:brown" id="myproduct"><?php echo $a['qty'] ?> qty Left</button></p>
                      </div>
                  </div>
                <?php endforeach;

            } 
          } ?>
      
          </div>

          <script type="text/javascript">
            function goToPage(self){
              var td = event.target;
              const id = td.id;

              window.location.href = 'editItem.php?id='+id;
            }
          </script>
  </body>

</html>