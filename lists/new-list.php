<?php

   $otherMetaData = "<title>New List | Pick 4 Me</title>";
   include "../reference/header.php";

   if(!$logged_in) {
     header('Location: ../index.php');
   }

   if (!empty($_POST)) {
     // define all info going into the list
     $title = $_POST["title"];
     $category = $_POST["category"];
     $public = $_POST["public_radio"];
     if (empty($_POST["luckyItem"])) {
       $luckyItem = "";
     } else {
       $luckyItem = $_POST["luckyItem"];
     }
     $listID = 0;

     // define the number of list Items and put into a function to output one value
     $pageItems = array($_POST["item1"], $_POST["item2"], $_POST["item3"], $_POST["item4"], $_POST["item5"], $_POST["item6"], $_POST["item7"], $_POST["item8"], $_POST["item9"], $_POST["item10"],
                        $_POST["item11"], $_POST["item12"], $_POST["item13"], $_POST["item14"], $_POST["item15"], $_POST["item16"], $_POST["item17"], $_POST["item18"], $_POST["item19"], $_POST["item20"]);
     $pagePriorities = array($_POST["prior-1"], $_POST["prior-2"], $_POST["prior-3"], $_POST["prior-4"], $_POST["prior-5"], $_POST["prior-6"], $_POST["prior-7"], $_POST["prior-8"], $_POST["prior-9"], $_POST["prior-10"],
                        $_POST["prior-11"], $_POST["prior-12"], $_POST["prior-13"], $_POST["prior-14"], $_POST["prior-15"], $_POST["prior-16"], $_POST["prior-17"], $_POST["prior-18"], $_POST["prior-19"], $_POST["prior-20"]);

     $itemsString = "";
     for($x=0; $x < 20; $x++) {
       if(!empty($pageItems[$x])) {
         $temp_listItem = new listedItem($pageItems[$x], $pagePriorities[$x]);
         $temp_text = $temp_listItem->convertToText();
         $itemsString .= $temp_text;
       }
     }

     // runQuery INSERT INTO $result1 = runQuery("INSERT INTO pick4me_table_Users (Username, Email, Password, Satus, LuckyCount, DateAdded, DateUpdated)        VALUES ('$username', '$email', '$password', '0', '0', CURRENT_TIMESTAMP(), CURRENT_TIMESTAMP())");
     if ($public == 0) {
       $private_list = new privateLists($listID, $title, $category, $luckyItem, $itemsString, $_SESSION["UserID"]);
       $private_list->savePrivateList();
     } else {
       $public_list = new publicLists($listID, $title, $category, $luckyItem, $itemsString, $_SESSION["UserID"]);
       $public_list->savePublicList();
     }

     // confirm MESSAGE -> to my-lists page
     $Confirm_Msg = "The list has been created.";
     header('Location: my-lists.php');
   }

   if(!$logged_in) {
     header('Location: ../index.php');
   }
?>

<div class="page-border">
  <h1>Create a New List</h1>
  <form id="create-list" action="" method="post" enctype="multipart/form-data">
    <div class="mb-3">
      <label for="title" class="form-label">Title</label>
      <label id="title_msg" class="form-text err_msg"></label>
      <input type="text" class="form-control" name="title" id="title" placeholder="Enter the title of your List" required>
    </div>
    <div class="mb-3">
      <label for="category" class="form-label">Category</label>
      <label id="cat_msg" class="form-text err_msg"></label>
      <select name="category" id="category" class="form-select">
        <? // this is going to pull all the categories available as a drop down menu once done
          $query_category = "SELECT * FROM pick4me_table_Category";
          $result_category = runQuery($query_category);

          // Found on https://stackoverflow.com/questions/14372860/display-mysql-table-field-values-in-select-box/14372980
          $option = '';
          while($row = mysqli_fetch_assoc($result_category)) {
            $option .= '<option value = "'.$row['CategoryID'].'">'.$row['CategoryName'].'</option>';
          }
          echo $option;
         ?>
      </select>
    </div>
    <div class="mb-3">
      <label id="public_msg" class="form-text err_msg"></label>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="public_radio" id="private" value = "0" checked>
        <label class="form-check-label" for="private">
          Private
        </label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="public_radio" id="public" value = "1">
        <label class="form-check-label" for="public">
          Public
        </label>
      </div>
    </div>
    <div class="mb-3">
      <label for="luckyItem" class="form-label">Lucky Item</label>
      <label id="lucky_msg" class="form-text err_msg"></label>
      <input type="text" class="form-control" name="luckyItem" id="luckyItem" placeholder="Enter your Best Possible Result (optional)">
    </div>
    <div class="mb-3">
      <label for="list" class="form-label">List Items</label>
      <label id="list_msg" class="form-text err_msg"></label>
      <div class="row">
        <div class="col-6">
          <input type="text" class="form-control" name="item1" id="item1" placeholder="Item 1" required>
        </div>
        <div class="col-6">
          <select name="prior-1" id="prior-1" class="form-select">
            <option value="5">High</option>
            <option value="3" selected>Medium</option>
            <option value="1">Low</option>
          </select>
        </div>
      </div>
      <div class="row">
        <div class="col-6">
          <input type="text" class="form-control" name="item2" id="item2" placeholder="Item 2" required>
        </div>
        <div class="col-6">
          <select name="prior-2" id="prior-2" class="form-select">
            <option value="5">High</option>
            <option value="3" selected>Medium</option>
            <option value="1">Low</option>
          </select>
        </div>
      </div>
      <div class="row">
        <div class="col-6">
          <input type="text" class="form-control" name="item3" id="item3" placeholder="Item 3">
        </div>
        <div class="col-6">
          <select name="prior-3" id="prior-3" class="form-select">
            <option value="5">High</option>
            <option value="3" selected>Medium</option>
            <option value="1">Low</option>
          </select>
        </div>
      </div>
      <div class="row">
        <div class="col-6">
          <input type="text" class="form-control" name="item4" id="item4" placeholder="Item 4">
        </div>
        <div class="col-6">
          <select name="prior-4" id="prior-4" class="form-select">
            <option value="5">High</option>
            <option value="3" selected>Medium</option>
            <option value="1">Low</option>
          </select>
        </div>
      </div>
      <div class="row">
        <div class="col-6">
          <input type="text" class="form-control" name="item5" id="item5" placeholder="Item 5">
        </div>
        <div class="col-6">
          <select name="prior-5" id="prior-5" class="form-select">
            <option value="5">High</option>
            <option value="3" selected>Medium</option>
            <option value="1">Low</option>
          </select>
        </div>
      </div>
      <div class="row">
        <div class="col-6">
          <input type="text" class="form-control" name="item6" id="item6" placeholder="Item 6">
        </div>
        <div class="col-6">
          <select name="prior-6" id="prior-6" class="form-select">
            <option value="5">High</option>
            <option value="3" selected>Medium</option>
            <option value="1">Low</option>
          </select>
        </div>
      </div>
      <div class="row">
        <div class="col-6">
          <input type="text" class="form-control" name="item7" id="item7" placeholder="Item 7">
        </div>
        <div class="col-6">
          <select name="prior-7" id="prior-7" class="form-select">
            <option value="5">High</option>
            <option value="3" selected>Medium</option>
            <option value="1">Low</option>
          </select>
        </div>
      </div>
      <div class="row">
        <div class="col-6">
          <input type="text" class="form-control" name="item8" id="item8" placeholder="Item 8">
        </div>
        <div class="col-6">
          <select name="prior-8" id="prior-8" class="form-select">
            <option value="5">High</option>
            <option value="3" selected>Medium</option>
            <option value="1">Low</option>
          </select>
        </div>
      </div>
      <div class="row">
        <div class="col-6">
          <input type="text" class="form-control" name="item9" id="item9" placeholder="Item 9">
        </div>
        <div class="col-6">
          <select name="prior-9" id="prior-9" class="form-select">
            <option value="5">High</option>
            <option value="3" selected>Medium</option>
            <option value="1">Low</option>
          </select>
        </div>
      </div>
      <div class="row">
        <div class="col-6">
          <input type="text" class="form-control" name="item10" id="item10" placeholder="Item 10">
        </div>
        <div class="col-6">
          <select name="prior-10" id="prior-10" class="form-select">
            <option value="5">High</option>
            <option value="3" selected>Medium</option>
            <option value="1">Low</option>
          </select>
        </div>
      </div>
      <div class="row">
        <div class="col-6">
          <input type="text" class="form-control" name="item11" id="item11" placeholder="Item 11">
        </div>
        <div class="col-6">
          <select name="prior-11" id="prior-11" class="form-select">
            <option value="5">High</option>
            <option value="3" selected>Medium</option>
            <option value="1">Low</option>
          </select>
        </div>
      </div>
      <div class="row">
        <div class="col-6">
          <input type="text" class="form-control" name="item12" id="item12" placeholder="Item 12">
        </div>
        <div class="col-6">
          <select name="prior-12" id="prior-12" class="form-select">
            <option value="5">High</option>
            <option value="3" selected>Medium</option>
            <option value="1">Low</option>
          </select>
        </div>
      </div>
      <div class="row">
        <div class="col-6">
          <input type="text" class="form-control" name="item13" id="item13" placeholder="Item 13">
        </div>
        <div class="col-6">
          <select name="prior-13" id="prior-13" class="form-select">
            <option value="5">High</option>
            <option value="3" selected>Medium</option>
            <option value="1">Low</option>
          </select>
        </div>
      </div>
      <div class="row">
        <div class="col-6">
          <input type="text" class="form-control" name="item14" id="item14" placeholder="Item 14">
        </div>
        <div class="col-6">
          <select name="prior-14" id="prior-14" class="form-select">
            <option value="5">High</option>
            <option value="3" selected>Medium</option>
            <option value="1">Low</option>
          </select>
        </div>
      </div>
      <div class="row">
        <div class="col-6">
          <input type="text" class="form-control" name="item15" id="item15" placeholder="Item 15">
        </div>
        <div class="col-6">
          <select name="prior-15" id="prior-15" class="form-select">
            <option value="5">High</option>
            <option value="3" selected>Medium</option>
            <option value="1">Low</option>
          </select>
        </div>
      </div>
      <div class="row">
        <div class="col-6">
          <input type="text" class="form-control" name="item16" id="item16" placeholder="Item 16">
        </div>
        <div class="col-6">
          <select name="prior-16" id="prior-16" class="form-select">
            <option value="5">High</option>
            <option value="3" selected>Medium</option>
            <option value="1">Low</option>
          </select>
        </div>
      </div>
      <div class="row">
        <div class="col-6">
          <input type="text" class="form-control" name="item17" id="item17" placeholder="Item 17">
        </div>
        <div class="col-6">
          <select name="prior-17" id="prior-17" class="form-select">
            <option value="5">High</option>
            <option value="3" selected>Medium</option>
            <option value="1">Low</option>
          </select>
        </div>
      </div>
      <div class="row">
        <div class="col-6">
          <input type="text" class="form-control" name="item18" id="item18" placeholder="Item 18">
        </div>
        <div class="col-6">
          <select name="prior-18" id="prior-18" class="form-select">
            <option value="5">High</option>
            <option value="3" selected>Medium</option>
            <option value="1">Low</option>
          </select>
        </div>
      </div>
      <div class="row">
        <div class="col-6">
          <input type="text" class="form-control" name="item19" id="item19" placeholder="Item 19">
        </div>
        <div class="col-6">
          <select name="prior-19" id="prior-19" class="form-select">
            <option value="5">High</option>
            <option value="3" selected>Medium</option>
            <option value="1">Low</option>
          </select>
        </div>
      </div>
      <div class="row">
        <div class="col-6">
          <input type="text" class="form-control" name="item20" id="item20" placeholder="Item 20">
        </div>
        <div class="col-6">
          <select name="prior-20" id="prior-20" class="form-select">
            <option value="5">High</option>
            <option value="3" selected>Medium</option>
            <option value="1">Low</option>
          </select>
        </div>
      </div>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>
<script>
  window.onload = function(event) {
    document.getElementById("create-list").addEventListener("submit", validateList, false);
  }
  function validateList(event) {
    var elements = event.currentTarget;

    var title = document.getElementById("title").value;

    var luckyItem = document.getElementById("luckyItem").value;

    var item1 = document.getElementById("item1").value;
    var item2 = document.getElementById("item2").value;
    var item3 = document.getElementById("item3").value;
    var item4 = document.getElementById("item4").value;
    var item5 = document.getElementById("item5").value;
    var item6 = document.getElementById("item6").value;
    var item7 = document.getElementById("item7").value;
    var item8 = document.getElementById("item8").value;
    var item9 = document.getElementById("item9").value;
    var item10 = document.getElementById("item10").value;
    var item11 = document.getElementById("item11").value;
    var item12 = document.getElementById("item12").value;
    var item13 = document.getElementById("item13").value;
    var item14 = document.getElementById("item14").value;
    var item15 = document.getElementById("item15").value;
    var item16 = document.getElementById("item16").value;
    var item17 = document.getElementById("item17").value;
    var item18 = document.getElementById("item18").value;
    var item19 = document.getElementById("item19").value;
    var item20 = document.getElementById("item20").value;

    var result = true;

    var general_val = /^[a-zA=Z0-9'\-"$.,)(]*$/;

    document.getElementById("title_msg").innerHTML = "";
    document.getElementById("lucky_msg").innerHTML = "";
    document.getElementById("list_msg").innerHTML = "";

    if (title.length > 50) {
      document.getElementById("title_msg").innerHTML = "Title of List is too long. Must be under 50 char.";
      result = false;
    }
    if (title == null || title == "") {
      document.getElementById("title_msg").innerHTML = "Title must be filled out.";
      result = false;
    }
    if (!general_val.test(title)) {
      document.getElementById("title_msg").innerHTML = "Invalid values entered into title.";
      result = false;
    }
    if (luckyItem.length > 20) {
      document.getElementById("lucky_msg").innerHTML = "Lucky Item is too long. Must be under 20 char.";
      result = false;
    }
    if (!general_val.test(luckyItem)) {
      document.getElementById("title_msg").innerHTML = "Invalid values entered into Lucky Item.";
      result = false;
    }
    if (item1.length > 20 || !general_val.test(item1) || item2.length > 20 || !general_val.test(item2) ||
        item3.length > 20 || !general_val.test(item3) || item4.length > 20 || !general_val.test(item4) ||
        item5.length > 20 || !general_val.test(item5) || item6.length > 20 || !general_val.test(item6) ||
        item7.length > 20 || !general_val.test(item7) || item8.length > 20 || !general_val.test(item8) ||
        item9.length > 20 || !general_val.test(item9) || item10.length > 20 || !general_val.test(item10) ||
        item11.length > 20 || !general_val.test(item11) || item12.length > 20 || !general_val.test(item12) ||
        item13.length > 20 || !general_val.test(item13) || item14.length > 20 || !general_val.test(item14) ||
        item15.length > 20 || !general_val.test(item15) || item16.length > 20 || !general_val.test(item16) ||
        item17.length > 20 || !general_val.test(item17) || item18.length > 20 || !general_val.test(item18) ||
        item19.length > 20 || !general_val.test(item19) || item20.length > 20 || !general_val.test(item20) || ) {
      document.getElementById("list_msg").innerHTML = "One or more list items is/are too long or include invalid characters. Must be under 20 char.";
      result = false;
    }
    if (result == false) {
      event.preventDefault();
    }
  }
</script>
</body>
