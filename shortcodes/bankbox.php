<?php

//[bank-box banks='hellobank|monabanq|ingdirect' col-xsmall=1 col-small=2 col-large=3 welcome_offer=true conditions=true pros='0,1' notes='0,1,2,3' notes-icons='fa-lock, fa-money, fa-users, fa-mobile']
function bankbox_func($atts, $content = null)
{
    $a = shortcode_atts(array(
     'background' => '#fafafa',
     'banks' => '',
     'col-xsmall' => 1,
     'col-small' => 2,
     'col-large' => 3,
     'welcome_offer' => true,
     'conditions' => true,
     'pros' => '',
     'notes' => '0,1,2,3',
     'notes-icons' => 'fa-lock, fa-money, fa-users,fa-mobile'
      ), $atts);

    $banks_input = $a['banks'];
    $xs_col = 'col-xs-'. (12 / $a['col-xsmall']);
    $sm_col = 'col-sm-'. (12 /  $a['col-small']);
    $lg_col = 'col-md-'. (12 / $a['col-large']);
    $welcome_offer = $a['welcome_offer'];
    $conditions = $a['conditions'];
    $pros = explode(",", $a['pros']);
    $notes = explode(",", $a['notes']);
    $icons = explode(",", $a['notes-icons']);

    $content = '';
    $banks = explode("|", $banks_input);
    $repository = new Bank_Repository();
    $data = $repository->get_banks_data($banks);

    $col_css = $xs_col.' '.$sm_col.' '.$lg_col;

    $model = [
             "banks"=> $data,
             "welcomeOffer" => $welcome_offer,
             "conditions" => $conditions,
             "pros" => $pros,
             "colCss" => $col_css,
             "notes" => $notes,
             "icons" => $icons
           ];
   $content .= '<script type="text/javascript"> var bankBoxes=' .json_encode($model, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES).';</script>';
   $content .= ViewRenderer::render('bankbox.html', $model);
   return $content;
}
add_shortcode('bank-box', 'bankbox_func');
