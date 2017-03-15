



 <div class="card">
 <!-- div class="card-header">
    <div class="h2 text-center"> <?phpecho $data->name;?></div>
  </div -->
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
       <div class="d-flex flex-column">
        <div class="text-center">

          <dl>
            <dt class="h5"><?php echo $row['label']; ?></dt>
            <ul class="rating" style="color: #ffa000;text-align:center;">
             <?php
               $note = floor(($row['note'] / 20) * 2) / 2;
               while (0.5 <= $note) {
                   $note--;
                   echo '<li style="display: inline;"><i class="fa fa-star fa-2x" ></i></li>';
               }
               if ($note == 0.5) {
                   echo '<li style="display: inline;"><i class="fa fa-star-half-o fa-2x"></i></li>';
               }
             ?>
            </ul>
            <dd><?php echo $row['description']; ?></dd>
          </ul>
        </div>
     </div>
 <?php endforeach; ?>
 <div class="d-flex flex-column">
   <div class="d-flex justify-content-center text-center">
     <dl>
       <dt class=" h5">Offre de bienvenue</dt>
       <div class="d-flex justify-content-center">  </div>
       <dd ><span><?php echo $data->welcome_offer; ?></</span</dd>
     </dl>
   </div>
  <div class="d-flex justify-content-center text-center">
    <dl>
      <dt class=" h5">Revenu minimum</dt>
      <div class="d-flex justify-content-center">  </div>
      <dd ><span><?php echo $data->minimum_wadge; ?></</span</dd>
    </dl>
  </div>
  <div class="d-flex justify-content-center text-center">
    <dl>
      <dt class=" h5">Carte de crédit</dt>
      <dd ><span><?php echo $data->credit_card; ?></</span</dd>
    </dl>
  </div>
  <div class="d-flex ">
    <div class="flex-row">
      <div class="justify-content-start">Offre jeune</div>
      <div class="justify-content-end" style="color:<?php echo $this->get_bgcolor($data->young_offer); ?>"><span class="<?php echo $this->get_icon($data->young_offer); ?>"></span></div>
    </div>
  </div>
  <div class="d-flex justify-content-center text-center">
    <dl class="row">
      <dt class="col-sm-9 h5  dflex align-self-center ">Compte professionnel</dt>
      <dd class="col-sm-3  dflex align-self-center " style="color:<?php echo $this->get_bgcolor($data->prof_account); ?>"><span class="<?php echo $this->get_icon($data->prof_account); ?>"></span></dd>
    </dl>
  </div>
  <div class="d-flex justify-content-center">Flex item 1</div>
  <div class="d-flex justify-content-center">Flex item 1</div>
  <div class="d-flex justify-content-center">Flex item 1</div>
  <div class="d-flex justify-content-center">Flex item 1</div>
  <div class="d-flex justify-content-center">Flex item 1</div>
  <div class="d-flex justify-content-center">Flex item 1</div>
  <div class="d-flex justify-content-center">Flex item 1</div>
  <div class="d-flex justify-content-center">Flex item 1</div>

</div>
  </div>
</div>
