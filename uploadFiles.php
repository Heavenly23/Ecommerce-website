<?php
          require('database.php');
          $userID = intval($_GET['id']);

          $target_dir = "images/$userID/";
          
          // Check if image file is a actual image or fake image
          if(isset($_POST["submit"])) {

            $name = $_POST['productName'];
            $category = $_POST['category'];
            $qty = $_POST['productQuantity'];
            $price = $_POST['price'];
            $description = $_POST['productDescription'];

            $street = $_POST['street'];
            $city = $_POST['city'];
            $state = $_POST['state'];
            $country = $_POST['country'];
            $zipCode = $_POST['zipCode'];

            $target_file = $target_dir.basename($_FILES["fileToUpload"]["name"]);

            $query = 'SELECT COUNT(productID) AS `count` FROM Items;';
            $result = mysqli_query($con, $query);
            $row = mysqli_fetch_assoc($result);
            $count = $row['count'];
            $productID = $count + 1;


            $query = "INSERT INTO Items (productID, name, price, category, description, url)
                    VALUES ('$productID', '$name', '$price', '$category', '$description', '$target_file');";
            mysqli_query($con, $query);

            $query = "INSERT INTO Sells (userID, productID, qty, country, zipCode, street)
                    VALUES ('$userID', '$productID', '$qty', '$country', '$zipCode', '$street');";
            mysqli_query($con, $query);

            $query = "INSERT INTO ZipCode (zipCode, country, city, state)
                    VALUES ('$zipCode', '$country', '$city', '$state');";
            mysqli_query($con, $query);


            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if($check !== false) {
              $uploadOk = 1;
            } 
            else {
              $uploadOk = 0;
            }         

            // Check file size
            if ($_FILES["fileToUpload"]["size"] > 500000) {
              echo "Sorry, your file is too large.";
              $uploadOk = 0;
            }

            // Allow certain file formats
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" ) {
              echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
              $uploadOk = 0;
            }

            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
              echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
            } else {
              if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
                header("Location: http://localhost/Ecommerce-website/home_for_sellers.php?id=$userID"); /* Redirect browser */
                exit();
              } else {
                echo "Sorry, there was an error uploading your file.";
              }
            }
          }
      ?>
