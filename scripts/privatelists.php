<?php
   //include "/home/loopingt/pick4me.loopingtangent.com/scripts/lists.php";

   class privateLists extends Lists {
     //Properties
     /*
     Inheritted
     public $listID;
     public $title;
     public $category;
     public $public_radio;
     public $luckyItem;
     public $listedItems;
     public $username;
     public $timesUsed;
     */

     // Constructor & Deconstructor
     function __construct($id, $title, $category, $luckyItem, $itemsFinal, $userID) {
       if($id != 0) {
         $this->listID = $id;
       } else {
         $this->listID = 0;
       }
       $this->title = $title;
       $this->category = $category;
       $this->public_radio = 0;
       $this->luckyItem = $luckyItem;
       $this->listedItems = $itemsFinal;
       $this->username = $userID;
       $this->timesUsed = 0;
     }

     // Functions
     function savePrivateList() {
       $result = runQuery("INSERT INTO pick4me_table_List (Title, CategoryIDs, Public, LuckyItem, ListedItems, UserID, TimesUsed, DateAdded, DateUpdated)
                      VALUES ('$this->title', '$this->category', '$this->public_radio', '$this->luckyItem', '$this->listedItems', '$this->username', '$this->timesUsed', CURRENT_TIMESTAMP(), CURRENT_TIMESTAMP())");
     }

     function editPrivateList() {
       $result = runQuery("UPDATE pick4me_table_List SET Title = '$this->title', CategoryIDs = '$this->category', LuckyItem = '$this->luckyItem', ListedItems = '$this->listedItems', DateUpdated = CURRENT_TIMESTAMP() WHERE ListID = '$this->listID'");
     }

     function uploadList() {
       $result = runQuery("UPDATE pick4me_table_List SET Title = '$this->title', CategoryIDs = '$this->category', Public = '1', LuckyItem = '$this->luckyItem', ListedItems = '$this->listedItems', DateUpdated = CURRENT_TIMESTAMP() WHERE ListID = '$this->listID'");
     }
   }

 ?>
