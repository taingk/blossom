<section class="row gutters container">
    <section class="col-xxs-12 mainView gutters row">
        <h1 class="is-third-color is-h-centered">Votre <span class="is-main-color">profil</span></h1>
        <hr>
        <p class="col-xxs-12 is-third-color text-is-left margin-zero">Nom et prénom : <strong><?php echo "<em class='is-third-color'>" . $aUsers['lastname'] . " " . $aUsers['firstname'] . "</em>" ?></strong></p>
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
        <hr>
        <a href="/front/user/update" class="col-xxs-12 col-md-4 bg-is-main-color small-bandeau is-h-centered">
            Modifier son adresse de livraison
        </a>
        <?php echo $aUsers['rights'] ? '<a href="/back" class="col-xxs-12 col-md-4 bg-is-main-color small-bandeau is-h-centered">
            Se rendre sur le back-office
            </a>' : '' ?>
    </section>

      <section class="col-xxs-12 mainView gutters" style="margin-top: 0; margin-left: 0">
        <h1 class="col-xxs-12 is-third-color">Commandes <span class="is-main-color">effectuées</span></h1>
        <hr>
        <?php foreach ( $aOrders as $aOrder ): ?>
          <p class="col-xxs-12 is-third-color text-is-left margin-zero">ID : <strong><?php echo "<em class='is-third-color'>" . $aOrder['id_order'] . "</em>" ?></strong></p>
          <p class="col-xxs-12 is-third-color text-is-left margin-zero">Date d'insertion : <strong><?php echo $aOrder['date_inserted'] ? "<em class='is-third-color'>" . $aOrder['date_inserted'] . "</em>" : "<em class='is-third-color'>Non défini</em>" ?></strong></p>
          <p class="col-xxs-12 is-third-color text-is-left margin-zero">Numéro de commande : <strong><?php echo $aOrder['tracking_number'] ? "<em class='is-third-color'>" . $aOrder['tracking_number'] . "</em>" : "<em class='is-third-color'>Non définie</em>" ?></strong></p>
          <p class="col-xxs-12 is-third-color text-is-left margin-zero">Status : <strong><?php echo $aOrder['status'] ? "<em class='is-third-color'>" . $aOrder['status'] . "</em>" : "<em class='is-third-color'>Non défini</em>" ?></strong></p>
          <p class="col-xxs-12 is-third-color text-is-left margin-zero">Mis à jour : <strong><?php echo $aOrder['date_updated'] ? "<em class='is-third-color'>" . $aOrder['date_updated'] . "</em>" : "<em class='is-third-color'>Non défini</em>" ?></strong></p>
          <hr>
        <?php endforeach; ?>
    </section>
</section>
