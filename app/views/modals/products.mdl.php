
<section class="row container mainView gutters">
    <?php foreach ($aConfigs[0]['products'] as $results): ?>
    <h1 class="is-third-color col-xxs-12"><?php echo $results["product_name"]?></h1>
    <hr>

        <a
           class="col-xxs-12 col-xs-6 col-md-4 container-product-box">
            <div class="col-xxs-12 product-box bg-is-main-color">
                <label>Photo</label>
            </div>

        </a>
        <strong class="col-xxs-12 is-third-color small-bandeau">
            Description : <?php echo $results["description"]?>
        </strong>
        <strong class="col-xxs-12 is-third-color small-bandeau">
            Prix : <?php echo $results["price"]?> €
        </strong>


    <form action="product/add?is=<?php echo $results['id_product']?>" method="POST">
        <?php endforeach; ?>
        <strong class="col-xxs-12 is-third-color small-bandeau">
            Couleur :
        </strong>

        <select class="is-third-color" name="color">
            <?php foreach ($aConfigs[1]['colors'] as $results): ?>
            <option value="<?php echo $results["name"]?>"><?php echo $results["name"]?></option>
            <?php endforeach; ?>
        </select>

        <br>
        <strong class="col-xxs-12 is-third-color small-bandeau">
            Capacité :
        </strong>

        <select class="is-third-color"  name="capacity">
            <?php foreach ($aConfigs[2]['capacities'] as $results): ?>
                <option value="<?php echo $results['capacity_number']?>"><?php echo $results["capacity_number"]?> +<?php echo $results["additional_price"]?> €</option>
            <?php endforeach; ?>
        </select>
        <br>
        <input type="submit" value="Ajouter au panier">
    </form>

</section>

</head>
