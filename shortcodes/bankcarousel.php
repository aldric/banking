<?php
require(__ROOT__. '/widgets/ranking.widget.php');
//[bankcarousel]
// [bank-slide bank='hellobank' background='#fafafa' title='Le meilleur de hellobank' cover-title='En bref' cover-text='' button-text='Voir la revue' button-type='default|primary|success|info|warning|danger|link' button-icon='fa-star']
function bankcarousel_func($atts, $content = null)
{
  $sliderid = 'slider-'.rand();
  $content = '<div id="'.$sliderid.'">'.do_shortcode($content).'</div>';

  $content .= '<script type="text/javascript">
    jQuery(document).ready(function(){
      jQuery("#'.$sliderid.'").bxSlider({
        controls: true,
        prevText : \'<i class="fa fa-chevron-circle-left fa-3x" aria-hidden="true"></i>\',
        nextText : \'<i class="fa fa-chevron-circle-right fa-3x" aria-hidden="true"></i>\',
        slideMargin: 10,
        auto: true
      });
    });
    </script>
  ';
  return $content;
}

function bankslide_func($atts, $content = null)
{
  $a = shortcode_atts( array(
     'background' => '#fafafa',
     'bank' => '',
     'title' => '',
     'cover-title' => '',
     'cover-text' => '',
     'button-text' => 'Voir la revue',
     'button-type' => 'success',
     'button-icon' => 'fa-star'

 ), $atts );

 $bg = $a['background'];
 $bank = $a['bank'];
 $title = $a['title'];
 $cover_title = $a['cover-title'];
 $cover_text = $a['cover-text'];
 $button_text = $a['button-text'];
 $button_type = $a['button-type'];
 $button_icon = $a['button-icon'];

 $repository = new Bank_Repository();
 $data = $repository->get_bank_data($bank);

 if($data == null)
    return $content;

  $credit_card = $data->credit_card == '' ? '&nbsp;' : $data->credit_card;
  $welcome_offer = $data->welcome_offer == '' ? '&nbsp;' : $data->welcome_offer;

  $pros_one   = count($data->pros) == 1 ? $data->pros[0] : '&nbsp;';
  $pros_two   = count($data->pros) == 2 ? $data->pros[1] : '';

 $content .= '<div class="slide" style="background:'.$bg.';">
   <div class="row" >
     <div class="col-sm-2 col-md-4 m-auto">
               <div class="text-center slide-image">
                   <img src="'.$data->icon.'"></img>
               </div>
           </div>
           <div class="col-sm-10 col-md-8">
             <div class="text-center">
                 <h2>'.$title.'</h2>
             </div>
               <ul class="faul">
                   <li class="cc"><span>Carte de cr&eacute;dit : '.$credit_card.'</span></li>
                   <li class="gift"><span>'.$welcome_offer.'</span></li>
                   <li class="check"><span>'.$pros_one.'</span></li>
                   <li class="check"><span>'.$pros_two.'</span></li>
               </ul>
               <div class="text-center"><a class="btn btn-lg btn-'.$button_type.'" href="#"><i class="fa '.$button_icon.' fa-2x"></i><span style="vertical-align: super;">'.$button_text.'</span></a></div>             </div>
           </div>
           <div class="carousel-overlay">
             <h2>'.$cover_title.'</h2>
             <p>'.$cover_text.'</p>
           </div>
  </div>';

 return $content;
}

add_shortcode('bankcarousel', 'bankcarousel_func');
add_shortcode('bank-slide', 'bankslide_func');
?>
