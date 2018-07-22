<section class="row gutters container">

    <section class="col-xxs-12 mainView gutters">
        <h1 class="is-third-color">Votre <span class="is-main-color">profil</span></h1>
        <hr>
        <p class="col-xxs-12 is-third-color text-is-left margin-zero">Nom/Prénom : <strong><?php echo "<em class='is-third-color'>" . $aUsers['firstname'] . " " . $aUsers['lastname'] . "</em>" ?></strong></p>
        <hr>
        <p class="col-xxs-12 is-third-color text-is-left margin-zero">Adresse email : <strong><?php echo $aUsers['email'] ? "<em class='is-third-color'>" . $aUsers['email'] . "</em>" : "<em class='is-third-color'>Non définie</em>" ?></strong></p>
        <hr>
        <p class="col-xxs-12 is-third-color text-is-left margin-zero">Adresse postale : <strong><?php echo $aUsers['address'] ? "<em class='is-third-color'>" . $aUsers['address'] . "</em>" : "<em class='is-third-color'>Non défini</em>" ?></strong></p>
        <hr>
        <p class="col-xxs-12 is-third-color text-is-left margin-zero">Code postal : <strong><?php echo $aUsers['zip_code'] ? "<em class='is-third-color'>" . $aUsers['zip_code'] . "</em>" : "<em class='is-third-color'>Non défini</em>" ?></strong></p>
        <hr>
        <p class="col-xxs-12 is-third-color text-is-left margin-zero">Ville : <strong><?php echo $aUsers['city'] ? "<em class='is-third-color'>" . $aUsers['city'] . "</em>" : "<em class='is-third-color'>Non définie</em>" ?></strong></p>
        <hr>
        <p class="col-xxs-12 is-third-color text-is-left margin-zero">Date d'inscription : <strong><?php echo $aUsers['date_inserted'] ? "<em class='is-third-color'>" . $aUsers['date_inserted'] . "</em>" : "<em class='is-third-color'>Non définie</em>" ?></strong></p>
        <button class="col-xxs-12 bg-is-main-color default-button">
            Modifier le profil
        </button>
    </section>

    <section class="col-xxs-12 mainView gutters" style="margin-top: 0; margin-left: 0">
        <h1 class="col-xxs-12 is-third-color">Commandes effecutées</h1>
        <hr>
        <p class="col-xxs-12 is-third-color text-is-left margin-zero">E-mail de contact : <strong><?php echo $aUsers['email'] ?></strong></p>
        <hr>
        <p class="col-xxs-12 is-third-color text-is-left margin-zero">Adresse : <strong><?php echo $aUsers['address'] ? $aUsers['address'] : "<em class='is-third-color'>Non définie</em>" ?></strong></p>
        <hr>
        <p class="col-xxs-12 is-third-color text-is-left margin-zero">Code postal : <strong><?php echo $aUsers['postal'] ? $aUsers['postal'] : "<em class='is-third-color'>Non défini</em>" ?></strong></p>
        <hr>
        <p class="col-xxs-12 is-third-color text-is-left margin-zero">Ville : <strong><?php echo $aUsers['city'] ? $aUsers['city'] : "<em class='is-third-color'>Non définie</em>" ?></strong></p>
    </section>
</section>
