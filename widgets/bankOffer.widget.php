<?php

if (!class_exists('BankOffer_Widget')) {
    class BankOffer_Widget extends WP_Widget
    {
        public function __construct()
        {
            parent::__construct(
                /*Base ID of your widget*/
                'agt_bank_offer',
                    /*Widget name will appear in UI*/
                __('AGT Bank Offer Widget', 'supermagpro-child'),
                    /*Widget description*/
                array('description' => __('Bank Offer', 'supermagpro-child'))
            );
        }

        public function update($new_instance, $old_instance)
        {
            return $new_instance;
        }

        public function form($instance)
        {
            echo '<br />';
        }

        public function widget($args, $instance)
        {
            if ($args == null)
                return '';

            $widget_id = 'widget_' . $args['widget_id'];
            global $post;
            if ($post == null)
                return '';

            $banks = array();
            if (have_rows('offers', $widget_id)) {
                while (have_rows('offers', $widget_id)) {
                    the_row();
                    $bk = get_sub_field('bank', $widget_id);
                    $bank = array();
                    $bank['name'] = $bk->bank_name_label;
                    $bank['image'] = wp_get_attachment_image_src($bk->bank_icon)[0];
                    $bank['link'] = $bk->affiliate_link;
                    $bank['offer'] = $bk->welcome_offer;
                    array_push($banks, $bank);
                }
            }

            if ($banks != null) {
                $data = array(
                    'widget_title' => get_field('widget_ranking_title', $widget_id),
                    'banks' => $banks
                );
                echo ViewRenderer::render('bank-offer.widget.php', $data);
            }
        }
    }

    add_action('widgets_init', function () {
        register_widget('BankOffer_Widget');
    });
}
