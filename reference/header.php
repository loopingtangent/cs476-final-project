<?php

   include "scripts/DBConnecton.php";

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
  <? if (isset($otherMetaData)) echo $otherMetaData;?>
</head>
<body>
  <div class="header-div-shape row">
    <div class="col-4">
      <a href="../index.php"><img class="logo-header" src="images/logo.png"/></a>
    </div>
    <? if ($logged_in) {>
    <div class="col-4 row"> 
      <div class="col-6">
        <p>My Lists</p>
      </div>
      <div class="col-6">
        <p>Shared Lists</p>
      </div>
    </div>
    <div class="col-4">
      <-- this is turning into a drop down menu when I get a chance -->
      <div class="row profile-header">
        <div class="col">
          <img class="profile-pic-header" src="images/placeholder_profile.png">
        </div>
        <div class="profile-options-header col">
          <p><a href="../user/index.php"><? echo $User_Username; ?></a></p>
          <p><a href="../options.php">Options</p>
          <p><a href="/logout.php">Log Out</a></p>
        </div>
      </div>
    </div><? } else {?>
    <div class="col-4">
       <p> </p>
    </div>
    <div class="col-4">
      <div class="profile-options-header">
         <-- I'm also gonna need the same drop-down function for the login info -->
        <p><a href="../log-in.php">Log In</a> | <a href="../sign-up.php">Sign Up</a></p>
      </div>
    </div><? } ?>
  </div>

  
<!-- </body>
</html> -->
