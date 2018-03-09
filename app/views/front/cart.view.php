<section class="row container bg-color">
    <h1 class="col-xs-12">Article de votre panier</h1>
    
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
                    <div class="captionProduct">
                        <p><strong>iPhone 8</strong> - Blanc - 250 Go</p>
                        <p class="grey">Garantie 2 ans</p>
                        <p class="grey">Référence : DHL06B2</p>
                    </div>
                </td>
                <td>
                    <p class="left">759,00€</p>
                </td>
                <td>
                    <p class="left">x 1</p>
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
                    <div class="captionProduct">
                        <p><strong>AirPod</strong></p>
                        <p class="grey">Garantie 1 an</p>
                        <p class="grey">Référence : BMW24R8</p>
                    </div>
                </td>
                <td>
                    <p class="left">250,00€</p>
                </td>
                <td>
                    <p class="left">x 2</p>
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

    <section class="col-xs-7"></section>
    <section class="col-xs-5 row line-height">
        <article class="col-xs-11 col-md-8 col-lg-6 text-right"><p>Sous-total du panier :</p></article>
        <article class="col-xs-12 col-md-4 col-lg-6"><p>1259,00€</p></article>
        <article class="col-xs-11 col-md-8 col-lg-6 text-right"><p>Livraison :</p></article>
        <article class="col-xs-12 col-md-4 col-lg-6"><p>00,00€</p></article>
        <article class="col-xs-11 col-md-8 col-lg-6 text-right"><p><strong>Total :</p></article>
        <article class="col-xs-12 col-md-4 col-lg-6"><p>1259,00€</strong></p></article>
    </section>

    <div class="col-xs-5 col-sm-5 col-md-7 col-lg-7"></div>
    <div class="col-xs-7 col-sm-7 col-md-5 col-lg-5 btn">
        <form action="/front/billing" method="post">
            <input class="btnPayer" type="submit" value="Payer" onclick="alert('Merci de votre commande')"/>
        </div>
    </form>
</section>
