<?php
  class Lists {
    //Properties
    public $listID;
    public $title;
    public $category;
    public $public_radio;
    public $luckyItem;
    public $listedItems;
    public $userID;
    public $timesUsed;

    //Constructor & Destructor
    function __construct() {
      $this->listID = 0;
      $this->title = "";
      $this->category = "";
      $this->public_radio = -1;
      $this->luckyItem = "";
      $this->listedItems = "";
      $this->userID = 0;
      $this->timesUsed = -1;
    }

    //Functions to Be Inheritted
  }


 ?>
