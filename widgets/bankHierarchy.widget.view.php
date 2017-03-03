<div>
  <h3 class="widget-title">
    <span>Catalogue 2do</span>
</h3>
  <div class="widget-custom">
      <?php 
      global $post;
      $current_post_id = $post->ID;
      echo '<nav class="bs-docs-sidebar"> <ul class="nav bs-docs-sidenav">'.printList($model, $current_post_id).'</ul></nav>'; ?>
 </div>
</div>
<?php 
//class="active"
  function printList($row, $p_id) {
    $active = $row->id == $p_id ? 'class="active"' : '';
    $out = '<li '.$active.'><a href="'.$row->permalink.'">'.$row->title.'</a>';

    if(count($row->children) > 0) {
      $out .= '<ul class="nav">';
      foreach($row->children as $child) {
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