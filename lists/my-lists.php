<?php


   $otherMetaData = "<title>User's Lists | Pick 4 Me</title>";
   include "../reference/header.php";

   if(!$logged_in) {
     header('Location: ../index.php');
   }

   $userID = $_SESSION["UserID"];

   $queryText = "SELECT * FROM pick4me_table_List WHERE UserID = ". $userID;
   $result = runQuery($queryText);


?>

<div class="page-border">
  <div class="row">
    <div class="col-12 right-align">
      <button class=" right-align btn btn-primary" onclick="window.location.href='new-list.php'">Create List</button> <!-- from https://www.geeksforgeeks.org/how-to-create-an-html-button-that-acts-like-a-link/ -->
    </div>
  </div>
  <? //start table here ?>
  <div>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">Delete</th>
          <th scope="col">Run</th>
          <th scope="col">Name</th>
          <th scope="col">Category</th>
          <th scope="col">Last Used</th>
          <th scope="col">Edit</th>
          <th scope="col">Publicize</th>
        </tr>
      </thead>
      <? if($result->num_rows != 0) { ?>
      <tbody>
        <? $i=0;
        while($row = mysqli_fetch_assoc($result)) {
          ?>
          <tr>
            <td>
              <form action="../scripts/delete-list.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="delete-list" id="delete-list" value="<? echo $row["ListID"]?>">
                <button class="btn btn-primary" type="submit" id="delete-list-form" name="delete-list-form">Delete</button>
              </form>
            </td>
            <td>
              <form action="../lists/run-lists.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="run-list" id="run-list" value="<? echo $row["ListID"]?>">
                <button class="btn btn-primary" type="submit" id="run-list-form" name="run-list-form">Run</button>
              </form>
            </td>
            <td>
              <form action="display-list.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="display-list" id="display-list" value="<? echo $row["ListID"]?>">
                <button class="btn" type="submit" id="display-list-form" name="display-list-form"><? echo $row["Title"]?></button>
              </form>
            </td>
            <td><? $categoryText = "SELECT * FROM pick4me_table_Category WHERE CategoryID = " . $row["CategoryIDs"];
            $result2 = runQuery($categoryText);
            $row2 = mysqli_fetch_assoc($result2);
            echo $row2["CategoryName"]; ?></td>
            <td><? echo $row["DateUpdated"]?></td>
            <td>
              <form action="edit-list.php" method="post" enctype="multipart/form-data">
                <input type="hidden" id="edit-list-id" name="edit-list-id" value="<? echo $row["ListID"]?>">
                <input type="hidden" name="edit-type" value="0">
                <button class="btn btn-primary" type="submit" id="edit-list-form" name="edit-list-form">Edit List</button>
              </form>
            </td>
            <td>
              <form action="edit-list.php" method="post" enctype="multipart/form-data">
                <input type="hidden" id="upload-list-id" name="upload-list-id" value="<? echo $row["ListID"]?>">
                <input type="hidden" name="edit-type" value="2">
                <button class="btn btn-primary" type="submit" id="edit-list-form" name="edit-list-form" <? if ($row["Public"] == 1) { ?> disabled <? } ?>>Publicize List</button>
              </form>
            </td>
          </tr>
        <? } ?>
      </tbody>
    </table>
    <? } if($result->num_rows == 0){ ?>
    </table>
    <div class="row">
      <div class="col-12">
        <p>You currently have no lists. Either select Create List or navigate to the Shared Lists Page </p>
      </div>
    </div>
    <? } ?>
  </div>
</div>
</body>
