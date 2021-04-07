<?php

   $otherMetaData = "<title>Shared Lists | Pick 4 Me</title>";
   include "../reference/header.php";

   if(!$logged_in) {
     header('Location: ../index.php');
   }

   $queryText = "SELECT * FROM pick4me_table_List
     WHERE Public = 1";
   $result = runQuery($queryText);


?>

<div class="page-border">
  <? //start table here ?>
  <div>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">Run </th>
          <th scope="col">Name</th>
          <th scope="col">Category</th>
          <th scope="col">Creator</th>
          <th scope="col">Times Used</th>
          <th scope="col">Download</th>
        </tr>
      </thead>
      <? if($result->num_rows != 0) { ?>
      <tbody>
        <? $i=0;
        while($row = mysqli_fetch_assoc($result)) {
          ?>
          <tr>
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
            <td><? $usernameText = "SELECT * FROM pick4me_table_Users WHERE UserID = " . $row["UserID"];
            $result3 = runQuery($usernameText);
            $row3 = mysqli_fetch_assoc($result3);
            echo $row3["Username"]; ?> </td>
            <td><? echo $row["TimesUsed"]?></td>
            <td>
              <form action="edit-list.php" method="post" enctype="multipart/form-data">
                <input type="hidden" id="edit-list-id" name="edit-list-id" value="<? echo $row["ListID"]?>">
                <input type="hidden" name="edit-type" value="1">
                <button class="btn btn-primary" type="submit" id="edit-list-form" name="edit-list-form">Download</button>
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
        <p>There are currently no Shared Lists available. Please return to the My Lists page and create a list to continue.</p>
      </div>
    </div>
    <? } ?>
  </div>
</div>
</body>
