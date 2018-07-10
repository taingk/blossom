<section class="frontImgHeader row">
    <article class="col-xxs-12 row">
        <h1 class="col-xxs-12"><?php echo $aConfig["title_page"]; ?></h1>
        <div class="col-xxs-12">
            <img class="img-is-max gutters" src="<?php echo $aConfig["banner"]; ?>">
        </div>
        <button class="more-info-bottom is-h-centered">En savoir plus</button>
    </article>
</section>

<section class="row">
    <article class="col-xss-12 col-md-6">
        <img class="img-is-max gutters" src="<?php echo $aConfig["left_image"]; ?>">
        <button class="more-info-left is-h-centered">En savoir plus</button>
    </article>
    <article class="col-xss-12 col-md-6">
        <img class="img-is-max gutters" src="<?php echo $aConfig["right_image"]; ?>">
        <button class="more-info-right is-h-centered">En savoir plus</button>
    </article>
    <article class="col-xss-12 col-md-12 row">
        <p class="col-xxs-12 col-xl-6 is-font-title is-black is-v-centered">
            <?php echo $aConfig["description_page"] ?>
        <img class="col-xxs-12 col-xl-6" src="<?php echo $aConfig["bottom_banner"]; ?>">
    </article>
</section>