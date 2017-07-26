<?php //[tableau titre="" responsive="true" class="table-striped | table-bordered | table-hover | table-condensed" style='']
function tables_short_code_func($atts, $content = null) {
  $a = shortcode_atts(array(
    'titre' => '',
    'responsive' => true,
    'class' => '',
    'style' => ''
  ), $atts);

  $caption = $a['titre'];
  $has_caption = strlen($caption) > 0;
  $is_responsive =  $a['responsive'] == 'true';
  $table_class = 'table '.$a['class'];
  $inline_style = strlen($a['style']) > 0 ? 'style="'.$a['style'].'"' : '';

  $output = '';
  if($is_responsive)
    $output .= '<div class="table-responsive">';

    $output .= '<table class="'.$table_class.'" '.$inline_style.'>';

  if($has_caption)
    $output .= '<caption>'.$caption.'</caption>';

  $output .= do_shortcode($content);

    $output .= '</table>';

  if($is_responsive)
    $output .= '</div>';

  return $output;
}

function tables_entetes_short_code_func($atts, $content = null) {
  $a = shortcode_atts(array(
    'class' => '',
    'style' => ''
  ), $atts);
  $table_class =  strlen($a['class']) > 0 ? 'class="'.$a['class'].'"' : '';
  $inline_style = strlen($a['style']) > 0 ? 'style="'.$a['style'].'"' : '';

  $output = '<thead><tr '.$table_class.' '.$inline_style.'>';
  $output .= do_shortcode($content);
  $output .= '</tr></thead>';
  return $output;
}

function tables_entete_short_code_func($atts, $content = null) {
  $a = shortcode_atts(array(
    'class' => '',
    'style' => '',
    'rowspan' => ''
  ), $atts);
  $table_class  =  strlen($a['class']) > 0 ? 'class="'.$a['class'].'"' : '';
  $inline_style = strlen($a['style']) > 0 ? 'style="'.$a['style'].'"' : '';
  $rowspan      = strlen($a['rowspan']) > 0 ? 'rowspan="'.$a['rowspan'].'"' : '';

  $output = '<th '.$table_class.' '.$inline_style.' '.$rowspan.' >';
  $output .= do_shortcode($content);
  $output .= '</th>';
  return $output;
}
function tables_line_short_code_func($atts, $content = null) {
  $a = shortcode_atts(array(
    'class' => '',
    'style' => ''
  ), $atts);
  $table_class =  strlen($a['class']) > 0 ? 'class="'.$a['class'].'"' : '';
  $inline_style = strlen($a['style']) > 0 ? 'style="'.$a['style'].'"' : '';

  $output = '<tr '.$table_class.' '.$inline_style.'>';
  $output .= do_shortcode($content);
  $output .= '</tr>';
  return $output;
}

function tables_cell_short_code_func($atts, $content = null) {
  $a = shortcode_atts(array(
    'class' => '',
    'style' => '',
    'rowspan' => '',
    'colspan' => ''
  ), $atts);
  $table_class =  strlen($a['class']) > 0 ? 'class="'.$a['class'].'"' : '';
  $inline_style = strlen($a['style']) > 0 ? 'style="'.$a['style'].'"' : '';
  $rowspan      = strlen($a['rowspan']) > 0 ? 'rowspan="'.$a['rowspan'].'"' : '';
  $colspan      = strlen($a['colspan']) > 0 ? 'colspan="'.$a['colspan'].'"' : '';

  $output = '<td '.$table_class.' '.$inline_style.' '.$rowspan.' '.$colspan.' >';
  $output .= do_shortcode($content);
  $output .= '</td>';
  return $output;
}
//[b-image bank="" class="" style="" size="small medium large" title="" alt=""]
function bank_image_short_code_func($atts, $content = null) {
  $a = shortcode_atts(array(
    'bank' => '',
    'class' => '',
    'style' => '',
    'size'  => 'small',
    'title' => '',
    'alt'   =>''
  ), $atts);
  $bank = $a['bank'];
  $table_class =  strlen($a['class']) > 0 ? 'class="'.$a['class'].'"' : '';
  $inline_style = strlen($a['style']) > 0 ? 'style="'.$a['style'].'"' : '';
  $title = strlen($a['title']) > 0 ? 'title="'.$a['title'].'"' : '';
  $alt = strlen($a['alt']) > 0 ? 'alt="'.$a['alt'].'"' : '';
  $size = $a['size'];

  $source = '/banques/';
  if($size == 'large')
    $source .= '512/';
  else if($size == 'medium')
    $source .= '225/';
  else if($size == 'small')
    $source .= '32/';
  $source .= $bank . '.png';

  $output = '<img '.$table_class.' '.$inline_style.' src="'.$source.'" '.$title.' '.$alt.' />';
  return $output;
}

//[b-icon]
function bank_icon_short_code_func($atts, $content = null) {
  $a = shortcode_atts(array(
    'size' => '1.5em',
    'icon'  => 'ok',
    'color' => 'success',
    'display' => 'inline'
  ), $atts);
  $class =  $a['class'];
  $display = strlen($a['display']) >0 ? 'display:' .$a['display'].';' : '';
  $size  =  'style="font-size:'.$a['size'].'; '.$display .' "';
  $icon  = 'glyphicon glyphicon-'.$a['icon'];
  $color = 'text-'.$a['color'];
//    display: inline;
  $output = '<span class="'.$icon.' '.$color.'"  '.$size.'" aria-hidden="true"></span>';
  return $output;
}

add_shortcode('tableau', 'tables_short_code_func');
add_shortcode('entetes', 'tables_entetes_short_code_func');
add_shortcode('entete', 'tables_entete_short_code_func');
add_shortcode('ligne', 'tables_line_short_code_func');
add_shortcode('cellule', 'tables_cell_short_code_func');
add_shortcode('b-image', 'bank_image_short_code_func');
add_shortcode('b-icon', 'bank_icon_short_code_func');

?>
