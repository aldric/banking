<?php
if (! class_exists('BankBanner_Widget')) {
    class BankBanner_Widget extends WP_Widget
    {
        public function __construct()
        {
            parent::__construct(
                /*Base ID of your widget*/
                    'agt_bank_banner',
                    /*Widget name will appear in UI*/
                    __('AGT Bank Banner Widget', 'supermagpro-child'),
                    /*Widget description*/
                    array( 'description' => __('Automatic, random bank banner', 'supermagpro-child'), )
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

        public function widget($args, $instance)
        {
            $widget_id = "widget_" . $args["widget_id"];
            $banners = array();
            $post_object = get_field('associated_bank');
            if($post_object != null) {
                $id = $post_object->ID;
                if (have_rows('bank_banners', $id)) {
                    while (have_rows('bank_banners', $id)) {
                        the_row();
                        $img = get_sub_field('banner_image', $id);
                        $url = get_sub_field('banner_link', $id);
                        array_push($banners, new BannerData($img, $url));
                    }
                }
                if(count($banners) > 0 ) {
                    $key = array_rand($banners);
                    $banner = $banners[$key];
                    echo ViewRenderer::render('bankbanner.widget.html', $data);
                }
            }
        }
    }
     class BannerData {
        public $image;
        public $url;

        function __construct($image, $url)
        {
            $this->image = $image;
            $this->url = $url;
        }
    }
    add_action('widgets_init', function () {
        register_widget("BankBanner_Widget");
    });
}
