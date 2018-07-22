<section class="row gutters container">
    
    <section class="col-xxs-12 mainView gutters">
        <h1 class="is-third-color">Connexion administrateur</h1>
        <hr>

        <?php echo $_GET['validity'] ? '
        <section id="error" class="col-xxs-12 mainView gutters bg-is-main-color" style="margin-top: 0;">
            <h3 class="is-secondary-color">Identifiants invalides</h3>
        </section>
        ' : '' ; ?>

        <?php $this->addModal( "form", $aConfigs ) ?>
    </section>
        
</section>