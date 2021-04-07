<?php

$otherMetaData = "<title>Sign Up | Pick 4 Me </title>";
include "/home/loopingt/pick4me.loopingtangent.com/reference/header.php";

// include js processing,
// ask for Username, password, email,
// check for username being used previously.
// check for email being used previously.
//
// available only not if logged in

if(!empty($_POST)) {
  $username = $_POST["username"];
  $email = $_POST["email"];
  $password = $_POST["password"];

  $result = runQuery("SELECT * FROM pick4me_table_Users WHERE Username='$username' OR Email='$email'");
  if($result->num_rows != 0) {
    $Err_Msg = "Either the username or the email have been previously used.";
  } else {
    $result1 = runQuery("INSERT INTO pick4me_table_Users (Username, Email, Password, Status, LuckyCount, DateAdded, DateUpdated)
       VALUES ('$username', '$email', '$password', '0', '0', CURRENT_TIMESTAMP(), CURRENT_TIMESTAMP())");
       // at this point, a confirmation email would be sent to the email address provided. clicking the link on the email would run a script
       // updating the value of status to 1.
       $Confirm_Msg = "The account was created. Please log in.";
       header('Location: index.php');
  }
}

if($logged_in) {
  header('Location: ../lists/my-lists.php');
}

?>
 <div class="page-border">
   <h1>Sign Up</h1>
   <? if(isset($Err_Msg)) {?><label for="Err_Msg" class="err_msg"><? echo $Err_Msg ?></label><br/><br/><? } ?>
   <form id="sign-up-form" action="" method="post" enctype="multipart/form-data">
     <div class="mb-3">
       <label for="username" class="form-label"><b>Username</b></label>
       <label id="username_msg" class="form-text err_msg"></label>
       <input type="text" class="form-control" placeholder="Enter Username" name="username" required>
     </div>
     <div class="mb-3">
       <label for="email" class="form-label"><b>Email</b></label>
       <div id="email_msg" class="form-text err_msg"></label>
       <input type="email" class="form-control" placeholder="Enter Email" name="email" required>
     </div>
     <div class="mb-3">
       <label for="password" class="form-label"><b>Password</b></label>
       <label id="pass_msg" class="form-text err_msg"></label>
       <input type="text" class="form-control" placeholder="Enter Password" name="password" required>
     </div>
     <div class="mb-3">
       <label for="con-password" class="form-label"><b>Confirm Password</b></label>
       <label id="con-pass_msg" class="form-text err_msg"></label>
       <input type="text" class="form-control" placeholder="Confirm Password" name="con-password" required>
     </div>
     <div class="mb-3 form-check">
       <label id="ua_msg" class="form-text err_msg"></label>
       <input type="checkbox" name="ua_confirm" class="form-check-input">
       <label for="user_agreement" class="form-check-label"><b>I accept the User Policies. <a href="../company/terms-of-service.php">Link for User Policies</a></b></label>
     </div>
     <button type="submit" class="btn btn-primary">Sign Up</button>
   </form>
  </div>
<script>
      window.onload = function(event){
        document.getElementById("sign-up-form").addEventListener("submit", validateSignUp, false);
      }
      function validateSignUp(event) {
        var elements = event.currentTarget;

        var username = elements[1].value;
        var email = elements[2].value;
        var password = elements[3].value;
        var con-password = elements[4].value;
        var ua_confirm = elements[5].value;

        var result = true;

        var general_val = /^[a-zA=Z0-9'\-"$.,)(]*$/;

        document.getElementById("username_msg").innerHTML = "";
        document.getElementById("email_msg").innerHTML = "";
        document.getElementById("pass_msg").innerHTML = "";
        document.getElementById("con-pass_msg").innerHTML = "";
        document.getElementById("ua_msg").innerHTML="";

        if(username == null || username == "" || !general_val.test(username)) {
          document.getElementById("username_msg").innerHTML="Username is empty or invalid. No Spaces Allowed.";
          result = false;
        }
        if(email == null || email == "") {
          document.getElementById("email_msg").innerHTML="Email is invalid or empty";
          result = false;
        }
        if(password == null || password == "" || !general_val.test(password)) {
          document.getElementById("pass_msg").innerHTML = "Password is invalid or empty";
          result = false;
        }
        if(con-password != password) {
          document.getElementById("con-pass_msg").innerHTML = "Passwords do not match";
          result = false;
        }
        if(ua_confirm.checked != true) {
          document.getElementById("ua_msg").innerHTML = "Please confirm agreement to User Policies.";
        }
        if (result == false) {
          event.preventDefault();
        }
      }
</script>
</body>
