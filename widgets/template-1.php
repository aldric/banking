 <div class="card">
 <div class="card-header">
    <div class="h2 text-center"> <?php /*echo $eval_title;*/ echo $data->name;?></div>
  </div>
   <div class="card-header alert alert-success" role="alert">
            <div class="c100 p<?php echo $data->mean; ?> center green">
                <span>
                    <?php echo $data->mean."%"; ?>
                </span>
                <div class="slice">
                    <div class="bar"></div>
                    <div class="fill"></div>
                </div>
            </div>
  </div>
  <div class="card-block">
    
     <?php foreach ($data->eval_data as $row) : ?>
       <div class="row">
        <div class="col py-2 text-center">
        <ul class="list-unstyled">
          <li><strong> <?php echo $row['label']; ?></strong></li>
          <li> <small>  <?php echo $row['description']; ?></small></li>
           </ul>
        </div>
        <div class="col-6">
         <ul class="rating" style="color: #ffa000;text-align:center;">
            <?php                         
                    $note = floor( ($row['note'] / 20) * 2) / 2;
                    while(0.5 <= $note) {
                        $note--;
                        echo '<li style="display: inline;"><i class="fa fa-star" ></i></li>';
                    }
                    if($note == 0.5) {
                        echo '<li style="display: inline;"><i class="fa fa-star-half-o"></i></li>';
                    }
                ?>
        </ul>
        </div>
     </div>
 <?php endforeach; ?>
  </div>
</div>
 