<?php

if (! class_exists('Ranking_Widget')) {
    class Ranking_Widget extends WP_Widget
    {
        private $repository;
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
            $this->repository = new Bank_Repository();
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

        public function widget($args, $instance)
        {
            $widget_id = "widget_" . $args["widget_id"];
            $template = get_field('side_template', $widget_id);
            $post_object = get_field('associated_bank');
            if($post_object == null) return;
            $data = $this->repository->get_bank_data($post_object);
            $widget_title = get_field('widget_ranking_title', $widget_id).' '. $data->name;
            if ($data != null) {
                echo ViewRenderer::render('ranking.widget.html', $data);
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

    add_action('widgets_init', function () {
        register_widget("Ranking_Widget");
    });
}
