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

    <div class="top_nav_bar">
       <a style="color:white;float:left;"> Hi! <?php echo $_SESSION['username']; ?></a>
       <a href="index.php"> Sign Out </a>
       <a id="my_product" href="my_product.html"> My Products </a>
       <a id="add_product" href="add_product.php?id="> Add Product </a>
       <a id="home_for_sellers" href="#"> Profile </a>
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
          <h2 class="text-center"> Add Product </h2>

          <form id="myForm" method="post" action="add_product.php" enctype="multipart/form-data">
                     <lable> Product Name <span>*</span> </lable><br>
                     <input type="text" id="productName" name="productName" required><br><br>

                     <lable> Category <span>*</span> </lable><br>
                     <input type="text" id="type" list="category" name="category"autocomplete="off" required>

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
                     <input type="number" id="productQuantity" name="productQuantity" min="1" max="20" required><br><br>

                     <lable> Price per product <span>*</span> </lable><br>
                     <input type="number" min="1" id="price" name="price" required><br><br>

                      <lable> Product Description <span>*</span> </lable><br>
                     <textarea type="text" id="productDescription" name="productDescription" rows="4" cols="50" required></textarea><br><br>

                     <lable> Warehouse Address <span>*</span> </lable><br>
                     <input type="text" id="type" list="street" name="street" placeholder=" Street" required><br><br>

                     <lable> City <span>*</span> </lable><br>
                     <input type="text" id="type" list="city" name="city" required><br><br>

                     <lable> State <span>*</span> </lable><br>
                     <input type="text" id="type" list="state" name="state" required><br><br>

                     <lable> Zip Code <span>*</span> </lable><br>
                     <input type="text" id="type" list="zipCode" name="zipCode" required><br><br>

                     <lable> Country <span>*</span> </lable><br>
                     <input type="text" id="type" list="country" name="country" required><br><br>

                     <span><input type="file"  id="fileToUpload" name="fileToUpload" value="Choose Image" onchange="readURL(this);" required>
                      <br>
                      <input type="submit" class="btn btn-primary" id="addProduct" style="float:right;border-radius:15px;" value="ADD PRODUCT" name="submit" required>
                      </span>
            </form>
       </div>

      <div class="productImage">
          <div class="card" >
               <img id="outputIMG" src="">
          </div>
      </div>

      <?php
          require('database.php');
          $userID = intval($_GET['id']);
      ?>

      <script type="text/javascript">
        $("#outputIMG").hide();
        $(document).ready(function(){
            var userID = "<?php echo $userID ?>";
            var url = "uploadFiles.php?id=" + userID;
            document.getElementById('myForm').action = url;

            var url1 = "add_product.php?id=" + userID;
            $('#add_product').attr('href','').attr('href',url1);
            var url2 = "my_product.php?id=" + userID;
            $('#my_product').attr('href','').attr('href',url2);
            var url3 = "home_for_sellers.php?id=" + userID;
            $('#home_for_sellers').attr('href','').attr('href',url3);

        });

        function readURL(input) {
          if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
              $("#outputIMG").attr("src", e.target.result).width(250).height(310);
              $("#outputIMG").show();

            };

            reader.readAsDataURL(input.files[0]);
            posterIMG = input.files[0];
          }
      }

      </script>

  </body>

</html>
