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

                <?php foreach ($aCarts as $aCart): ?>
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

    <section class="col-xxs-12 col-lg-6 mainView is-h-centered" style="margin-top: 0">
        <h1 class="is-third-color">Total <span class="is-main-color" style="font-size: small;">(hors frais de port)</span></h1>
    </section>
    
</section>
