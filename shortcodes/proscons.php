<?php

class ProsConsModel
{
    public $pros = array();
    public $cons = array();
    public $pros_title;
    public $cons_title;
    public function __construct($pros_title = 'Points positifs',
                                $cons_title = 'Points négatifs',
                                $pros = array(),
                                $cons = array())
    {
        $this->pros_title = $pros_title;
        $this->cons_title = $cons_title;
        $this->pros = $pros;
        $this->cons = $cons;
    }
}
//[proscons bank="fortuneo"]
function proscons_func()
{
    $a = shortcode_atts(array(
      'bank' => '',
      'pros_title' => 'Points positifs',
      'cons_title' => 'Points négatifs',
  ), $atts);

    $repo = new Bank_Repository();
    $bank_input = $a['bank'];
    $bank = explode('|', $bank_input);

    $data = $repo->get_banks_data($bank);
    $out = ViewRenderer::render('proscons.html', new ProsConsModel(
      $a['pros_title'],
      $a['cons_title'],
      $data->pros,
      $data->cons
    ));

    return $out;
}

add_shortcode('proscons', 'proscons_func');
