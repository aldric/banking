<?php

class Helper {

  public static function get_icon($value)
  {
      return $value == 1 ?  "fa fa-check-circle-o fa-3x" : "fa fa-times fa-3x";
  }

  public static function get_text($value, $text)
  {
      return $value == 1 ?  '<i class="fa fa-check" aria-hidden="true"></i>'.$text : '<i class="fa fa-times" aria-hidden="true"></i><s>'.$text."</s>";
  }

  public static function get_bg($value)
  {
      return $value == 1 ?  "text-success" : "text-danger";
  }
  
}

?>
