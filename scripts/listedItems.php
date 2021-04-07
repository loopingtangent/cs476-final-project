<?php
  class listedItem {
    //Properties
    public $listItem;
    public $priority;

    //Constructor & Deconstructor
    function __construct($item, $prior) {
      $this->listItem = $item;
      $this->priority = $prior;
    }

    //Functions
    function convertToText() {
      $text = $this->listItem . "|" . $this->priority . "||";
      return $text;
    }

  }

  class multipleItems {
    //Properties
    public $items = array(""); //as an array
    public $num_items;

    //Constructor & Deconstructor
    function __constructor($array_items, $array_length) {
      $this->items = $array_items;
      $this->num_itmes = $array_length;
    }

    //Functions
    function convertFromText($text) {
      $text_split = array(explode("||", $text));
      $array_length = count($text_split);
      $i = 0;

      for($i = 0; $i < $array_length; $i++) {
        $temp_text = $text_split[$x];
        $temp_text_array = array(explode("|", $temp_text));
        $temp_item = new listedItem($temp_text_array[0],$temp_text_array[1]);
        $tempItems[$x] = $temp_item;
      }
      $returnMultipleItems = new multipleItems($tempItems, $array_length);
      return $returnMultipleItems;
    }

    function convertToText() {
      $return_text = "";
      for($x = 0; $x < $this->num_items; $x++) {
        $temp_Item = new listedItem($this->items[$x]->listItem, $this->items[$x]->priority);
        $temp_text = $temp_Item->convertToText();
        $return_text = $return_text + $temp_text;
      }
      return $return_text;
    }

    function totalPriorities() {
      $return_integer = 0;
      for($x=0; $x < $this->num_items; $x++) {
        $return_integer += $this->items[$x]->priority;
      }
      return $return_integer;
    }
  }
?>
