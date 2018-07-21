<section class="row container mainView gutters">
    <h1 class="is-third-color col-xxs-12"></h1>
    <hr>

    <?php foreach ($aConfigs[0]['products'] as $results): ?>
        <strong class="col-xxs-12 is-third-color small-bandeau">
            <?php echo $results["product_name"]?>
        </strong>

        <a
           class="col-xxs-12 col-xs-6 col-md-4 row container-product-box">
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

        <select>
            <?php foreach ($aConfigs[1]['colors'] as $results): ?>
            <option><?php echo $results["name"]?></option>
            <?php endforeach; ?>
        </select>


        <strong class="col-xxs-12 is-third-color small-bandeau">
            Capacité :
        </strong>

        <select>
            <?php foreach ($aConfigs[1]['capacities'] as $results): ?>
                <option><?php echo $results["capacity_number"]?></option>
            <?php endforeach; ?>
        </select>

</section>