<?php
require (__ROOT__.'/widgets/ranking.widget.php');

//[bank-box banks='hellobank|monabanq|ingdirect']
function bankbox_func($atts, $content = null)
{
  $a = shortcode_atts( array(
     'background' => '#fafafa',
     'banks' => '',
      ), $atts );

    $banks_input = $a['banks'];
    $content = '';

    if(strlen($banks_input) == 0) return $content;

    $banks = explode("|", $banks_input);
    $repository = new Bank_Repository();
    $data = $repository->get_banks_data($banks);
    $count = count($data);
    $columns = 12 /  ($count > 0 ? $count : 1);
    $col_css = "col-sm-12 col-md-".$columns;

    $content = '<div class="row">';
    foreach ($data as $bank) {
      $content .= '<div class="'.$col_css.'"><div class="well well-lg shade">';
      $content .= $bank->name;
      $content .= '</div></div>';
    }
    $content .= '</div>';
    return $content;
}

add_shortcode('bank-box', 'bankbox_func');
?>
