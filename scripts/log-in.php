<?php
  if(! empty($_POST)){
    $Username = $_POST["Username"];
    $Password = $_POST["Password"];

    $result = runQuery("SELECT * FROM pick4me_table_Users WHERE Username='$Username' AND Password='$Password'");
    if($result->num_rows == 0) {
      $Error_Msg = "Either the Username or Password are Incorrect!";
    } else {
      $_SESSION["User_ID"] = mysqli_fetch_assoc($result)["User_ID"];
      header('Location: ../index.php');
    }
  }
?>
