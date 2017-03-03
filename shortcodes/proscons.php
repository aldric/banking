<?php

//[proscons]
function proscons_func()
{
    $post_object = get_field('associated_bank');

    $pros = array();
    $cons = array();

    if ($post_object != null) {
        $id = $post_object->ID;
        $name = get_field('bank_name_label', $id);
        echo 'plop : '.$name;
        if(have_rows('points_forts', $id)) {
            while(have_rows('points_forts', $id)) {
                the_row();
                array_push($pros, get_sub_field('point_fort', $id));
            }
        }
        
        if(have_rows('points_faibles', $id)) {
            while(have_rows('points_faibles', $id)) {
                the_row();
                array_push($cons, get_sub_field('point_faible', $id));
           }
        }
    }
    $class = count($pros) > 0 && count($cons) > 0 ? 'col-md-6' : 'col-md-12';
    $out = "<div class=\"container-fluid\"><div class=\"row\">";

    $iterator1 = new ArrayIterator($pros);
    $iterator2 = new ArrayIterator($cons);
    $multiple = new MultipleIterator(MultipleIterator::MIT_NEED_ANY);
    $multiple->attachIterator($iterator1);
    $multiple->attachIterator($iterator2);
   
   if(count($pros) > 0 ) {
       $out .= '<div class="'.$class.' bg-success pc-tab"><h3>Points forts</h3></div>';
   }
   if(count($cons) > 0 ) {
       $out .= '<div class="'.$class.' bg-warning pc-tab"><h3>Points faibles</h3></div>';
   }

    foreach ($multiple as $value) {
        $key = $multiple->key();
        $pro = $key[0];
        $out .= "<div class=\"row\">";
        $out .= '<div class="'.$class.'">'.$value[0].'</div>';
        $out .= '<div class="'.$class.'">'.$value[1].'</div>';
        $out .= '</div>';
    }
    $out .= "</div></div>";
    return $out;
}

add_shortcode('proscons', 'proscons_func');

?>