<section class="row gutters">
    <section class="col-xxs-8 mainView gutters">
        <h1 class="col-xxs-12">Votre <span class="is-pink">panier</span></h1>
        <hr>
        <section class="responsiveTable">
            <table>
                <tr>
                    <th></th>
                    <th>Référence</th>
                    <th>Produit</th>
                    <th>Prix unitaire</th>
                    <th>Quantité</th>
                    <th>Prix total</th>
                </tr>

                <?php foreach ($cart as $results): ?>
                    <tr>
                        <td>
                            <figure>
                                <img src="/public/img/airpodPanier.jpeg" class="PanierImg" alt="airphone" title="...">
                            </figure>
                        </td>
                        <td>
                            <span class="is-black">Commande numéro: <?php echo $results['orders_id_order']; ?></span>
                        </td>
                        <td>
                            <div class="captionProduct responsive-center">
                                <p><strong><?php echo $results['products_id_product']; ?></strong></p>
                                <p class="is-grey">N° réf: BMW24R8</p>
                            </div>
                        </td>
                        <td>
                            <p class="text-is-left is-grey"><?php echo $results["price"] ?></p>
                        </td>
                        <td>
                            <p class="text-is-left is-grey"><?php echo $results["quantity"] ?></p>
                        </td>
                        <td>
                            <div class="text-is-left">
                                <p><strong><?php echo $results["price"]*$results["quantity"]; ?>€</strong></p>
                                <p class="is-pink">Supprimer</p>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </section>
    </section>

    <section class="col-xxs-3 mainView gutters is-h-centered">
        <h1>Total <span class="is-pink" style="font-size small;">(hors frais de port)</span></h1>
    </section>
</section>
