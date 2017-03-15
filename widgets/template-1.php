

 <div class="card">
    <img class="card-img-top" src="<?php echo $data->icon; ?>" alt="Boursorama icone">
   <div class="card-header alert alert-success" role="alert">
     <div class="progress">
       <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: <?php echo $data->mean; ?>%" aria-valuenow="<?php echo $data->mean; ?>" aria-valuemin="0" aria-valuemax="100"><?php echo $data->mean; ?>%</div>
    </div>
  </div>
  <div>
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
                   echo '<li style="display: inline;"><i class="fa fa-star" ></i></li>';
               }
               if ($note == 0.5) {
                   echo '<li style="display: inline;"><i class="fa fa-star-half-o "></i></li>';
               }
             ?>
            </ul>
            <dd><?php echo $row['description']; ?></dd>
          </ul>
        </div>
     </div>
 <?php endforeach; ?>
 <div class="d-flex flex-column">
   <div class="justify-content-center text-center">
     <dl>
       <dt class=" h5">Offre de bienvenue</dt>
       <div class="d-flex justify-content-center">  </div>
       <dd ><span><?php echo $data->welcome_offer; ?></</span</dd>
     </dl>
   </div>
  <div class="justify-content-center text-center">
    <dl>
      <dt class="h5">Revenu minimum</dt>
      <div class="d-flex justify-content-center">  </div>
      <dd ><span><?php echo $data->minimum_wadge; ?></</span</dd>
    </dl>
  </div>
  <div class="justify-content-center text-center">
    <dl>
      <dt class=" h5">Carte de crédit</dt>
      <dd ><span><?php echo $data->credit_card; ?></</span</dd>
    </dl>
  </div>
    <div class="card-block ">
      <h2 class="card-title">Services disponibles</h2>
      <div class=" <?php echo $this->get_bg($data->saving_account); ?>">
          <div class="h6"><?php echo $this->get_text($data->saving_account, 'Compte courant') ?></div>
      </div>
      <div class=" <?php echo $this->get_bg($data->young_offer); ?>">
        <div class="h6"><?php echo $this->get_text($data->young_offer, 'Offre jeune') ?></div>
      </div>
      <div class=" <?php echo $this->get_bg($data->prof_account); ?>">
        <div class="h6"><?php echo $this->get_text($data->prof_account, 'Compte professionnel') ?></div>
      </div>
      <div class=" <?php echo $this->get_bg($data->revolving_credit); ?>">
        <div class="h6"><?php echo $this->get_text($data->revolving_credit, 'Crédit à la consommation') ?></div>
      </div>
      <div class=" <?php echo $this->get_bg($data->mortgage); ?>">
        <div class="h6"><?php echo $this->get_text($data->mortgage, 'Crédit immobilier') ?></div>
      </div>
      <div class=" <?php echo $this->get_bg($data->credit_rebuy); ?>">
        <div class="h6"><?php echo $this->get_text($data->credit_rebuy, 'Rachat de crédit') ?></div>
      </div>
      <div class=" <?php echo $this->get_bg($data->life_insurance); ?>">
        <div class="h6"><?php echo $this->get_text($data->life_insurance, 'Assurance vie') ?></div>
      </div>
      <div class=" <?php echo $this->get_bg($data->car_insurance); ?>">
        <div class="h6"><?php echo $this->get_text($data->car_insurance, 'Assurance voiture') ?></div>
      </div>
      <div class=" <?php echo $this->get_bg($data->home_insurance); ?>">
        <div class="h6"><?php echo $this->get_text($data->home_insurance, 'Assurance habitation') ?></div>
      </div>
      <div class="p2 justify-content-center <?php echo $this->get_bg($data->other_insurance); ?>">
        <div class="h6"><?php echo $this->get_text($data->other_insurance, 'Autres Assurances') ?></div>
      </div>
      <div class="p2 justify-content-center <?php echo $this->get_bg($data->stock); ?>">
        <div class="h6"><?php echo $this->get_text($data->stock, 'Bourse') ?></div>
      </div>
        <a href="<?php echo $data->review_link; ?>" class="btn btn-success btn-lg btn-block">Voir la revue détaillée</a>
    </div>
</div>
  </div>
</div>
