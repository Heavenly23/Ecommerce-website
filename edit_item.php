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

      <div class="addProduct">

      <div class="productInfo">
        <h1> <strong>Edit Products </strong></h1>

        <?php 
        require('database.php');

        $productID = intval($_GET['id']);

        $query = 'SELECT * FROM Items WHERE productID ='. $productID;

                $result = mysqli_query($con, $query);

                $product = mysqli_fetch_assoc($result);
                mysqli_free_result($result);

                $query = 'SELECT * FROM Sells WHERE productID ='. $productID;

                $result = mysqli_query($con, $query);

                $a = mysqli_fetch_assoc($result);
                mysqli_free_result($result); ?>

        <form id="myForm" method="post" action="edit_product.php" enctype="multipart/form-data">
                     <lable> Product Name <span>*</span> </lable><br>
                     <input type="text" id="productName" name="productName" value="<?php echo $product['name'] ?>"><br><br>
                     
                     <lable> Category <span>*</span> </lable><br>
                     <input type="text" id="type" list="egory" name="category"autocomplete="off" value="<?php echo $product['category'] ?>">
                     
                     <datalist id="category" >
                         <option value="Clothing">
                         <option value="Accessories/Shoes">
                         <option value="Food">
                         <option value="Beauty/Hair">
                         <option value="Home Appliances">
                         <option value="Health/Diet">
                         <option value="Sport">
                         <option value="Electronics">
                     </datalist><br><br>

                     <lable> Quantity <span>*</span> </lable><br>
                     <input type="number" id="productQuantity" name="productQuantity" min="1" max="20" value="<?php echo $a['qty'] ?>"><br><br>
                    
                     <lable> Price per product <span>*</span> </lable><br>
                     <input type="number" min="1" id="price" name="price" value="<?php echo $product['price'] ?>"><br><br>
                     
                      <lable> Product Description <span>*</span> </lable><br>
                     <textarea type="text" id="productDescription" name="productDescription" rows="4" cols="50" placeholder="<?php echo $product['description'] ?>"></textarea><br><br>
                                          
                     
                      <input type="submit" class="btn btn-primary" id="addProduct" style="float:right;border-radius:15px;" value="Save Changes" name="submit" required> 
                      </span>
            </form>
      
      </div>

      <div class="productImage">
          <div class="card">
               <img id="outputIMG" src="<?php echo $product['url'] ?>">
          </div>
      </div>
          
      <script type="text/javascript">
        $(document).ready(function(){ 
            var productID = "<?php echo $productID ?>";
            var url = "edit_items_aux.php?id=" + productID;
            document.getElementById('myForm').action = url;
        });
      </script>
  </body>

</html>