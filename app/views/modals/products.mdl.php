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

    <?php endforeach; ?>

        <strong class="col-xxs-12 is-third-color small-bandeau">
            Couleur :
        </strong>

        <select style="color:black;">
            <?php foreach ($aConfigs[1]['colors'] as $results): ?>
            <option><?php echo $results["name"]?></option>
            <?php endforeach; ?>
        </select>


        <strong class="col-xxs-12 is-third-color small-bandeau">
            Capacité :
        </strong>

        <select style="color:black;">
            <?php foreach ($aConfigs[2]['capacities'] as $results): ?>
                <option ><?php echo $results["capacity_number"]?> +<?php echo $results["additional_price"]?> €</option>
            <?php endforeach; ?>
        </select>
        
        <div class="box col-xxs-12">
            <div class="col-xxs-12">
                    <form action="/front/product/addComment?is=<?php echo $aConfigs[0]['products'][0]['id_product']?>" method='POST'>
                        <input class="input is-third-color" placeholder="Ton commentaire" size="60" name="Comment">
                        <input type="submit" value="Valider">
                    </form>
            </div>

            <div class="col-xxs-12">
                <?php foreach ($aConfigs[3]['comment'] as $results): ?>
                    <p class="is-third-color text-is-left"><?php echo $results["comment"]?></p>
                <?php endforeach; ?>
            </div>
        </div>
</section>