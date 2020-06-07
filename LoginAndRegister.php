
<html>
<title> LoginAndRegister</title>
<!--  -->
<head></head>
<body>

  <?php
  session_start();
  $servername = "localhost";
  $username = "username";
  $password = "password";
  $dbname = "mb";

  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);
  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }


  if(isset($_POST["register"])){
    $username = $_POST["usernameRegister"];
    $email = $_POST["emailRegister"];
    $accountType = $_POST["accountType"];
    $bankAccount = $_POST["bankAccountRegister"];
    $password = $_POST["password"];

    if($username == '' || $email == '' || $accountType == '' || $bankAccount == ''|| $password == ''){
      echo '<script type="text/javascript"> document.location = "register.html";</script>';
    }
    else {
      $sql1="SELECT MAX(u.userID) FROM Users u";
      $result = $conn->query($sql1);
      $row = $result->fetch_assoc();
      $id = $row["MAX(u.userID)"] + 1;

      $sql2 = "INSERT INTO Users(userID,name, email,password,bankAccountNo,userType)
      VALUES ('$id','$username', '$email', '$password','$bankAccount','$accountType')";

      if ($conn->query($sql2) === TRUE) {
        echo "<script type='text/javascript'> document.location = 'login.html';</script>";
      }
      else {
        echo "<script type='text/javascript'> document.location = 'register.html';</script>";
      }
    }
  }





  if(isset($_GET["login"])){
     $emailOrName = $_GET['username'];
     $password = $_GET['password'];
     $sql1 = "SELECT * FROM Users u WHERE (u.email = '$emailOrName' Or u.name = '$emailOrName')
              AND u.password = '$password' ";
     $result = $conn->query($sql1);

     if($result->num_rows == 0){
       echo "<script type='text/javascript'> document.location = 'login.html'</script>";
     }
     else{
       $row = $result->fetch_assoc();
       if($row['userType'] == "Custom" || $row['userType'] == "Seller"){
         $_SESSION['logged_in'] = true;
         $_SESSION['username'] = $row['name'];
         $_SESSION['userId'] = $row['userID'];
       }
       if($row['userType'] == "Custom"){
          echo "<script type='text/javascript'> document.location = 'home_for_buyers.php';</script>";

       }
       else if($row['userType'] == "Seller"){
         echo "<script type='text/javascript'> document.location = 'home_for_sellers.php';</script>";

       }}

  }


  $conn->close();
  ?>

</body>
</html>
