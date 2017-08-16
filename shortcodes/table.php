<?php //[tableau titre="" responsive="true" class="table-striped | table-bordered | table-hover | table-condensed" style='']

function _build_attr($attributes, $name, $postfix = '') {
  $val = $attributes[$name];
  return strlen($val) > 0 ? $name.'="'.$val.$postfix.'"' : '';
}

function tables_short_code_func($atts, $content = null) {
  $a = shortcode_atts(array(
    'titre' => '',
    'responsive' => true,
    'class' => '',
    'style' => '',
    'id' => ''
  ), $atts);

  $caption = $a['titre'];
  $has_caption = strlen($caption) > 0;
  $is_responsive =  $a['responsive'] == 'true';
  $table_class = 'table '.$a['class'];
  $inline_style = strlen($a['style']) > 0 ? 'style="'.$a['style'].'"' : '';
  $table_id = strlen($a['id']) > 0 ? 'id="'.$a['id'].'"' : '';
  
  $output = '';
  if($is_responsive)
    $output .= '<div class="table-responsive">';

    $output .= '<table class="'.$table_class.'" '.$inline_style.' '.$table_id.'>';

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

//[b-icon icon="ok" color="success" size="1.5em"]
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
  $output = '<span class="'.$icon.' '.$color.'"  '.$size.'" aria-hidden="true"></span>';
  return $output;
}

//[h-img class="cb-comp-img" title="Logo Boursorama Banque" src="/cards/boursorama-225.png" alt="Logo Boursorama Banque" ]
function html_image_short_code_func($atts, $content = null) {
  $a = shortcode_atts(array(
    'class' => '',
    'title'  => '',
    'src' => '',
    'alt' => ''
  ), $atts);
  $class =  strlen($a['class']) > 0 ? 'class="'.$a['class'].'"' : '';
  $title =  strlen($a['title']) > 0 ? 'title="'.$a['title'].'"' : '';
  $source =  strlen($a['src']) > 0 ? $a['src'] : '';
  $alt =  strlen($a['alt']) > 0 ? 'alt="'.$a['alt'].'"' : '';
  
  $output = '<img '.$class.' '.$title.' src="'.$source.'" '.$title.' '.$alt.' />';
  return $output;
}

//[b-video width="" height="" src=""]
function video_short_code_func($atts, $content = null) {
  $a = shortcode_atts(array(
    'class' => 'embed-responsive',
    'ratio' => 'embed-responsive-16by9',
    'width'  => '',
    'height' => '',
    'src' => ''
  ), $atts);
  $src     = _build_attr($a,'src');
  $width   = _build_attr($a,'width','px');
  $height  = _build_attr($a,'height','px');
  $class   = _build_attr($a,'class', ' '.$a['ratio']);
  $i_class  = _build_attr($a,'class', '-item');
  
  $output = '<div '.$class.'><iframe '.$src.' '.$width.' '.$height.' '.$i_class.' allowfullscreen></iframe></div>';
  return $output;
}

//[aff-link bank="monabanq" text="Text a afficher" color="default ou primary ou success ou info ou warning ou link", size="xs ou sm ou lg (facultatif par default taille normale)"]
function afflink_short_code_func($atts, $content = null) {
  $a = shortcode_atts(array(
    'bank'  => '',
    'text' => 'Visiter',
    'color' => 'link',
    'role' => 'button',
    'size' => ''
  ), $atts);
  
  $affiliates = array(
    'monabanq' => 'https://clk.tradedoubler.com/click?p=200547&a=2973410'
  );

  $bank  = $a['bank'];
  $text  = $a['text'];
  $color = 'btn btn-'.$a['color'];
  $size  =  strlen($a['size']) > 0 ? 'btn-'.$a['size'] : ''; 
  $role  = _build_attr($a,'role');
  $style = $color.' '.$size;
  $link = $affiliates[$bank];
  
  $output = '<a class="'.$style.'" href="'.$link.'" '.$role.' target="_blank" rel="nofollow">'.$text.'</a>';
  return $output;
}

add_shortcode('tableau', 'tables_short_code_func');
add_shortcode('entetes', 'tables_entetes_short_code_func');
add_shortcode('entete', 'tables_entete_short_code_func');
add_shortcode('ligne', 'tables_line_short_code_func');
add_shortcode('cellule', 'tables_cell_short_code_func');
add_shortcode('b-image', 'bank_image_short_code_func');
add_shortcode('b-icon', 'bank_icon_short_code_func');
add_shortcode('h-img', 'html_image_short_code_func');
add_shortcode('b-video', 'video_short_code_func');
add_shortcode('aff-link', 'afflink_short_code_func');

?>
