<section class="row container mainView box-has-shadow">
    <h1 class="col-xxs-12">Votre panier</h1>
    
    <hr>



    <section class="responsiveTable">
        <table>
            <tr>
                <th></th>
                <th>Produit</th>
                <th>Prix unitaire</th>
                <th>Quantité</th>
                <th>Prix total</th>
            </tr>

            <?php foreach ($products as $results): ?>
            <tr>
                <td>
                    <figure>
                        <img src="/public/img/airpodPanier.jpeg" class="PanierImg" alt="airphone" title="...">
                    </figure>
                </td>
                <td>
                    <div class="captionProduct responsive-center">
                        <p><strong><?php echo $results["product_name"]?></strong></p>
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

    <hr>

    <section class="col-xxs-12 row">
        <article class="col-xs-4 col-md-6"></article>
        <article class="col-xxs-7 col-xs-6 col-md-4 text-is-right"><p class="is-grey">Sous-total du panier :</p></article>
        <article class="col-xxs-5 col-xs-2"><p class="is-grey">1259,00€</p></article>
        <article class="col-xs-4 col-md-6"></article>
        <article class="col-xxs-7 col-xs-6 col-md-4 text-is-right"><p class="is-grey">Livraison :</p></article>
        <article class="col-xxs-5 col-xs-2"><p class="is-grey">00,00€</p></article>
        <article class="col-xs-4 col-md-6"></article>
        <article class="col-xxs-7 col-xs-6 col-md-4 text-is-right"><p><strong>Total :</p></article>
        <article class="col-xxs-5 col-xs-2"><p>1259,00€</strong></p></article>
    </section>

    <div class="col-xs-5 col-md-7"></div>
    <div class="col-xxs-12 col-xs-7 col-md-5 btn text-is-right">
        <form action="/front/billing" method="post">
            <input class="btnPayer" type="submit" value="Payer" onclick="alert('Merci de votre commande')"/>
        </div>
    </form>
</section>
