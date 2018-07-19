<section class="row">
    <section class="col-xxs-12 mainView">
        <h1 class="is-third-color">
            <?php echo $aConfigs["description_top_banner"]; ?>
        </h1>
        <img class="img-is-max" src="<?php echo $aConfigs["banner"] ? $aConfigs["banner"] : "public/img/iphoneX.jpeg" ; ?>">
    </section>
</section>

<section class="row">
    <section class="col-xxs-12 mainView gutters row">
        <h2 class="col-xxs-12 is-third-color">
            <?php echo $aConfigs["description_images"] ?>
        </h2>
        <article class="col-xxs-12 col-md-6">
            <img class="img-is-max gutters" src="<?php echo $aConfigs["left_image"] ? $aConfigs["left_image"] : "public/img/samsung.jpg" ; ?>">
        </article>
        <article class="col-xxs-12 col-md-6">
            <img class="img-is-max gutters" src="<?php echo $aConfigs["right_image"] ? $aConfigs["right_image"] : "public/img/lg.jpg" ; ?>">
        </article>
    </section>
</section>

<section class="row">
    <section class="col-xxs-12 mainView row">
        <h2 class="col-xxs-12 is-third-color">
            <?php echo $aConfigs["description_bottom_banner"] ?>
        </h2>
        <img class="img-is-max" src="<?php echo $aConfigs["bottom_banner"] ? $aConfigs["bottom_banner"] : "public/img/galaxy2.jpg" ; ?>">
    </section>
</section>
