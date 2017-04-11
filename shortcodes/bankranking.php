<?php
//[bankranking display="all"]
function bankranking_func($atts)
{

   $a = shortcode_atts( array(
        'display' => '',
        'sort' => 'desc'
    ), $atts );
    $repo = new Bank_Repository();
    $data = $repo->get_banks_data($a['display']);
    usort($data,"cmp");
    if($a['sort'] == 'asc') {
      array_reverse($data);
    }
    //var_dump($data);
    $out = ViewRenderer::render('ranking.html', $data);
    return $out;
}

function cmp($a, $b)
{
    if ($a->mean == $b->mean) {
        return 0;
    }
    return ($a->mean < $b->mean) ? -1 : 1;
}

add_shortcode('bankranking', 'bankranking_func');

?>
