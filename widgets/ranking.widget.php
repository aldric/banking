<?php

if (! class_exists('Ranking_Widget')) {
    class Ranking_Widget extends WP_Widget
    {
        public function __construct()
        {
            parent::__construct(
                /*Base ID of your widget*/
                    'agt_bank_ranking',
                    /*Widget name will appear in UI*/
                    __('AGT Bank Ranking Widget', 'supermagpro-child'),
                    /*Widget description*/
                    array( 'description' => __('Bank Ranking', 'supermagpro-child'), )
                );
        }

        public function update($new_instance, $old_instance)
        {
            return $new_instance;
        }

        public function form($instance)
        {
            // $title = esc_attr($instance["title"]);
            echo "<br />";
        }

        public function get_ranking_data($p)
        {
            $ranking_data = null;
            if ($p) {
                $id = $p->ID;
                $name = get_field('bank_name_label', $id);
                $ranking_data  = new RankingData($name, $id);

                if (have_rows('evaluation_criteres', $id)) {
                    $eval_count = 0;
                    $eval_sum = 0;
                    $eval_data = array();
                    while (have_rows('evaluation_criteres', $id)) {
                        the_row();
                        $eval_sum += (int) get_sub_field('valeur_note', $id);
                        $eval_count++;

                        array_push($ranking_data->eval_data, array(
                        "label" => get_sub_field('label_critere', $id),
                        "description" => get_sub_field('description_critere', $id),
                        "note" => get_sub_field('valeur_note', $id)
                    ));
                    }
                    $ranking_data->title = get_field("evaluation_title", $id);
                    $ranking_data->mean = round($eval_sum / $eval_count);
                }
            }
            return $ranking_data;
        }

        public function widget($args, $instance)
        {
            $widget_id = "widget_" . $args["widget_id"];
            $template = get_field('side_template', $widget_id);
            $widget_title = get_field('widget_ranking_title', $widget_id);
            $post_object = get_field('associated_bank');
            $data = $this->get_ranking_data($post_object);
            if ($data != null) {
                include(realpath(dirname(__FILE__)) . "/ranking.widget.view.php");
                $review = new BankReviewJson($data->name,
                                             "Villeneuve d'asq, Lille cedex 9",
                                             "0680606073",
                                             "http://www.example.com/monabanq.jpg",
                                             "Le banque en ligne au meilleur prix",
                                             "https://topbanque.net/linkAffiliate",
                                             round($data->mean / 20, 2),
                                             "Revue de la banque en ligne Monabanq.",
                                             "Ici on pourrait mettre le recap en une ligne de notre avis");
                echo '<script type = "application/ld+json" >'.$review->toJson().'</script>';
            }
        }
    }

    class RankingData
    {
        public $name;
        public $title;
        public $mean;
        public $eval_data = array();

        public function __construct($name, $id)
        {
            $this->name = $name;
            $this->id = $id;
        }
    }
    add_action('widgets_init', function () {
        register_widget("Ranking_Widget");
    });
}
