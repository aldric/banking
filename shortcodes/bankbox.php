<?php
require(__ROOT__.'/widgets/ranking.widget.php');

//[bank-box banks='hellobank|monabanq|ingdirect']
function bankbox_func($atts, $content = null)
{
    $a = shortcode_atts(array(
     'background' => '#fafafa',
     'banks' => '',
      ), $atts);

    $banks_input = $a['banks'];
    $content = '';

    if (strlen($banks_input) == 0) {
        return $content;
    }

    $banks = explode("|", $banks_input);
    $repository = new Bank_Repository();
    $data = $repository->get_banks_data($banks);
    $count = count($data);
    $columns = 12 /  ($count > 0 ? $count : 1);
    $col_css = "col-sm-12 col-md-".$columns;




    $content = '<div class="row">';
    foreach ($data as $bank) {
      $pros_one   = count($bank->pros) == 1 ? $bank->pros[0] : '';
      $pros_two   = count($bank->pros) == 2 ? $bank->pros[1] : '';
      $content .= '<div class="bank-box '.$col_css.'">';
      $content .= '<span class="thumbnail text-center"><img src="'.$bank->icon.'" style="max-width:350px;" alt="Icône"'.$bank->name.' />';
      $content .= '<h1 class="text-danger">'.$bank->name.'</h1>';
      $content .= '<div class="ratings">'.get_stars($bank->mean, '', 'fa-3x', false).'</div>';
      $content .= '<p>'.$pros_one.'</p>';
      $content .= '<p>'.$pros_two.'</p>';
      $content .= '<p>'.$bank->welcome_offer.'</p>';
      $content .= '<p>'.$bank->minimum_wadge.'</p>';
      $content .= get_stars($bank->eval_data[0]['note'], 'fa-users', 'fa-2x', true, 'blue');
      $content .= get_stars($bank->eval_data[1]['note'], 'fa-mobile', 'fa-2x', true, 'green');
      $content .= get_stars($bank->eval_data[2]['note'], 'fa-credit-card', 'fa-2x', true, 'blue');

      $content .= '<a class="btn btn-danger" href="'.$ranking_data->review_link.'"><i class="fa fa-info-circle fa-lg"></i> Revue</a><a class="btn btn-success" href="#"><i class="fa fa-external-link fa-lg"></i> Visiter</a>';
      $content .= '</div>';
    }
    $content .= '</div>';
    return $content;
}

function get_stars($raw_note, $icon = 'fa-check', $size = '', $enclose = true, $color_class = 'gold') {
  $content = '';
  if($enclose)
    $content .= '<p><i class="fa '.$icon.' '.$size.' " aria-hidden="true"></i>';
  $note = (floor($raw_note / 20) * 2) / 2;
  $left = 5 - ((int)$note + 0.5);
  while (0.5 <= $note) {
      $note--;
      $content .= '<i class="fa fa-star '.$size.' '.$color_class.'" ></i>';
  }
  if ($note == 0.5) {
      $content .= '<i class="fa fa-star-half-o '.$size.' '.$color_class.'"></i>';
  }
  while(0 <= $left) {
    $left--;
    $content .= '<i class="fa fa-star-o '.$size.' '.$color_class.'" ></i>';
  }
  if($enclose)
    $content .= '</p>';
  return $content;
}

//http://www.cssscript.com/creating-fast-and-responsive-gauges-with-pure-css/
add_shortcode('bank-box', 'bankbox_func');
/*
<div class="col-md-3 col-sm-6">
    		<span class="thumbnail text-center">
      			<img src="http://placehold.it/350x280" alt="...">
      			<h4 class="text-danger">Toyota Fortuner</h4>
      			<div class="ratings">
                    <span class="glyphicon glyphicon-star"></span>
                    <span class="glyphicon glyphicon-star"></span>
                    <span class="glyphicon glyphicon-star"></span>
                    <span class="glyphicon glyphicon-star"></span>
                    <span class="glyphicon glyphicon-star-empty"></span>
                </div>
      			<p>Uttar Pradesh (North Zone)</p>
      			<p>Registration No :gaadiexpert.com</p>
      			<p>Auction End in 5 days</p>



      			<hr class="line">
      			<div class="row">
      				<div class="col-md-6 col-sm-6">
      					<button type="button" class="btn btn-link">Add to Wishlist</button>
      				</div>
      				<div class="col-md-6 col-sm-6">
      					<button class="btn btn-danger right" > BID NOW</button>
      				</div>

      			</div>
    		</span>
  		</div>
      */
