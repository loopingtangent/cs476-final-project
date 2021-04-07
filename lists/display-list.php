<?php

   $otherMetaData = "<title>List | Pick 4 Me</title>";
   include "../reference/header.php";

   if(!$logged_in) {
     header('Location: ../index.php');
   }

   $listID = $_POST["display-list"];

   $displayQuery = "SELECT * FROM pick4me_table_List WHERE ListID = " . $listID;
   $result = runQuery($displayQuery);

 ?>

 <div class="page-border">
   <? $row = mysqli_fetch_assoc($result); ?>
   <h1><? echo $row["Title"] ?></h1>
   <form action="run-list.php" method="post" enctype="multipart/form-data">
     <input type="hidden" name="run-list" id="run-list" value="<? echo $row["ListID"]?>">
     <button class="btn btn-primary" type="submit" id="display-list-form" name="display-list-form">Run This List</button>
   </form>
   <table class="table">
     <tbody>
       <tr>
         <td scope="row">Creator</td>
         <td><? $usernameText = "SELECT * FROM pick4me_table_Users WHERE UserID = " . $row["UserID"];
         $result3 = runQuery($usernameText);
         $row3 = mysqli_fetch_assoc($result3);
         echo $row3["Username"];?></td>
       </tr>
       <tr>
         <td scope="row">Category</td>
         <td>
           <? $categoryText = "SELECT * FROM pick4me_table_Category WHERE CategoryID = " . $row["CategoryIDs"];
           $result2 = runQuery($categoryText);
           $row2 = mysqli_fetch_assoc($result2);
           echo $row2["CategoryName"]; ?>
         </td>
       </tr>
       <tr>
         <td scope="row">List Type</td>
         <td>
           <? if ($row["Public"] == 0) {
             echo "Private";
           } else {
             echo "Public";
           }
           ?>
         </td>
       </tr>
       <tr>
         <td scope="row">Lucky Item</td>
         <td><? echo $row["LuckyItem"] ?></td>
       </tr>
       <tr>
         <td scope="row" colspan="2">Listed Items</td>
       </tr>
       <tr>
         <td colspan="2">
           <table class="table">
             <thead>
               <tr>
                 <td scope="col">Item</td>
                <td scope="col">Priority</td>
              </tr>
            </thead>
            <tbody>
              <? $text_split = explode("||", $row["ListedItems"]);
              $array_length = count($text_split);

              $x = 0;

              for($x = 0; $x < ($array_length-1); $x++) {
                $temp_text = $text_split[$x];
                $temp_text_array = explode("|", $temp_text);
                ?>
                <tr>
                  <td><? echo $temp_text_array[0]?></td>
                  <td><?
                  if ($temp_text_array[1] == 1) {
                    echo "Low";
                  } else if ($temp_text_array[1] == 3) {
                    echo "Medium";
                  } else {
                    echo "High";
                  }?></td>
                </tr>
              <? } ?>
            </tbody>
          </table>
        </td>
       </tr>
       <tr>
       <? if ($row["Public"] == 0) {
         ?>
         <td scope="col">Last Updated</td>
         <td><? echo $row["DateUpdated"] ?></td>
       <? } else {
         ?>
         <td scope="col">Times Used</td>
         <td><? echo $row["TimesUsed"]?></td>
       <? } ?>
       </tr>
     </tbody>
   </table>
 </div>
</body>
