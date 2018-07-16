<section class="frontImgHeader row">
    <article class="small-bandeau">
        <h1 class="col-xxs-12">
            <?php echo $aConfigs["description_top_banner"]; ?>
        </h1>
        <div class="col-xxs-12">
            <img class="img-is-max gutters" src="<?php echo $aConfigs["banner"] ? $aConfigs["banner"] : "public/img/iphoneX.jpeg" ; ?>">
        </div>
    </article>
</section>

<section class="row">
    <h2 class="col-xxs-12 is-black">
        <?php echo $aConfigs["description_images"] ?>
    </h2>
    <article class="col-xxs-12 col-md-6">
        <img class="img-is-max gutters" src="<?php echo $aConfigs["left_image"] ? $aConfigs["left_image"] : "public/img/samsung.jpg" ; ?>">
    </article>
    <article class="col-xxs-12 col-md-6">
        <img class="img-is-max gutters" src="<?php echo $aConfigs["right_image"] ? $aConfigs["right_image"] : "public/img/lg.jpg" ; ?>">
    </article>
    <h2 class="col-xxs-12 is-black">
        <?php echo $aConfigs["description_bottom_banner"] ?>
    </h2>
    <img class="col-xxs-12" src="<?php echo $aConfigs["bottom_banner"] ? $aConfigs["bottom_banner"] : "public/img/galaxy2.jpg" ; ?>">
</section>