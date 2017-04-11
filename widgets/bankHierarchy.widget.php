<?php
if (! class_exists('BankHierarchy_Widget')) {
    class BankHierarchy_Widget extends WP_Widget
    {
        public function __construct()
        {
            parent::__construct(
                /*Base ID of your widget*/
                    'agt_bank_hierarchy',
                    /*Widget name will appear in UI*/
                    __('AGT Bank Hierarchy Widget', 'supermagpro-child'),
                    /*Widget description*/
                    array( 'description' => __('Bank Hierarchy', 'supermagpro-child'), )
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
            global $post;
            $current_id = $post->ID;
            $top = $post;
            $parents = get_post_ancestors($current_id);
           // echo 'parents :'.count($parents);
            if(count($parents) > 0) {
                $top_id = end($parents);
                $top = get_post($top_id);
            }
          //  echo 'type :'.get_post_type($top);
            $model =  $this->get_posts_children($top);
            if ( get_post_type($top) == 'banque_en_ligne' && $model != null && count($model->children) > 0) {
                echo ViewRenderer::render('bankHierarchy.widget.html', $model);
            }
        }

        public function get_posts_children($p)
        {
            $children = array();
            $id = $p->ID;
            $posts = get_posts(array( 'numberposts' => -1, 'post_status' => 'publish', 'post_type' => 'banque_en_ligne', 'post_parent' => $id, 'suppress_filters' => false, 'orderby' => 'menu_order' ));
            $parent = new HierarchicalData($id, get_the_title($p), get_permalink($p));
            foreach ($posts as $child) {
                array_push($parent->children, $this->get_posts_children($child));
            }
            return $parent;
        }
    }

    class HierarchicalData
    {
        public $id;
        public $title;
        public $permalink;
        public $children = array();

        public function __construct($id, $title, $permalink)
        {
            $this->id = $id;
            $this->title = $title;
            $this->permalink = $permalink;
        }
    }

    add_action('widgets_init', function () {
        register_widget("BankHierarchy_Widget");
    });
}
