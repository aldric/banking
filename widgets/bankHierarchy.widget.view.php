<aside>
<div class="widget-catalogue">
  <h3 class="widget-title">
    <span>Catalogue</span>
  </h3>
  <div class="widget-custom">
      <?php
      global $post;
      $current_post_id = $post->ID;
      echo '<ul>'.printList($model, $current_post_id).'</ul>'; ?>
 </div>
</div>
<?php
//class="active"
  function printList($row, $p_id)
  {
      $is_active = $row->id == $p_id;
      $active = $is_active ? 'class="active"' : '';
      $link = $is_active ? 'javascript:return false;' : $row->permalink;
      $out = '<li class=""><a href="'.$link.'" '.$active.'>'.$row->title.'</a>';

      if (count($row->children) > 0) {
          $out .= '<ul>';
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
</aside>
