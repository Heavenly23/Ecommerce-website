<html>
<title> Welcome_page</title>
<!--  -->
<head></head>
<body>

  <?php
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
  echo "Connected successfully";

  if(isset($_POST["register"])){
    $username = $_POST["usernameRegister"];
    $email = $_POST["emailRegister"];
    $accountType = $_POST["accountType"];
    $bankAccount = $_POST["bankAccountRegister"];
    $password = $_POST["password"];

    if($username == '' || $email == '' || $accountType == '' || $bankAccount == ''|| $password == ''){
      echo "<script> alert('Please fill in all the required inputs!') </script>";
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
        echo "<script> alert(You are successfully registered!) </script>";
      }
      else {
        echo "<script type='text/javascript'> document.location = 'register.html';</script>";
        echo "<script> alert(Not Successful registration!) </script>";
        //echo "Error: " . $sql . "<br>" . $conn->error
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
       echo "<script type='text/javascript'>alert('No account found with the given credentials!'') </script>";
       echo "<script type='text/javascript'> document.location = 'login.html'</script>";

     }
     else{
       $row = $result->fetch_assoc();
       if($row['userType'] == "Custom"){
          echo "<script type='text/javascript'> document.location = 'home_for_buyers.html';</script>";
  echo "<script type='text/javascript'> document.getElementById('usernameAndId').InnerHTML = 'Hello';</script>";
       }
       else if($row['userType'] == "Seller"){
          echo "<script type='text/javascript'> document.location = 'home_for_sellers.html';</script>";
       }}

  }


  $conn->close();
  ?>

</body>
</html>
