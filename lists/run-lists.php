<?php

   $otherMetaData = "<title>Run Lists | Pick 4 Me</title>";
   include "../reference/header.php";

   if(!$logged_in) {
     header('Location: ../index.php');
   }

   $listID = $_POST["run-list"];

   $displayQuery = "SELECT * FROM pick4me_table_List WHERE ListID = " . $listID;
   $result = runQuery($displayQuery);
   $row = mysqli_fetch_assoc($result);

   $text_split = explode("||", $row["ListedItems"]);
   $array_length = count($text_split);

   $temp_int = 0;
   $x = 0;

   for($x = 0; $x < ($array_length-1); $x++) {
     $temp_text = $text_split[$x];
     $temp_text_array = explode("|", $temp_text);
     $temp_int += $temp_text_array[1];
   }

   $luckyNumber = rand(1,100);
   $vsLuckyNumber = rand(1,5);

   if($luckyNumber > $vsLuckyNumber) {
     $checkNumber = rand(1, $temp_int);
     $temp_add_num = 0;
     $x = 0;
     while(empty($result_text)) {
       $temp_text = $text_split[$x];
       $temp_text_array = explode("|", $temp_text);
       if($temp_text_array[1] < ($checkNumber - $temp_add_num)) {
         $temp_add_num += $temp_text_array[1];
       } else {
         $result_text = $temp_text_array[0];
       }
     }
   } else {
     $result_text = $_POST["LuckyItem"];
   }
?>

<div class="page-border">
  <div class="run-list">
    <h1><? echo $row["Title"] ?></h1>
    <p> Your result is: </p>
    <p><? echo $result_text ?></p>
  </div>
</div>
</body>
