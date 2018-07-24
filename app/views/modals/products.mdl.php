<section class="row container mainView gutters">
    <?php foreach ($aConfigs[0]['products'] as $results): ?>
    <h1 class="is-third-color col-xxs-12"><?php echo $results["product_name"]?></h1>
    <hr>

    <?php echo $_GET['validity'] ? '
    <section id="error" class="col-xxs-12 mainView gutters bg-is-main-color" style="margin-top: 0;">
        <h3 class="is-secondary-color">Ce produit n\'est plus disponible.</h3>
    </section>
    ' : '' ; ?>

    <?php echo $_GET['connection'] ? '
    <section id="error" class="col-xxs-12 mainView gutters bg-is-main-color" style="margin-top: 0;">
        <h3 class="is-secondary-color">Vous devez être connecter pour commenter ou ajouter un produit au panier.</h3>
    </section>
    ' : '' ; ?>

    <article class="col-xxs-12 col-md-5 row container-product-box">
        <?php foreach ($aConfigs[4]['images'] as $aImages ): ?>
            <img src="<?php echo $aImages['path'] ?>" alt="category product" class="first-product-image">
        <?php endforeach; ?>
    </article>

    <article class="col-xxs-12 col-md-7 is-third-color gutters text-is-left">
        <strong class="is-third-color small-bandeau">
            Description :
        </strong>
        <p class="is-third-color text-is-justified small-bandeau">
            <?php echo $results["description"]?>
        </p>
        <hr>

        <strong class="is-third-color small-bandeau">
            Prix :
        </strong>
            <span id="price" class="is-third-color"><?php echo $results["price"]?></span>€
        <hr>
        
        <form action="/front/product/add?is=<?php echo $results['id_product']?>" method="POST" class="row">
            <strong class="is-third-color small-bandeau text-is-left">
                Couleur :
            </strong>
            <select class="is-third-color small-bandeau" name="color">
                <?php foreach ($aConfigs[1]['colors'] as $results): ?>
                <option class="is-third-color" value="<?php echo $results["name"]?>"><?php echo $results["name"]?></option>
                <?php endforeach; ?>
            </select>
            <hr>

            <strong class="is-third-color small-bandeau text-is-left">
                Capacité :
            </strong>
            <select class="is-third-color small-bandeau" id="capacity" onchange="onCapacity()" name="capacity">
                <?php foreach ($aConfigs[2]['capacities'] as $results): ?>
                    <option class="is-third-color" value="<?php echo $results['capacity_number']?>"><?php echo $results["capacity_number"]?>go + <?php echo $results["additional_price"]?>€</option>
                <?php endforeach; ?>
            </select>
            <hr>

            <strong class="col-xxs-12 is-third-color text-is-right small-bandeau">
                Sous-total : <span id="sub-total" class="is-third-color"></span>€
            </strong>

            <input class="col-xxs-12" type="submit" value="Ajouter au panier">
        </form>

    </article>
    <?php endforeach; ?>
  
</section>

<section class="row container mainView gutters">
    <h1 class="is-third-color col-xxs-12">Espace commentaires</h1>
    <hr>

    <?php echo $_GET['comment'] ? '
    <section id="error" class="col-xxs-12 mainView gutters bg-is-main-color" style="margin-top: 0;">
        <h3 class="is-secondary-color">Votre commentaire est posté. Il est en attente de validation par le modérateur.</h3>
    </section>
    ' : '' ; ?>

    <form action="/front/product/addComment?is=<?php echo $aConfigs[0]['products'][0]['id_product']?>" class="row col-xxs-12" method="POST">
        <input id="comment" class="is-third-color col-xxs-12 small-bandeau" placeholder="Votre commentaire" name="comment">
        <input class="col-xxs-12 col-md-3 is-h-centered" type="submit" value="Envoyer un commentaire">
    </form>

    <?php foreach ($aConfigs[3]['comment'] as $results): ?>
    <hr>
    <div class="col-xxs-12">
        <p class="is-third-color text-is-justified"><?php echo 'Commenté(e) par ' . $results["user"]["firstname"] . ' ' . $results["user"]["lastname"] . ' le ' . $results["date_inserted"] ?> :</p>
        <p class="is-third-color text-is-justified"><?php echo $results["comment"]?></p>
    </div>
    <?php endforeach; ?>
</section>

<script>
onCapacity = () => {
    const subTotal = document.getElementById('sub-total');
    const price = document.getElementById('price').innerHTML;
    const selectBox = document.getElementById('capacity');

    subTotal.innerHTML = parseInt(price);

    if ( selectBox.options[selectBox.selectedIndex] ) {
        const additional_price = selectBox.options[selectBox.selectedIndex].innerHTML;
        subTotal.innerHTML = parseInt(subTotal.innerHTML) + parseInt(additional_price.split('+')[1].slice(1, -1));
    }
}

onCapacity();
</script>
