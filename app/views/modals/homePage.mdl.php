<?php echo $_GET['confirm'] ? '<section class="row gutters">
    <section id="error" class="col-xxs-12 gutters bg-is-main-color" style="margin-top: 50px;">
        <h3 class="is-secondary-color">Vous avez confirmé votre email. Connectez-vous pour commencer à shopper !</h3>
    </section></section>
    ' : '' ; ?>

<?php echo $_GET['payment'] ? '<section class="row gutters">
    <section id="error" class="col-xxs-12 gutters bg-is-main-color" style="margin-top: 50px;">
        <h3 class="is-secondary-color">Le paiement est validé, un mail de confirmation vous a été envoyé.</h3>
    </section></section>
    ' : '' ; ?>

<section class="row">
    <section class="col-xxs-12 mainView">
        <?php echo $aConfigs["description_top_banner"] ? 
        '<h1 class="is-third-color">
            ' . $aConfigs["description_top_banner"] . ' 
        </h1>' : ''; ?>
        <img class="img-is-max" src="<?php echo $aConfigs["banner"] ? $aConfigs["banner"] : "public/img/iphoneX.jpeg" ; ?>">
    </section>
</section>

<section class="row">
    <section class="col-xxs-12 mainView gutters row">
        <?php echo $aConfigs["description_top_banner"] ? 
        '<h2 class="col-xxs-12 is-third-color">
            ' . $aConfigs["description_images"] . ' 
        </h2>' : ''; ?>
        <article class="col-xxs-12 col-md-6">
            <img class="img-is-max gutters" src="<?php echo $aConfigs["left_image"] ? $aConfigs["left_image"] : "public/img/samsung.jpg" ; ?>">
        </article>
        <article class="col-xxs-12 col-md-6">
            <img class="img-is-max gutters" src="<?php echo $aConfigs["right_image"] ? $aConfigs["right_image"] : "public/img/lg.jpg" ; ?>">
        </article>
    </section>
</section>

<section class="row">
    <section class="col-xxs-12 mainView">
        <?php echo $aConfigs["description_top_banner"] ? 
        '<h2 class="is-third-color">
            ' . $aConfigs["description_bottom_banner"] . ' 
        </h2>' : ''; ?>
        <img class="img-is-max" src="<?php echo $aConfigs["bottom_banner"] ? $aConfigs["bottom_banner"] : "public/img/galaxy2.jpg" ; ?>">
    </section>
</section>
