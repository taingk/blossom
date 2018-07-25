<section class="row gutters container">
    
    <section class="col-xxs-12 mainView gutters">
        <h1 class="is-third-color">Connexion utilisateur</h1>
        <hr>
        <h3 class="is-third-color">Vous n'êtes pas encore membre ? <a class="is-third-color" href="/front/user/subscribe">Inscrivez-vous</a> !</h3>

        <?php echo $_GET['validity'] ? '
        <section id="error" class="col-xxs-12 mainView gutters bg-is-main-color" style="margin-top: 0;">
            <h3 class="is-secondary-color">Identifiants invalides.</h3>
        </section>
        ' : '' ; ?>

        <?php echo $_GET['status'] ? '
        <section id="error" class="col-xxs-12 mainView gutters bg-is-main-color" style="margin-top: 0;">
            <h3 class="is-secondary-color">Votre compte est inactif, vous pouvez l\'activer en confirmant votre email.</h3>
        </section>
        ' : '' ; ?>

        <?php $this->addModal( "form", $aConfigs ) ?>
    </section>
        
</section>