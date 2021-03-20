<?php

   include "../scripts/DBConnecton.php";

   if ($_SESSION["User_ID"]){
      $logged_in = true;
   } else {
      $logged_in = false;
   }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
  <link rel="stylesheet" href="style/web_style.css">
  <? if (isset($otherMetaData))
         echo $otherMetaData;
  ?>
</head>
<body>
  <div class="header-div-shape row">
    <div class="col-4">
      <a href="../index.php"><img class="logo-header" src="../images/Pick4MeLogo.png"/></a>
    </div>
    <? if ($logged_in) {?>
      <div class="col-4 row header-padding">
        <div class="col-6">
          <p><a class="header-link" href="../lists/my-lists.php">My Lists</a></p>
        </div>
        <div class="col-6">
          <p><a class="header-link" href="../lists/shared-lists.php">Shared Lists</a></p>
        </div>
      </div>
      <div class="col-4">
        <div class="dropdown header-padding right-align">
          <button class="dropbtn"><a class="header-link" href="../user/profile.php">Username</a></button>
          <div class="dropdown-content">
            <a class="header-link" href="../logout.php">Logout</a>
          </div>
        </div>
      </div>
    </div>
  <? } else {?>
    <div class="col-8 header-padding">
      <div class="dropdown right-align">
        <button class="dropbtn">Log In / Sign Up</button>
        <div class="dropdown-content">
          <p class="header-login-text">Log In</p>
          <form class="login-dropdown" action="../scripts/log-in.php" method="post" enctype="multipart/form-data">
            <label for="Username">Username</label>
            <input type="text" placeholder="Username" name="Username" required>
            <label for="Password">Password</label>
            <input type="text" placeholder="Password" name="Password" required>
            <button type="submit"> Log In </button>
          </form>
          <p class="sign-up-header-text">No Account? <a class="header-link" href="../sign-up.php">Sign Up</a> here.</p>
        </div>
      </div>
    </div>
  <? }
  if($Error_Msg){?>
      <div class="Error_Msg">
        <p><? echo $Error_Msg; ?></p>
      </div>
  <?};?>
  </div>


<!-- </body>
</html> -->
