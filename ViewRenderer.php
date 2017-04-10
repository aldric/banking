<?php

class ViewRenderer {
    public static function render($tpl, $data) {
      ob_start();
      include($tpl);
      $output = str_replace(array("\r", "\n"), '', ob_get_contents());
      ob_end_clean();
      return $output;
    }
  }
