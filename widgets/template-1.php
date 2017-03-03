 <div class="pricing animated swing">
        <div>
       <?php /*  <input value="<?php echo $data->mean; ?>" class="rating-loading" data-rating-xl /> */ ?>
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
        <div class='title'>
            <?php /*echo $eval_title;*/ echo $data->name;?>
        </div>
        <div class='content'>
            <ul>
                 <?php foreach ($data->eval_data as $row) : ?>
                <li>
                    <div class="row">
                        <div class="col-xs-12 col-md-6">
                            <div>
                                <strong>
                                    <?php echo $row['label']; ?>
                                </strong>
                            </div>
                            <div>
                                <small>
                                    <?php echo $row['description']; ?>
                                </small>
                            </div>

                        </div>
                        <div class="col-xs-12 col-md-6">
                            <input value="<?php echo $row['note']; ?>" class="rating-loading" data-rating />
                        </div>
                    </div>
                </li>
                <?php endforeach; ?>
            </ul>
            <a href='https://www.elegantthemes.com/cgi-bin/members/register.cgi?sub=16'>
                Visiter le site
            </a>
        </div>
    </div>
    <script>
    jQuery(document).on('ready', function () {
        jQuery('input[data-rating]').rating({ displayOnly: true, step: 1, min: 0, max: 100, size: 'xxs' });
        /*jQuery('input[data-rating-xl]').rating({ displayOnly: true, step: 1, min: 0, max: 100, size: 'md', stars : 4 });*/
    });
</script>