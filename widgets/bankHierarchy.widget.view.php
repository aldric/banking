<div>
  <h3 class="widget-title">
    <span>Catalogue</span>
</h3>
  <div class="widget-custom">
      <?php
      global $post;
      $current_post_id = $post->ID;
      echo '<ul class="">'.printList($model, $current_post_id).'</ul>'; ?>
 </div>
</div>
<?php
//class="active"
  function printList($row, $p_id)
  {
      $active = $row->id == $p_id ? 'class="active"' : '';
      $out = '<li class=""><a href="'.$row->permalink.'" '.$active.'>'.$row->title.'</a>';

      if (count($row->children) > 0) {
          $out .= '<ul class="">';
          foreach ($row->children as $child) {
              $out .= printList($child, $p_id);
          }
          $out .= '</ul>';
      } else {
          $out .= '</li>';
      }
    //$out .= '</ul>';
    return $out;
  }
?>
