<?php
  include "/home/loopingt/pick4me.loopingtangent.com/scripts/DBConnection.php";

  if(! empty($_POST)){
    $Username = $_POST["Username"];
    $Password = $_POST["Password"];

    $result = runQuery("SELECT * FROM pick4me_table_Users WHERE Username='$Username' AND Password='$Password'");
    if($result->num_rows == 0) {
      $_SESSION["Error_Msg"] = "Either the Username or Password are Incorrect!";
    } else {
      while($object = mysqli_fetch_assoc($result)){
        $_SESSION["UserID"] = $object["UserID"];
        $_SESSION["Username"] = $object["Username"];
        $_SESSION["Status"] = $object["Status"];
        $_SESSION["LuckyCount"] = $object["LuckyCount"];
      }
    }
    header('Location: ../lists/my-lists.php');
  }
?>
