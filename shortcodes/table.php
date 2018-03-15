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

//[aff-link name="monabanq" text="Text a afficher" color="default ou primary ou success ou info ou warning ou link", size="xs ou sm ou lg (facultatif par default taille normale)" style="width:600px;"]
function afflink_short_code_func($atts, $content = null) {
  $a = shortcode_atts(array(
    'name'  => '',
    'text' => 'Visiter',
    'color' => 'link',
    'role' => 'button',
    'size' => '',
    'style' => ''
  ), $atts);
 

  $name  = $a['name'];
  $text  = $a['text'];
  $color = 'btn btn-'.$a['color'];
  $size  =  strlen($a['size']) > 0 ? 'btn-'.$a['size'] : ''; 
  $role  = _build_attr($a,'role');
  $style  = _build_attr($a,'style');
  $class = $color.' '.$size;
  $link = '/visite/'.$name;
  
  $output = '<a class="'.$class.'" href="'.$link.'" '.$role.' '.$style.' target="_blank" rel="nofollow">'.$text.'</a>';
  return $output;
}

//[aff-image name="monabanq" image="01.gif"]
function affimage_short_code_func($atts, $content = null) {
  $a = shortcode_atts(array(
    'name'  => '',
    'image' => '01'
  ), $atts);
 
  $name  = $a['name'];
  $link = '/visite/'.$name;
  $image = '/images/'.$name.'/'.$a['image'];
  $output = '<a href="'.$link.'" target="_blank" rel="nofollow"><img src="'.$image.'"></img></a>';
  return $output;
}

//[aff-button name="" style="width:600px;" title="" text="", size="", type="", url="", new_window="False", nofollow="True"]
//[maxbutton  name="" style="width:600px;"]
function affbutton_short_code_func($atts, $content = null) {
  $a = shortcode_atts(array(
    'name'  => '',
    'text' => '',
    'title' => '',
    'url' => '',
    'type' => '',
    'role' => '',
    'size' => '',
    'new_window' => '',
    'nofollow' => '',
    'style' => '',
    'role' => 'button'
  ), $atts);
  $output = '';
  $data = get_field('affiliate_button', 'option');
  $search = $a['name'];
  
  $result = array_filter($data == null ? array() : $data, function($item) use ($search) {
      if ($item['name'] == $search) {
          return true;
      }
      return false;
  }, ARRAY_FILTER_USE_BOTH);
  
    $button = reset($result);
    $url = strlen($a['url']) > 0 ? $a['url'] : $button['url']; 
    $text = strlen($a['text']) > 0 ? $a['text'] : $button['text']; 
    $title = strlen($a['title']) > 0 ? $a['title'] : $button['title']; 
    $type = strlen($a['type']) > 0 ? $a['type'] : $button['type']; 
    $size = strlen($a['size']) > 0 ? $a['size'] : $button['size']; 
    $new = strlen($a['new_window']) > 0 ? $a['new_window'] : $button['new_window']; 
    $nof = strlen($a['nofollow']) > 0 ? $a['nofollow'] : $button['nofollow']; 

    $role  = _build_attr($a,'role');
    $style  = _build_attr($a,'style');
    $target = is_bool($new) && $new ? '_blank' : $new; 
    $rel = is_bool($nof) && $nof ? 'nofollow' : $nof; 
    $class = $type.' '.$size;
    $output = '<a class="btn  '.$class.'" href="'.$url.'" '.$role.' '.$style.' target="'.$target.'" rel="'.$rel.'" title="'.$title.'">'.$text.'</a>';
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
add_shortcode('aff-image', 'affimage_short_code_func');
add_shortcode('aff-button', 'affbutton_short_code_func');
//add_shortcode('maxbutton', 'affbutton_short_code_func');

?>
