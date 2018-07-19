<section class="row gutters container">

    <section class="col-xxs-12 mainView gutters">
        <h1 class="is-third-color">Votre <span class="is-main-color">panier</span></h1>
        <hr>
        <section class="responsiveTable">
            <table>
                <tr>
                    <th></th>
                    <th>Produit</th>
                    <th>Prix unitaire</th>
                    <th>Prix total</th>
                </tr>

                <?php foreach ( $aCarts as $aCart ): ?>
                    <tr>
                        <td>
                            <img src="/public/img/airpodPanier.jpeg" class="images" alt="product_image">
                        </td>
                        <td>
                            <p class="is-third-color text-left responsive-center"><?php echo $aCart['category_name']; ?> : <?php echo $aCart['product_name']; ?></p>
                            <p class="is-third-color text-left responsive-center">Couleur : <?php echo $aCart['color_name']; ?></p>
                            <p class="is-third-color text-left responsive-center">Capacités : <?php echo $aCart['capacity_number']; ?>go</p>
                        </td>
                        <td>
                            <p class="is-third-color text-left responsive-center">Base : <?php echo $aCart["price"] ?>€</p>
                            <p class="is-third-color text-left responsive-center">Supplément : <?php echo $aCart["additional_price"] ?>€</p>
                        </td>
                        <td>
                            <p class="is-third-color text-left responsive-center"><?php echo $aCart["final_price"] ?>€</p>                            
                            <a href="/front/cart/delete?id=<?php echo $aCart['id_cart'] ?>">
                                <p class="is-main-color text-left responsive-center">Supprimer</p>
                            </a>                            
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </section>
    </section>

    <?php echo $_GET['validity'] ? '
    <section id="error" class="col-xxs-12 mainView gutters bg-is-main-color" style="margin-top: 0;">
        <h3 class="is-secondary-color">Vous devez définir une adresse de livraison ou avoir un produit dans le panier.</h3>
    </section>
    ' : '' ; ?>
    
    <section class="col-xxs-12 col-md-7 mainView is-h-centered row gutters" style="margin-top: 0; margin-left: 0">
        <h1 class="col-xxs-12 is-third-color">Adresse de livraison</h1>
        <hr>
        <p class="col-xxs-12 is-third-color text-is-left margin-zero">E-mail de contact : <strong><?php echo $aUsers['email'] ? $aUsers['email'] : "<em class='is-third-color'>Non définie</em>" ?></strong></p>
        <hr>
        <p class="col-xxs-12 is-third-color text-is-left margin-zero">Adresse : <strong><?php echo $aUsers['address'] ? $aUsers['address'] : "<em class='is-third-color'>Non définie</em>" ?></strong></p>
        <hr>
        <p class="col-xxs-12 is-third-color text-is-left margin-zero">Code postal : <strong><?php echo $aUsers['zip_code'] ? $aUsers['zip_code'] : "<em class='is-third-color'>Non défini</em>" ?></strong></p>
        <hr>
        <p class="col-xxs-12 is-third-color text-is-left margin-zero">Ville : <strong><?php echo $aUsers['city'] ? $aUsers['city'] : "<em class='is-third-color'>Non définie</em>" ?></strong></p>
        <hr>
        <a href="/back/users/update?id=<?php echo $_SESSION['user_id'] ?>" class="col-xxs-12 col-md-6 bg-is-main-color default-button is-h-centered" style="padding: 15px">
            <strong><em>Définir son adresse de livraison</em></strong>
        </a>
    </section>

    <section class="col-xxs-12 col-md-4 mainView is-h-centered row gutters" style="margin-top: 0; margin-right: 0">
        <h1 class="col-xxs-12 is-third-color">Total</h1>
        <hr>
        <p class="col-xxs-12 is-third-color text-is-left margin-zero">Sous-total : <strong><?php echo $iTotalPrice ? $iTotalPrice : "0" ?>€</strong></p>
        <hr>
        <p class="col-xxs-12 is-third-color text-is-left margin-zero">Livraison : <strong>Gratuite</strong></p>
        <hr>
        <h3 class="col-xxs-12 is-third-color text-is-left margin-zero">Total à régler : <?php echo $iTotalPrice ? $iTotalPrice : "0" ?>€</h3>
        <hr>
        <a href="<?php echo $aUsers['city'] && $aUsers['zip_code'] && $aUsers['address'] && !empty($aCarts) ? '/front/billing' : '/front/cart?validity=false#error'; ?>" class="col-xxs-12 bg-is-main-color default-button margin-zero" style="padding: 15px">
            <strong><em>Procéder au paiement</em></strong>
        </a>
    </section>
   
</section>
