<section class="row container mainView box-shadow">
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
            <tr>
                <td>
                    <figure>
                        <img src="/public/img/iphone8Panier.jpg" class="PanierImg" alt="iPhone8" title="...">
                    </figure>
                </td>
                <td>
                    <div class="captionProduct responsive-center">
                        <p><strong>iPhone 8</strong></p>
                        <p class="grey"><strong>Blanc - 250 Go</strong></p>
                        <p class="grey">N° réf: DHL06B2</p>
                    </div>
                </td>
                <td>
                    <p class="left grey">759,00€</p>
                </td>
                <td>
                    <p class="left grey">x 1</p>
                </td>
                <td>
                    <div class="text-left">
                        <p><strong>759,00€</strong></p> 
                        <p class="rose">Supprimer</p>
                    </div>
                </td>            
            </tr>
            <tr>
                <td>
                    <figure>
                        <img src="/public/img/airpodPanier.jpeg" class="PanierImg" alt="airphone" title="...">
                    </figure>
                </td>
                <td>
                    <div class="captionProduct responsive-center">
                        <p><strong>AirPod</strong></p>
                        <p class="grey">N° réf: BMW24R8</p>
                    </div>
                </td>
                <td>
                    <p class="left grey">250,00€</p>
                </td>
                <td>
                    <p class="left grey">x 2</p>
                </td>
                <td>
                    <div class="text-left">
                        <p><strong>500,00€</strong></p> 
                        <p class="rose">Supprimer</p>
                    </div>
                </td>
            </tr>
        </table>
    </section>

    <hr>

    <section class="col-xxs-12 row line-height">
        <article class="col-xs-4 col-md-6"></article>
        <article class="col-xxs-7 col-xs-6 col-md-4 text-right"><p class="grey">Sous-total du panier :</p></article>
        <article class="col-xxs-5 col-xs-2"><p class="grey">1259,00€</p></article>
        <article class="col-xs-4 col-md-6"></article>
        <article class="col-xxs-7 col-xs-6 col-md-4 text-right"><p class="grey">Livraison :</p></article>
        <article class="col-xxs-5 col-xs-2"><p class="grey">00,00€</p></article>
        <article class="col-xs-4 col-md-6"></article>
        <article class="col-xxs-7 col-xs-6 col-md-4 text-right"><p><strong>Total :</p></article>
        <article class="col-xxs-5 col-xs-2"><p>1259,00€</strong></p></article>
    </section>

    <div class="col-xs-5 col-md-7"></div>
    <div class="col-xxs-12 col-sm-7 col-md-5 btn">
        <form action="/front/billing" method="post">
            <input class="btnPayer right" type="submit" value="Payer" onclick="alert('Merci de votre commande')"/>
        </div>
    </form>
</section>
