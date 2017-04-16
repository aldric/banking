<?php
//[bankranking display="all"]
function bankranking_func($atts)
{
    $a = shortcode_atts(array(
        'banks' => '',
        'sort' => 'desc'
    ), $atts);
    $repo = new Bank_Repository();
    $banks_input = $a['banks'];
    $banks = explode("|", $banks_input);

    $data = $repo->get_banks_data($banks);
    usort($data, "cmp");
    if ($a['sort'] == 'asc') {
        array_reverse($data);
    }
    $banks_model = new RankingModel($data);
    $out = '<script type="text/javascript"> var ranking=' .json_encode($banks_model, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES).';</script>';
    $out .= ViewRenderer::render('ranking.html', new RankingModel($data));
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
