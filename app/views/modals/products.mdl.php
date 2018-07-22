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
        <h3 class="is-secondary-color">Vous devez être connecter pour ajouter un produit au panier.</h3>
    </section>
    ' : '' ; ?>

    <article class="col-xxs-12 col-md-5 container-product-box">
        <div class="product-box bg-is-main-color">
            <label>Photo</label>
        </div>
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
        
        <form action="product/add?is=<?php echo $results['id_product']?>" method="POST" class="row">
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

<script>
onCapacity = () => {
    const subTotal = document.getElementById('sub-total');
    const price = document.getElementById('price').innerHTML;
    const selectBox = document.getElementById("capacity");
    const additional_price = selectBox.options[selectBox.selectedIndex].innerHTML;

    subTotal.innerHTML = parseInt(price);
    subTotal.innerHTML = parseInt(subTotal.innerHTML) + parseInt(additional_price.split('+')[1].slice(1, -1));
}

onCapacity();
</script>
