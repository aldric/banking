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

        public function get_icon($value)
        {
            return $value == 1 ?  "fa fa-check-circle-o fa-3x" : "fa fa-times fa-3x";
        }
        public function get_bg($value)
        {
            return $value == 1 ?  "alert-success" : "alert-danger";
        }
        public function get_bgcolor($value)
        {
            return $value == 1 ?  "#3c763d" : "#a94442";
        }

        public function get_ranking_data($p)
        {
            $ranking_data = null;
            if ($p) {
                $id = $p->ID;
                $name = get_field('bank_name_label', $id);
                $ranking_data  = new RankingData($name, $id);

                $ranking_data->address = get_field("address", $id);
                $ranking_data->icon = get_field("bank_icon", $id);
                $ranking_data->image = get_field("bank_image", $id);
                $ranking_data->holding_label = get_field("holding_label", $id);
                $ranking_data->holding_name = get_field("holding", $id);
                $ranking_data->holding_image = get_field("holding_image", $id);
                $ranking_data->customer_count_label = get_field("numbers_of_customers_label", $id);
                $ranking_data->customer_count = get_field("numbers_of_customers", $id);

                $ranking_data->review_link = get_field("review_link", $id);
                $ranking_data->review_link_text = get_field("review_link_text", $id);

                $ranking_data->welcome_offer = get_field("welcome_offer", $id);
                $ranking_data->minimum_wadge = get_field("minimum_wadge", $id);
                $ranking_data->credit_card = get_field("numbers_of_customers", $id);

                $ranking_data->young_offer = get_field("young_offer", $id);
                $ranking_data->prof_account = get_field("prof_account", $id);
                $ranking_data->saving_account = get_field("saving_account", $id);
                $ranking_data->revolving_credit = get_field("revolving_credit", $id);
                $ranking_data->mortgage = get_field("mortgage", $id);
                $ranking_data->credit_rebuy = get_field("credit_rebuy", $id);
                $ranking_data->life_insurance = get_field("life_insurance", $id);
                $ranking_data->car_insurance = get_field("car_insurance", $id);
                $ranking_data->home_insurance = get_field("home_insurance", $id);
                $ranking_data->other_insurance = get_field("other_insurance", $id);
                $ranking_data->stock = get_field("stock", $id);


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
            $post_object = get_field('associated_bank');
            $data = $this->get_ranking_data($post_object);
            $widget_title = get_field('widget_ranking_title', $widget_id).' '. $data->name;
            if ($data != null) {
                include(realpath(dirname(__FILE__)) . "/ranking.widget.view.php");
                $review = new BankReviewJson($data->name,
                                             $data->address,
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
        public $address;

        public $icon;
        public $image;
        public $holding_image;
        public $review_link;
        public $review_link_text;

        public $holding_label;
        public $holding_name;
        public $customer_count_label;
        public $customer_count;

        public $welcome_offer;
        public $minimum_wadge;
        public $credit_card;

        public $young_offer;
        public $prof_account;
        public $saving_account;
        public $revolving_credit;
        public $mortgage;
        public $credit_rebuy;
        public $life_insurance;
        public $car_insurance;
        public $home_insurance;
        public $other_insurance;
        public $stock;


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
