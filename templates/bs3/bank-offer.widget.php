
<aside class="bk-offer-widget">
<h3 class="widget-title"><span><?php echo  $data['widget_title']; ?></span></h3>
  <?php foreach ($data['banks'] as $bank) : ?>
    <div class="mat-card">
        <div class="bk-line">
          <div class="bk-img"><img src="<?php echo $bank['image']; ?>" /></div>
          <div>
            <div class="name"><?php echo $bank['name']; ?></div>
            <div class="offer"><?php echo $bank['offer']; ?></div>
          </div>
          <div class="bk-link"><a class="btn-mat cyan" href="<?php echo $bank['link']; ?>" role="button" target="_blank" rel="nofollow">Visiter</a></div>
        </div>
    </div>    
<?php endforeach; ?>
</aside>
