<?php

if (!class_exists('Bank_Repository')) {
    class Bank_Repository
    {
        public function __construct()
        {
        }

        public function get_bank_data($bank_name)
        {
            $the_query = new WP_Query(array(
            'post_type' => 'fiche_banque',
            'name' => $bank_name,
        ));
            $data;
            if ($the_query->have_posts()) {
                global $post;
                while ($the_query->have_posts()) {
                    $the_query->the_post();
                    setup_postdata($post);
                    $data = $this->get_ranking_data($post);
                }
                wp_reset_postdata();
            }

            return $data;
        }

        public function get_banks_data($bank_name_array)
        {
            $the_query = new WP_Query(array(
            'post_type' => 'fiche_banque',
            'post_name__in' => $bank_name_array,
        ));
            $data = array();

            if ($the_query->have_posts()) {
                global $post;
                while ($the_query->have_posts()) {
                    $the_query->the_post();
                    setup_postdata($post);
                    array_push($data, $this->get_ranking_data($post));
                }
                wp_reset_postdata();
            }

            return $data;
        }

        private function coerse_null_value($value, $default_value)
        {
            return $value == null ? $default_value : $value;
        }

        private function get_ranking_data($p)
        {
            $ranking_data = null;
            if ($p) {
                $id = $p->ID;
                $name = get_field('bank_name_label', $id);
                $ranking_data = new RankingData($name, $id);

                $ranking_data->favicon = get_field('bank_favicon', $id);
                $ranking_data->icon = get_field('bank_icon', $id);
                $ranking_data->image = get_field('bank_image', $id);

                $ranking_data->address = get_field('address', $id);
                $ranking_data->bank_phone = $this->coerse_null_value(get_field('bank_phone', $id), '');

                $ranking_data->holding_label = get_field('holding_label', $id);
                $ranking_data->holding_name = get_field('holding', $id);
                $ranking_data->holding_image = get_field('holding_image', $id);
                $ranking_data->customer_count_label = get_field('numbers_of_customers_label', $id);
                $ranking_data->customer_count = get_field('numbers_of_customers', $id);

                $ranking_data->review_link = get_field('review_link', $id);
                $ranking_data->review_link_text = get_field('review_link_text', $id);

                $ranking_data->welcome_offer = get_field('welcome_offer', $id);
                $ranking_data->minimum_wadge = get_field('minimum_wadge', $id);
                $ranking_data->credit_card = get_field('credit_card', $id);

                $ranking_data->opinion_title = get_field('avis_title', $id);
                $ranking_data->opinion_text = get_field('avis_resume', $id);

                $ranking_data->affiliate_link = get_field('affiliate_link', $id);

                $ranking_data->young_offer = $this->coerse_null_value(get_field('young_offer', $id), 0);
                $ranking_data->prof_account = $this->coerse_null_value(get_field('prof_account', $id), 0);
                $ranking_data->saving_account = $this->coerse_null_value(get_field('saving_account', $id), 0);
                $ranking_data->revolving_credit = $this->coerse_null_value(get_field('revolving_credit', $id), 0);
                $ranking_data->mortgage = $this->coerse_null_value(get_field('mortgage', $id), 0);
                $ranking_data->credit_rebuy = $this->coerse_null_value(get_field('credit_rebuy', $id), 0);
                $ranking_data->life_insurance = $this->coerse_null_value(get_field('life_insurance', $id), 0);
                $ranking_data->car_insurance = $this->coerse_null_value(get_field('car_insurance', $id), 0);
                $ranking_data->home_insurance = $this->coerse_null_value(get_field('home_insurance', $id), 0);
                $ranking_data->other_insurance = $this->coerse_null_value(get_field('other_insurance', $id), 0);
                $ranking_data->stock = $this->coerse_null_value(get_field('stock', $id), 0);

                $apps = get_field('mobile_apps', $id);
                $apps = is_array ($apps) ? $apps : array();
                $ranking_data->mobile_apps['iOS'] = array_search('iOS', $apps) > -1;
                $ranking_data->mobile_apps['Android'] = array_search('Android', $apps)> -1;
                $ranking_data->mobile_apps['Windows'] = array_search('Windows', $apps) > -1;

                $ranking_data->offer[ 'Compte courant'] = $ranking_data->saving_account;
                $ranking_data->offer[ 'Offre jeune'] = $ranking_data->young_offer;
                $ranking_data->offer[ 'Compte professionnel'] = $ranking_data->prof_account;
                $ranking_data->offer[ 'Crédit à la consommation' ] = $ranking_data->revolving_credit;
                $ranking_data->offer[ 'Crédit immobilier' ] = $ranking_data->mortgage;
                $ranking_data->offer[ 'Rachat de crédit' ] = $ranking_data->credit_rebuy;
                $ranking_data->offer[ 'Assurance vie' ] = $ranking_data->life_insurance;
                $ranking_data->offer[ 'Assurance automobile' ] = $ranking_data->car_insurance;
                $ranking_data->offer[ 'Assurance habitation' ] = $ranking_data->home_insurance;
                $ranking_data->offer[ 'Autre assurance' ] = $ranking_data->other_insurance;
                $ranking_data->offer[ 'Bourse en ligne' ] = $ranking_data->stock;

                if (have_rows('points_forts', $id)) {
                    while (have_rows('points_forts', $id)) {
                        the_row();
                        array_push($ranking_data->pros, get_sub_field('point_fort', $id));
                    }
                }

                if (have_rows('points_faibles', $id)) {
                    while (have_rows('points_faibles', $id)) {
                        the_row();
                        array_push($ranking_data->cons, get_sub_field('point_faible', $id));
                    }
                }

                if (have_rows('evaluation_criteres', $id)) {
                    $eval_count = 0;
                    $eval_sum = 0;
                    $eval_data = array();
                    while (have_rows('evaluation_criteres', $id)) {
                        the_row();
                        $eval_sum += (int) get_sub_field('valeur_note', $id);
                        ++$eval_count;

                        array_push($ranking_data->eval_data, array(
                      'label' => get_sub_field('label_critere', $id),
                      'description' => get_sub_field('description_critere', $id),
                      'note' => get_sub_field('valeur_note', $id),
                    ));
                    }
                    $ranking_data->title = get_field('evaluation_title', $id);
                    $ranking_data->mean = round($eval_sum / $eval_count);
                }
            }

            return $ranking_data;
        }
    }

    class RankingData
    {
        public $name;
        public $title;
        public $address;
        public $bank_phone;

        public $favicon;
        public $icon;
        public $image;
        public $holding_image;
        public $review_link;
        public $review_link_text;
        public $affiliate_link;

        public $holding_label;
        public $holding_name;
        public $customer_count_label;
        public $customer_count;

        public $welcome_offer;
        public $minimum_wadge;
        public $credit_card;
        public $opinion_title;
        public $opinion_text;

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
        public $app_android;
        public $app_ios;
        public $app_windows;

        public $widget_title;

        public $mean;
        public $eval_data = array();
        public $pros = array();
        public $cons = array();
        public $offer = array();
        public $mobile_apps = array();

        public function __construct($name, $id)
        {
            $this->name = $name;
            $this->id = $id;
        }
    }
}
