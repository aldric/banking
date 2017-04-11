<?php
//[bankranking display="all"]
function bankranking_func($atts)
{
    $a = shortcode_atts(array(
        'display' => '',
        'sort' => 'desc'
    ), $atts);
    $repo = new Bank_Repository();
    $data = $repo->get_banks_data($a['display']);
    usort($data, "cmp");
    if ($a['sort'] == 'asc') {
        array_reverse($data);
    }
    //var_dump($data);
    $out = ViewRenderer::render('ranking.html', new RankingModel($data));
    return $out;
}

function cmp($a, $b)
{
    if ($a->mean == $b->mean) {
        return 0;
    }
    return ($a->mean < $b->mean) ? -1 : 1;
}

class RankingModel
{
    public $banks;
    public $offer = array();
    public function __construct($banks)
    {
        $this->banks = $banks;
        $o = array();

        foreach ($banks as $bank) {
            foreach ($bank->offer as $key => $value) {
                array_push($o, $key);
            }
        }
        $this->offer = array_unique($o);
    }
}

add_shortcode('bankranking', 'bankranking_func');
